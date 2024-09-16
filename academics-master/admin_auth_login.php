<?php
include('db_connect.php');

// Get the form data
$email = $_POST['email'];
$pass = $_POST['password'];

// Validate the inputs
if (empty($email) || empty($pass)) {
    echo "<script>
    alert('Email or Password cannot be empty');
    window.location.href = 'admin_login.php'; // Redirect to login.php
    </script>";
    exit(); // Stop further script execution
}

// Prepare and bind the SQL query
$stmt = $conn->prepare("SELECT password FROM admin_login WHERE email = ?");
if ($stmt === false) {
    echo "<script>
    alert('Database query error');
    window.location.href = 'admin_login.php';
    </script>";
    exit(); // Stop further script execution
}

$stmt->bind_param("s", $email);

// Execute the query
$stmt->execute();
$stmt->store_result();

// Check if the email exists
if ($stmt->num_rows === 0) {
    echo "<script>
    alert('Email or Password is wrong');
    window.location.href = 'admin_login.php'; // Redirect to login.php
    </script>";
    exit(); // Stop further script execution
}

// Bind result variable to fetch the hashed password
$stmt->bind_result($hashed_password);
$stmt->fetch();

// Verify the password
if (password_verify($pass, $hashed_password)) {
    // You can set session variables here if needed
    header("Location: admin_upload_news.php");
    exit();  
} else {
    echo "<script>
    alert('Email or Password is wrong');
    window.location.href = 'admin_login.php'; // Redirect to login.php
    </script>";
}

// Close the statement and connection
$stmt->close();
$conn->close();
?>
