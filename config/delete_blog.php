<?php
session_start();

// Check if the delete button is clicked and if the user is an admin
if (isset($_POST['delete_blog']) && $_SESSION["admink"]) {
    // Get the blog ID to delete
    $blog_id = $_POST['blog_id'];

    // Include your database connection file or establish the connection here
    include_once('databases.php'); // Update with the correct file path

    // Perform the deletion query
    $delete_query = "DELETE FROM tbl_ckeditor WHERE id = $blog_id";
    $result = mysqli_query($induction, $delete_query);

    // Check for success and perform actions accordingly
    if ($result) {
        // Deletion successful
        echo "Успешно yдален.";
        // You may redirect the user or perform other actions here
    } else {
        // Deletion failed
        echo "Ошибка " . mysqli_error($induction);
    }
}
?>