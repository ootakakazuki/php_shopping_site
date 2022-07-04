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
        スタッフ追加<br>
        <form  method="post" action="pro_add_check.php" enctype="multipart/form-data">
            商品名を入力してください。<br>
            <input type="text" name="name" style="width:200px"><br>
            価格入れて<br>
            <input type="text" name="price" style="width:50px"><br>
            <br>
            画像選べ<br>
            <input type="file" name="gazou" style="width=400px"><br>
            <input type="button" onclick="history.back()" value="戻る">
            <input type="submit" value="OK">
        </form>
    </body>
</html>