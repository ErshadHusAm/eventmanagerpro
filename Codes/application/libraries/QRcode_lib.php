<?php
/**
 * Author : Ershadul Bari
 */
include("phpqrcode/qrlib.php");
class QRcode_lib
{
  public function generateQRCode($value, $image_path){
    QRcode::png($value, $image_path);
  }
}
