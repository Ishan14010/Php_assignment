<?php
// Include the database connection configuration
include '../includes/db.inc.php';

// Check if the HTTP request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the submitted username and password from the POST data
    $username = $_POST["loginUsername"];
    $password = $_POST["loginPassword"];

    // Hash the password using the default password hashing algorithm
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    try {
        // Prepare and execute a database query to insert user data
        $stmt = $pdo->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
        $stmt->execute([$username, $hashedPassword]);

        // Redirect to a success page after successful user registration
        header("Location: ../pages/success.html");
        exit;
    } catch (PDOException $e) {
        // If an exception (error) occurs during database operation, display an error message and terminate
        die("Error: " . $e->getMessage());
    }
} else {
    // If the request method is not POST, redirect to a sign-in page
    header("Location: ../pages/signin.html");
    exit;
}
?>
