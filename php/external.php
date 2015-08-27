<?php
header('Access-Control-Allow-Origin: *');
if (@$_POST['get_ads']) {
    require_once __DIR__.'/lib/advert.php';
    $advert=new \Panggoo\advert();
    echo json_encode($advert->extAdvert((int)@$_POST['count']));
}
?>