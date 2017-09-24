<?php


$file =  "../phpjasper/vendor/geekcom/phpjasper/templates/pdf/" .  $_GET["nmRelatorio"] . ".pdf";

if (file_exists($file)) {
  $fp = fopen($file,"r");
  $strPDF = fread($fp,filesize($file));
  fclose($fp);

  header('Content-Type: application/pdf');
  header("Content-disposition: inline; filename=\"". $_GET["nmRelatorio"] . ".pdf\"");
  header("Expires: 0");
  header("Cache-Control: no-cache");
  header('Cache-Control: private, max-age=0, must-revalidate');
  header("Pragma: public");

  echo $strPDF;

} else {
 echo "Relatorio nao encontrado. Favor gerar novamente.";
}

//To have the file downloaded rather than viewed:

/*Content-Type: application/pdf
Content-Disposition: attachment; filename="filename.pdf"*/

?>
