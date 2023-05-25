<?php 
 session_start();
 require_once "connect.php";

 var_dump($_POST['value']);
 var_dump($_POST['category']);
 var_dump($_SESSION['userid']);
if ($_POST['value'] > 0) {
     $value = $_POST['value'];
     $category_id = $_POST['category'];
     $user_id = $_SESSION['userid'];
     $date = $_POST['date'];
     $category_query = mysqli_query($connect, "SELECT * FROM categories WHERE id = $category_id AND user_id = $user_id");
     $category = mysqli_fetch_assoc($category_query);
     if ($date == "") { 
        $currentDate = date('Y-m-d');
        mysqli_query($connect, "INSERT INTO transactions (user_id, summ, category_id, date) VALUES ('$user_id', summ + $value, '$category_id', '$currentDate')");
    } else {
        mysqli_query($connect, "INSERT INTO transactions (user_id, summ, category_id, date) VALUES ('$user_id', summ + $value, '$category_id', '$date')");
    }
    mysqli_query($connect, "UPDATE accounts SET balance = balance - $value WHERE user_id = $user_id");
    header('Location: transactions.php');
}
?>
