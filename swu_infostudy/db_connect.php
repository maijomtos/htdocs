<?php
// db_connect.php
// Configuration for Database connection
$servername = "localhost";
$username = "root";   // Default XAMPP username
$password = "";       // Default XAMPP password
$dbname = "swu_infostudy";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Database Connection failed: " . $conn->connect_error);
}
?>
