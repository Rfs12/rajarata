<?php
// post_news.php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "rajarata_system";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Collect and sanitize form data
$title = $conn->real_escape_string($_POST['title']);
$content = $conn->real_escape_string($_POST['content']);
$created_at = date('Y-m-d H:i:s'); // Set the created_at automatically

// Handle file upload
if (isset($_FILES['image']) && $_FILES['image']['error'] == UPLOAD_ERR_OK) {
    $file_tmp = $_FILES['image']['tmp_name'];
    $file_name = basename($_FILES['image']['name']);
    $file_path = 'uploads/' . $file_name;

    // Ensure the upload directory exists
    if (!file_exists('uploads')) {
        mkdir('uploads', 0777, true);
    }

    if (move_uploaded_file($file_tmp, $file_path)) {
        $image = $file_name;
    } else {
        $image = null;
    }
} else {
    $image = null;
}

// Insert into database
$sql = "INSERT INTO academics_news (title, content, image, created_at) VALUES ('$title', '$content', '$image', '$created_at')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

