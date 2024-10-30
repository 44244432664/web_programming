<!-- here store the function buttons to update and delete the user account, add, update, delete the book information -->

<?php 
include(__DIR__.'/head.php');
include(__DIR__.'/navbar.php');
 ?>

<body>
    <div class="container">
        <div class="p-5 mb-4 rounded-3">
            <div class="container-fluid py-5 justify-content-center">
                <h1 class="display-5 fw-bold">The book of manipulation</h1>
                <p class="fs-3">
                    Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quam quidem nulla reiciendis ea. Illum,
                    dolor. Voluptatibus et minima blanditiis distinctio quidem cum autem excepturi vel voluptate a. Earum,
                    eum voluptas?
                </p>
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-center">
        <div class="container-fluid py-5 justify-content-start">
            <a href="user_profile.php?page=new_book" class="btn btn-primary">Add Book</a>
            <a href="user_profile.php?page=update_book" class="btn btn-primary">Update Book</a>
            <a href="user_profile.php?page=delete_book" class="btn btn-primary">Delete Book</a>
        </div>

        <div class="container-fluid py-5 justify-content-end">
            <a href="user_profile.php?page=update_user" class="btn btn-primary">Update profile</a>
            <a href="delete_user.php" class="btn btn-danger">Delete Account</a>
        </div>
    </div>
<?php
if (isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = '';
}

if ($page == 'new_book'){
    include(__DIR__.'/new_book.php');
} else if ($page == 'update_book'){
    include(__DIR__.'/update_book.php');
} else if ($page == 'delete_book'){
    include(__DIR__.'/delete_book.php');
} else if ($page == 'update_user'){
    include(__DIR__.'/update_user.php');
}

include(__DIR__.'/footer.php');
?>