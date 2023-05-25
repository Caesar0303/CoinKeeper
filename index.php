<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.2/css/bootstrap.min.css">
    <title>CoinKeeper</title>
</head>
<style>
    .header {
        margin-bottom: 100px;
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

    .table_wrapper {
        display: flex;
        justify-content: center;
        flex-direction: column-reverse;
    }
    .table {
        font-size:22;
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
</style>
<body>
    <?php 
        session_start();
        require_once 'connect.php';
    ?>
    <div class="header">
        <a class="btn btn-danger" href="http://coinkeeper3/authAndReg/auth&amp;reg.php">Выйти</a>
        <?php
            echo "Добро пожаловать " . $_SESSION['login'] . "!" . "<br>";
            echo "Ваш балланс " . $balance . "$" . "<br>";
            $categories = mysqli_query($connect, "SELECT id, name FROM categories WHERE user_id = {$_SESSION['userid']}");
        ?>
    </div>
    <form action="new_balance.php" method="POST" id="mySecondForm">
        <input type="number" name="value" placeholder="Новый счёт">
        <button class="btn btn-primary"> Сохранить </button>
    </form>
    <div>
        <a class="btn btn-danger" href="category.php">Категорий</a>
        <a class="btn btn-danger" href="transactions.php">История</a>
        <a class="btn btn-danger" href="http://debt.loc?login=<?= $_SESSION['login'] ?>">Долги</a>
    </div>
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
                    foreach($categories as $category) {
                        $query = "SELECT SUM(summ) AS total_sum FROM transactions WHERE category_id = {$category['id']}";
                        $result = mysqli_query($connect, $query);
                        $row = mysqli_fetch_assoc($result);
                        $totalSum = $row['total_sum'];
                ?>
                <tr>
                    <td><?= $category['name'] ?></td>
                    <td><?php if($totalSum == NULL) {echo '0$';} 
                              else { echo $totalSum . "$"; }?>
                    </td>
                </tr>
                <?php 
                    }
                ?>
                <tr>

                </tr>
            </tbody>
        </table>
    </div> 
</body>
</html>