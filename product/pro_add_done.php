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
        <?php
            try{
                $pro_name = $_POST['name'];
                $pro_price = $_POST['price'];
                $pro_gazou_name = $_POST['gazou_name'];


                $pro_name = htmlspecialchars($pro_name, ENT_QUOTES, 'UTF-8');
                $pro_price = htmlspecialchars($pro_price, ENT_QUOTES, 'UTF-8');

                // DB接続
                $dns = 'mysql:dbname=shop; host=localhost; charset=utf8';
                $user = 'root';
                $password = '';
                $dbh = new PDO($dns, $user, $password);
                $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $sql = 'INSERT INTO mst_product(name, price, gazou) values(?, ?, ?)';
                $stmt = $dbh->prepare($sql);
                $data[] = $pro_name;
                $data[] = $pro_price;
                $data[] = $pro_gazou_name;
                $stmt->execute($data);

                $dbh = null;

                print $pro_name;
                print 'を追加しました<br>';

            }catch(Exception $e){
                print 'ただいま障害発生中';
                print $e;
                exit();
            }
        ?>
        <a href="pro_list.php">戻る</a>
    </body>
</html>