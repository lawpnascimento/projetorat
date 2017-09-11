<?php
require_once("../../../autoload.php");

use JasperPHP\JasperPHP;


$txbDatIni = $_POST["txbDatIni"];
$txbDatFin = $_POST["txbDatFin"];
$txbConsultor = $_POST["txbConsultor"];
$txbCliente = $_POST["txbCliente"];
$nmRelatorio = $_POST["nmRelatorio"];

$input = __DIR__ . '\ExtratoComissao.jrxml';
$output = __DIR__ . '\\pdf\\' . $nmRelatorio;

//$jdbc_dir = 'D:\xampp\htdocs\projetorat\trunk\phpjasper\vendor\geekcom\phpjasper\bin\jasperstarter\jdbc';
$jdbc_dir = 'C:\xampp\htdocs\projetorat\trunk\phpjasper\vendor\geekcom\phpjasper\bin\jasperstarter\jdbc';

$options = [
    'format' => ['pdf'],
    'locale' => 'en',
    'params' => ['txbDatIni' => $txbDatIni,
                 'txbDatFin' => $txbDatFin,
                 'txbConsultor' => $txbConsultor,
                 'txbCliente' => $txbCliente],
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
