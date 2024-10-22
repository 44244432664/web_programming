<?php include('head.php'); ?>

<body>
    <form action="" method="post" class="">
        <div class="form-group">
            <label for="bookName">Book Name</label>
            <input type="text" class="form-control" id="bookName" name="bookName" required>
        </div>

        <div class="form-group">
            <label for="cover">Cover</label>
            <input type="file" class="form-control" id="cover" name="cover">
        </div>

        <div class="form-group">
            <label for="author">Author</label>
            <input type="text" class="form-control" id="author" name="author" required>
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" id="description" name="description" rows="3"></textarea>
        </div>

        <div class="form-group">
            <div>
            <label for="category">Category:</label>
            </div>

            <?php
                // function add_category() {
                //     echo "<div class='form-control-inline'>";
                //     echo "<input class='form-control-input' type='text' placeholder='New Category' onkeyup='new_category(this.value)'>";
                //     echo "</div>";
                // }


                $servername = "localhost";
                $username = "root";
                $password = "";
                
                // $conn = new mysqli_connect($servername, $username, $password);
                $conn = mysqli_connect($servername, $username, $password);
                
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }
                else{
                    // echo "<p>Connected successfully</p></br>";
                }

                $conn = mysqli_connect($servername, $username, $password, "Library");

                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }
                else{
                    // echo "<p>Connected to Library successfully</p></br>";
                }


                re_qeuery:
                $sql = "SELECT * FROM categories";
                $result = $conn->query($sql);

                echo "div class='form-group' id='categories'>";
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {   
                        // echo "<option value=\"" . $row['category'] . "\">" . $row['category'] . "</option>";
                        echo "<div class='form-check form-check-inline'>";
                        echo "<input class='form-check-input' type='checkbox' name='". $row['category'] . "value='" . $row['category'] . ">";
                        echo "<label class='form-check-label' for='" . $row['category'] . "'>" . $row['category'] . "</label>";
                        echo "</div>";
                    }
                }
                else {
                    echo "<p>No categories found</p>";
                }
                echo "</div>";

                // echo "<div class='form-check form-check-inline' id='new_cat_form'></div>";
                echo "<div class='form-group' id='new_cat_form'>";
                echo "<div class='btn btn-primary' onclick='category_form()'>Add Category</div>";
                echo "</div>";

                $conn->close();
            ?>
        </div>

        <div class="form-group">
            <label for="content">Content</label>
            <input type="file" class="form-control" id="content" name="content" required>
        </div>


        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</body>