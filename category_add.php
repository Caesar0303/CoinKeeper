<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php 
        require_once('connect.php');
        var_dump($_POST['newCategory']);
        mysqli_query($connect, "INSERT INTO categories (user_id, name) VALUES ('".$_SESSION['userid']."', '".$_POST['newCategory']."')");
        header('Location: category.php');
    ?>
</body>
</html>