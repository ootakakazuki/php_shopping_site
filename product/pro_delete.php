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
                $pro_code = $_GET['procode'];
                // DB接続
                $dns = 'mysql:dbname=shop; host=localhost; charset=utf8';
                $user = 'root';
                $password = '';
                $dbh = new PDO($dns, $user, $password);
                $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                
                $sql = 'SELECT name FROM mst_product where code = ?';

                $stmt = $dbh->prepare($sql);
                $data[] = $pro_code;
                $stmt->execute($data);

                $rec = $stmt->fetch(PDO::FETCH_ASSOC);
                $pro_name = $rec['name'];

                $dbh = null;



            }catch(Exception $e){
                print '障害';
                exit();
            }
        ?>
        商品削除<br><br>
        商品コード<br>
        <?php print $pro_code;?>
        <br><br>
        この商品を削除しますよ。<br>
        <form method="post" action="pro_delete_done.php">
            <input type="hidden" name="code" value="<?php print $pro_code; ?>">
            【スタッフ名】<br>
            <?php print $pro_name;?>
            <br>
            <input type="button" onclick="history.back()" value="戻る">
            <input type="submit" value="ok">
        </form>
    </body>
</html>