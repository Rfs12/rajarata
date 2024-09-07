<?php
// Include database connection
include 'db_connect.php';

// Handle form submissions for adding/editing
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check for required POST data
    if (!isset($_POST['title']) || !isset($_FILES['image_file']) || !isset($_FILES['video_file'])) {
        die('Title, image, or video file is missing.');
    }

    $id = isset($_POST['id']) ? intval($_POST['id']) : 0;
    $title = trim($_POST['title']);
    $video_file_path = ''; // Default to empty if no file uploaded

    // Handle image upload
    $image_path = '';
    if (isset($_FILES['image_file']) && $_FILES['image_file']['error'] == UPLOAD_ERR_OK) {
        $upload_dir = 'videos/';
        $allowed_image_types = ['image/jpeg', 'image/png', 'image/gif'];
        $image_type = $_FILES['image_file']['type'];
        $image_path = $upload_dir . basename($_FILES['image_file']['name']);

        // Check if the file type is allowed
        if (in_array($image_type, $allowed_image_types)) {
            if (move_uploaded_file($_FILES['image_file']['tmp_name'], $image_path)) {
                echo "<script>alert('Image uploaded successfully');</script>";
            } else {
                echo "<script>alert('Image upload failed');</script>";
            }
        } else {
            echo "<script>alert('Unsupported image file type.');</script>";
        }
    }

    // Handle video upload
    if (isset($_FILES['video_file']) && $_FILES['video_file']['error'] == UPLOAD_ERR_OK) {
        $upload_dir = 'videos/';
        $allowed_video_types = ['video/mp4', 'video/avi', 'video/mkv']; // Allowed video file types
        $file_type = $_FILES['video_file']['type'];
        $video_file_path = $upload_dir . basename($_FILES['video_file']['name']);

        // Check if the file type is allowed
        if (in_array($file_type, $allowed_video_types)) {
            if (move_uploaded_file($_FILES['video_file']['tmp_name'], $video_file_path)) {
                echo "<script>alert('Video uploaded successfully');</script>";
            } else {
                echo "<script>alert('Video upload failed');</script>";
            }
        } else {
            echo "<script>alert('Unsupported video file type. Please upload a valid video file.');</script>";
        }
    }

    // Handle adding or updating video in the database
    if ($id > 0) {
        // Update existing video
        $sql = "UPDATE campus_videos SET title = ?, image_path = ?, video_file_path = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('sssi', $title, $image_path, $video_file_path, $id);
    } else {
        // Add new video
        $sql = "INSERT INTO campus_videos (title, image_path, video_file_path) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('sss', $title, $image_path, $video_file_path);
    }

    if ($stmt->execute()) {
        echo "<script>alert('Video saved successfully');</script>";
    } else {
        echo "<script>alert('Error saving video: " . $stmt->error . "');</script>";
    }
    $stmt->close();
    header("Location: admin_manage_videos.php");
    exit();
}

// Fetch videos for display
$videos = [];
$result = $conn->query("SELECT * FROM campus_videos ORDER BY created_at DESC");
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $videos[] = $row;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel - Manage Videos</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1 class="mt-5">Manage Campus Videos</h1>
        
        <!-- Add/Edit Form -->
        <form method="POST" enctype="multipart/form-data" class="mb-4">
            <input type="hidden" name="id" value="">
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" id="title" name="title" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="image_file">Image File</label>
                <input type="file" id="image_file" name="image_file" class="form-control-file" accept="image/*" required>
            </div>
            <div class="form-group">
                <label for="video_file">Video File</label>
                <input type="file" id="video_file" name="video_file" class="form-control-file" accept="video/*" required>
            </div>
            <button type="submit" class="btn btn-primary">Save Video</button>
        </form>

        <!-- Video List -->
        <h2 class="mb-4">Video List</h2>
        <div class="row">
            <?php foreach ($videos as $video): ?>
                <div class="col-lg-4 mb-4">
                    <div class="card">
                        <!-- Video Thumbnail with Fancybox -->
                        <a href="<?php echo htmlspecialchars($video['video_file_path']); ?>" class="video-1" data-fancybox data-ratio="2">
                            <img src="<?php echo htmlspecialchars($video['image_path']); ?>" alt="Video Thumbnail" class="card-img-top">
                            <span class="play">
                                <span class="icon-play"></span>
                            </span>
                        </a>
                        <div class="card-body">
                            <!-- Video Title -->
                            <h5 class="card-title"><?php echo htmlspecialchars($video['title']); ?></h5>
                            <!-- Watch Video Button -->
                            <?php if (!empty($video['video_file_path'])): ?>
                                <a href="<?php echo htmlspecialchars($video['video_file_path']); ?>" class="btn btn-info" target="_blank">Watch Video</a>
                            <?php else: ?>
                                <span class="text-muted">No video available</span>
                            <?php endif; ?>
                            <!-- Delete Button -->
                            <a href="admin_manage_videos.php?delete=<?php echo $video['id']; ?>" class="btn btn-danger">Delete</a>
                            </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <?php
include 'db_connect.php';

// Handle delete request
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    
    // Prepare the delete statement
    $sql = "DELETE FROM campus_videos WHERE id = ?";
    $stmt = $conn->prepare($sql);
    
    if ($stmt) {
        $stmt->bind_param('i', $id);
        
        if ($stmt->execute()) {
            // Optionally, delete the associated video and image files
            $stmt->close();
            header("Location: admin_manage_videos.php"); // Redirect to avoid resubmission
            exit();
        } else {
            echo "<script>alert('Error deleting record: " . $stmt->error . "');</script>";
        }
    } else {
        echo "<script>alert('Failed to prepare statement.');</script>";
    }
}
?>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
