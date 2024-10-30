<!-- only user can update their own information -->

<form action="" method="POST">
    <div class="form-group">
        <label for="email">New Email</label>
        <input type="email" class="form-control" id="email" name="email" value="<?php echo $_SESSION['username']; ?>">
    </div>
    <div class="form-group">
        <label for="password">Current Password</label>
        <input type="password" class="form-control" id="password" name="password" value="">
    </div>
    <div class="form-group">
        <label for="newPassword">New Password</label>
        <input type="password" class="form-control" id="newPassword" name="newPassword">
    </div>
    <div class="form-group">
        <label for="confirmPassword">Confirm Password</label>
        <input type="password" class="form-control" id="confirmPassword" name="confirmPassword">
    </div>
    <input type="submit" class="btn btn-primary" value="Update">
</form>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $newPassword = $_POST['newPassword'];
    $confirmPassword = $_POST['confirmPassword'];

    $sql = "SELECT * FROM users WHERE userMail = '" . $_SESSION['username'] . "'";
    $result = mysqli_query($conn, $sql);

    $user = mysqli_fetch_assoc($result);

    if (password_verify($password, $user['password']) === false) {
        echo "<div class='alert alert-danger'>Incorrect password</div>";
    } else
    {
        if ($newPassword !== $confirmPassword) {
            echo "<div class='alert alert-danger'>Passwords do not match</div>";
        } else {
            $sql = "UPDATE users SET userMail = '$email', password = '$newPassword' WHERE userID = '" . $user['userID'] . "'";
            if (mysqli_query($conn, $sql)) {
                echo "<div class='alert alert-success'>User updated successfully</div>";
                $_SESSION['username'] = $email;
            } else {
                echo "<div class='alert alert-danger'>Error updating user: " . mysqli_error($conn) . "</div>";
            }
        }
    }
}

?>