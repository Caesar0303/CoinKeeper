<?php
    require_once('../connect.php');
    $login = $_POST['rlogin'];
    $password = md5($_POST['rpassword']);
    $email = $_POST['remail'];
    if (empty($login) || empty($password) || empty($email)) {
        $_SESSION['notFill'] = true;
    } else {
        $sql = "INSERT INTO `users` (login,password,email) VALUES ('$login','$password','$email')";
        if ($connect -> query($sql) === TRUE) {
            echo 'Успех!';
            $_SESSION['success'] = true;
        } else {
            $_SESSION['error'] = true;
            echo 'Ошибка ' . $connect -> error;
        }
    }

?>
