<?php
    session_start();
    session_regenerate_id(true);
    if (!isset($_SESSION['member_login'])){
        print 'ようこそゲスト野郎！';
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
                農園
            </title>
        </head>
        <body>
            <?php
                try{

                    // DB接続
                    $dns = 'mysql:dbname=shop; host=localhost; charset=utf8';
                    $user = 'root';
                    $password = '';
                    $dbh = new PDO($dns, $user, $password);
                    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                    $sql = 'SELECT code, name, price, gazou FROM mst_product';
                    $stmt = $dbh->prepare($sql);
                    $stmt->execute();

                    $dbh = null;

                    print '商品一覧<br><br>';

                    print '<div class="item-container">';
                    $i = 0;
                    while(1){

                        $rec = $stmt->fetch(PDO::FETCH_ASSOC);
                        if ($rec == false){
                            break;
                        }
                        print '<div class="item">';
                        print '<a href="shop_product.php?procode='.$rec['code'].'">';
                        
                        $pro_gazou_name = $rec['gazou'];

                        $gazou =  '<img src="../product/gazou/'.$pro_gazou_name.'">';
                        print $gazou;
                        print '<br>';
                        print $rec['name'].'    ';
                        print $rec['price'].'円';
                        print '</a>';
                        print '<br>';
                        print '</div>';
                        $i++;
                    }
                    print '</div>';
                    //list($width, $height) = getImageSize("../product/gazou/'.$pro_gazou_name.'");
                }catch(Exception $e){
                    print '障害発生！';
                }
            print '<br>';
            print '<a href="shop_cartlook.php">カート一覧を見る</a>';


            ?>
        </body>
    </html>