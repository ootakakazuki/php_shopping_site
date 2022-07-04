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
        <?php
            try{
                $staff_code = $_POST['code'];

                // DB接続
                $dns = 'mysql:dbname=shop; host=localhost; charset=utf8';
                $user = 'root';
                $password = '';
                $dbh = new PDO($dns, $user, $password);
                $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $sql = 'DELETE FROM stuff_table WHERE code=?';

                $stmt = $dbh->prepare($sql);
                $data[] = $staff_code;
                $stmt->execute($data);

                $dbh = null;


            }catch(Exception $e){
                print 'ただいま障害発生中';
                print $e;
                exit();
            }
        ?>
        削除しました。<br>

        <a href="staff_list.php">戻る</a>
    </body>
</html>