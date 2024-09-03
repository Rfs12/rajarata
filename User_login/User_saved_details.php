<?php
include('db_connect.php');
// Get the form data
$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];

// Validate the inputs (basic example, add more validation as needed)
if (empty($username) || empty($email) || empty($password)) {
    die("All fields are required.");
}

// Hash the password
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Prepare and bind
$stmt = $conn->prepare("INSERT INTO user_signup (username, email, password) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $username, $email, $hashed_password);

// Execute the query
if ($stmt->execute()) {
    echo "Registration successful!with this: $email";
} else {
    echo "error" . $stmt->error;
}

// Close the statement and connection
$stmt->close();
$conn->close();
