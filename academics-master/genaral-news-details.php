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

// Get the news ID from the URL
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Fetch the specific news item from the database
$sql = "SELECT title, content, image, created_at FROM genaral_news WHERE id = $id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $news = $result->fetch_assoc();
} else {
    echo "News not found.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title><?php echo htmlspecialchars($news['title']); ?></title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/style.css">
</head>

<body>
  <!-- Mobile Navigation -->
  <div class="site-mobile-menu site-navbar-target">
    <div class="site-mobile-menu-header">
      <div class="site-mobile-menu-close js-menu-toggle">
        <span class="icon-close2"></span>
      </div>
    </div>
    <div class="site-mobile-menu-body">
      <nav class="site-navigation position-relative text-right" role="navigation">
        <ul class="site-menu main-menu js-clone-nav d-block d-lg-none">
          <li><a href="index.php" class="nav-link text-left">Home</a></li>
          <li class="has-children">
            <a href="about.php" class="nav-link text-left">About Us</a>
            <ul class="dropdown">
              <li><a href="teachers.php">Our Teachers</a></li>
              <li><a href="about.php">Our School</a></li>
            </ul>
          </li>
          <li><a href="admissions.php" class="nav-link text-left">Admissions</a></li>
          <li><a href="courses.php" class="nav-link text-left">Courses</a></li>
          <li><a href="sports.php" class="nav-link text-left">Sports News</a></li>
          <li><a href="contact.php" class="nav-link text-left">Contact</a></li>
        </ul>
      </nav>
    </div>
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

  <!-- News Details Section -->
  <div class="site-section">
    <div class="container">
      <h1><?php echo htmlspecialchars($news['title']); ?></h1>
      <p><small><?php echo date('F d, Y', strtotime($news['created_at'])); ?></small></p>
    
      <?php if ($news['image']): ?>
        <img src="uploads/<?php echo htmlspecialchars($news['image']); ?>" alt="<?php echo htmlspecialchars($news['title']); ?>" class="img-fluid">
      <?php endif; ?>
    
      <p><?php echo nl2br(htmlspecialchars($news['content'])); ?></p>
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