<?php require_once(__DIR__.'/head.php'); ?>

<!-- <body> -->
<div class="container">
    <div class="p-5 mb-4 rounded-3">
    <div class="container-fluid py-5 justify-content-center">
        <h1 class="display-5 fw-bold">The book of books</h1>
        <p class="fs-3">
        Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quam quidem nulla reiciendis ea. Illum, dolor. Voluptatibus et minima blanditiis distinctio quidem cum autem excepturi vel voluptate a. Earum, eum voluptas?
        </p>
    </div>
    </div>
</div>


<?php
$servername = "localhost";
$username = "root";
$password = "";

$conn = mysqli_connect($servername, $username, $password, "Library");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
else{
    // echo "<p>Connected to Library successfully</p></br>";
}
// $sql = "SELECT * FROM books";
// $result = $conn->query($sql);

?>


<div class="d-flex justify-content-center">
    <div class="card" style="width: 18rem;">
        <img src="img/cover.jpg" class="card-img-top" alt="...">
        <div class="card-body">
            <h5 class="card-title">Book Title</h5>
            <p class="card-text">Author</p>
            <a href="#" class="btn btn-primary">Read</a>
        </div>
    </div>
    <div class="card" style="width: 18rem;">
        <img src="img/cover.jpg" class="card-img-top" alt="...">
        <div class="card-body">
            <h5 class="card-title">Book Title</h5>
            <p class="card-text">Author</p>
            <a href="#" class="btn btn-primary">Read</a>
        </div>
    </div>
    <div class="card" style="width: 18rem;">
        <img src="img/cover.jpg" class="card-img-top" alt="...">
        <div class="card-body">
            <h5 class="card-title">Book Title</h5>
            <p class="card-text">Author</p>
            <a href="#" class="btn btn-primary">Read</a>
        </div>
    </div>

</div>
<!-- </body> -->