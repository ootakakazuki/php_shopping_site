<?php
    session_start();
    session_regenerate_id(true);
    if (!isset($_SESSION['login'])){
        print 'ログインされていません。<br>';
        print '<a href="../staff_login/staff_login.html">ログイン画面へ</a>';
        exit();
    }else{
        print $_SESSION['staff_name'].'さんログイン中<br>';
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>
            NG
        </title>
    </head>
    <body>
        スタッフ未選択<br>
        <a href="staff_list.php">戻る</a>
    </body>
</html>