<!DOCTYPE html>
<html lang="en">

<head>
  <title>Admin &mdash; Website by Colorlib</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


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

    
   <div class="site-section ftco-subscribe-1 site-blocks-cover pb-4" style="background-image: url('images/bg_1.jpg')">
  <div class="container">
    <div class="row align-items-end">
      <div class="col-lg-12 text-center">
        <h2 class="mb-0">Sports</h2>
        <p class="mt-4">
          At Rajarata University of Sri Lanka, our sports program is designed to foster excellence and well-being among students. We offer a variety of sports and athletic activities to support our students' physical fitness and competitive spirit. From football and basketball to athletics and swimming, our sports facilities are state-of-the-art, ensuring our students have access to the best resources. Our dedicated sports staff and coaches work tirelessly to provide top-notch training and support, encouraging students to excel and reach their full potential in both individual and team sports.
        </p>
      </div>
    </div>
  </div>
</div>

 <!-- Post Sports News Form -->
 <div class="form-container">
      <h2>Post University sports News</h2>
      <form action="admin_sport_php.php" method="POST" enctype="multipart/form-data">
        <div class="form-group">
          <label for="title">Title</label>
          <input type="text" id="title" name="title" placeholder="Enter the title" required>
        </div>

        <div class="form-group">
          <label for="content">Content</label>
          <textarea id="content" name="content" rows="5" placeholder="Write the news content" required></textarea>
        </div>

        <div class="form-group">
          <label for="image">Upload Image</label>
          <input type="file" id="image" name="image" accept="image/*">
        </div>

        <div class="form-group">
          <label for="created_at">Date</label>
          <input type="date" id="created_at" name="created_at" required>
        </div>

        <div class="form-group">
          <button type="submit">Post News</button>
        </div>
      </form>
    </div>
  <h2 class="mt-5">Manage News</h2>
    <div class="container">
    <div class="row">
    <?php
include('db_connect.php');

// Define the path to the uploads folder
$uploads_path = 'uploads/';

// Fetch news items from the database
$result = mysqli_query($conn, "SELECT * FROM sports_news ORDER BY created_at DESC");

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $id = $row['id'];
        $title = htmlspecialchars($row['title']);
        $description = htmlspecialchars($row['content']);
        $image_path = htmlspecialchars($row['image']);
        $created_at = date('F j, Y', strtotime($row['created_at']));
        
        echo '<div class="col-lg-4 col-md-6 mb-4">'; // Use Bootstrap grid classes to create columns
        echo '<div class="news-item">';
        echo '<h3>' . $title . '</h3>';
        
        // Display image if it exists
        if (!empty($image_path)) {
            echo '<p><img src="' . $uploads_path . $image_path . '" alt="Image" class="img-fluid" style="max-width: 20rem; height: 20rem;"></p>'; // Responsive image
        }
        
        echo '<p>' . $description . '</p>';
        echo '<p><small>' . $created_at . '</small></p>';
        echo '<a href="admin_edit_sport_news.php?id=' . $id . '" class="btn btn-warning" style="margin-right:1rem;">Edit</a>';
        echo '<a href="admin_sport_news.php?delete=' . $id . '" class="btn btn-danger">Delete</a>';
        echo '</div>';
        echo '</div>'; // Close the column div
    }
} else {
    echo '<div class="col-12"><p>No news articles available.</p></div>';
}
?>

    </div>
</div>

<?php   
    // Handle news deletion
    include('db_connect.php');
if (isset($_GET['delete'])) {
    $delete_id = intval($_GET['delete']);
    $delete_query = "DELETE FROM sports_news WHERE id = $delete_id";
    if (mysqli_query($conn, $delete_query)) {
        echo "<script>alert('News deleted successfully.');</script>";
    } else {
        echo "<script>alert('Database error.');</script>";
    }
}     
?>
    <div class="footer">
            <div class="copyright">
                <p>
                    Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="icon-heart" aria-hidden="true"></i> by <a href="#" target="_blank" >Colorlib</a>
                </p>
            </div>
    </div>
    

  </div>
  <!-- .site-wrap -->

  <!-- loader -->
  <div id="loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#51be78"/></svg></div>

  <script src="js/jquery-3.3.1.min.js"></script>
  <script src="js/jquery-migrate-3.0.1.min.js"></script>
  <script src="js/jquery-ui.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/owl.carousel.min.js"></script>
  <script src="js/jquery.stellar.min.js"></script>
  <script src="js/jquery.countdown.min.js"></script>
  <script src="js/bootstrap-datepicker.min.js"></script>
  <script src="js/jquery.easing.1.3.js"></script>
  <script src="js/aos.js"></script>
  <script src="js/jquery.fancybox.min.js"></script>
  <script src="js/jquery.sticky.js"></script>
  <script src="js/jquery.mb.YTPlayer.min.js"></script>




  <script src="js/main.js"></script>

</body>

</html>