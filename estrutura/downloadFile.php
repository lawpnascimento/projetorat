<?php

  $file =  "../phpjasper/geekcom/phpjasper/examples/" .  $_GET["nmRelatorio"];

  if (file_exists($file)) {
    $fp = fopen($file,"r");
    $strPDF = fread($fp,filesize($file));
    fclose($fp);

    header('Content-Type: application/x-download');
    header("Content-disposition: attachment; filename=\"". $_GET["nmRelatorio"] . "\"");
    header("Expires: 0");
    header("Cache-Control: no-cache");
    header('Cache-Control: private, max-age=0, must-revalidate');
    header("Pragma: public");

    echo $strPDF;

  } else {
    //mensagem que arquivo não existe
  }




?>
