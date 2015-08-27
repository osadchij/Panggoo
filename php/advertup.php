<?php
@session_start();
if (@$_POST['url'] && @$_POST['title'] && @$_FILES['picture']) {
    if (@$_SESSION['sign']) {
        require_once __DIR__.'/lib/advert.php';
        $advert=new \Panggoo\advert();
        $data=$_POST;
        $result=$advert->putAdvert($_SESSION['sign']['Id'], $data['url'], $data['title'], $_FILES['picture']);
        echo json_encode($result);
    } else {
        echo json_encode([0, 'Try to resign in']);
    }
} else {
    echo json_encode([0, 'Fill out all fields, please']);
}
?>