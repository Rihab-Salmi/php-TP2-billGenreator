<?php
session_start();
require_once "database.php";
// Check if the ID_Client is set in the session
if(isset($_SESSION['ID_Client'])) {
    // Retrieve the ID_Client from the session
    $id_client = $_SESSION['ID_Client'];

    echo "ID_Client stored in session: " . $id_client;
}
?>