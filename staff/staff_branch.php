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
        header('Location: staff_add.php');
        exit();
    }


    if (!isset($_POST['staffcode'])){
        header("Location: staff_ng.php");
        exit();
    }


    $staff_code = $_POST['staffcode'];  //     if (!isset($_POST['staffcode']))の前で宣言すると警告

    // 参照
    if (isset($_POST['disp'])){
        header('Location: staff_disp.php?staff_code='.$staff_code);
        exit();
    }

    // 修正
    if (isset($_POST['edit'])){
        header('Location: staff_edit.php?staffcode='.$staff_code);
        exit();
    }

    // 削除
    if (isset($_POST['delete'])){
        header('Location: staff_delete.php?staffcode='.$staff_code);
        exit();
    }
?>