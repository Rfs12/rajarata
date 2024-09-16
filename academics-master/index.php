<!DOCTYPE html>
<html lang="en">

<head>
  <title>Rajarata &mdash; News and Updates</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


  <link href="https://fonts.googleapis.com/css?family=Muli:300,400,700,900" rel="stylesheet">
  <link rel="stylesheet" href="fonts/icomoon/style.css">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/jquery-ui.css">
  <link rel="stylesheet" href="css/owl.carousel.min.css">
  <link rel="stylesheet" href="css/owl.theme.default.min.css">
  <link rel="stylesheet" href="css/owl.theme.default.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">


  <link rel="stylesheet" href="css/jquery.fancybox.min.css">

  <link rel="stylesheet" href="css/bootstrap-datepicker.css">

  <link rel="stylesheet" href="fonts/flaticon/font/flaticon.css">

  <link rel="stylesheet" href="css/aos.css">
  <link href="css/jquery.mb.YTPlayer.min.css" media="all" rel="stylesheet" type="text/css">

  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="news.css">


</head>

<body data-spy="scroll" data-target=".site-navbar-target" data-offset="300">
<?php
include('db_connect.php');

?>
  <div class="site-wrap">
<header>
   

    <?php include('user_navbar.php');?>

    
          
    </header>

    <div class="hero-slide owl-carousel site-blocks-cover">
    <?php
    include('db_connect.php');
    // Fetch all banner data
    $result = mysqli_query($conn, "SELECT * FROM banners");

    // Check if there are results
    if (mysqli_num_rows($result) > 0) {
        $first = true;

        // Loop through each banner
        while ($row = mysqli_fetch_assoc($result)) {
            // Output each carousel item
            echo '<div class="carousel-item ' . ($first ? 'active' : '') . '">';
            echo '<div class="intro-section" style="background-image: url(\'' . htmlspecialchars($row['image_path']) . '\');">';
            if (!empty($row['title'])) {
                echo '<div class="carousel-caption d-none d-md-block">';
                echo '<h5>' . htmlspecialchars($row['title']) . '</h5>';
                echo '</div>';
            }
            echo '</div>';
            echo '</div>';
            
        }
    } else {
        echo '<p>No banners available.</p>';
    }
    ?>
</div>


    <div></div>

    <div class="site-section">
      <div class="container">
        <div class="row mb-5 justify-content-center text-center">
          <div class="col-lg-4 mb-5">
            <h2 class="section-title-underline mb-5">
              <span>Why We Need</span>
            </h2>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-4 col-md-6 mb-4 mb-lg-0">

            <div class="feature-1 border">
              <div class="icon-wrapper bg-primary">
                <span class="flaticon-mortarboard text-white"></span>
              </div>
              <div class="feature-1-content">
                <h2>News and Updates</h2>
                <p>Rajarata News and all university updates</p>
                <p><a href="#" class="btn btn-primary px-4 rounded-0">Click Here</a></p>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
            <div class="feature-1 border">
            <div class="icon-wrapper bg-primary">
                <span class="fas fa-futbol text-white"></span> 
            </div>
            <div class="feature-1-content">
                <h2>Sports News</h2>
                <p>Latest Updates and Highlights from the World of Sports</p>
                <p><a href="#" class="btn btn-primary px-4 rounded-0">Click Here</a></p>
            </div>
            </div> 
          </div>
          <div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
            <div class="feature-1 border">
              <div class="icon-wrapper bg-primary">
                <span class="flaticon-library text-white"></span>
              </div>
              <div class="feature-1-content">
                <h2>Academic News</h2>
                <p>Breaking Developments and Insights in the Academic World</p>
                <p><a href="#" class="btn btn-primary px-4 rounded-0">Learn More</a></p>
              </div>
            </div> 
          </div>
        </div>
      </div>
    </div>


    <div class="site-section">
      <div class="container">


        <div class="row mb-5 justify-content-center text-center">
          <div class="col-lg-6 mb-5">
            <h2 class="section-title-underline mb-3">
              <span>Popular News</span>
            </h2>
            <p>Instant Updates of Sri Lankan Universities</p>
          </div>
        </div>

        <div class="row">
  <div class="col-12">
      <div class="owl-slide-3 owl-carousel">
          <!-- News Item 1 -->
          <div class="news-1-item">
            <figure class="thumbnail">
              <a href="news-single.php"><img src="images/course_3.jpg" alt="Image" class="img-fluid"></a>
              <div class="category"><h3>Research Breakthrough</h3></div>  
            </figure>
            <div class="news-1-content pb-4">
              <h2>Major Research Breakthrough at University of Colombo</h2>
              <p class="desc mb-4">University of Colombo researchers have made a significant breakthrough in renewable energy technology. The discovery ...</p>
              <p><a href="news-single.php" class="btn btn-primary rounded-0 px-4">Read More</a></p>
            </div>
          </div>

          <!-- News Item 2 -->
          <div class="news-1-item">
            <figure class="thumbnail">
              <a href="news-single.php"><img src="images/course_1.jpg" alt="Image" class="img-fluid"></a>
              <div class="category"><h3>Student Achievement</h3></div>  
            </figure>
            <div class="news-1-content pb-4">
              <h2>Rajarata University Student Wins National Award</h2>
              <p class="desc mb-4">A student from Rajarata University has been awarded the prestigious National Award for innovation in tech solutions...</p>
              <p><a href="news-single.php" class="btn btn-primary rounded-0 px-4">Read More</a></p>
            </div>
          </div>

          <!-- News Item 3 -->
          <div class="news-1-item">
            <figure class="thumbnail">
              <a href="news-single.php"><img src="images/course_2.jpg" alt="Image" class="img-fluid"></a>
              <div class="category"><h3>Campus Event</h3></div>  
            </figure>
            <div class="news-1-content pb-4">
              <h2>Upcoming University of Peradeniya Cultural Festival</h2>
              <p class="desc mb-4">The University of Peradeniya is hosting its annual cultural festival, showcasing traditional music, dance and .....</p>
              <p><a href="news-single.php" class="btn btn-primary rounded-0 px-4">Read More</a></p>
            </div>
          </div>
      </div>
  </div>
</div>

      
          </div>
        </div>

        
        
      </div>
    </div>

    


    <div class="section-bg style-1" style="background-image: url('images/about_1.jpg');">
      <div class="container">
        <div class="row">
          <div class="col-lg-4">
            <h2 class="section-title-underline style-2">
              <span>About Our Website</span>
            </h2>
          </div>
          <div class="col-lg-8">
            <p class="lead">Our platform provides detailed coverage of university news, including significant research findings, faculty achievements, and student successes. We aim to bridge the gap between the university community and the public by delivering timely and accurate information. Whether it’s groundbreaking research or important campus events, we ensure that you stay up-to-date with everything happening at Sri Lankan universities.</p>
            <p><a href="#">Read more</a></p>
          </div>
        </div>
      </div>
    </div>

    <!-- // 05 - Block -->
  <div class="site-section">
      <div class="container">
        <div class="row mb-5">
          <div class="col-lg-4">
            <h2 class="section-title-underline">
              <span>Administration</span>
            </h2>
          </div>
        </div>


        <div class="owl-slide owl-carousel">

          <div class="ftco-testimonial-1">
            <div class="ftco-testimonial-vcard d-flex align-items-center mb-4">
              <img src="images/person_1.jpg" alt="Image" class="img-fluid mr-3">
              <div>
                <h3>Fathima Akeela</h3>
                <span>Designer</span>
              </div>
            </div>
            <div>
              <p>&ldquo;Fathima Akeela is an experienced website designer with a passion for creating visually stunning and user-friendly digital experiences. With a background in graphic design and web development, she blends creativity with technical expertise to craft unique websites that effectively communicate clients' brand messages. &rdquo;</p>
            </div>
          </div>

          <div class="ftco-testimonial-1">
            <div class="ftco-testimonial-vcard d-flex align-items-center mb-4">
              <img src="images/person_2.jpg" alt="Image" class="img-fluid mr-3">
              <div>
                <h3>Ishadha Farwin</h3>
                <span>Developer</span>
              </div>
            </div>
            <div>
              <p>Ishadha is a skilled web developer specializing in building robust and scalable websites and web applications. With a strong foundation in both front-end and back-end development, Alex excels in transforming complex requirements into functional, high-performance solutions. </p>
            </div>
          </div>

          <div class="ftco-testimonial-1">
            <div class="ftco-testimonial-vcard d-flex align-items-center mb-4">
              <img src="images/person_4.jpg" alt="Image" class="img-fluid mr-3">
              <div>
                <h3>Allison Holmes</h3>
                <span>Designer</span>
              </div>
            </div>
            <div>
              <p>&ldquo;Lorem ipsum dolor sit, amet consectetur adipisicing elit. Neque, mollitia. Possimus mollitia nobis libero quidem aut tempore dolore iure maiores, perferendis, provident numquam illum nisi amet necessitatibus. A, provident aperiam!&rdquo;</p>
            </div>
          </div>

          <div class="ftco-testimonial-1">
            <div class="ftco-testimonial-vcard d-flex align-items-center mb-4">
              <img src="images/person_3.jpg" alt="Image" class="img-fluid mr-3">
              <div>
                <h3>Allison Holmes</h3>
                <span>Designer</span>
              </div>
            </div>
            <div>
              <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Neque, mollitia. Possimus mollitia nobis libero quidem aut tempore dolore iure maiores, perferendis, provident numquam illum nisi amet necessitatibus. A, provident aperiam!</p>
            </div>
          </div>

          <div class="ftco-testimonial-1">
            <div class="ftco-testimonial-vcard d-flex align-items-center mb-4">
              <img src="images/person_2.jpg" alt="Image" class="img-fluid mr-3">
              <div>
                <h3>Allison Holmes</h3>
                <span>Designer</span>
              </div>
            </div>
            <div>
              <p>&ldquo;Lorem ipsum dolor sit, amet consectetur adipisicing elit. Neque, mollitia. Possimus mollitia nobis libero quidem aut tempore dolore iure maiores, perferendis, provident numquam illum nisi amet necessitatibus. A, provident aperiam!&rdquo;</p>
            </div>
          </div>

          <div class="ftco-testimonial-1">
            <div class="ftco-testimonial-vcard d-flex align-items-center mb-4">
              <img src="images/person_4.jpg" alt="Image" class="img-fluid mr-3">
              <div>
                <h3>Allison Holmes</h3>
                <span>Designer</span>
              </div>
            </div>
            <div>
              <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Neque, mollitia. Possimus mollitia nobis libero quidem aut tempore dolore iure maiores, perferendis, provident numquam illum nisi amet necessitatibus. A, provident aperiam!</p>
            </div>
          </div>

        </div>
        
      </div>
    </div>
    

    <div class="section-bg style-1" style="background-image: url('images/hero_1.jpg');">
      <div class="container">
        <div class="row">
          <div class="col-lg-4 col-md-6 mb-5 mb-lg-0">
            <span class="icon flaticon-mortarboard"></span>
            <h3>Our Philosphy</h3>
            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Reiciendis recusandae, iure repellat quis delectus ea? Dolore, amet reprehenderit.</p>
          </div>
          <div class="col-lg-4 col-md-6 mb-5 mb-lg-0">
            <span class="icon flaticon-school-material"></span>
            <h3>Academics Principle</h3>
            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Reiciendis recusandae, iure repellat quis delectus ea?
              Dolore, amet reprehenderit.</p>
          </div>
          <div class="col-lg-4 col-md-6 mb-5 mb-lg-0">
            <span class="icon flaticon-library"></span>
            <h3>Key of Success</h3>
            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Reiciendis recusandae, iure repellat quis delectus ea?
              Dolore, amet reprehenderit.</p>
          </div>
        </div>
      </div>
    </div>
    
    <div class="news-updates">
    <div class="container">
        <div class="row">
            <!-- Main news section on the left -->
            <div class="col-lg-8">
                <div class="section-heading">
                    <h2 class="text-black">News & Updates</h2>
                    <a href="view_all_news.php">View All News</a>
                </div>
                <div class="news-container">
                    <div class="main-news">
                        <?php
                            // Define the base path to the uploads directory
                            $base_url = 'uploads/';

                            // Query to fetch the latest 3 news items
                            $result = mysqli_query($conn, "SELECT * FROM news ORDER BY created_at DESC LIMIT 4");

                            // Fetch all news items
                            $news_items = [];
                            while ($row = mysqli_fetch_assoc($result)) {
                                $news_items[] = $row;
                            }

                            // Display the first news item as large
                            if (!empty($news_items)) {
                                $first = true;
                                foreach ($news_items as $index => $row) {
                                    // Construct the full URL to the image
                                    $image_url = $base_url . htmlspecialchars($row['image']);

                                    // Determine class for large or small news
                                    $news_class = $first ? 'large-news-item' : 'small-news-item';
                                    $first = false;

                                    echo '<div class="' . $news_class . '">';
                                    echo '<a href="news-single.php?id=' . $row['id'] . '" class="img-link">';
                                    echo '<img src="' . $image_url . '" alt="Image" class="img-fluid">';
                                    echo '<div class="post-content">';
                                    echo '<div class="post-meta">';
                                    echo '<a href="news-single.php?id=' . $row['id'] . '">' . date('F j, Y', strtotime($row['created_at'])) . '</a>';
                                    echo '</div>';
                                    echo '<h3 class="post-heading">' . htmlspecialchars($row['title']) . '</h3>';
                                    echo '</div>';
                                    echo '</a>';
                                    echo '</div>';

                                    // If it's the first item, stop further processing
                                    if ($first === false) break;
                                }
                            }
                        ?>
                    </div>

                    <!-- Smaller news items -->
                    <div class="small-news-container">
                        <?php
                            // Display the remaining news items as small
                            foreach ($news_items as $index => $row) {
                                // Skip the first item as it is already used as large news
                                if ($index > 0) {
                                    // Construct the full URL to the image
                                    $image_url = $base_url . htmlspecialchars($row['image']);

                                    echo '<div class="small-news-item">';
                                    echo '<a href="news-single.php?id=' . $row['id'] . '" class="img-link">';
                                    echo '<img src="' . $image_url . '" alt="Image" class="img-fluid">';
                                    echo '<div class="post-content">';
                                    echo '<div class="post-meta">';
                                    echo '<a href="news-single.php?id=' . $row['id'] . '">' . date('F j, Y', strtotime($row['created_at'])) . '</a>';
                                    echo '</div>';
                                    echo '<h5 class="post-heading">' . htmlspecialchars($row['title']) . '</h5>';
                                    echo '</div>';
                                    echo '</a>';
                                    echo '</div>';
                                }
                            }
                        ?>
                    </div>
                </div>
            </div>

            <!-- Campus Videos section on the right -->
      <?php
            // Fetch videos from the database
$videos = [];
$result = $conn->query("SELECT * FROM campus_videos ORDER BY created_at DESC LIMIT 2");
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Verify that files exist in the directory
        $video_file_path = 'videos/' . basename($row['video_file_path']);
        $image_file_path = 'videos/' . basename($row['image_path']);

        if (file_exists($video_file_path) && file_exists($image_file_path)) {
            $row['video_file_path'] = $video_file_path;
            $row['image_path'] = $image_file_path;
            $videos[] = $row;
        }
    }
}
?>

        <div class="col-lg-4">
            <div class="section-heading">
                <h2 class="text-black">Campus Videos</h2>
                <a href="view_all_videos.php">View All Videos</a>
            </div>
            <div class="container mt-5">
        <div class="column">
            <?php foreach ($videos as $video): ?>
              <div class="col-md-4 custom-video-width">                    
                <div class="card" >
                        <!-- Video Thumbnail with Fancybox -->
                        <a href="<?php echo htmlspecialchars($video['video_file_path']); ?>" class="video-1" style=""data-fancybox data-ratio="2">
                            <img src="<?php echo htmlspecialchars($video['image_path']); ?>" alt="Video Thumbnail" class="card-img-top" >
                            <span class="play">
                                <span class="icon-play"></span>
                            </span>
                        </a>
                    </div>
                </div>
                            <!-- Video Title -->
                    <h6 class="card-title"><?php echo htmlspecialchars($video['title']); ?></h6>
                            <!-- Watch Video Button -->
                      <?php if (!empty($video['video_file_path'])): ?>
                        <?php else: ?>
                            <span class="text-muted">No video available</span>
                        <?php endif; ?>                        
                      <?php endforeach; ?>
                </div>
              </div>
            </div>
          </div>
        </div>

    <div class="site-section ftco-subscribe-1" style="background-image: url('images/bg_1.jpg')">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-lg-7">
            <h2>Subscribe to us!</h2>
            <p>Keep in touch with us</p>
          </div>
          <div class="col-lg-5">
            <form action="" class="d-flex">
              <input type="text" class="rounded form-control mr-2 py-3" placeholder="Enter your email">
              <button class="btn btn-primary rounded py-3 px-4" type="submit">Send</button>
            </form>
          </div>
        </div>
      </div>
    </div> 


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