<?php
    require_once 'connect.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="" method="GET" id="mySecondForm">
        <input id="myInput" type="number" name="value">
        <input id="myInput" type="date" name="date">
        <input type="hidden" name="updateid" value="<?= $_GET['updateId'] ?>">
        <select id="category" name="category">
            <?php
            $user_id = $_SESSION['userid'];
            $result = mysqli_query($connect, "SELECT id, name FROM categories WHERE user_id = '$user_id'");
            while ($category = mysqli_fetch_assoc($result)) {
                echo '<option value="' . $category['id'] . '">' . $category['name'] . '</option>';
            }
            ?>
        </select>
        <button class="btn btn-primary">Сохранить</button>
    </form> 
    <?php
        $updateid = $_GET['updateid'];
        $newValue = $_GET['value'];
        $newDate = $_GET['date'];
        $newCategory = $_GET['category'];

        if (isset($_GET['deleteId'])) {
            $value = mysqli_query($connect, "SELECT summ FROM transactions WHERE id = {$_GET['deleteId']}");
            $value = mysqli_fetch_all($value);
            $value = $value[0][0];
        } else {
            $value = mysqli_query($connect, "SELECT summ FROM transactions WHERE id = '$updateid'");
            $value = mysqli_fetch_all($value);
            $value = $value[0][0];
        }

        if(isset($updateid)) {
            mysqli_query($connect, "UPDATE transactions SET summ = '$newValue', date = '$newDate', category_id = '$newCategory' WHERE id = $updateid");
            $newValue = $newValue - $value;
            mysqli_query($connect, "UPDATE accounts SET balance = balance + $newValue WHERE user_id = $user_id");
            header('Location: transactions.php');
        }
        if(isset($_GET['deleteId'])) {
            mysqli_query($connect, "UPDATE accounts SET balance = balance + $value WHERE user_id = $user_id");
            mysqli_query($connect, "DELETE FROM transactions WHERE id = {$_GET['deleteId']}");
            header('Location: transactions.php');
        }
    ?>

</body>
</html>