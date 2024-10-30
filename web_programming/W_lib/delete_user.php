<!-- user can delete their own account -->
 <!-- admin can delete any user account -->

<?php
include(__DIR__.'/head.php');
session_start();
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

$sql = "SELECT * FROM users WHERE userMail = '" . $_SESSION['username'] . "'";
$result = mysqli_query($conn, $sql);

$user = mysqli_fetch_assoc($result);
$userLevel = $user['userLevel'];
?>

<h2>Delete Account</h2>
<form action="" method="POST">
    <label for="user">Select a user:</label>
    <select name="user" id="user">
        <?php
        if ($userLevel == 1) {
            $sql = "SELECT * FROM users";
        } else {
            $sql = "SELECT * FROM users WHERE userMail = '" . $_SESSION['username'] . "'";
        }
        $result = $conn->query($sql);

        $users = array();
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {   
                $users[] = $row;
            }
        }

        foreach ($users as $user) {
            echo "<option value='".$user['userID']."'>".$user['userMail']."</option>";
        }
        ?>
    </select>
    <br>
    <input type="submit" class="btn btn-primary" value="Delete">
</form>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userID = $_POST['user'];

    $sql = "DELETE FROM users WHERE userID = $userID";


    if (mysqli_query($conn, $sql)) {
        echo "<div class='alert alert-success'>User deleted successfully</div>";
        if ($userLevel == 0) {
            // session_destroy();
            // header('Location: index.php');
        }
    } else {
        echo "<div class='alert alert-danger'>Error deleting user" . $conn->error . "</div>";
    }
}

include(__DIR__.'/footer.php');
?>