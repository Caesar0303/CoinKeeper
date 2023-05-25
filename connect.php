<?php 
    session_start();
    $connect = mysqli_connect('localhost','root','','CoinKeeper');
    if(!$connect) {
        die('Ошибка');
    }

    if (!(isset($_SESSION["login"]))) {
        header('Location: authAndReg/auth&Reg.php');
    }
    
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
?>