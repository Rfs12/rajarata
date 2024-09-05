<?php
include('db_connect.php');
// Get the form data
$email = $_POST['email'];
$pass = $_POST['password'];

// Validate the inputs
if (empty($email) || empty($pass)) {
    echo "<script>
    alert('Email or Password is wrong');
    window.location.href = 'login.php'; // Redirect to login.php
  </script>";
}

// Prepare and bind
$stmt = $conn->prepare("SELECT password FROM user_signup WHERE email = ?");
$stmt->bind_param("s", $email);

// Execute the query
$stmt->execute();
$stmt->store_result();

// Check if the email exists
if ($stmt->num_rows === 0) {
}

// Bind result variable
$stmt->bind_result($hashed_password);
$stmt->fetch();

// Verify the password
if (password_verify($pass, $hashed_password)) {
    header("Location: index.php");
    exit();  
    // You can set session variables or redirect the user here
} else {
    echo "<script>
    alert('Email or Password is wrong');
    window.location.href = 'login.php'; // Redirect to login.php
  </script>";
}

// Close the statement and connection
$stmt->close();
$conn->close();
