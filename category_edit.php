<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.2/css/bootstrap.min.css">
    <title>Document</title>
</head>
<style>
    .wrapper {
        display: flex;
        flex-direction: row-reverse;
        justify-content: flex-end;
    }
</style>
<body>
<?php
session_start();
require_once 'connect.php';
?>
<div class="wrapper">
    <a href="category.php" class="btn btn btn-danger">Назад</a>
    <form action="" method="GET">
        <input type="text" name="edited_name_category">
        <button class="btn btn btn-success">Сохранить</button>
    </form>
</div>
<?php
if (isset($_GET['updateid'])) {
    $_SESSION['updateid'] = $_GET['updateid'];
}

$category = mysqli_query($connect, "SELECT name FROM categories WHERE id = {$_SESSION['updateid']}");
$category = mysqli_fetch_all($category);
$category = $category[0][0];

if (isset($_GET['edited_name_category']) && isset($_SESSION['updateid'])) {
    mysqli_query($connect, "UPDATE categories SET name = '{$_GET['edited_name_category']}' WHERE id = {$_SESSION['updateid']}");
    header('Location: category.php');
}

?>
</body>
</html>