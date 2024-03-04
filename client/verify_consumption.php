<?php
session_start();
require_once "database.php";

if(isset($_SESSION['ID_Client']) && isset($_SESSION['username'])) {
    $id_client = $_SESSION['ID_Client'];
    $username = $_SESSION['username'];
}
   
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        $month = $_POST['month'];
        $year = $_POST['year'];
        $consumption = $_POST['consumption'];
        echo $month;
        if(isset($_FILES['meterImage'])) {
            $image = $_FILES['meterImage'];
            //checking the extension png
            // $fileExtension = pathinfo($image['name'], PATHINFO_EXTENSION);
            // if(strtolower($fileExtension) != "png") {
            //     echo "Only PNG files are allowed.";
            //     exit;
            // }
    }
      $imagename = $id_client . "_" . $year . "_" . $month . ".png";
      $targetDirectory = "uploads/";
      $targetPath = $targetDirectory . $fileName;
}
?>
