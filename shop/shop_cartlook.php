<?php
    session_start();
    session_regenerate_id(true);
    if (!isset($_SESSION['member_login']))
    {
        print 'ようこそゲスト！';
        print '<a href="member_login.html">会員ログイン</a>';
        print '<br>';
    }
    else
    {
        print 'ようこそ';
        print $_SESSION['member_name'];
        print '様';
        print '<a href="member_logout.html">ログアウト</a>';
        print '<br>';
    }
?>

<!DOCTYPE html>
    <html>
        <head>
            <meta charset="UTF-8">
            <link rel="stylesheet" href="../css/style.css">
            <title>
                カートの中身
            </title>
            
        </head>
        <body>
            <?php
                try{
                    $sum = 0;
                    $cart = $_SESSION['cart'];
                    $kazu = $_SESSION['kazu'];
                    $max = count($cart);

                    // DB接続
                    $dns = 'mysql:dbname=shop; host=localhost; charset=utf8';
                    $user = 'root';
                    $password = '';
                    $dbh = new PDO($dns, $user, $password);
                    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                    foreach($cart as $key => $val){
                        $sql = 'SELECT name, price, gazou FROM mst_product where code = ?';
                        $stmt = $dbh->prepare($sql);
                        $data[0] = $val;
                        $stmt->execute($data);
    
                        $rec = $stmt->fetch(PDO::FETCH_ASSOC);
                        //if (!$rec['name']) continue;
                        $pro_name[] = $rec['name'];
                        $pro_price[] = $rec['price'];
                        if ($rec['gazou'] == ''){
                            $pro_gazou_name[] = '';
                        }else{
                            $pro_gazou_name[] = '<img src="../product/gazou/'.$rec['gazou'].'">';
                        }    
                    }
                    $dbh = null;
                }catch(Exception $e){
                    print '障害';
                    exit();
                }

            ?>
            <form method="post" action="kazu_change.php">
                <table border="1">
                    <tr>
                        <td>商品</td>
                        <td>商品画像</td>
                        <td>価格</td>
                        <td>数量</td>
                        <td>小計</td>
                        <td>削除</td>
                    </tr>
                <?php for ($i=0; $i < $max; $i++){ ?>
                    <input type="hidden" name="max" value="<?php print $max;?>">
                    <tr>
                        <td>
                            <?php print $pro_name[$i]; ?>
                        </td>
                        <td>
                            <?php print $pro_gazou_name[$i]; ?>
                        </td>
                        <td>                    
                            <?php print $pro_price[$i]; ?>円
                        </td>
                        <td>
                            <input type="text" size="4px" name="kazu<?php print $i;?>" value="<?php print $kazu[$i];?>">

                        </td>
                        <td>
                            <?php print (int)$pro_price[$i] * (int)$kazu[$i];?>
                        </td>
                        <td>
                            <input type="checkbox" name="sakujo<?php print $i;?>" >
                        </td>
                        <?php 
                            $sum += (int)$pro_price[$i] * (int)$kazu[$i];
                        ?>
                    </tr>
                    <br><br>
                <?php } ;?>
                </table>
                <input type="submit" value="数量変更"><br>

                合計<?php print $sum;?>円
            </form>
<!--
            <input type="button" onclick="history.back()" value="戻る"><br>
                -->
            <br>
            <a href="shop_form.html">ご購入手続きへ進む</a>
        </body>
    </html>