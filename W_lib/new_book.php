<?php
// $sharedOptions = [
//     0 => 1,
//     1 => 2,
//     2 => 3,
//     3 => 4,
//     4 => 5
// ];
?>

<?php include('head.php'); ?>

<body>
    <form action="" method="post" class="">
        <div class="form-group">
            <label for="bookName">Book Name</label>
            <input type="text" class="form-control" id="bookName" name="bookName" required>
        </div>

        <div class="form-group">
            <label for="cover">Cover</label>
            <input type="file" class="form-control" id="cover" name="cover" required>
        </div>

        <div class="form-group">
            <label for="author">Author</label>
            <input type="text" class="form-control" id="author" name="author" required>
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
        </div>

        <div class="form-group">
            <div>
            <label for="category">Category:</label>
            </div>

            <?php
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

                $sql = "SELECT * FROM categories";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    // echo "<p>Checkbox:</p>";    
                    echo "<select name='category' multiple id='category' class='form-control'>";
                    // echo "<div class='form-check'>";
                    while($row = $result->fetch_assoc()) {   
                        echo "<option value='" . $row['category'] . "'>" . $row['category'] . "</option>";
                        // echo "<input class='form-check-input' type='checkbox' name='category[]' value='" . $row['category'] . "' id='" . $row['category'] . "'>";
                        // echo "<label class='form-check-label' for='" . $row['category'] . "'>" . $row['category'] . "</label>";
                    }
                    echo "<option value='other'>Other</option>";
                    echo "</select>";
                    // echo "<input class='form-check-input' type='checkbox' name='category[]' value='other' id='other'>";
                    // echo "<label class='form-check-label' for='other'>Other</label>";
                    // echo "</div>";
                }
                else {
                    echo "0 results";
                }
            ?>
        </div>

        <div class="form-group">
            <label for="content">Content</label>
            <input type="file" class="form-control" id="content" name="content" required>
        </div>
    </form>
</body>