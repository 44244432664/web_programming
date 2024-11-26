<?php
// require_once(__DIR__.'/head.php');

$bookID = $_GET['bookID'];

$servername = "localhost";
$username = "root";
$password = "";

$conn = mysqli_connect($servername, $username, $password, "Library");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    // echo "<p>Connected to Library successfully</p></br>";
}

echo "<script>console.log('book.php');</script>";


$book_info = array();

echo "<script>console.log('init array');</script>";

$sql = "SELECT * FROM books WHERE bookID=$bookID";
$result = $conn->query($sql);
$book = $result->fetch_assoc();

$book_info['bookName'] = $book['bookName'];
$book_info['img'] = $book['img'];
$book_info['descriptions'] = $book['descriptions'];

echo "<script>console.log('fetch book info " . $book_info['bookName'] . "');</script>";

$sql = "SELECT * FROM book_author WHERE bookID=$bookID";
$result = $conn->query($sql);

while ($row = $result->fetch_assoc()) {
    $author[] = $row['author'];
}

$book_info['author'] = $author;

echo "<script>console.log('fetch author " . implode(", ", $book_info['author']) . "');</script>";


$sql = "SELECT * FROM book_category WHERE bookID=$bookID";
$result = $conn->query($sql);

while ($row = $result->fetch_assoc()) {
    $genre[] = $row['category'];
}

$book_info['genre'] = $genre;

echo "<script>console.log('fetch genre " . implode(", ", $book_info['genre']) . "');</script>";

$book_info['price'] = 10.00;

echo "<script>console.log('fetch price " . $book_info['price'] . "');</script>";

echo "
<div>
    <div class='d-flex justify-content-center'>
        <div class='m-2'>
            <img src=" . $book_info['img'] . " alt='...' style='max-width: 15rem; max-height: 30rem;'>
        </div>
        <div>
            <h1>" . $book_info['bookName'] . "</h1>
            <h2>Author: " . implode(", ", $book_info['author']) . "</h2>
            <h3>Gernes: " . implode(", ", $book_info['genre']) . "</h3>
            <p>Description: " . $book_info['descriptions'] . "</p>
            <p>Price: $" . $book_info['price'] . "</p>
            <a href='#' class='btn btn-primary'>Read</a>
        </div>
    </div>
</div>";
echo "<script>console.log('" . $page . ", " . $bookID . "');</script>";
$conn->close();
?>

<!-- <script type="text/javascript">
    console.log($bookID);
</script> -->