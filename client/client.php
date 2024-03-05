<?php
session_start();
require_once "database.php";

if(isset($_SESSION['ID_Client']) && isset($_SESSION['username'])) {
    $id_client = $_SESSION['ID_Client'];
    $username = $_SESSION['username'];

    $sql = "SELECT C.Month, C.year, F.priX_TTC, F.status_payment 
            FROM Facture F 
            JOIN Consumption C ON F.ID_Consumption = C.ID_Consumption
            WHERE F.ID_Client = $id_client";
            $result = $conn->query($sql);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Client Dashboard</title>
    <link rel="stylesheet" href="style/styles.css">
    <style>  
    .home{
            background-color: #8693AB;
        }
        </style>
</head>
<body>
    <?php include 'style/navbar.php'; ?>
<div class="container head">

<h1>Welcome Back, <?php echo $username ?></h1>
<p>manage your bill from your home, check all your previous bills here :</p>
</div>
    <div class="container">
        
        <div class="scroll-table">
        <table>
            <tr>
                <th>Month/Year</th>
                <th>Total price</th>
                <th>Payment status</th>
            </tr>
            <?php
            if ($result && $result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['Month'] . "/" . $row['year'] . "</td>";
                    echo "<td>" . $row['priX_TTC'] . "</td>";
                    echo "<td>" . ($row['status_payment'] ? 'Paid' : 'Unpaid') . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='3'>No invoices found for this client.</td></tr>";
            }
            ?>
        </table>
    </div>
    </div>
</body>
</html>
