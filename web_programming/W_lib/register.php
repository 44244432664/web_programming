<div class="d-flex justify-content-center">
<form action="" id="register_form" method="post" onsubmit="event.preventDefault(); validateForm();">
    <div id="register_noti"></div>
    <img src="img/Wanderer_s_Library.png" style="width:50%;" alt="The Wanderer's Library" class="center">

    <h2 class="text-center primary">Register</h2>

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
    <div class="mb-3">
        <label for="password2" class="form-label">Confirm Password</label>
        <input type="password" class="form-control" id="password2" name="password2">
        <p class="danger" id="password2_noti"></p>
    </div>

    <div class="d-flex justify-content-center">
        <button type="submit" class="btn btn-primary hover m-1">Register</button>
        <a href="index.php?page=login" 
        class="btn btn-outline-primary hover m-1">Login</a>
    </div>
</form>
</div>




<script>
    function validateForm() {
            var username = document.getElementById("username").value;
            var password = document.getElementById("password").value;
            var password2 = document.getElementById("password2").value;

            var valid = false;

            // var specialChars = /[!#$%^&*()_+\-=\[\]{};':"\|,.<>\/?]+/;
            var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
            var numbers = /[0-9]/;

            if (!mailformat.test(username) && username.length > 0) {
                document.getElementById("username_noti").textContent = "Username is not in mail format.";
                // return false;
                valid = false;
            }
            else{
                valid = true;}

            if (password.length < 8 || password.toLowerCase() === password || !numbers.test(password)) {
                if (password.length > 0){
                    document.getElementById("password_noti").textContent = "Password must be at least 8 characters long, contain at least one uppercase letter and one number.";
                }
                // return false;
                valid = false;
            }
            else{
                valid = true;}

            if (password2 != password) {
                if (password2.length > 0){
                    document.getElementById("password2_noti").textContent = "Passwords do not match.";
                }
                // return false;
                valid = false;
            }
            else{
                valid = true;}


            // window.location.href='index.php?page=home';
            console.log(valid);
            console.log(username);
            console.log(password);
            console.log(password2);
            if(valid){
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        res = this.responseText;
                        console.log(res);
                        res =JSON.parse(res);
                        // console.log(res);
                        // console.log(typeof res['success']);
                        // console.log(res['success'].length)
                        // console.log(res['success']==true);
                        // console.log(res);
                        // console.log(res['logged_in']);
                        console.log(res['msg']);
                        // document.getElementById("login_noti").innerHTML = res;
                        if(res['registered']) {
                            document.getElementById("register_noti").innerHTML = res['msg'];
                            window.location.href='index.php?page=home';
                        } else {
                            // document.getElementById("log_res").innerHTML = products;
                            document.getElementById("register_noti").innerHTML = res['msg'];
                        }
                    }
                };
                xmlhttp.open("POST", "register_processing.php");
                // xmlhttp.open("GET", "login_processing.php?q="+username+"&p="+password, true);
                xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                var postData = "username=" + username + "&password=" + password;
                xmlhttp.send(postData);   

            }

        }
</script>