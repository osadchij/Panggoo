<?php
@session_start();
if (@$_SESSION['sign']) {
    require_once __DIR__.'/lib/advert.php';
    $advert=new \Panggoo\advert();
    $data=$_POST;
    $result=$advert->getAdvert(@$data['num']);
    if ($result[0]) {
        echo json_encode([1, $advert->advert]);
    } else {
        echo json_encode($result);
    }
} else {
    echo json_encode([0, 'Try to resign in']);
}
?>