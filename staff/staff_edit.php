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
                    $staff_code = $_GET['staffcode'];
                    // DB接続
                    $dns = 'mysql:dbname=shop; host=localhost; charset=utf8';
                    $user = 'root';
                    $password = '';
                    $dbh = new PDO($dns, $user, $password);
                    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                    
                    $sql = 'SELECT name FROM stuff_table where code = ?';

                    $stmt = $dbh->prepare($sql);
                    $data[] = $staff_code;
                    $stmt->execute($data);

                    $rec = $stmt->fetch(PDO::FETCH_ASSOC);
                    $staff_name = $rec['name'];

                    $dbh = null;



                }catch(Exception $e){
                    print '障害';
                    exit();
                }
            ?>

            スタッフ修正<br><br>
            スタッフコード<br>
            <?php print $staff_code;?>
            <br><br>
            <form method="post" action="staff_edit_check.php">
                <input type="hidden" name="code" value="<?php print $staff_code; ?>">
                スタッフ名<br>
                <input type="text" name="name" value="<?php print $staff_name;?>">
                <br>
                パスワードを入力して。<br>
                <input type="password" name="pass" style="width:100px"><br>
                もう一度。<br>
                <input type="password" name="pass2" style="width:100px"><br>
                <input type="button" onclick="history.back()" value="戻る"><br>
                <input type="submit" value="ok">
            </form>
        </body>
    </html>