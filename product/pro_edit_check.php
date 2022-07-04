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
            $pro_code = $_POST['code'];
            $pro_name = $_POST['name'];
            $pro_price = $_POST['price'];
            $pro_gazou_name_old = $_POST['gazou_name_old'];
            $pro_gazou = $_FILES['gazou'];

            $pro_code = htmlspecialchars($pro_code, ENT_QUOTES, 'UTF-8');
            $pro_name = htmlspecialchars($pro_name, ENT_QUOTES, 'UTF-8');
            $pro_price = htmlspecialchars($pro_price, ENT_QUOTES, 'UTF-8');

            if($pro_name == '')
            {
                print '商品名が入力されていない<br>';
            }
            else{
                print '商品名:';
                print $pro_name;
                print '<br>';
            }

//            if($pro_price == '')
            if(!preg_match('/\A[0-9]+\z/', $pro_price))
            {
                print '価格おかしい<br>';
            }
            if ($pro_gazou['size'] > 0){
                if ($pro_gazou['size'] > 1000000){
                    print '画像でかすぎ';
                }
            }else{
                move_uploaded_file($pro_gazou['tmp_name'], './gazou/'.$pro_gazou['name']);
                print '<img src="./gazou/'.$pro_gazou['name'].'">';
                print '<br>';
            }
            if($pro_name == '' || !preg_match('/\A[0-9]+\z/', $pro_price) || $pro_gazou['size'] > 1000000)
            {
//            if ($staff_name == '' || $staff_pass == '' || $staff_pass != $staff_pass2){
                print '<form>';
                print '<input type="button" onclick="history.back()" value="戻る">';
                print '</form>';
            }
            else{
                print '上記の商品を追加します。';
                print '<form method="post" action="pro_edit_done.php">';

                // hiddenでデータを渡せる。表示させることなく。
                print '<input type="hidden" name="name" value="'.$pro_name.'">';
                print '<input type="hidden" name="price" value="'.$pro_price.'">';
                print '<input type="hidden" name="code" value="'.$pro_code.'">';
                print '<input type="hidden" name="gazou_name_old" value="'.$pro_gazou_name_old.'">';
                print '<input type="hidden" name="gazou_name" value="'.$pro_gazou['name'].'">';

                print '<br>';
                print '<input type="button"  onclick="history.back()" value="戻る">';
                print '<input type="submit" value="OK">';
                print '</form>';
            }
        ?>
    </body>
</html>