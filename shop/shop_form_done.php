<?php
    session_start();
    session_regenerate_id(true);
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../css/style.css">
    </head>
    <body>
        <?php 
            try{

                require_once("../common/common.php");
                $post = sanitize($_POST);

                $onamae = $post['onamae'];
                $email = $post['email'];
                $postal1 = $post['postal1'];
                $postal2 = $post['postal2'];
                $address = $post['address'];
                $tel = $post['tel'];

                print $onamae.'様、注文サンクス<br>';
                print $email.'に送ったよ。確認してね。<br>商品は以下の住所に送ったよ。<br>';
                print $postal1.'-'.$postal2.'<br>'.$address.'<br>'.$tel.'<br>';

                print '注文内容<br>';
                $honbun = "--------------------------\n";

                $cart = $_SESSION['cart'];
                $kazu = $_SESSION['kazu'];
                $max = count($cart);


                // DB接続
                $dns = 'mysql:dbname=shop; host=localhost; charset=utf8';
                $user = 'root';
                $password = '';
                $dbh = new PDO($dns, $user, $password);
                $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                for ($i = 0; $i < $max; $i++){
                    $sql = 'SELECT name, price FROM mst_product where code=?';
                    $stmt = $dbh->prepare($sql);
                    $data[0] = $cart[$i];
                    $stmt->execute($data);

                    $rec = $stmt->fetch(PDO::FETCH_ASSOC);
                    
                    $name = $rec['name'];
                    $price = $rec['price'];
                    $kakaku[] = $price;
                    $suryo = $kazu[$i];
                    $shokei = $price * $suryo;

                    $honbun .= $name.' ';
                    $honbun .= $price.'円 x';
                    $honbun .= $suryo.'個 =';
                    $honbun .= $shokei."円\n";
                    
                }

                $sql = 'INSERT INTO dat_sales(code_member, name, email, postal1, postal2, address, tel) values(?, ?, ?, ?, ?, ?, ?)';
                $stmt = $dbh -> prepare($sql);
                $data = array();
                $data[] = 0;
                $data[] = $onamae;
                $data[] = $email;
                $data[] = $postal1;
                $data[] = $postal2;
                $data[] = $address;
                $data[] = $tel;
                $stmt->execute($data);

                $sql = 'SELECT LAST_INSERT_ID()';
                $stmt = $dbh -> prepare($sql);
                $stmt -> execute();
                $rec = $stmt->fetch(PDO::FETCH_ASSOC);
                $last_code = $rec['LAST_INSERT_ID()'];

                for ($i = 0; $i < $max; $i++)
                {
                    $sql = 'INSERT INTO dat_sales_product(code_sales, code_product, price, quantity) values(?, ?, ?, ?)';
                    $stmt = $dbh -> prepare($sql);
                    $data = array();
                    $data[] = $last_code;
                    $data[] = $cart[$i];
                    $data[] = $kakaku[$i];
                    $data[] = $kazu[$i];
                    $stmt -> execute($data);
                }
                $dbh = null;
                $honbun .= "--------------------------\n";

                print nl2br($honbun);

                // 客宛
                $title = "注文ありがと";
                $header = "From info@kuro.co.jp";
                $honbun = html_entity_decode($honbun, ENT_QUOTES, 'UTF-8');
                mb_language("Japanese");
                mb_internal_encoding('UTF-8');
                mb_send_mail($email, $title, $honbun, $header);

                // 店宛
                $title = "客から注文あったよ";
                $header = 'From:'.$email;
                $honbun = html_entity_decode($honbun, ENT_QUOTES, 'UTF-8'); 
                mb_language("Japanese");
                mb_internal_encoding('UTF-8');
                mb_send_mail("info@kuro.co.jp", $title, $honbun, $header);
            }catch(Exception $e){
                print $e;
                exit();
            }

        ?>

    </body>
</html>