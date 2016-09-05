<?php
if(!isset($_SESSION)) { 
        session_start(); 
    }
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dcwr";
global $conn; 
$conn = new mysqli($servername, $username, $password, $dbname); // Create connection
if ($conn->connect_error) { // Check connection
    die("Connection failed: " . $conn->connect_error);
}
?>