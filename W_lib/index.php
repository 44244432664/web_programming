<?php $title = 'Home'; ?>
<?php $metaTags = 'tag1 tag2'; ?>
<?php $currentPage = 'index'; ?>
<?php require_once(__DIR__.'/head.php'); ?>
<body>
    <!-- <header>The Wanderer's Library</header> -->
    <?php include(__DIR__.'/navbar.php'); ?>
    <?php 
    if(isset($_GET['page'])) {
        $page = $_GET['page'];
        if($page == 'products') {
            include(__DIR__.'/products.php');
        } else if($page == 'login') {
            include(__DIR__.'/login.php');
        } else if($page == 'register') {
            include(__DIR__.'/register.php');
        } else {
            include(__DIR__.'/home.php');
        }
    } else {
        include(__DIR__.'/home.php');
    }
    ?>
    <script src="scripts.js"></script>
    <?php require_once(__DIR__.'/footer.php'); ?>
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script> -->
</body>
</html>