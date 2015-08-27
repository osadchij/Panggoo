<?php
@session_start();
if (@$_POST['get_sign']) {
    if (@$_SESSION['sign']) {
        echo json_encode($_SESSION['sign']);
    } else {
        echo 0;
    }
} else if (@$_POST['signout']) {
    if (@$_SESSION['sign']) {
        unset($_SESSION['sign']);
        echo 1;
    } else {
        echo 0;
    }
} else if (@$_POST['username'] && @$_POST['password']) {
    require_once __DIR__ . '/lib/sign.php';
    $conf=new \Panggoo\sign_config();
    $sign=new \Panggoo\sign();
    $data=$_POST;
    if ($conf->getEmail($data['username'])) {
        $result=$sign->getSign(null, $data['password'], $data['username']);
    } else {
        $result=$sign->getSign($data['username'], $data['password']);
    }
    if ($result[0]) {
        $_SESSION['sign']=$sign->user;
    }
    echo json_encode($result);
} else {
    $err_log=[0, 'Fill out all fields, please'];
    echo json_encode($err_log);
}
?>