<?php 
    session_start();
    if (!isset($_SESSION['login'])){
        print 'ログインされていません';
        print '<br>';
        print '<a href="staff_login.html">ログイン画面へ</a>';
        exit();
    }
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
        ショップ管理メニュー<br>
        <br>
        <a href="../staff/staff_list.php">スタッフ管理</a><br>
        <a href="../product/pro_list.php">商品管理</a><br>
        <a href="staff_logout.php">ログアウト</a>
    </body>
</html>
