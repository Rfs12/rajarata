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
$sql = "SELECT title, content, image, created_at FROM sports_news WHERE id = $id";
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

  <!-- Top Bar -->
  <div class="py-2 bg-light">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-lg-9 d-none d-lg-block">
          <a href="#" class="small mr-3"><span class="icon-question-circle-o mr-2"></span> Have a question?</a>
          <a href="#" class="small mr-3"><span class="icon-phone2 mr-2"></span> 10 20 123 456</a>
          <a href="#" class="small mr-3"><span class="icon-envelope-o mr-2"></span> info@mydomain.com</a>
        </div>
        <div class="col-lg-3 text-right">
          <a href="login.php" class="small mr-3"><span class="icon-unlock-alt"></span> Log In</a>
          <a href="register.php" class="small btn btn-primary px-4 py-2 rounded-0"><span class="icon-users"></span> Register</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Navigation -->
  <header class="site-navbar py-4 js-sticky-header site-navbar-target" role="banner">
    <div class="container">
      <div class="d-flex align-items-center">
        <div class="site-logo">
          <a href="index.php" class="d-block">
            <img src="images/logo.jpg" alt="Logo" class="img-fluid">
          </a>
        </div>
        <div class="mr-auto d-none d-lg-block">
          <nav class="site-navigation position-relative text-right" role="navigation">
            <ul class="site-menu main-menu js-clone-nav mr-auto">
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
          <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Beatae nemo minima qui dolor, iusto iure.</p>
          <p><a href="#">Learn More</a></p>
        </div>
        <div class="col-lg-3">
          <h3 class="footer-heading"><span>Our Campus</span></h3>
          <ul class="list-unstyled">
            <li><a href="#">Academic</a></li>
            <li><a href="#">News</a></li>
            <li><a href="#">Our Interns</a></li>
            <li><a href="#">Our Leadership</a></li>
            <li><a href="#">Careers</a></li>
            <li><a href="#">Human Resources</a></li>
          </ul>
        </div>
        <div class="col-lg-3">
          <h3 class="footer-heading"><span>Our Courses</span></h3>
          <ul class="list-unstyled">
            <li><a href="#">Math</a></li>
            <li><a href="#">Science &amp; Engineering</a></li>
            <li><a href="#">Arts &amp; Humanities</a></li>
            <li><a href="#">Economics &amp; Finance</a></li>
            <li><a href="#">Business Administration</a></li>
            <li><a href="#">Computer Science</a></li>
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
            <p>&copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | Made with <i class="icon-heart" aria-hidden="true"></i> by <a href="#" target="_blank">Colorlib</a></p>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- JavaScript -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script>
    $(document).ready(function() {
      // Toggle the mobile menu
      $('.js-menu-toggle').on('click', function() {
        $('.site-mobile-menu').toggleClass('active');
      });
      $('.site-mobile-menu-close').on('click', function() {
        $('.site-mobile-menu').removeClass('active');
      });
    });
  </script>
</body>
</html>

<?php
$conn->close();
?>
