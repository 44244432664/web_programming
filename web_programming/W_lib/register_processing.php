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

$username = $_POST['username'];
$password = $_POST['password'];
$password_hash = password_hash($password, PASSWORD_DEFAULT);

$sql = "SELECT * FROM users WHERE userMail = '$username'";
$result = mysqli_query($conn, $sql);
$return = array();


if ($result->num_rows > 0) {
    $return['registered'] = false;
    $return['msg'] = "<div class='alert alert-danger'>Username already exists</div>";
}
else {
    $sql = "INSERT INTO users (userLevel, userMail, password) VALUES (0, '$username', '$password_hash')";
    if ($conn->query($sql) === TRUE) {
        $return['registered'] = true;
        $return['msg'] = "<div class='alert alert-success'>User registered successfully</div>";
    } else {
        $return['registered'] = false;
        $return['msg'] = "<div class='alert alert-danger'>Error registering user: " . $conn->error. "</div>";
    }
}

echo json_encode($return);

?>