<?php
include('db_connect.php');

// Get the form data
$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];

// Validate the inputs
if (empty($username) || empty($email) || empty($password)) {
    echo "<script>
    alert('All fields are required!');
    window.location.href = 'register.php'; 
    </script>";
    exit;
}
if (!preg_match('/^[a-zA-Z0-9._%+-]+@tec\.rjt\.ac\.lk$/', $email)) {
  echo "<script>
  alert('Email must be in the format example@tec.rjt.ac.lk.');
  window.location.href = 'register.php'; 
  </script>";
  exit;
}
// Check if the email already exists
$stmt = $conn->prepare("SELECT email FROM user_signup WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    echo "<script>
    alert('This email is already registered. Please use a different email.');
    window.location.href = 'register.php'; 
    </script>";
    $stmt->close();
    $conn->close();
    exit;
}

// Hash the password
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Prepare and bind
$stmt = $conn->prepare("INSERT INTO user_signup (username, email, password) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $username, $email, $hashed_password);

// Execute the query
if ($stmt->execute()) {
    echo "<script>
    alert('Your account has been created successfully.');
    window.location.href = 'login.php'; 
    </script>";
} else {
    echo "<script>
    alert('An error occurred while creating your account. Please try again.');
    window.location.href = 'register.php'; 
    </script>";
}

// Close the statement and connection
$stmt->close();
$conn->close();
