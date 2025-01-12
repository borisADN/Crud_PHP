<?php 
session_start();
//logic to delete user
include('db.php');
$id = $_GET['id'];
if (isset($id)) {
    $query = "DELETE FROM `users` WHERE id = '$id'";
    $result = mysqli_query($conn, $query);
    if ($result) {
        $_SESSION['message'] = 'User deleted successfully';
        $_SESSION['message_type'] = 'success';
        header('Location: index.php');
    } 
}


?>