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
    body{
        background:#F0F8FF;
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
    .table_wrapper {
        display: flex;
        justify-content: center;
        flex-direction: column-reverse;
    }
    .btn2 {
        margin-left: 10px;
    }
</style>
<body>
    <?php
        $_POST = json_decode(file_get_contents('php://input'), true);
        require_once 'connect.php';
        $result = mysqli_query($connect, "SELECT id FROM users WHERE login = '{$_SESSION["login"]}'");
        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $user_id = $row['id'];
            $_SESSION['userid'] = $user_id;
            $result = mysqli_query($connect, "SELECT id FROM accounts WHERE user_id = '$user_id'");
        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $account_id = $row['id'];
            $_SESSION['account_id'] = $account_id; 
        } else {
            mysqli_query($connect, "INSERT INTO accounts (user_id, name, balance) VALUES ('$user_id', '{$_SESSION['login']}', 0)");
            $account_id = mysqli_insert_id($connect);
        }
            $_SESSION['account_id'] = $account_id;
        } else {
            echo "Пользователь не найден!";
        }

        $result = mysqli_query($connect, "SELECT balance FROM accounts WHERE user_id = {$_SESSION['userid']} AND id = {$_SESSION['account_id']}");
        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $balance = $row['balance'];
            $_SESSION['balance'] = $balance;
        } else {
            echo "Не удалось получить баланс.";
        }

        $account_id = mysqli_insert_id($connect);
        $category2 = mysqli_query($connect, "SELECT id, name, total_expenses FROM categories WHERE user_id = {$_SESSION['userid']}");
    ?>
    <a href="index.php" class="btn btn-danger">Вернутся на главную страницу</a>
    <form action="update.php" method="POST" id="myForm">
        <input id="myInput" type="number" >
        <select id="category" name="category">
        <?php
            $user_id = $_SESSION['userid'];
            $result = mysqli_query($connect, "SELECT id, name FROM categories WHERE user_id = '$user_id'");
            while ($category = mysqli_fetch_assoc($result)) {
                echo '<option value="' . $category['id'] . '">' . $category['name'] . '</option>';
            }
        ?>
        </select>
        <button class="btn2 btn-primary" type="submit">Сохранить</button>
    </form>

    <div class="table_wrapper table-responsive">
        <table>
            <tbody class="table table-striped table-bordered table-hover">
                <tr>
                    <th>
                        Категория
                    </th>
                    <th>
                        Раходы
                    </th>
                </tr>
                <?php
                    while ($row = mysqli_fetch_assoc($category2)) {
                        $i++;
                        echo '<tr>';
                        echo '<td>' . $row['name'] . '</td>';
                        echo '<td>' . $row['total_expenses'] . "$" . '</td>';
                        // echo '<td><a href="update.php?deleteId='.$row['id'].'">Удалить</a></td>';
                        echo '</tr>';
                    }
                ?>
            </tbody>
        </table>
    </div> 
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="spend.js"></script>
</body>
</html>