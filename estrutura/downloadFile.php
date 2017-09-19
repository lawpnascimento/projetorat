<?php


  $file =  "../phpjasper/vendor/geekcom/phpjasper/templates/pdf/" .  $_GET["nmRelatorio"] . ".pdf";

  if (file_exists($file)) {
    $fp = fopen($file,"r");
    $strPDF = fread($fp,filesize($file));
    fclose($fp);

    header('Content-Type: application/x-download');
    header("Content-disposition: attachment; filename=\"". $_GET["nmRelatorio"] . ".pdf\"");
    header("Expires: 0");
    header("Cache-Control: no-cache");
    header('Cache-Control: private, max-age=0, must-revalidate');
    header("Pragma: public");

    echo $strPDF;

  } else {
   echo "nao encontrou";
  }




?>
