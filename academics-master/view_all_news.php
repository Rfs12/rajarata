<?php
// Database connection
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

// Fetch the news from the database

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>Sports News</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  
  <link href="https://fonts.googleapis.com/css?family=Muli:300,400,700,900" rel="stylesheet">
  <link rel="stylesheet" href="fonts/icomoon/style.css">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/style.css">
</head>

<body>

  <!-- Mobile Navigation -->
  <div class="site-mobile-menu site-navbar-target">
    <div class="site-mobile-menu-header">
      <div class="site-mobile-menu-close mt-3">
        <span class="icon-close2 js-menu-toggle"></span>
      </div>
    </div>
    <div class="site-mobile-menu-body"></div>
  </div>
  <?php include('user_navbar.php');?>

        <div class="ml-auto">
          <div class="social-wrap">
            <a href="#"><span class="icon-facebook"></span></a>
            <a href="#"><span class="icon-twitter"></span></a>
            <a href="#"><span class="icon-linkedin"></span></a>
            <a href="#" class="d-inline-block d-lg-none site-menu-toggle js-menu-toggle text-black"><span class="icon-menu h3"></span></a>
          </div>
        </div>
      </div>
    </div>
  </header>

  <!-- Sports News Section -->
  <div class="site-section">
    <div class="container">
      <div class="row">
      
      <?php
// Database connection (ensure $conn is properly initialized)
$sql = "
    SELECT id,title, content, image, created_at FROM sports_news
    UNION ALL
    SELECT id,title, content, image, created_at FROM academics_news
    UNION ALL
    SELECT id,title, content, image, created_at FROM genaral_news
    UNION ALL
    SELECT id,title, content, image, created_at FROM news
    ORDER BY created_at DESC
";

// Execute the query and check for errors
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        echo '<div class="col-lg-4 col-md-6 mb-4">
                <div class="course-1-item">
                  <figure class="thumbnail">';
        if ($row['image']) {
            echo '<img src="uploads/' . $row['image'] . '" alt="Image" class="img-fluid">';
        } else {
            echo '<img src="images/default-image.jpg" alt="Default Image" class="img-fluid">';
        }
        echo '     </figure>
                  <div class="course-1-content pb-4">
                    <h2>' . $row['title'] . '</h2>
                    <p class="desc mb-4">' . substr($row['content'], 0, 100) . '...</p> <!-- Shortened content --> 
                    <p><small>' . date('F d, Y', strtotime($row['created_at'])) . '</small></p>
                    <a href="news-details.php?id=' . $row['id'] . '" class="btn btn-primary px-4">See More</a>
                  </div>
                </div>
              </div>';
    }
} else {
    echo "<p>No news found</p>";
}

$conn->close();
?>




      </div>
    </div>
  </div>

  <!-- Footer -->
  < <div class="footer">
      <div class="container">
        <div class="row">
          <div class="col-lg-3">
            <p class="mb-4"><img src="images/logo.png" alt="Image" class="img-fluid"></p>
            <p>The fastest and reliable News provider of Sri Lankan Universities</p>  
            <p><a href="#">Learn More</a></p>
          </div>
          <div class="col-lg-3">
            <h3 class="footer-heading"><span>Our News</span></h3>
            <ul class="list-unstyled">
                <li><a href="#">Acedemic</a></li>
                <li><a href="#">Sports</a></li>
                <li><a href="#">Our Gallery</a></li>
                <li><a href="#">Our Programmes</a></li>
                <li><a href="#">Careers</a></li>
            </ul>
          </div>
 
          <div class="col-lg-3">
              <h3 class="footer-heading"><span>Contact</span></h3>
              <ul class="list-unstyled">
                  <li><a href="#">Help Center</a></li>
                  <li><a href="#">Support Community</a></li>
                  <li><a href="#">Press</a></li>
                  <li><a href="#">Share Your Story</a></li>
                  <li><a href="#">Our Supporters</a></li>
              </ul>
          </div>
        </div>

        <div class="row">
          <div class="col-12">
            <div class="copyright">
                <p>
                   
                    Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved <i class="icon-heart" aria-hidden="true"></i> by <a href="#" target="_blank" >Rajarata News</a>
                   
                    </p>
            </div>
          </div>
        </div>
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