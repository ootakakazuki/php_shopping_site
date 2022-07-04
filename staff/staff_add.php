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
            農園
        </title>
    </head>
    <body>
        スタッフ追加<br>
        <form  method="post" action="staff_add_check.php">
            スタッフ名を入力してください。<br>
            <input type="text" name="name" style="width:200px"><br>
            パスワード入れて<br>
            <input type="password" name="pass" style="width:100px"><br>
            もう一回<br>
            <input type="password" name="pass2" style="width:100px"><br>
            <br>
            <input type="button" onclick="history.back()" value="戻る">
            <input type="submit" value="OK">
        </form>
    </body>
</html>