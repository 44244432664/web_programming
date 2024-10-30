<!-- only user can update their book information -->

<?php
// include(__DIR__.'/head.php');
// session_start();

// if (!isset($_SESSION['username'])) {
//     header("Location: login.php");
//     exit();
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


$sql = "SELECT * FROM categories";
$result = $conn->query($sql);

$categories = array();
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {   
        $categories[] = $row['category'];
    }
}
?>
<body>
<h2>Update Book</h2>
<form action="" method="POST">
    <label for="book">Select a book:</label>
    <select name="book" id="book">
        <?php
        foreach ($books as $book) {
            echo "<option value='".$book['bookID']."'>".$book['bookName']."</option>";
        }
        ?>
    </select>
    <div class="form-group">
        <label for="cover">Cover</label>
        <input type="file" class="form-control" id="cover" name="cover">
    </div>
    <div class="form-group">
        <label for="bookName">Book Name</label>
        <input type="text" class="form-control" id="bookName" name="bookName" required>
    </div>
    <div class="form-group">
        <label for="author">Author</label>
        <input type="text" class="form-control" id="author" name="author" required>
    </div>
    <div class="form-group">
        <label for="description">Description</label>
        <textarea class="form-control" id="description" name="description" rows="3"></textarea>
    </div>
    <div class="form-group">
        <div>
        <label for="category">Category:</label>
        </div>

        <div class='form-group' id='categories'>
        <?php
        foreach ($categories as $category) {
            echo "<div class='form-check form-check-inline'>";
            echo "<input type='checkbox' class='form-check-input' name='$category' value='".$category."'>";
            // echo "<label class='form-check-label' for='" . $row['category'] . "'>" . $row['category'] . "</label>";
            echo "<label class='form-check-label' for='" . $category . "'>" . $category . "</label>";
            echo "</div>";
        }
        ?>
        <div class="form-check form-check-inline">
            <input type="checkbox" class="form-check-input" name="other" value="other">
            <label for="other" class="form-check-label">Other</label>
        </div>
        </div>

        <div class="form-group">
            <label for="content">Content</label>
            <input type="file" class="form-control" id="content" name="content" required>
        </div>
    <input type="submit" class="btn btn-primary" value="Update Book">
</form>
</body>


<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $bookID = $_POST['book'];
    $bookName = $_POST['bookName'];
    $cover = $_POST['cover'];
    $author = $_POST['author'];
    $description = $_POST['description'];
    $content = $_POST['content'];

    $new_categories = array();
    foreach ($categories as $category) {
        if (isset($_POST[$category])) {
            $new_categories[] = $category;
        }
    }

    if ($bookName != ""){
        $sql = "UPDATE books SET bookName = '$bookName', description = '$description', content = '$content' WHERE bookID = $bookID";
        $result = $conn->query($sql);

        if ($result) {
            echo "<div class='alert alert-success'>Book updated successfully</div>";
        } else {
            echo "<div class='alert alert-danger'>Error updating book</div>";
        }
    }


    if ($cover != ""){
        $sql = "UPDATE books SET cover = '$cover' WHERE bookID = $bookID";
        $result = $conn->query($sql);

        if ($result) {
            echo "<div class='alert alert-success'>Cover updated successfully</div>";
        } else {
            echo "<div class='alert alert-danger'>Error updating cover</div>";
        }
    }

    if ($author != ""){
        $sql = "UPDATE book_authors SET author = '$author' WHERE bookID = $bookID";
        $result = $conn->query($sql);

        if ($result) {
            echo "<div class='alert alert-success'>Author updated successfully</div>";
        } else {
            echo "<div class='alert alert-danger'>Error updating author</div>";
        }
    }
    // $sql = "UPDATE book_authors SET author = '$author' WHERE bookID = $bookID";
    // $result = $conn->query($sql);

    // if ($result) {
    //     echo "<div class='alert alert-success'>Author updated successfully</div>";
    // } else {
    //     echo "<div class='alert alert-danger'>Error updating author</div>";
    // }

    if ($description != ""){
        $sql = "UPDATE books SET description = '$description' WHERE bookID = $bookID";
        $result = $conn->query($sql);

        if ($result) {
            echo "<div class='alert alert-success'>Description updated successfully</div>";
        } else {
            echo "<div class='alert alert-danger'>Error updating description</div>";
        }
    }

    if ($content != ""){
        $sql = "UPDATE books SET content = '$content' WHERE bookID = $bookID";
        $result = $conn->query($sql);

        if ($result) {
            echo "<div class='alert alert-success'>Content updated successfully</div>";
        } else {
            echo "<div class='alert alert-danger'>Error updating content</div>";
        }
    }

    if (count($new_categories) != 0) {
        $sql = "DELETE FROM book_categories WHERE bookID = $bookID";
        $result = $conn->query($sql);

        if ($result) {
            echo "<div class='alert alert-success'>Categories updated successfully</div>";
        } else {
            echo "<div class='alert alert-danger'>Error updating categories</div>";
        }

        foreach ($new_categories as $category) {
            $sql = "INSERT INTO book_categories (bookID, category) VALUES ($bookID, '$category')";
            $result = $conn->query($sql);

            if ($result) {
                echo "<div class='alert alert-success'>Category $category updated successfully</div>";
            } else {
                echo "<div class='alert alert-danger'>Error updating category $category</div>";
            }
        }   
    }
}

$conn->close();

// header("Location: user_profile.php?page=update_book");
// exit();
?>