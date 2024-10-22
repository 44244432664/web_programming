<?php require_once(__DIR__.'/head.php'); ?>

<!-- <div class="d-flex p-2">

</div> -->
<div class="d-flex justify-content-center">
    <form action="login_processing.php" id="login_form" method="post">
        <img src="img/Wanderer_s_Library.png" alt="The Wanderer's Library">

        <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" class="form-control" id="username" name="username">
            <p class="danger" id="username_noti"></p>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password">
            <p class="danger" id="password_noti"></p>
        </div>

        <div class="d-flex justify-content-center">
            <button type="submit" class="btn btn-primary hover m-1">Login</button>
            <a href="index.php?page=register" 
            class="btn btn-outline-primary hover m-1">Register</a>
        </div>
        <a href="index.php?page=forgot_password" 
        class="d-flex justify-content-center">Forgot Password?</a>
    </form>
     <!-- <input type="text" name="username" placeholder="Username">
        <input type="password" name="password" placeholder="Password">
        <button type="submit">Login</button> -->
</div>