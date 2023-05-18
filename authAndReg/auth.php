<?php 
    require_once('../connect.php');

    $login = $_POST['alogin'];
    $password = md5($_POST['apassword']);
    if(empty($login) || empty($password)) {
        echo 'Заполните все поля';
    } else {
        $sql = "SELECT * FROM `users` WHERE login = '$login' AND password = '$password'";
        $result = $connect->query($sql);
            if ($result->num_rows > 0){
                while ($row = $result->fetch_assoc()) {
                    $_SESSION['login'] =  $login;
                    header('Location: ../index.php');
                    exit;
                }
            } else {
                echo 'Нет такого пользователя';
            }
    }
?>