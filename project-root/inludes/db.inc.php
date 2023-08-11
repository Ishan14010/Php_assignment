<?php
// Database connection parameters
$host = "localhost:3306";   // The host and port where the database is located
$dbname = "mydb_php";       // The name of the database you want to connect to
$username = "root";         // The username for accessing the database
$password = "1234";         // The password for the database user

try {
    // Create a new PDO (PHP Data Objects) instance for database connection
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);

    // Set PDO attributes to handle errors gracefully
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // If an exception (error) occurs during connection, display an error message and terminate
    die("Database connection failed: " . $e->getMessage());
}
?>
