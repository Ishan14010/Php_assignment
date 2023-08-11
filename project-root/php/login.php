<?php
// Include the database connection configuration
include '../includes/db.inc.php';

// Start a new session or resume the existing session
session_start();

// Check if the HTTP request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the submitted login username and password from the POST data
    $loginUsername = $_POST["loginUsername"];
    $loginPassword = $_POST["loginPassword"];

    try {
        // Prepare and execute a database query to retrieve user data by username
        $stmt = $pdo->prepare("SELECT id, username, password FROM users WHERE username = ?");
        $stmt->execute([$loginUsername]);
        $user = $stmt->fetch();

        // Check if the user exists and the provided password matches the hashed password
        if ($user && password_verify($loginPassword, $user["password"])) {
            // Store the user's ID in the session for authentication
            $_SESSION["user_id"] = $user["id"];

            // Redirect to a success page after successful login
            header("Location: ../pages/success.html");
            exit;
        } else {
            // Redirect to the sign-in page if login credentials are incorrect
            header("Location: ../pages/signin.html");
            exit;
        }
    } catch (PDOException $e) {
        // If an exception (error) occurs during database operation, display an error message and terminate
        die("Error: " . $e->getMessage());
    }
} else {
    // Redirect to the sign-in page if the request method is not POST
    header("Location: ../pages/signin.html");
    exit;
}
?>
