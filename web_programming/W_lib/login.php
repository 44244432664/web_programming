<?php require_once(__DIR__.'/head.php'); ?>

<!-- <div class="d-flex p-2">

</div> -->
<!-- <body> -->

<div class="d-flex justify-content-center">
    <form action="" id="login_form" method="post" onsubmit=" event.preventDefault(); validateForm();">
        <div id="login_noti"></div>
        <img src="img/Wanderer_s_Library.png" style="width:50%;" alt="The Wanderer's Library" class="center">

        <h2 class="text-center primary">Login</h2>

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

<script>
    function validateForm() {
            var username = document.getElementById("username").value;
            var password = document.getElementById("password").value;

            var valid = false;

            // var specialChars = /[!#$%^&*()_+\-=\[\]{};':"\|,.<>\/?]+/;
            var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
            var numbers = /[0-9]/;

            if (!mailformat.test(username) && username.length > 0) {
                document.getElementById("username_noti").textContent = "Username is not in mail format.";
                // return false;
                valid = false;
            }else{
                valid = true;}

            if (password.length < 8 || password.toLowerCase() === password || !numbers.test(password)) {
                if (password.length > 0){
                    document.getElementById("password_noti").textContent = "Password must be at least 8 characters long, contain at least one uppercase letter and one number.";
                }
                // return false;
                valid = false;
            }else{
                valid = true;}
            // if (!validateInput(username, password)) {
            //     tmpUsername = username;
            //     tmpPassword = password;
            // }
            // return true;


            if(valid){
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        res = this.responseText;
                        res =JSON.parse(res);
                        // console.log(res);
                        // console.log(typeof res['success']);
                        // console.log(res['success'].length)
                        // console.log(res['success']==true);
                        document.getElementById("login_noti").innerHTML = res;
                        if(res['logged_in']) {
                            document.getElementById("login_noti").innerHTML = res['msg'];
                            window.location.href='index.php?page=home';
                        } else {
                            // document.getElementById("log_res").innerHTML = products;
                            document.getElementById("login_noti").innerHTML = res['msg'];
                        }
                    }
                };
                xmlhttp.open("POST", "login_processing.php", true);
                // xmlhttp.open("GET", "login_processing.php?q="+username+"&p="+password, true);
                xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                var postData = "username=" + username + "&password=" + password;
                xmlhttp.send(postData);   

            }
        }
</script>

<?php require_once(__DIR__.'/footer.php'); ?>