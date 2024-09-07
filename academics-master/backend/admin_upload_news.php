<?php
include('db_connect.php');

// Handle news upload
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['news_image']) && isset($_POST['title']) && isset($_POST['description'])) {
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $news_image = $_FILES['news_image'];

    // Handle file upload
    if ($news_image['size'] > 0) { // Check if a file is uploaded
        $target_dir = "uploads/";
        $file_name = basename($news_image["name"]);
        $imageFileType = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
        $target_file = $target_dir . uniqid() . '.' . $imageFileType;

        $uploadOk = 1;

        // Check if image file is a valid image
        $check = getimagesize($news_image["tmp_name"]);
        if ($check === false) {
            echo "<script>alert('File is not an image.');</script>";
            $uploadOk = 0;
        }

        // Check file size
        if ($news_image["size"] > 500000) {
            echo "<script>alert('Sorry, your file is too large.');</script>";
            $uploadOk = 0;
        }

        // Allow certain file formats
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
            echo "<script>alert('Sorry, only JPG, JPEG, PNG & GIF files are allowed.');</script>";
            $uploadOk = 0;
        }

        if ($uploadOk == 0) {
            echo "<script>alert('Sorry, your file was not uploaded.');</script>";
        } else {
            if (move_uploaded_file($news_image["tmp_name"], $target_file)) {
                $insert_query = "INSERT INTO news (title, description, image_path, created_at) VALUES ('$title', '$description', '$target_file', NOW())";
                if (mysqli_query($conn, $insert_query)) {
                    echo "<script>alert('News uploaded successfully.');</script>";
                } else {
                    echo "<script>alert('Database error.');</script>";
                }
            } else {
                echo "<script>alert('Sorry, there was an error uploading your file.');</script>";
            }
        }
    } else {
        $insert_query = "INSERT INTO news (title, description, created_at) VALUES ('$title', '$description',  NOW())";
        if (mysqli_query($conn, $insert_query)) {
            echo "<script>alert('News uploaded successfully.');</script>";
        } else {
            echo "<script>alert('Database error.');</script>";
        }
    }
}

// Handle news deletion
if (isset($_GET['delete'])) {
    $delete_id = intval($_GET['delete']);
    $delete_query = "DELETE FROM news WHERE id = $delete_id";
    if (mysqli_query($conn, $delete_query)) {
        echo "<script>alert('News deleted successfully.');</script>";
    } else {
        echo "<script>alert('Database error.');</script>";
    }
}

// Handle news update
if (isset($_POST['update'])) {
    $update_id = intval($_POST['update_id']);
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $news_image = $_FILES['news_image'];

    // Prepare the update query for title and description
    $update_query = "UPDATE news SET title = '$title', description = '$description' WHERE id = $update_id";

    // Execute the update query
    if (mysqli_query($conn, $update_query)) {
        if ($news_image['size'] > 0) { // Check if a new image is uploaded
            $file_name = basename($news_image["name"]);
            $imageFileType = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
            $target_file = "uploads/" . uniqid() . '.' . $imageFileType;

            // Validate the uploaded image
            $uploadOk = 1;
            $check = getimagesize($news_image["tmp_name"]);
            if ($check === false) {
                echo "<script>alert('File is not an image.');</script>";
                $uploadOk = 0;
            }
            if ($news_image["size"] > 500000) {
                echo "<script>alert('Sorry, your file is too large.');</script>";
                $uploadOk = 0;
            }
            if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
                echo "<script>alert('Sorry, only JPG, JPEG, PNG & GIF files are allowed.');</script>";
                $uploadOk = 0;
            }
            if ($uploadOk == 0) {
                echo "<script>alert('Sorry, your file was not uploaded.');</script>";
            } else {
                // Move the uploaded file to the server
                if (move_uploaded_file($news_image["tmp_name"], $target_file)) {
                    // Update the image path in the database
                    $update_query_image = "UPDATE news SET image_path = '$target_file' WHERE id = $update_id";
                    if (mysqli_query($conn, $update_query_image)) {
                        echo "<script>alert('News updated successfully.');</script>";
                    } else {
                        echo "<script>alert('Database error updating image.');</script>";
                    }
                } else {
                    echo "<script>alert('Sorry, there was an error uploading your file.');</script>";
                }
            }
        } else {
            echo "<script>alert('News updated successfully.');</script>";
        }
    } else {
        echo "<script>alert('Database error.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Manage News</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container">
    <h1>Upload News</h1>
    <form action="admin_upload_news.php" method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="title" class="form-label">Title:</label>
            <input type="text" name="title" id="title" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description:</label>
            <textarea name="description" id="description" class="form-control" rows="4" required></textarea>
        </div>
        <div class="mb-3">
            <label for="news_image" class="form-label">Select image to upload:</label>
            <input type="file" name="news_image" id="news_image" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Upload News</button>
    </form>

    <h2 class="mt-5">Manage News</h2>
    <div class="container">
    <div class="row">
        <?php
        $result = mysqli_query($conn, "SELECT * FROM news ORDER BY created_at DESC");
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $id = $row['id'];
                $title = htmlspecialchars($row['title']);
                $description = htmlspecialchars($row['description']);
                $image_path = htmlspecialchars($row['image_path']);
                $created_at = date('F j, Y', strtotime($row['created_at']));
                echo '<div class="col-lg-4 col-md-6 mb-4">'; // Use Bootstrap grid classes to create columns
                echo '<div class="news-item">';
                echo '<h3>' . $title . '</h3>';
                if (!empty($image_path)) {
                    echo '<p><img src="' . $image_path . '" alt="Image" class="img-fluid" style="max-width: 20rem; height: 20rem;"></p>'; // Responsive image
                }
                echo '<p>' . $description . '</p>';
                echo '<p><small>' . $created_at . '</small></p>';
                echo '<a href="admin_edit_upload_news.php?id=' . $id . '" class="btn btn-warning"style="margin-right:1rem;">Edit</a>';
                echo '<a href="admin_upload_news.php?delete=' . $id . '" class="btn btn-danger">Delete</a>';
                echo '</div>';
                echo '</div>'; // Close the column div
            }
        } else {
            echo '<div class="col-12"><p>No news articles available.</p></div>';
        }
        ?>
    </div>
</div>

</div>
</body>
</html>
