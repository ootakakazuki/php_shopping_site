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


                $sql = 'SELECT name, price, gazou FROM mst_product where code = ?';

                $stmt = $dbh->prepare($sql);
                $data[] = $pro_code;
                $stmt->execute($data);

                $rec = $stmt->fetch(PDO::FETCH_ASSOC);
                $pro_name = $rec['name'];
                $pro_price = $rec['price'];
                $pro_gazou_name_old = $rec['gazou'];

                $dbh = null;

                if ($pro_gazou_name_old == ""){
                    $disp_gazou = "";
                }else{
                    $disp_gazou = '<img src="./gaozu/'.$pro_gazou_name_old.'">';
                }
            }catch(Exception $e){
                print '障害';
                print $e;
                exit();
            }
        ?>
        商品修正<br><br>
        商品コード<br>
        <?php print $pro_code;?>
        <br><br>
        <form method="post" action="pro_edit_check.php" enctype="multipart/form-data">
            <input type="hidden" name="code" value="<?php print $pro_code; ?>">
            <input type="hidden" name="gazou_name_old" value="<?php print $pro_gazou_name_old; ?>">
            商品名<br>
            <input type="text" name="name" value="<?php print $pro_name;?>">
            <br>
            価格<br>
            <input type="text" name="price" style="width:50px" value="<?php print $pro_price;?>"><br>
            <br>
            画像を選んでください。<br>
            <input type="file" name="gazou" style="width:400px"><br>
            <input type="button" onclick="history.back()" value="戻る">
            <input type="submit" value="ok">
        </form>
    </body>
</html>