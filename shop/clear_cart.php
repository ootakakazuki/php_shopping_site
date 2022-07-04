<?php 
    session_start();
    $_SESSION = array();

    if (isset($_COOKIE['session_name'])){
        setcookie(session_name(), '', time() - 42000, '/');
    }
    session_destroy();
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>
            農園
        </title>
    </head>
    <body>
        カートを空にしました。
        <br><br>
        <a href="staff_login.html">ログイン画面へ</a>
    </body>
</html>
