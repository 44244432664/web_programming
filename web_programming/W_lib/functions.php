<?php

// function new_category($category) {
//     $servername = "localhost";
//     $username = "root";
//     $password = "";

//     $conn = mysqli_connect($servername, $username, $password, "Library");

//     if ($conn->connect_error) {
//         die("Connection failed: " . $conn->connect_error);
//     }
//     else{
//         // echo "<p>Connected to Library successfully</p></br>";
//     }

//     $sql = "INSERT INTO book_category (category) VALUES ('$category')";
//     if ($conn->query($sql) === TRUE) {
//         // echo "<p>Book Category inserted successfully</p></br>";
//         echo $category;
//     } else {
//         // echo "Error inserting book category: " . $conn->error;
//         echo "";
//     }
// }


// $f = $_REQUEST['f'];

// if ($f == 'new_category') {
//     $category = $_REQUEST['category'];
//     new_category($category);
// }

?>