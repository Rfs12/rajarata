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
$sql = "SELECT id, title, content, image, created_at FROM academics_news ORDER BY created_at DESC";
$result = $conn->query($sql);
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
                            <a href="academics-news-details.php?id=' . $row['id'] . '" class="btn btn-primary px-4">See More</a> <!-- See More Button -->
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

  <script src="js/jquery-3.3.1.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
</body>
</html>
