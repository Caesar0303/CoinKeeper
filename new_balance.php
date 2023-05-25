<?php 
    require_once 'connect.php';
    $newValue = $_POST['value'];
    if (isset($newValue)) {
        mysqli_query($connect, "UPDATE accounts SET balance = $newValue WHERE user_id = $user_id");
        header('location: index.php');
    }
?>