<?php
@session_start();
if (@$_POST['username'] && @$_POST['password']) {
    require_once __DIR__ . '/lib/sign.php';
    $sign=new \Panggoo\sign();
    $data=$_POST;
    if (@$data['password']===@$data['repassword']) {
        if (!@$data['email'] || !$sign->getSign(null, null, @$data['email'])[0]) {
            $result=$sign->putSign($data['username'], $data['password'], $data['email']);
            if ($result[0]) {
                $sign->getSign($data['username']);
                $_SESSION['sign']=$sign->user;
            }
            echo json_encode($result);
        } else {
            $err_log=[0, 'Email already exist'];
            echo json_encode($err_log);
        }
    } else {
        $err_log=[0, 'Passwords are not equal'];
        echo json_encode($err_log);
    }
} else {
    $err_log=[0, 'Fill out all fields, please'];
    echo json_encode($err_log);
}
?>