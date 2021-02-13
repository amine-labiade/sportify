<?php
require_once (__DIR__ . "/../functions.php");
require_once(__DIR__ . "/../fpdf182/phpqrcode/qrlib.php");


$data = $_SESSION['data'][0] . " " . $_SESSION['data'][1] . " " . $_SESSION['data'][2] . " " . $_SESSION['data'][3] . " " . $_SESSION['data'][4] ." " . $_SESSION['data'][5];

QRcode::png($data,"qr.png");
?>
