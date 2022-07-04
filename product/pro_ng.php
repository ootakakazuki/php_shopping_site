
<?php
    session_start();
    session_regenerate_id(true);
    if (!isset($_SESSION['login'])){
        print 'ログインされていません。<br>';
        print '<a href="../staff_login/staff_login.html">ログイン画面へ</a>';
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
        商品未選択<br>
        <a href="pro_list.php">戻る</a>
    </body>
</html>