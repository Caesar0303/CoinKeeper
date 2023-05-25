<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.2/css/bootstrap.min.css">
    <title>Document</title>
</head>
<body>
    <style>
    #mySecondForm {
        display: flex;
        position: fixed;
        bottom: 0;
        left: 0;
        right: 0;
        margin: auto;
        justify-content: center;
        align-items: stretch;
        margin-bottom: 80px;
        
    }

    body{
        background:#F0F8FF;
    }
    .table_wrapper {
        display: flex;
        justify-content: center;
        flex-direction: column-reverse;
    }
    .table {
        font-size:22;
    }
    </style>
    <?php
        require_once 'connect.php';
    ?>
    <a href="index.php" class="btn btn-danger">На главную страницу</a>
    <form action="transactions_update.php" method="POST" id="mySecondForm">
        <input id="myInput" type="number" name="value" placeholder="Введите сумму">
        <input id="myInput" type="date" name="date">
        <select id="category" name="category">
            <?php
            $user_id = $_SESSION['userid'];
            $result = mysqli_query($connect, "SELECT id, name FROM categories WHERE user_id = '$user_id'");
            while ($category = mysqli_fetch_assoc($result)) {
                echo '<option value="' . $category['id'] . '">' . $category['name'] . '</option>';
            }
            ?>
        </select>
        <button class="btn btn-primary" type="submit">Сохранить</button>
    </form> 
    <div class="table_wrapper table-responsive">
        <table>
            <tbody class="table table-striped table-bordered table-hover">
                <tr>
                    <th>
                        Категория
                    </th>
                    <th>
                        Сумма
                    </th>
                    <th>
                        Дата
                    </th>
                </tr>
                <?php 
                    $transactions = mysqli_query($connect, "SELECT id, summ, category_id, date FROM transactions WHERE user_id = {$_SESSION['userid']} ORDER BY date DESC, id DESC");
                    $transactions = mysqli_fetch_all($transactions);
                    foreach($transactions as $transaction) {
                        $category_names = mysqli_query($connect, "SELECT name FROM categories WHERE id = '$transaction[2]'");
                        $category_names = mysqli_fetch_all($category_names);
                        foreach ($category_names as $category_name){
                ?>
                    <tr>
                        <td><?= $category_name[0] ?></td>
                        <td><?= "+".$transaction[1]."$"?></td>
                        <td><?= $transaction[3] ?></td>
                        <td><a href="transactions_edit_delete.php?deleteId=<?= $transaction[0]; ?>">Удалить</a></td>
                        <td><a href="transactions_edit_delete.php?updateId=<?= $transaction[0]; ?>">Изменить</a></td>
                    </tr>
                <?php 
                        }
                    }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>