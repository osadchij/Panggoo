<?php
@session_start();
if (@$_SESSION['sign']) {
    echo file_get_contents(__DIR__.'/signed.php');
} else {
    echo file_get_contents(__DIR__.'/unsigned.php');
}
?>