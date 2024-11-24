
<!-- <div class="d-flex justify-content-center"> -->

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

if (isset($_GET['search'])) {
    $search = $_GET['search'];
    $title = strlen($search) <= 0 ? "Void" : $search;
    echo '<div class="container">
    <div class="p-5 mb-4 rounded-3">
    <div class="container-fluid py-5 justify-content-center">
        <h1 class="display-5 fw-bold">The book of ' . $title . '</h1>
        <p class="fs-3">
        Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quam quidem nulla reiciendis ea. Illum, dolor. Voluptatibus et minima blanditiis distinctio quidem cum autem excepturi vel voluptate a. Earum, eum voluptas?
        </p>
    </div>
    </div>
    </div>';

    // echo '<div class="d-flex justify-content-center">';

    $sql = "SELECT bookID FROM books WHERE bookName LIKE '%$search%'";
    $sql1 = "SELECT bookID FROM books WHERE bookID IN (SELECT bookID FROM book_author WHERE author LIKE '%$search%')";
    $sql2 = "SELECT bookID FROM books WHERE uploaderID IN (SELECT userID FROM users WHERE userMail LIKE '%$search%')";
    $result = $conn->query($sql);
    $result1 = $conn->query($sql1);
    $result2 = $conn->query($sql2);
    $search_id = array();
    $count = 0;
    // $res = false;
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $search_id[] = $row['bookID'];
        }
    }
    if ($result1->num_rows > 0) {
        while($row = $result1->fetch_assoc()) {
            $search_id[] = $row['bookID'];
        }
    }
    if ($result2->num_rows > 0) {
        while($row = $result2->fetch_assoc()) {
            $search_id[] = $row['bookID'];
        }
    }

    $search_id = array_unique($search_id);

    
    if (!$search_id){
        echo '<div class="d-flex justify-content-center m-2"">';
        echo "<h3 class='primary primary rounded-pill p-3'>No result</h3>";
        echo "</div>";
    }
    else{
        $sql = "SELECT * FROM books WHERE bookID IN (" . implode(',', $search_id) . ")";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
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
            if ($count != 0 || $count != 3){
                echo "</div>";
            }
        }
    }

    

    // while($row = $result2->fetch_assoc()) {
    //     global $count;
    //     if ($count == 0 || $count == 3){
    //         echo '<div class="d-flex justify-content-center">';
    //     }
    //     echo '<div class="card" style="width: 12rem;">';
    //     echo '<img src="' . $row['img'] . '" class="card-img-top" alt="..." style="object-fit:cover;">';
    //     echo '<div class="card-body">';
    //     echo '<h5 class="card-title">' . $row['bookName'] . '</h5>';
    //     // echo '<p class="card-text">' . $row['author'] . '</p>';
    //     echo '<a href="#" class="btn btn-primary">Read</a>';
    //     echo '</div>';
    //     echo '</div>';
    //     $count++;
    //     if ($count == 3){
    //         echo "</div>";
    //         $count = 0;
    //     }
    // }
    // $res = true;

    // echo "</div>";
}

// echo "</div>"
?>

</div>