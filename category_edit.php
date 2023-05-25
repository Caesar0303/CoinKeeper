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
    $category = mysqli_query($connect, "SELECT name FROM categories WHERE id = {$_GET['updateid']}");
    $category = mysqli_fetch_all($category);
    $category = $category[0][0];
?>
<div class="wrapper">
    <a href="category.php" class="btn btn btn-danger">Назад</a>
    <form action="" method="GET">
        <input type="text" name="edited_name_category" value="<?= $category ?>">
        <input type="hidden" name="updateid" value="<?= $_GET['updateid'] ?>">
        <button class="btn btn btn-success">Сохранить</button>
    </form>
</div>
<?php
    if (isset($_GET['edited_name_category']) && isset($_GET['updateid'])) {
        mysqli_query($connect, "UPDATE categories SET name = '{$_GET['edited_name_category']}' WHERE id = {$_GET['updateid']}");
        header('Location: category.php');
    }

    if (isset($_GET['deleteId'])) {
        $id = $_GET['deleteId'];
        mysqli_query($connect, "DELETE FROM categories WHERE id = $id AND user_id = {$_SESSION['userid']} ");
        header('Location: category.php');
    }
?>
</body>
</html>