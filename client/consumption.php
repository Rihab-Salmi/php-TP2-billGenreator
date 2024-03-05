<?php
session_start();
require_once "database.php";

if(isset($_SESSION['ID_Client']) && isset($_SESSION['username'])) {
    $id_client = $_SESSION['ID_Client'];
    $username = $_SESSION['username'];
}

if($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $month = $_POST['monthSelect'];
    $year = $_POST['yearSelect'];
    $consumption = $_POST['consumptionInput'];

    // Fetch the latest month and year from the Consumption table for the given client
    $latest_month_year_query = "SELECT MAX(year) AS max_year, MAX(month) AS max_month FROM Consumption WHERE ID_Client = $id_client";
    $latest_month_year_result = $conn->query($latest_month_year_query);
    $latest_month_year_row = $latest_month_year_result->fetch_assoc();
    $latest_year = $latest_month_year_row['max_year'];
    $latest_month = $latest_month_year_row['max_month'];

    // Check if the submitted month and year are valid
    if($year < $latest_year || ($year == $latest_year && $month <= $latest_month) || $year > date('Y') || ($year == date('Y') && $month > date('n'))) {
        echo "Date is invalid. Please enter a valid date.";
        exit;
    }

    // Proceed with file upload and database insertion
    if(isset($_FILES['meterImage'])) {
        $image = $_FILES['meterImage'];
        $imageName = $id_client . "_" . $month . "_" . $year . ".png"; // Constructing the image name
        
        $targetDir = "uploads/";
        $targetPath = $targetDir . $imageName;
        
        // Check if the file is a PNG
        $fileExtension = pathinfo($image['name'], PATHINFO_EXTENSION);
        if(strtolower($fileExtension) != "png") {
            echo "Only PNG files are allowed.";
            exit;
        }
        if(move_uploaded_file($image['tmp_name'], $targetPath)) {
            // Insert the image name into the database


            if ($month != 1) {
        // Fetch the consumption data for the previous month
        $previousMonth = $month - 1;
        $sql = "SELECT value FROM Consumption WHERE ID_Client = $id_client AND year = $year AND month = $previousMonth";
        $result = $conn->query($sql);
        
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $lastMonthValue = $row['value'];
            
            // If the current consumption is smaller than the last month's value, set anomaly to 1
            $anomaly = ($consumption < $lastMonthValue) ? 1 : 0;
        }
    } else {
        // For January, set anomaly to 0 since there's no previous month in the same year
        $anomaly = 0;
    }

     // Assuming you have the values of $id_client, $month, and $year already defined


    
if ($annomaly == 0){
      $sql = "INSERT INTO Consumption (ID_Client, date, month, year, value, image_meter, annomaly) 
                    VALUES ($id_client, NOW(), $month, $year, $consumption, '$imageName', 0)";
                      if($conn->query($sql) === TRUE) {
                echo "Record added successfully.";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }




$sql = "SELECT ID_Consumption FROM Consumption 
        WHERE ID_Client = $id_client 
        AND month = $month 
        AND year = $year";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Assuming that only one row will be returned for a given client, month, and year
    $row = $result->fetch_assoc();
    $id_consumption = $row['ID_Consumption'];
    echo "ID_Consumption: " . $id_consumption;
} else {
    echo "No consumption record found for the specified criteria.";
}








            $ht = ($consumption - $lastMonthValue)*5;
            $ttc = $ht*1.2;
      $sql = "INSERT INTO Facture (ID_Consumption, ID_client, priX_HT, priX_TTC) 	
                    VALUES ($id_consumption, $id_client, $ht, $ttc)";

                    if($conn->query($sql) === TRUE) {
                echo "Record facture added successfully.";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }




        } else {
            echo "Error uploading the file.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADD Consumption</title>
    <link rel="stylesheet" href="style/styles.css">
  
    <style>
        .consumption{
            background-color: #8693AB;
        }       
        .container{
             opacity: 0.7;
        }
        h2 {
            color: #333;
            text-align: center;
        }

        form {
            width: 100%;
        }

        label {
            margin-bottom: 5px;
            display: block;
            color: #333;
        }

        input[type="number"],
        select,
        input[type="file"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        button[type="submit"] {
            width: 15%;
            padding: 10px;
            background-color: green;
            border: none;
            color: #fff;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button[type="submit"]:hover {
            background-color: #8693AB;
        }
    </style>
</head>
<body>
    <?php include 'style/navbar.php'; ?>
    
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h2 class="mb-4">Add Consumption</h2>
            <form  action="consumption.php" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="monthSelect">Select Month:</label>
                    <select id="monthSelect" name="monthSelect" class="form-control" required>
                        <option value="">Months</option>
                        <option value="1">January</option>
                        <option value="2">February</option>
                        <option value="3">March</option>
                        <option value="4">April</option>
                        <option value="5">May</option>
                        <option value="6">June</option>
                        <option value="7">July</option>
                        <option value="8">August</option>
                        <option value="9">September</option>
                        <option value="10">October</option>
                        <option value="11">November</option>
                        <option value="12">December</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="yearSelect">Enter Year:</label>
                    <input type="number" id="yearSelect" name="yearSelect" class="form-control" placeholder="Enter Year" required>
                </div>
                <div class="form-group">
                    <label for="consumptionInput">Enter Consumption:</label>
                    <input type="number" id="consumptionInput" name="consumptionInput" class="form-control" placeholder="Enter Consumption" required>
                </div>
               <div class="form-group">
                    <label for="meterImage">Upload Meter Image (PNG only):</label>
                    <input type="file" id="meterImage" name="meterImage" class="form-control" accept=".png" required>
               </div>
                <button type="submit" class="btn btn-primary">Generate bill</button>
            </form>
        </div>
    </div>
</div>

</body>
</html>
