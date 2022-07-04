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

                    // DB接続
                    $dns = 'mysql:dbname=shop; host=localhost; charset=utf8';
                    $user = 'root';
                    $password = '';
                    $dbh = new PDO($dns, $user, $password);
                    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                    $sql = 'SELECT code, name FROM stuff_table';
                    $stmt = $dbh->prepare($sql);
                    $stmt->execute();

                    $dbh = null;

                    print 'スタッフ一覧<br><br>';

//                    print '<form method="post"action="staff_edit.php">';
                    print '<form method="post"action="staff_branch.php">';

                    while(1){
                        $rec = $stmt->fetch(PDO::FETCH_ASSOC);
                        if ($rec == false){
                            break;
                        }
                        print '<input type="radio" name="staffcode" value="'.$rec['code'].'">';
                        print $rec['name'];
                        print '<br>';
                    }
                    print '<input type="submit" name="disp" value="参照">';
                    print '<input type="submit" name="add" value="追加">';
                    print '<input type="submit" name="edit" value="修正">';
                    print '<input type="submit" name="delete" value="削除">';
                    print '</form>';
                }catch(Exception $e){
                    print '障害発生！';
                }
            ?>
            <br>
            <a href="../staff_login/staff_top.php">トップメニュ－へ</a>
            
        </body>
    </html>