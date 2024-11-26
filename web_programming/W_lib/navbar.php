<?php session_start(); ?>
<!-- <div class="container"></div> -->
    <header class="d-flex flex-wrap justify-content-center py-3 mb-4 border-bottom"> 
      <div class="me-2">
      <a href="index.php" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto
      text-light text-decoration-none">
        <!-- <svg class="bi me-2" width="40" height="32"><use xlink:href="#bootstrap"></use></svg> -->
        <img src="img/Wanderers_Library.png" alt="Wanderer's Library" width="40" height="40">
        <span class="fs-4">The Wanderer's Library</span>
      </a>
      </div>
      <!-- <div class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0"> -->
      <div class="rounded-pill" id="search_bar">
        <form action="index.php?search" method="get" class="d-flex">
          <input type="text" class="form-control me-2" name="search" placeholder="Search" aria-label="Search" onkeyup="showResult(this.value)">
          <!-- <button type="submit" class="btn btn-outline-primary hover">Search</button> -->
          <button type="submit" class="btn btn-md me-2 btn-primary">
            <i class="fa fa-search"></i>
          </button>
        </form>
        <div id="livesearch_result"></div>
      </div>
      <!-- </ul> -->

    <script type="text/javascript">
      function showResult(str) {
        console.log(str);
        if (str.length==0) {
          document.getElementById("livesearch_result").innerHTML="";
          document.getElementById("livesearch_result").style.border="0px";
          return;
        }
        document.getElementById("livesearch_result").style.display = "block";
        var xmlhttp=new XMLHttpRequest();
        xmlhttp.onreadystatechange=function() {
          if (this.readyState==4 && this.status==200) {
            document.getElementById("livesearch_result").innerHTML=this.responseText;
            document.getElementById("livesearch_result").style.border="1px solid #A5ACB2";
          }
        }
        xmlhttp.open("GET","livesearch.php?q="+str,true);
        xmlhttp.send();
      }
    </script>

    <div>
    <ul class="nav align-items-center col-12 col-md-auto me-md-auto"
      id="nav_group">
      <?php
      if (isset($_GET['page'])) {
        $page = $_GET['page'];
      } else {
        $page = '';
      }

      if (isset($_GET['p'])) {
        $p = $_GET['p'];
      } else {
        $p = 0;
      }
      // echo "<scripts>console.log('page: $p');</Scripts>";

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


      <?php
      if($page == 'map') {
        echo '<li class="rounded-pill hover active" id="gg_map"><a href="index.php?page=map" 
        class="nav-link px-2 link-light">';
      } else {
        echo '<li class="rounded-pill hover" id="gg_map"><a href="index.php?page=map" 
        class="nav-link px-2 link-light">';
      }
      ?>
      Contact
      </a></li>
      </ul>
      </div>

      <!-- <div class="col-md-3 text-end"></div> -->
      <?php
      // if (!isset($_SESSION)) {
      //   session_start();
      // }
      // session_start();

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
<!-- </div> -->
