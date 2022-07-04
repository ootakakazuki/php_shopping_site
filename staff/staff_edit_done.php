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
                $staff_name = $_POST['name'];
                $staff_pass = $_POST['pass'];

                $staff_name = htmlspecialchars($staff_name, ENT_QUOTES, 'UTF-8');
                $staff_pass = htmlspecialchars($staff_pass, ENT_QUOTES, 'UTF-8');

                // DB接続
                $dns = 'mysql:dbname=shop; host=localhost; charset=utf8';
                $user = 'root';
                $password = '';
                $dbh = new PDO($dns, $user, $password);
                $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $sql = 'UPDATE stuff_table SET name=?, password=? WHERE code=?';
//                $sql = 'UPDATE stuff_table SET name=?,  password=?';

                $stmt = $dbh->prepare($sql);
                $data[] = $staff_name;
                $data[] = $staff_pass;
                $data[] = $staff_code;
                $stmt->execute($data);

                $dbh = null;

                print $staff_name;
                print 'さんを追加しました<br>';

            }catch(Exception $e){
                print 'ただいま障害発生中';
                print $e;
                exit();
            }
        ?>
        修正しました。<br>

        <a href="staff_list.php">戻る</a>
    </body>
</html>