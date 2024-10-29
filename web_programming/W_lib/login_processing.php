
<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "Library";
$dbname = "Library";

$conn = mysqli_connect($servername, $username, $password);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
else{
    // echo "<p>Connected successfully</p></br>";
}

mysqli_select_db($conn, $dbname);
$username = $_POST['username'];
$password = $_POST['password'];
$return = array();
// $hased_password = password_hash($password, PASSWORD_DEFAULT);

$return['logged_in'] = false;
$return['msg'] = "Default message";

$sql = "SELECT * FROM users WHERE userMail = '$username'";
$result = mysqli_query($conn, $sql);

$return['msg'] = "query executed";

if (mysqli_num_rows($result) > 0) {
    $return['msg'] = "User found";
    $row = mysqli_fetch_assoc($result);
    $return['msg'] = "fetched data";
    if (password_verify($password, $row['password'])) {
        $_SESSION['logged_in'] = true;
        $_SESSION['username'] = $username;

        $return['logged_in'] = true;
        $return['msg'] = "<div class='alert alert-success'>Login successful</div>";
        // header("Location: index.php");
        // echo "<script>window.location.href='index.php';</script>";
        // exit();
    }
    else {
        $return['logged_in'] = false;
        $return['msg'] = "<div class='alert alert-danger'>Incorrect username or password</div>";
    }
}
else {
    $return['logged_in'] = false;
    $return['msg'] = "<div class='alert alert-danger'>User does not exist</div>";
}

echo json_encode($return);

mysqli_close($conn);