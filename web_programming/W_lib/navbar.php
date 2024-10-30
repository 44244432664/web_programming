
<div class="container"></div>
    <header class="d-flex flex-wrap justify-content-center py-3 mb-4 border-bottom"> 
      <a href="index.php" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto
      text-light text-decoration-none">
        <!-- <svg class="bi me-2" width="40" height="32"><use xlink:href="#bootstrap"></use></svg> -->
        <img src="img/Wanderers_Library.png" alt="Wanderer's Library" width="40" height="40">
        <span class="fs-4">The Wanderer's Library</span>
      </a>
      <!-- <div> -->
      <ul class="nav align-items-center col-12 col-md-auto me-md-auto"
      id="nav_group">
      <?php
      if (isset($_GET['page'])) {
        $page = $_GET['page'];
      } else {
        $page = '';
      }
      // $page = $_GET['page'];
      if ($page == '') {
        $page = 'home';
      }
      if($page == 'home') {
        echo '<li class="rounded-pill hover active" id="home"><a href="index.php?page=home" 
        class="nav-link px-2 link-light">';
      } else {
        echo '<li class="rounded-pill hover" id="home"><a href="index.php?page=home" 
        class="nav-link px-2 link-light">';
      }
      ?>
      <!-- <li class="rounded-pill hover" id="home"><a href="index.php?page=home" 
      class="nav-link px-2 link-light"> -->
      Home
      </a></li>
      <?php
      if($page == 'products') {
        echo '<li class="rounded-pill hover active" id="products"><a href="index.php?page=products" 
        class="nav-link px-2 link-light">';
      } else {
        echo '<li class="rounded-pill hover" id="products"><a href="index.php?page=products" 
        class="nav-link px-2 link-light">';
      }
      ?>
      <!-- <li class="rounded-pill hover" id="products"><a href="index.php?page=products" 
      class="nav-link px-2 link-light"> -->
      Products
      </a></li>
        <!-- <li><a href="#" class="nav-link px-2 link-dark">Pricing</a></li> -->
        <!-- <li><a href="#" class="nav-link px-2 link-dark">FAQs</a></li> -->
        <!-- <li><a href="#" class="nav-link px-2 link-dark">About</a></li> -->
      </ul>

      <!-- <div class="col-md-3 text-end"></div> -->
      <?php
      session_start();

      // echo '<p>SESSION: ' . $_SESSION['logged_in'] . '</p>';
      
      if (isset($_GET['page'])) {
        $page = $_GET['page'];
      } else {
        $page = '';
      }
      // $page = $_GET['page'];
      if ($page != 'login' && $page != 'register') {  // && $page != 'profile'
        // $str = implode("; ", $_SESSION);
        // echo '<p>SESSION: ' . $_SESSION . '</p>';
        if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
          echo '<div class="col-md-3 text-end">';
          // echo '<p>' . $_SESSION['username'] . '</p>';
          echo '<a href="logout.php" class="btn btn-outline-primary me-2 hover">Logout</a>';
          echo '<a href="user_profile.php" class="btn btn-primary hover">' . $_SESSION['username'] . '</a>';
          echo '</div>';
        } else {
          // $_SESSION['logged_in'] = false;

          echo '<div class="col-md-3 text-end">';
          echo '<a href="index.php?page=login" class="btn btn-outline-primary me-2 hover">' .
          "Login" . '</a>';
          echo '<a href="index.php?page=register" class="btn btn-primary hover">' .
          "Register" . '</a>';
          echo '</div>';
        }
      }
      else {
        echo '<div class="col-md-3 text-end"></div>';
      }

      // if(isset($_SESSION['username'])) {
      //   echo '<div class="col-md-3 text-end">';
      //   echo '<a href="index.php?page=logout" class="btn btn-outline-primary me-2 hover">Logout</a>';
      //   echo '<a href="index.php?page=profile" class="btn btn-primary hover">Profile</a>';
      //   echo '</div>';
      // } else {
      //   echo '<div class="col-md-3 text-end">';
      //   echo '<a href="index.php?page=login" class="btn btn-outline-primary me-2 hover">Login</a>';
      //   echo '<a href="index.php?page=register" class="btn btn-primary hover">Register</a>';
      //   echo '</div>';
      // }
      ?>
        <!-- <a href="index.php?page=login" class="btn btn-outline-primary me-2 hover">Login</a>
        <a href="index.php?page=register" class="btn btn-primary hover">Register</a> -->
      <!-- </div> -->
    </header>
</div>
