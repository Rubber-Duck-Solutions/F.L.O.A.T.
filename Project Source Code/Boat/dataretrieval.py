# -*- coding: utf-8 -*-
# Carter Brezinski
# RDS - F.L.O.A.T. Capstone project
# File: DataRetrieval.py
# The purpose of this file is to grab water constant parameter data from our boat
# This program helps us achieve that by having a while loop that constantly
# calls upon each of the sensors connected to the Rasp Pi.

import csv
import time
import pynmea2
import Adafruit_ADS1x15
import serial
import board
import adafruit_dht
import psutil
import os
import busio
from time import sleep
from time import strftime

# port AMA0 directly interfaces with the GPS device.
# to retrieve data from it we need to call upon AMA0
port="/dev/ttyAMA0"
# to retrieve serial port data from the gps sensor, we need to declare
# the specific serial port.
ser=serial.Serial(port, baudrate=9600)
# The DHT11 sensor covers 
sensor = adafruit_dht.DHT11(board.D23)
# The analog digital converter values for turbidity are directly grabbed from the analog digital converter
adc = Adafruit_ADS1x15.ADS1115()

# Set gain to 1
GAIN = 1

# Begin consistently grabbing turbidity data
adc.start_adc(0, gain = GAIN)

with open('SensorTest04-06-2022.csv', mode='w') as entryfile:
    writer = csv.writer(entryfile)
    writer.writerow(["Current Time", "Latitude", "Longitude", "Turbidity (NTU)" , "Temperature (°C)" , "Humidity (%)"])
    #start = timer()
    while True:
            #read the line of serial port data
            received_data = ser.readline()
        
            #The data received by the GPS Module is in Bytes, hence the need to decode
            #it to utf-8 format.
            #If the first 6 characters of the byte retreived data is equal to our
            #longitude & latitude data callsign, as indicated by this website:
            #http://aprs.gids.nl/nmea/#gll
            #Then parse this data entry, and extract the longitude and latitude data
            #from it to be used in our csv data entry.
        
            if received_data[0:6].decode("utf-8") == "$GPGLL":
                msg = pynmea2.parse(received_data.decode('utf-8'))
                print(msg.latitude, msg.longitude)
                lat = msg.latitude
                lon = msg.longitude
                value = (((adc.get_last_result())/32767)*5)
                turbidity = 5 - value
                print("Turbidity is",turbidity,"NTU")
                try:
                    # Grab temperature and humidity from the sensor
                    # It isn't always 100% accurate, hence the try and exception cases.
                    temperature = sensor.temperature
                    humidity = sensor.humidity
                    print("Temp: {:.1f} *C \t Humidity: {}%".format(temperature, humidity))
                except RuntimeError as e:
                    # Reading wont always work! hence the error message
                    # Directly plugging in 0's into the original print statement as
                    # an indicator that the sensor wasn't behaving as intended.
                    print("Reading from DHT failure: ", e.args)
                    print("Temp: {:.1f} *C \t Humidity: {}%".format(0, 0))
                    temperature = 0
                    humidity = 0
                temp = temperature
                humid = humidity
        
            #For the sake of this program, it is important to say 'when' exactly
            #this sensor data was grabbed, for that we use the full datetime format
            #as it is necessary for our database entries.
        
                full_datetime = strftime("%I:%M:%S%p")
                print(full_datetime)
                writer.writerow([full_datetime, lat, lon, turbidity, temperature, humidity])

	    #The purpose of the sleep function for the case of this project
	    #is to allow for us to have a long enough gap between call statements
	    #to run/gather data.

	    #In the case of our project, we want to grab data about every 30s.
            #because of this, and the use of the baud rate, we do so with sleep(4)
            #This is because the baudrate is being grabbed at 9600 bits/s, and
            #about every 28s-32s we hit the GPGLL SerialPort0 
	    #If we wanted to grab data every 15s, we could do so with sleep(2)
            sleep(4)

