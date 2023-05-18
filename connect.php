<?php 
    session_start();
    $connect = mysqli_connect('localhost','root','','CoinKeeper');
    if(!$connect) {
        die('Ошибка');
    }
?>