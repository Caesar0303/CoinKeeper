<?php 
    session_start();
    require_once 'connect.php';
    $categories = mysqli_query($connect, "SELECT id, name FROM categories WHERE user_id = {$_SESSION['userid']}");
?>
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
    .header {
        margin-top:10px;
        font-size:25px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
    }
    body{
        background:#F0F8FF;
    }
    .header {
        margin-bottom: 100px;
    }
    #myForm {
        display: flex;
        position: fixed;
        bottom: 0;
        left: 0;
        right: 0;
        margin: auto;
        justify-content: center;
        align-items: stretch;
        margin-bottom: 30px;
    }

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
    #myInput {
        width: 800px;
    }
    #category {
        width: 200px;
    }
    .table_wrapper {
        display: flex;
        justify-content: center;
        flex-direction: column-reverse;
    }
    .table {
        font-size:22;
    }
    .btn1 {
        margin-right: 50px;
    }
    .hide {
        display: none;
    }
</style>
<body>
</div>
    <a class="btn btn-danger" href="index.php">Вернутся на главную страницу</a>
    <form action="category_add.php" method="POST" id="mySecondForm">
        <input type="text" name="newCategory">
        <button type="submit" class="btn btn-success" id="addNewExpenses">Добавить новый вид трат</button> 
        <br>
    </form>
    <div class="table_wrapper table-responsive">
        <table>
            <tbody class="table table-striped table-bordered table-hover">
                <tr>
                    <th>
                        Категория
                    </th>
                </tr>
                <?php
                    while ($row = mysqli_fetch_assoc($categories)) {
                        $i++;
                        echo '<tr>';
                        echo '<td>' . $row['name'] . '</td>';
                        // echo '<td>' . $row['total_expenses'] . "$" . '</td>';
                        echo '<td><a href="category_edit.php?deleteId='.$row['id'].'">Удалить</a></td>';
                        echo '<td><a href="category_edit.php?updateid='.$row['id'].'">Изменить</a></td>';
                        echo '</tr>';
                    }
                ?>
            </tbody>
        </table>
    </div> 
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="script.js"></script>
</body>
</html>