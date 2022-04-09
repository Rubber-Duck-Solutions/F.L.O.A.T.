<?php
include './user_validation/login_validation.php'
?>
<!DOCTYPE html>
<html>
<head>
<?php    include './head.php'; ?>
<link rel="stylesheet" href="./aboutStyles.css">
  
  <title>About</title>
  
</head>
<body>
    <?php    include './navigationBar.php';?>
    
    
    <div class="container">
        <div class="row justify-content-center">
            <div class="title col-md-12 col-lg-10">
                <h2 class="mbr-section-title mbr-fonts-style align-center mb-4 display-2"><strong>About</strong></h2>
                
            </div>
            <p>A page dedicated on explaining parameters collected</p>
        </div>
    </div>
    <p class="section-break"></p>

    
    <h2 class="align-center">Parameters we are collecting</h2>
    <div class="container">
        <div class="row justify-content-center mt-4">
            <div class="detail-column-auto">
                <h3>Turbidity</h3>
            <hr>
            <p>Turbidity is the measurement of relative opacity of a liquid 
           due to suspended solids and other material floating in the liquid. 
           Materials such as clay, silt, algae and colored organic compounds 
           contribute to a liquid's turbidity. This characteristic is measured in 
           nephelometric turbidity units.  As pointed out by the 
           <a href="https://www.canada.ca/content/dam/canada/health-canada/migration/healthy-canadians/publications/healthy-living-vie-saine/water-recreational-recreative-eau/alt/pdf/water-recreational-recreative-eau-eng.pdf">Guidelines for Canadian Recreational Water Quality</a> 
           waters should be no higher than 50 NTU.
            </p>
            </div>

             <div class="detail-column-auto">
             <h3>Environmental Temperature</h3>
             <hr>
             <p>
            This is the ambient temperature of the environment around the body 
            of water. Environmental temperature directly affects the water 
            temperature. This in turn creates  different variables for certain 
            organisms and accumulation of different compounds in the water. 
             </p>
             </div>
            
                <div class="detail-column-auto">
                <h3>Relative Humidity</h3>
                <hr>
                 <p>
                 Humidity refers to the ratio of the amount of water vapor that 
                the air can hold at a specific temperature. Measured in percentage 
                this reading is compared to the maximum the air can hold. A higher 
                reading can limit the amount of evaporation that can occur in the 
                ecosystem.
              <br>
             <a href="https://www.worldatlas.com/articles/what-is-humidity-and-how-does-it-affect-life-on-earth.html">Read more here</a>
                 </p>
            </div>
        </div>    
    </div>
    <br>
    
    <h2 class="align-center">Future Parameters to collect</h2>
    <div class="container">
        <div class="row justify-content-center mt-4">
            <div class="detail-column-auto">
                <h3>pH level</h3>
                <hr>
                    <p>
                    A measurement of water acidity. This is measured from a numerical
                    scale from 0 to 14, lower levels indicates greater acidity and higher
                    levels indicating greater a more basic solution. The pH levels 
                    determines the solubility and biological availability a body of water
                    has. The <a href="https://www.canada.ca/content/dam/canada/health-canada/migration/healthy-canadians/publications/healthy-living-vie-saine/water-recreational-recreative-eau/alt/pdf/water-recreational-recreative-eau-eng.pdf">Guidelines for Canadian Recreational Water Quality</a> aims to 
                    keep recreational waters at a safe pH level of 5.0 - 9.0.
                    <br>
                    <a href="https://www.usgs.gov/special-topics/water-science-school/science/ph-and-water#overview">Read more here</a>
                    </p>
            </div>
            <div class="detail-column-auto">
                <h3>Cyanobacteria</h3>
                    <hr>    
                    <p>
                    This single-celled organism (also known as blue-green algae) can be 
                    found in nutrient-rich water. While harmless in certain levels 
                    Cyanobacteria can quickly overrun the body of water. Some cyanobacteria 
                    produce toxins called cyanotoxins which can negatively directly affect  
                    humans and animals. Cyanobacteria can cause harmful algal bloom that 
                    depletes the oxygen in the water suffocating fish and other animals in 
                    the water.
                    <br>
                    <a href="https://www.cdc.gov/habs/illness-symptoms-freshwater.html">Read more here</a> 
                    </p>
            </div>
        </div>  
    </div>
    <p class="section-break"></p>
    
    
    
    
</body>
</html>