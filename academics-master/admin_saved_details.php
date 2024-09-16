<?php
include('db_connect.php');
// Get the form data
$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];

// Validate the inputs (basic example, add more validation as needed)
if (empty($username) || empty($email) || empty($password)) {
    echo "<script>
    alert('All fields are want to filled!');
  </script>";}

// Hash the password
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Prepare and bind
$stmt = $conn->prepare("INSERT INTO admin_login (username, email, password) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $username, $email, $hashed_password);

// Execute the query
if ($stmt->execute()) {
    echo "<script>
    alert('Your Account is created');
    window.location.href = 'admin_login.php'; 
  </script>";
  
   
} else {
    echo "<script>
    alert('Email or Password is wrong');
    window.location.href = 'admin_login.php'; 
  </script>";
}

// Close the statement and connection
$stmt->close();
$conn->close();
