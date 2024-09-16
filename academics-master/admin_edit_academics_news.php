<?php
include('db_connect.php');

// Initialize variables
$id = $title = $description = $image_path = "";
$editMode = false;

// Define the path to the uploads folder
$uploads_path = 'uploads/';

// Check if an ID is provided in the query string
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    
    // Fetch the news item from the database
    $query = "SELECT * FROM academics_news WHERE id = $id";
    $result = mysqli_query($conn, $query);
    
    if ($row = mysqli_fetch_assoc($result)) {
        $title = htmlspecialchars($row['title']);
        $description = htmlspecialchars($row['content']);
        $image_path = htmlspecialchars($row['image']);
        $editMode = true;
    } else {
        echo "<script>alert('News item not found.'); window.location.href='admin_academics_news.php';</script>";
        exit;
    }
}

// Handle news update
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'])) {
    $id = intval($_POST['update_id']);
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $news_image = $_FILES['news_image'];
    
    // Prepare the update query for title and description
    $update_query = "UPDATE academics_news SET title = '$title', content = '$description' WHERE id = $id";
    
    // Execute the update query
    if (mysqli_query($conn, $update_query)) {
        if ($news_image['size'] > 0) { // Check if a new image is uploaded
            $file_name = basename($news_image["name"]);
            $imageFileType = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
            $target_file = $uploads_path . uniqid() . '.' . $imageFileType;

            // Validate the uploaded image
            $uploadOk = 1;
            $check = getimagesize($news_image["tmp_name"]);
            if ($check === false) {
                echo "<script>alert('File is not an image.');</script>";
                $uploadOk = 0;
            }
            if ($news_image["size"] > 10 * 1024 * 1024) {
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
                    $update_query_image = "UPDATE academics_news SET image = '$target_file' WHERE id = $id";
                    if (mysqli_query($conn, $update_query_image)) {
                        echo "<script>alert('News updated successfully.'); window.location.href='admin_academics_news.php';</script>";
                    } else {
                        echo "<script>alert('Database error updating image.');</script>";
                    }
                } else {
                    echo "<script>alert('Sorry, there was an error uploading your file.');</script>";
                }
            }
        } else {
            echo "<script>alert('News updated successfully.'); window.location.href='admin_academics_news.php';</script>";
        }
    } else {
        echo "<script>alert('Database error.');</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit News</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h1>Edit News</h1>

    <?php if ($editMode): ?>
    <form action="admin_edit_academics_news.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="update_id" value="<?php echo $id; ?>">
        <div class="mb-3">
            <label for="title" class="form-label">Title:</label>
            <input type="text" name="title" id="title" class="form-control" value="<?php echo $title; ?>" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description:</label>
            <textarea name="description" id="description" class="form-control" rows="4" required><?php echo $description; ?></textarea>
        </div>
        <div class="mb-3">
            <label for="news_image" class="form-label">Select image to upload (optional):</label>
            <input type="file" name="news_image" id="news_image" class="form-control">
            <?php if (!empty($image_path)): ?>
                <p><img src="<?php echo $uploads_path . $image_path; ?>" alt="Current Image" class="img-fluid" style="max-width: 200px;"></p>
            <?php endif; ?>
        </div>
        <button type="submit" name="update" class="btn btn-primary">Update News</button>
    </form>
    <?php else: ?>
        <p>News item not found.</p>
    <?php endif; ?>
</div>
</body>
</html>
