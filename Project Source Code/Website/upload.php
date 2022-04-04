<?php
ini_set('display_errors',1);
error_reporting(E_ALL);
if(isset($_POST['upload'])){
    $file = $_FILES['file'];
    
    $fileName =$_FILES['file']['name'];
    $fileTmpName =$_FILES['file']['tmp_name'];
    $fileSize =$_FILES['file']['size'];
    $fileError =$_FILES['file']['error'];
    $fileType =$_FILES['file']['type'];
    
    $fileExt = explode('.', $fileName);
    $fileActualExt = strtolower(end($fileExt));
    
    $allowed = ['jpg', 'jpeg', 'png', 'csv'];
    
    if (in_array($fileActualExt, $allowed)) {
        if ($fileError === 0){
            if ($fileSize < 1000000) {
                $fileNameNew = uniqid('', true).".".$fileActualExt;
                $fileDestination = 'RIDES/'.$fileNameNew;
                if(move_uploaded_file($fileTmpName, $fileDestination)){
                move_uploaded_file($fileTmpName, $fileDestination);
                header("Location: testupload.php?uploadsuccess?$fileDestination");
                }
                else
                {
                    echo "wtf man";
                }
                
                
            } else {
                echo("your file is too big");
            }
        }else {
           echo("there was an error uploading your file!");
        }
    }
    else{
        echo("you can't upload files of this type!");
        echo($fileActualExt);
        echo "this sth666666665";
        $yeet = in_array($fileAcutalExt, $allowed);
if ($yeet === TRUE) {
   echo 'The value is TRUE';
} else {
   echo 'The value is FALSE';
}
print_r($allowed);

    }
}
?>