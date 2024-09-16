<?php
include('db_connect.php');
?>
<!DOCTYPE html>
<html>
<head>
    <title>Manage Banners</title>
    

  <link href="https://fonts.googleapis.com/css?family=Muli:300,400,700,900" rel="stylesheet">
  <link rel="stylesheet" href="fonts/icomoon/style.css">

  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/jquery-ui.css">
  <link rel="stylesheet" href="css/owl.carousel.min.css">
  <link rel="stylesheet" href="css/owl.theme.default.min.css">
  <link rel="stylesheet" href="css/owl.theme.default.min.css">

  <link rel="stylesheet" href="css/jquery.fancybox.min.css">

  <link rel="stylesheet" href="css/bootstrap-datepicker.css">

  <link rel="stylesheet" href="fonts/flaticon/font/flaticon.css">

  <link rel="stylesheet" href="css/aos.css">
  <link href="css/jquery.mb.YTPlayer.min.css" media="all" rel="stylesheet" type="text/css">

  <link rel="stylesheet" href="css/style.css">
  <style>
  /* General Styles */
  body {
    font-family: 'Muli', sans-serif;
    background-color: #f8f9fa;
    margin: 0;
    padding: 0;
  }

  .container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 15px;
  }

  .site-section {
    background-size: cover;
    background-position: center;
    height: 100vh;
    position: relative;
    padding-top: 90px;
  }

  /* Form Container Styles */
  .form-container {
    background-color: #ffffff;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    padding: 30px;
    max-width: 700px;
    margin: 40px auto;
    position: relative;
    z-index: 20;
    
  }

  .form-container h2 {
    margin-bottom: 30px;
    font-weight: 700;
    color: #333333;
    text-align: center;
  }

  .form-container .form-group {
    margin-bottom: 20px;
  }

  .form-container .form-group label {
    font-weight: 600;
    color: #555555;
    display: block;
    margin-bottom: 5px;
  }

  .form-container input,
  .form-container textarea {
    width: 100%;
    padding: 12px;
    border: 1px solid #ced4da;
    border-radius: 5px;
    margin-bottom: 15px;
  }

  .form-container textarea {
    resize: vertical;
  }

  .form-container button {
    background-color: #51be78;
    color: #ffffff;
    font-size: 16px;
    border: none;
    padding: 12px 20px;
    border-radius: 5px;
    cursor: pointer;
    width: 100%;
    transition: background-color 0.3s;
  }

  .form-container button:hover {
    background-color: #45a56a;
  }
</style>

</head>

<body data-spy="scroll" data-target=".site-navbar-target" data-offset="300">

  <div class="site-wrap">

    <div class="site-mobile-menu site-navbar-target">
      <div class="site-mobile-menu-header">
        <div class="site-mobile-menu-close mt-3">
          <span class="icon-close2 js-menu-toggle"></span>
        </div>
      </div>
      <div class="site-mobile-menu-body"></div>
    </div>

      <div class="container">
        <div class="row align-items-center">
          
         
        </div>
      </div> 
<?php include 'navbar.php';?>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_FILES['banner_images']) && isset($_POST['titles'])) {
        $titles = $_POST['titles'];
        $banner_images = $_FILES['banner_images'];

        // Check if the number of titles matches the number of files
        if (count($titles) !== count($banner_images['name'])) {
            echo "<script>alert('The number of titles does not match the number of images.');</script>";
            exit;
        }

        for ($i = 0; $i < count($banner_images['name']); $i++) {
            $target_dir = "uploads/";
            $file_name = basename($banner_images["name"][$i]);
            $imageFileType = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
            $target_file = $target_dir . uniqid() . '.' . $imageFileType;
            $uploadOk = 1;

            // Check if image file is a actual image or fake image
            $check = getimagesize($banner_images["tmp_name"][$i]);
            if ($check === false) {
                echo "<script>alert('File is not an image.');</script>";
                $uploadOk = 0;
            }

            // Check file size
            if ($banner_images["size"][$i] > 10 * 1024 * 1024) {
                echo "<script>alert('Sorry, your file is too large.');</script>";
                $uploadOk = 0;
            }

            // Allow certain file formats
            if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
                echo "<script>alert('Sorry, only JPG, JPEG, PNG & GIF files are allowed.');</script>";
                $uploadOk = 0;
            }

            // Check if $uploadOk is set to 0 by an error
            if ($uploadOk == 0) {
                echo "<script>alert('Sorry, your file was not uploaded.');</script>";
            } else {
                if (move_uploaded_file($banner_images["tmp_name"][$i], $target_file)) {
                    // Insert banner details into the database
                    $title = mysqli_real_escape_string($conn, $titles[$i]);
                    $image_path = mysqli_real_escape_string($conn, $target_file);

                    $insert_query = "INSERT INTO banners (image_path, title) VALUES ('$image_path', '$title')";
                    if (mysqli_query($conn, $insert_query)) {
                      echo "<script>alert('News Uploaded successfully.');</script>";
                    } else {
                        echo "<script>alert('Sorry, there was an error uploading your file.');</script>";
                    }
                } else {
                    echo "<script>alert('Sorry, there was an error uploading your file.');</script>";
                }
            }
        }
    }
}
?>

<!-- Page content -->
<div class="container" >
    <div class="form-container"style="margin-top:7rem;">
      <h2>Post Banners</h2>
      <form action="backend_banners.php" method="POST" enctype="multipart/form-data">
        <div class="form-group">
        <label for="banner_images" class="form-label">Select images to upload:</label>
        <input type="file" name="banner_images[]" id="banner_images" class="form-control" multiple required>
        </div>
        <div class="form-group">
        <label for="titles" class="form-label">Titles:</label>
        <input type="text" name="titles[]" id="titles" class="form-control">
        </div>
        <div class="form-group">
          <button type="submit">Post News</button>
        </div>
      </form>
    </div>
    <h2 class="mt-5">Existing Banners</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Image</th>
                <th>Title</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        <?php
        $result = mysqli_query($conn, "SELECT * FROM banners");
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td><img src='" . htmlspecialchars($row['image_path']) . "' width='100'></td>";
            echo "<td>" . htmlspecialchars($row['title']) . "</td>";
            echo "<td><a href='admin_delete_banners.php?id=" . $row['id'] . "' class='btn btn-danger'>Delete</a></td>";
            echo "</tr>";
        }
        ?>
        </tbody>
    </table>
</div>
</body>
</html>
