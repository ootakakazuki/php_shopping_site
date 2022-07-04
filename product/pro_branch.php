<?php

    session_start();
    session_regenerate_id(true);
    if (!isset($_SESSION['login'])){
        print 'ログインされていません。<br>';
        print '<a href="../staff_login/staff_login.html">ログイン画面へ</a>';
        exit();
    }

    // 追加
    if (isset($_POST['add'])){
        header('Location: pro_add.php');
        exit();
    }

    if (!isset($_POST['procode'])){
        header("Location: pro_ng.php");
        exit();
    }

    $pro_code = $_POST['procode'];  //     if (!isset($_POST['staffcode']))の前で宣言すると警告

    // 参照
    if (isset($_POST['disp'])){
        header('Location: pro_disp.php?procode='.$pro_code);
        exit();
    }

    // 修正
    if (isset($_POST['edit'])){
        header('Location: pro_edit.php?procode='.$pro_code);
        exit();
    }

    // 削除
    if (isset($_POST['delete'])){
        header('Location: pro_delete.php?procode='.$pro_code);
        exit();
    }
?>