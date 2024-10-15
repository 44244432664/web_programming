<?php include(__DIR__.'/head.php'); ?>
<body>
    <div class="container">
        <div class="p-5 mb-4 rounded-3">
            <div class="container-fluid py-5 justify-content-center">
                <h1 class="display-5 fw-bold">The book of books</h1>
                <p class="fs-3">
                    Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quam quidem nulla reiciendis ea. Illum,
                    dolor. Voluptatibus et minima blanditiis distinctio quidem cum autem excepturi vel voluptate a. Earum,
                    eum voluptas?
                </p>
            </div>
        </div>
    <a href="config.php?add_books" class="btn btn-primary">
        Add Book
    </a>

    <a href='config.php?auto_add_books' class='btn btn-primary'>
        Auto Add Books
    </a>

    <a href="config.php?auto_add_users" class="btn btn-primary">
        Auto Add Users
    </a>
    <!-- <button type="button" class="btn btn-primary"
    onclick="auto_add_books(); this.disabled=true;">
        Auto Add Books
    </button> -->
    

    <!-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="scripts.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> -->
</body>

</html>








<?php
// Create a new database
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

$sql = "CREATE DATABASE if not exists Library";
if ($conn->query($sql) === TRUE) {
    // echo "<p>Database created successfully</p></br>";
} else {
    echo "Error creating database: " . $conn->error;
}

$conn->close();

// Create tables: products and users

// $conn = mysqli_connect($servername, $username, $password, "Library");
$conn = mysqli_connect($servername, $username, $password, "Library");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
else{
    echo "<p>Connected to Library successfully</p></br>";
}

// Create products table
// echo "<p>Creating table 'books'...</p></br>";
$sql = "CREATE TABLE if not exists books (
    bookID INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    bookName VARCHAR(90) NOT NULL,
    img VARCHAR(600),
    descriptions VARCHAR(600),
    uploaderID INT(6) UNSIGNED DEFAULT 0,
    LinkToRead VARCHAR(600)
);";

if ($conn->query($sql) === TRUE) {
    // echo "<p>Table 'books' created successfully</p></br>";
} else {
    echo "Error creating table: " . $conn->error;
}



// Create categories table
// echo "<p>Creating table 'categories'...</p></br>";
$sql = "CREATE TABLE if not exists categories (
    categoryID INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    category VARCHAR(30) NOT NULL UNIQUE
);";

if ($conn->query($sql) === TRUE) {
    // echo "<p>Table 'categories' created successfully</p></br>";
} else {
    echo "Error creating table: " . $conn->error;
}

// Create authors table
// echo "<p>Creating table 'authors'...</p></br>";
$sql = "CREATE TABLE if not exists authors (
    authorID INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    author VARCHAR(30) NOT NULL UNIQUE
);";

if ($conn->query($sql) === TRUE) {
    // echo "<p>Table 'authors' created successfully</p></br>";
} else {
    echo "Error creating table: " . $conn->error;
}




// Create book_category table
// echo "<p>Creating table 'book_category'...</p></br>";
$sql = "CREATE TABLE if not exists book_category (
    bookID INT(6) UNSIGNED,
    category VARCHAR(30),
    PRIMARY KEY (bookID, category),
    FOREIGN KEY (bookID) REFERENCES books(bookID)
    -- FOREIGN KEY (category) REFERENCES books(category)
);";

if ($conn->query($sql) === TRUE) {
    // echo "<p>Table 'book_category' created successfully</p></br>";
} else {
    echo "Error creating table: " . $conn->error;
}

// Create book_author table
// echo "<p>Creating table 'book_author'...</p></br>";
$sql = "CREATE TABLE if not exists book_author (
    bookID INT(6) UNSIGNED,
    author VARCHAR(30),
    PRIMARY KEY (bookID, author),
    FOREIGN KEY (bookID) REFERENCES books(bookID)
    -- FOREIGN KEY (author) REFERENCES books(author)
);";

if ($conn->query($sql) === TRUE) {
    // echo "<p>Table 'book_author' created successfully</p></br>";
} else {
    echo "Error creating table: " . $conn->error;
}



// Create users table
// echo "<p>Creating table 'users'...</p></br>";
$sql = "CREATE TABLE if not exists users (
userID INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
userLevel INT(1) NOT NULL DEFAULT 0,
username VARCHAR(30) NOT NULL UNIQUE,
password VARCHAR(255) NOT NULL,
email VARCHAR(50) NOT NULL UNIQUE
)";

if ($conn->query($sql) === TRUE) {
    // echo "<p>Table 'users' created successfully</p></br>";
} else {
    echo "Error creating table: " . $conn->error;
}







if (isset($_GET['auto_add_books'])) {    
    // Insert new products form json file
    $json = file_get_contents('books.json', true);

    $data = json_decode($json, true);


    // $book_array = array();
    // $book_author_array = array();
    // $book_category_array = array();

    // $author_array = array();
    // $category_array = array();

    $sql = "SELECT category FROM categories";
    $result = $conn->query($sql);
    $category_array = array();
    while ($row = $result->fetch_assoc()) {
        array_push($category_array, $row['category']);
    }

    $sql = "SELECT author FROM authors";
    $result = $conn->query($sql);
    $author_array = array();
    while ($row = $result->fetch_assoc()) {
        array_push($author_array, $row['author']);
    }


    // echo "<p># of categories: " . count($category_array) . "</p></br>";
    // echo "<p># of authors: " . count($author_array) . "</p></br>";

    // echo "<p>Getting new books...</p></br>";
    // $num = 0;
    foreach ($data as $row) {
        // $bookID = $row['id'];
        $bookName = $row['title'];
        // $bookID = password_hash($row['title'], PASSWORD_DEFAULT);
        $img = $row['cover_image'];
        $descriptions = $row['description'];
        $category = $row['genre'];
        $author = $row['author'];
        // $LinkToRead = $row['LinkToRead'];

        // echo "row: $num</br>";

        // echo "<p>Inserting:</p></br>";
        // echo "<p>Book Name: $bookName</p></br>";
        // echo "<p>Image: $img</p></br>";
        // echo "<p>Descriptions: $descriptions</p></br>";
        // echo "<p>Category: $category</p></br>";
        // echo "<p>Author: $author</p></br>";

        $sql = "INSERT INTO books (bookName, img, descriptions) VALUES
        (\"$bookName\", \"$img\", \"$descriptions\")";
        // echo "<p>SQL Query: $sql</p></br>";

        // error_reporting(E_ALL);
        // ini_set('display_errors', 1);

        if ($conn->query($sql) === TRUE) {
            // echo "<p>Book inserted successfully</p></br>";
        } else {
            echo "Error inserting book: " . $conn->error;
        }
        

        // echo "<p>Inserting categories...</p></br>";
        // Insert categories
        foreach ($category as $i) {
            // echo "<p>Category: $i</p></br>";
            if (!in_array($i, $category_array)) {
                array_push($category_array, $i);
                $sql = "INSERT INTO categories (category) VALUES (\"$i\")";
                // error_reporting(E_ALL);
                // ini_set('display_errors', 1);
                
                if ($conn->query($sql) === TRUE) {
                    // echo "<p>Category inserted successfully</p></br>";
                } else {
                    echo "Error inserting category: " . $conn->error;
                }
            }
        }

        // echo "<p>Inserting author...</p></br>";
        // Insert authors
        if (!in_array($author, $author_array)) {
            array_push($author_array, $author);
            $sql = "INSERT INTO authors (author) VALUES (\"$author\")";
            
            // error_reporting(E_ALL);
            // ini_set('display_errors', 1);

            if ($conn->query($sql) === TRUE) {
                // echo "<p>Author inserted successfully</p></br>";
            } else {
                echo "Error inserting author: " . $conn->error;
            }
        }

        // echo "<p>Inserting book_category...</p></br>";
        // Insert book_category
        $sql = "SELECT bookID FROM books WHERE bookID = (SELECT MAX(bookID) FROM books)";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        $bookID = $row['bookID'];

        foreach ($category as $i) {
            $sql = "INSERT INTO book_category (bookID, category) VALUES ('$bookID', \"$i\")";
            // error_reporting(E_ALL);
            
            if ($conn->query($sql) === TRUE) {
                // echo "<p>Book Category inserted successfully</p></br>";
            } else {
                echo "Error inserting book category: " . $conn->error;
            }
        }

        // echo "<p>Inserting book_author...</p></br>";
        // Insert book_author
        $sql = "INSERT INTO book_author (bookID, author) VALUES ('$bookID', \"$author\")";
        // error_reporting(E_ALL);

        if ($conn->query($sql) === TRUE) {
            // echo "<p>Book Author inserted successfully</p></br>";
        } else {
            echo "Error inserting book author: " . $conn->error;
        }


        // $book_array = array_merge($book_array, array("(\"$bookName\", \"$img\", \"$descriptions\")"));
        // $book_author_array = array_merge($book_author_array, array("('$bookName', '$author')"));
        
        // $num++;
    }

    // echo "<p>all books inserted successfully</p></br>";
    // echo implode(", ", $book_array);
    // echo "<p>Inserting new books...</p></br>";

    // $sql = "INSERT INTO books (bookName, img, descriptions) VALUES " . implode(", ", $book_array);
    // echo "<p>SQL Query: $sql</p></br>";

    // error_reporting(E_ALL);
    // ini_set('display_errors', 1);

    // global $conn;

    // if ($conn->query($sql) === TRUE) {
    //     echo "<p>Books inserted successfully</p></br>";
    // } else {
    //     echo "Error inserting books: " . $conn->error;
    // }
    // echo "<p>Books inserted successfully</p></br>";

    // disable button
    // global $auto_add_books;
    // $auto_add_books = true;


    // return to config.php
    header("Location: config.php");
    exit();
}








// search for admin account
$sql = "SELECT * FROM users WHERE username='admin' AND userLevel=1";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // echo "Admin account already exists";
}
else{
    // Insert admin account
    $sql = "INSERT INTO users (userLevel, username, password, email) VALUES
    (1, 'admin', '$passwordHash', 'creatormode@example.com')";
    if ($conn->query($sql) === TRUE) {
        // echo "Admin account inserted successfully";
    } else {
    echo "Error inserting admin account: " . $conn->error;
    }
}


if (isset($_GET['auto_add_users'])) {
    // Insert new user accounts with hashed passwords
    $passwordHash = password_hash('password123', PASSWORD_DEFAULT);
    $sql = "INSERT INTO users (username, password, email) VALUES
        ('user1', '$passwordHash', 'user1@example.com'),
        ('user2', '$passwordHash', 'user2@example.com'),
        ('user3', '$passwordHash', 'user3@example.com')";

    if ($conn->query($sql) === TRUE) {
        // echo "New user accounts inserted successfully";
    } else {
        echo "Error inserting user accounts: " . $conn->error;
    }
    header("Location: config.php");
    exit();
}

$conn->close();

if (isset($_GET['add_books'])) {
    include('new_book.php');
}

?>
