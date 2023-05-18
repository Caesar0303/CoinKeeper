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
</style>
<body>
    <div class="forms_wrapper">
        <form action="auth.php" method="POST" id="authorization_form" class="forms container mt-4">
            <h2>Авторизация</h2>
            <br>
            <input type="text" name="alogin" placeholder="Введите логин" id="alogin" class="form-control" required> 
            <br>
            <input type="password" name="apassword" placeholder="Введите пароль" id="apassword" class="form-control" required>
            <br>
            <button class="btn btn-success">Войти</button>
        </form>
        <br>
        <br>
        <br>
        <form action="reg.php" method="POST" id="registration_form" class="forms container mt-4">
            <h2>Регистрация</h2> 
            <br>
            <input type="text" name="rlogin" placeholder="Введите логин" id="rLogin" class="form-control" required>
            <br>
            <input type="text" name="remail" placeholder="Введите e-mail" id="rEmail" class="form-control" required>
            <br>
            <input type="password" name="rpassword" placeholder="Введите пароль" id="rPassword" class="form-control" required>
            <br>
            <button class="btn btn-success">Зарегистрироваться</button>
        </form>
    </div>  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.2/js/bootstrap.min.js"></script>
</body>
</html>
