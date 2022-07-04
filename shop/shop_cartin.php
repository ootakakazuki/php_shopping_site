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
            <title>
                農園
            </title>
        </head>
        <body>
            <?php
                try{
                    $pro_code = $_GET['procode'];

                    if (isset($_SESSION['cart'])){
                        // 空っぽをカートに移すのはよくない
                        $cart = $_SESSION['cart'];
                        $kazu = $_SESSION['kazu'];
                    }
                    $cart[] = $pro_code;
                    $kazu[] = 1;
                    $_SESSION['cart'] = $cart;
                    $_SESSION['kazu'] = $kazu;

                    foreach($cart as $key => $val){
                        print $val;
                        print '<br>';
                    }

                }catch(Exception $e){
                    print '障害中';
                    exit();
                }
            ?>

            カートに追加しました。
            <br><br>
            <a href="shop_list.php">商品一覧に戻る</a>
        </body>
    </html>