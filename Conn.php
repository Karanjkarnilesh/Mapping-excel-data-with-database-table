<?php
// Database connection
$host = 'localhost';
$dbname = 'mapping';
$username = 'root';
$password = '';

try {
    // Create a new PDO instance
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    // Set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // If there's a connection error, show it
    die("Connection failed: " . $e->getMessage());
}
?>