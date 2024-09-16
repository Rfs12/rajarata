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
// Database connection (ensure $conn is properly initialized)
$sql = "
    SELECT id, title, image_path, created_at, video_file_path FROM campus_videos
    ORDER BY created_at DESC
";

// Execute the query
$result = $conn->query($sql);

// Check for errors
if ($result === false) {
    echo "Error: " . $conn->error;
    exit;
}

// Fetch all videos into an array
$videos = [];
while ($row = $result->fetch_assoc()) {
    $videos[] = $row;
}
$conn->close();
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
      
      <?php foreach ($videos as $video): ?>
            <div class="col-md-4 custom-video-width">                    
                <div class="card">
                    <!-- Video Thumbnail with Fancybox -->
                    <a href="<?php echo htmlspecialchars($video['video_file_path']); ?>" class="video-1" data-fancybox data-ratio="2">
                        <img src="<?php echo htmlspecialchars($video['image_path']); ?>" alt="Video Thumbnail" class="card-img-top">
                        <span class="play">
                            <span class="icon-play">&#9658;</span>
                        </span>
                    </a>
                    <!-- Video Title -->
                    <div class="card-body">
                        <h6 class="card-title"><?php echo htmlspecialchars($video['title']); ?></h6>
                        <!-- Watch Video Button -->
                        <?php if (!empty($video['video_file_path'])): ?>
                            <a href="<?php echo htmlspecialchars($video['video_file_path']); ?>" class="btn btn-primary" data-fancybox>Watch Video</a>
                        <?php else: ?>
                            <span class="text-muted">No video available</span>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>

      </div>
    </div>
  </div>

  <!-- Footer -->
  <div class="footer">
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