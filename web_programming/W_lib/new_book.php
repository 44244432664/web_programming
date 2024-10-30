
<?php
  //  include 'header.php';
?>

<body>
    <h2>New Book</h2>
    <div class="justify-content-center">
    <form action="" method="post" class="">
        <div class="form-group">
            <label for="bookName">Book Name</label>
            <input type="text" class="form-control" id="bookName" name="bookName" required>
        </div>

        <div class="form-group">
            <label for="cover">Cover</label>
            <input type="file" class="form-control" id="cover" name="cover">
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

            <?php
                // function add_category() {
                //     echo "<div class='form-control-inline'>";
                //     echo "<input class='form-control-input' type='text' placeholder='New Category' onkeyup='new_category(this.value)'>";
                //     echo "</div>";
                // }


                $servername = "localhost";
                $username = "root";
                $password = "";
                
                // $conn = new mysqli_connect($servername, $username, $password);
                $conn = mysqli_connect($servername, $username, $password);
                
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }
                else{
                    // echo "<p>Connected successfully</p></br>";
                }

                $conn = mysqli_connect($servername, $username, $password, "Library");

                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }
                else{
                    // echo "<p>Connected to Library successfully</p></br>";
                }

                $sql = "SELECT * FROM categories";
                $result = $conn->query($sql);

                echo "<div class='form-group' id='categories'>";
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {   
                        // echo "<option value=\"" . $row['category'] . "\">" . $row['category'] . "</option>";
                        echo "<div class='form-check form-check-inline'>";
                        echo "<input class='form-check-input' type='checkbox' name='". $row['category'] . "value='" . $row['category'] . ">";
                        echo "<label class='form-check-label' for='" . $row['category'] . "'>" . $row['category'] . "</label>";
                        echo "</div>";
                    }
                    echo "<div class='form-check form-check-inline'>";
                    echo "<input class='form-check-input' type='checkbox' name='other' value='other'>";
                    echo "<label class='form-check-label' for='other'>Other</label>";
                    echo "</div>";
                }
                else {
                    echo "<p>No categories found</p>";
                }
                // echo "</div>";

                // // echo "<div class='form-check form-check-inline' id='new_cat_form'></div>";
                // echo "<div class='form-group' id='new_cat_form'>";
                // echo "<div class='btn btn-primary' onclick='category_form()'>Add Category</div>";
                // echo "</div>";

                $conn->close();
            ?>
        </div>

        <div class="form-group">
            <label for="content">Content</label>
            <input type="file" class="form-control" id="content" name="content">
        </div>


        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    </div>
</body>


<?php
    // session_start();
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
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
        $sql = "SELECT * FROM categories";
        $result = $conn->query($sql);

        $categories = array();
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {   
                $categories[] = $row['category'];
            }
        }

        $new_categories = array();
        foreach ($categories as $category) {
            if (isset($_POST[$category])) {
                $new_categories[] = $category;
            }
        }

        if (isset($_POST['other'])) {
            $new_categories[] = $_POST['other'];
        }

        // $new_categories = implode(", ", $new_categories);

        // $cover = $_POST['cover'];
        $bookName = $_POST['bookName'];
        $author = $_POST['author'];
        $description = $_POST['description'];
        // $content = $_POST['content'];

        $uploader = $_SESSION['username'];
        $sql = "SELECT * FROM users WHERE userMail = '$uploader'";
        $result = mysqli_query($conn, $sql);
        $uploaderID = mysqli_fetch_assoc($result)['userID'];

        $sql = "INSERT INTO books (bookName, descriptions, uploaderID) VALUES ('$bookName', '$description', '$uploaderID')";
        if ($conn->query($sql) === TRUE) {
            echo "<div class='alert alert-success'>Book inserted successfully</div>";
        } else {
            echo "<div class='alert alert-danger'>Error inserting book: " . $conn->error. "</div>";
        }

        $sql = "SELECT * FROM books WHERE bookName = '$bookName'";
        $result = mysqli_query($conn, $sql);
        $bookID = mysqli_fetch_assoc($result)['bookID'];


        $sql = "SELECT * FROM authors WHERE author = '$author'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            $authorID = mysqli_fetch_assoc($result)['authorID'];
        }
        else {
            $sql = "INSERT INTO authors (author) VALUES ('$author')";
            if ($conn->query($sql) === TRUE) {
                echo "<div class='alert alert-success'>Author inserted successfully</div>";
            } else {
                echo "<div class='alert alert-danger'>Error inserting author: " . $conn->error . "</div>";
            }
        }
        

        // $sql = "SELECT * FROM authors WHERE authorName = '$author'";
        // $result = mysqli_query($conn, $sql);
        // $authorID = mysqli_fetch_assoc($result)['authorID'];
        

        $sql = "INSERT INTO book_author (bookID, author) VALUES ('$bookID', '$author')";
        if ($conn->query($sql) === TRUE) {
            echo "<div class='alert alert-success'>Book Author inserted successfully</div>";
        } else {
            echo "<div class='alert alert-danger'>Error inserting book author: " . $conn->error . "</div>";
        }

        foreach ($new_categories as $category) {
            $sql = "INSERT INTO book_category (bookID, category) VALUES ('$bookID', '$category')";
            if ($conn->query($sql) === TRUE) {
                echo "<div class='alert alert-success'>Book Category inserted successfully</div>";
            } else {
                echo "<div class='alert alert-danger'>Error inserting book category: " . $conn->error . "</div>";
            }
        }

        $conn->close();

        // header("Location: user_profile.php?page=update_book");
    }