<?php
require 'db_connect.php'; // Use a separate file for database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['psw'];

    // Validate input
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Invalid email format.");
    }

    // Hash the password for security
    $passwordHash = password_hash($password, PASSWORD_DEFAULT);

    // Prepare and execute SQL query
    try {
        $stmt = $conn->prepare("INSERT INTO users (Email, Password) VALUES (:email, :password)");
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $passwordHash);
        $stmt->execute();

        echo "Account created successfully! <a href='signin.php'>Sign in here</a>";
    } catch (PDOException $e) {
        if ($e->getCode() == 23000) { // Duplicate email error
            echo "Email already registered. Try another one.";
        } else {
            echo "Error: " . $e->getMessage();
        }
    }
}
?>