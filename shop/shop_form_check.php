<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../css/style.css">
    </head>
    <body>
        <?php
            require_once("../common/common.php");

            $flag = true;
            $post = sanitize($_POST);
            $onamae = $post['onamae'];
            $email = $post['email'];
            $postal1 = $post['postal1'];
            $postal2 = $post['postal2'];
            $address = $post['address'];
            $tel = $post['tel'];

            if (!$onamae)
            {
                print '名前を入力せんかい(-_-)<br>';
                $flag = false;
            }
            else
            {
                print '名前: ';
                print $onamae;
                print '<br>';
            }
            if (preg_match('/\A[\w\-\.]+\@[\w\-\.]+\.([a-z]+)\z/', $email) == 0)
            {
                print 'メールアドレスもまともにうてんのかい(-_-)<br>';
                $flag = false;
            }
            else
            {
                print 'メールアドレス: ';
                print $email;
                print '<br>';
            }
            if (preg_match('/^[0-9]+$/', $postal1) == 0 || preg_match('/^[0-9]+$/', $postal2) == 0)
            {
                print '郵便番号は半角数字で(-_-)<br>';
                $flag = false;
            }
            else
            {
                print '郵便番号: ';
                print $postal1.'-'.$postal2;
                print '<br>';
            }
            if (!$address)
            {
                print '住所書こう(-_-)<br>';
                $flag = false;
            }
            else
            {
                print '住所: ';
                print $address;
                print '<br>';
            }
            if (preg_match('/^[0-9]+$/', $tel) == 0)
            {
                print '電話番号は半角数字で(-_-)<br>';
                $flag = false;
            }
            else
            {
                print '電話番号: ';
                print $tel;
                print '<br>';
            }
            if ($flag){
                print '<form method="post" action="shop_form_done.php">';
                print '<input type="hidden" name="onamae" value="'.$onamae.'">';
                print '<input type="hidden" name="email" value="'.$email.'">';
                print '<input type="hidden" name="postal1" value="'.$postal1.'">';
                print '<input type="hidden" name="postal2" value="'.$postal2.'">';
                print '<input type="hidden" name="address" value="'.$address.'">';
                print '<input type="hidden" name="tel" value="'.$tel.'">';
                print '<input type="button" onclick="history.back()" value="戻る">';

                print 'これでええんか<br>';

                print '<input type="submit" value="OK">';            
            }
        ?>
    </body>
</html>