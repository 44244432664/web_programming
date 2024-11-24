<?php require_once(__DIR__.'/head.php');
// include(__DIR__.'/navbar.php'); ?>

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
} else {
    // echo "<p>Connected to Library successfully</p></br>";
}

// Define how many results per page
$results_per_page = 9;

// Find out the number of results in the database
$sql = "SELECT COUNT(*) AS total FROM books";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$total_results = $row['total'];

// echo $total_results;

// Calculate total pages needed
$total_pages = ceil($total_results / $results_per_page);

// Determine current page (default to 1 if not set)
$page = isset($_GET['p']) && is_numeric($_GET['p']) ? (int)$_GET['p'] : 1;
// echo $page;

// Calculate the starting limit number for the SQL query
$start_limit = ($page - 1) * $results_per_page;

// Retrieve selected results from database
$sql = "SELECT * FROM books LIMIT $start_limit, $results_per_page";
$result = $conn->query($sql);
$count = 0;

if ($result->num_rows > 0) {
    // echo '<div class="d-flex justify-content-center">';
   
        while($row = $result->fetch_assoc()) {
            if ($count == 0 || $count == 3){
                echo '<div class="d-flex justify-content-center m-2"">';
            }
            echo '<div class="card m-1 w-30 bg-dark" style="width: 15rem; height: 30rem">';
            echo '<img src="' . $row['img'] . '" class="card-img-top" style="max-width: 15rem; max-height: 30rem;" alt="...">';
            echo '<div class="card-body">';
            echo '<h5 class="card-title-bottom">' . $row['bookName'] . '</h5>';
            // echo '<p class="card-text">' . $row['author'] . '</p>';
            echo '<a href="#" class="btn btn-primary">Read</a>';
            echo '</div>';
            echo '</div>';
            $count++;
            if ($count == 3){
                echo "</div>";
                $count = 0;
            }
        }
    // echo '</div>';
    if ($count != 0 || $count != 3){
        echo "</div>";
    }

    // Pagination controls
    echo '<div class="d-flex justify-content-center">';
    echo '<nav><ul class="pagination justify-content-center">';
    if ($page > 1) {
        echo '<li class="page-item"><a class="page-link" href="index.php?page=products&p=' . ($page - 1) . '">Previous</a></li>';
    }
    for ($i = 1; $i <= $total_pages; $i++) {
        echo '<li class="page-item' . ($i == $page ? ' active' : '') . '"><a class="page-link" href="index.php?page=products&p=' . $i . '">' . $i . '</a></li>';
    }
    if ($page < $total_pages) {
        echo '<li class="page-item"><a class="page-link" href="index.php?page=products&p=' . ($page + 1) . '">Next</a></li>';
    }
    echo '</ul></nav>';
    echo '</div>';
} else {
    echo "No results found.";
}

$conn->close();

?>

<!-- 
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

</div> -->
<!-- </body> -->