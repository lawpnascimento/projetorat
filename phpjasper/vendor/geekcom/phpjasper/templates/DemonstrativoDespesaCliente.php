<?php
require_once("../../../autoload.php");

use JasperPHP\JasperPHP;


$txbDatIni = $_POST["txbDatIni"];
$txbDatFin = $_POST["txbDatFin"];
$txbConsultor = $_POST["txbConsultor"];
$txbCliente = $_POST["txbCliente"];
$nmRelatorio = $_POST["nmRelatorio"];

$whereClause = "rat.Situacao_codSit = 4";
$whereClause = $whereClause . " AND (dsprat.Fatdespesa_codTipFat = 1 OR dsprat.Fatdespesa_codTipFat = 2)";

if ($txbDatIni != null && $txbDatFin != null) {
    $whereClause = $whereClause . " AND fat.datFec BETWEEN '" . $txbDatIni . "' AND '" . $txbDatFin . "'";
}

if ($txbConsultor != null) {
    $whereClause = $whereClause . " AND usu.codUsu = '" . $txbConsultor . "'";
}

if ($txbCliente != null) {
    $whereClause = $whereClause . " AND cli.codCli = '" . $txbCliente . "'";
}

$whereClause = $whereClause . " ORDER by cli.codCli asc, fat.datFec asc, rat.codRat asc";

$input = __DIR__ . '\DemonstrativoDespesaCliente.jrxml';
$output = __DIR__ . '\\pdf\\' . $nmRelatorio;

//$jdbc_dir = 'D:\xampp\htdocs\projetorat\trunk\phpjasper\vendor\geekcom\phpjasper\bin\jasperstarter\jdbc';
$jdbc_dir = 'C:\xampp\htdocs\projetorat\trunk\phpjasper\vendor\geekcom\phpjasper\bin\jasperstarter\jdbc';

$options = [
    'format' => ['pdf'],
    'locale' => 'en',
    'params' => ['txbDatIni' => $txbDatIni,
                 'txbDatFin' => $txbDatFin,
                 'whereClause' => $whereClause],
    'db_connection' => [
        'driver' => 'mysql',
        'host' => 'localhost',
        'port' => '3306',
        'database' => 'dbprojetorat',
        'username' => 'root',
        'password' => 'root',
        'jdbc_driver' => 'com.mysql.jdbc.Driver',
        'jdbc_url' => 'jdbc:mysql://localhost:3306/dbprojetorat',
        'jdbc_dir' => $jdbc_dir
    ]
];



$jasper = new JasperPHP;

$jasper->process(
        $input,
        $output,
        $options
    )->execute();

 ?>
