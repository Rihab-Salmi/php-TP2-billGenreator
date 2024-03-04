<?php
session_start();
require_once "database.php";

if(isset($_SESSION['ID_Client']) && isset($_SESSION['username'])) {
    $id_client = $_SESSION['ID_Client'];
    $username = $_SESSION['username'];
}
?><!DOCTYPE html>
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
            <form method="post" action="verify_consumption.php">
                <div class="form-group">
                    <label for="monthSelect">Select Month:</label>
                    <select id="monthSelect" class="form-control" required>
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
                    <input type="number" id="yearSelect" class="form-control" placeholder="Enter Year" required>
                </div>
                <div class="form-group">
                    <label for="consumptionInput">Enter Consumption:</label>
                    <input type="number" id="consumptionInput" class="form-control" placeholder="Enter Consumption" required>
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
