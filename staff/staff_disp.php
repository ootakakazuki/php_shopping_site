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
                    $staff_code = $_GET['staff_code'];  // staffcodeだとエラーになる
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
            スタッフコード<br>
            <?php print $staff_code;?>
            <br><br>
            スタッフ名<br>
            <?php print $staff_name;?>
            <br>
            <input type="button" onclick="history.back()" value="戻る"><br>

        </body>
    </html>