<?php
if (isset($_GET['q'])) {
    $search = $_GET['q'];
} else {
    $search = '';
}

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


$sql = "SELECT * FROM books WHERE bookName LIKE '%$search%'";
$result = $conn->query($sql);
$books = array();
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $books[] = $row;
    }
}
$res = "";
for ($i = 0 ; $i < $result->num_rows ; $i++) {
    $res .= "<a href='index.php?page=book&bookID=" . $books[$i]['bookID'] . "' class='list-group-item list-group-item-action'>" . $books[$i]['bookName'] . "</a>";
}
echo $res;
?>
