<!-- only user can delete their books -->

<?php
// session_start();

// if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] === false) {
//   header('Location: index.php?page=login');
// }

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

$sql = "SELECT * FROM books WHERE uploaderID = (SELECT userID FROM users WHERE userMail = '".$_SESSION['username']."')";
$result = $conn->query($sql);

$books = array();
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {   
        $books[] = $row;
    }
}

?>

<h2>Delete Book</h2>
<form action="" method="POST">
    <label for="book">Select a book:</label>
    <select name="book" id="book">
        <?php
        foreach ($books as $book) {
            echo "<option value='".$book['bookID']."'>".$book['bookName']."</option>";
        }
        ?>
    </select>
    <br>
    <input type="submit" class="btn btn-primary" value="Delete">
</form>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $bookID = $_POST['book'];

    $sql = "DELETE FROM book_category WHERE bookID = $bookID";
    $conn->query($sql);

    $sql = "DELETE FROM book_author WHERE bookID = $bookID";
    $conn->query($sql);

    $sql = "DELETE FROM books WHERE bookID = $bookID";
    $conn->query($sql);

    echo "<div class='alert alert-success'>Book deleted successfully</div>";

    // header("Location: user_profile.php?page=delete_book");
}