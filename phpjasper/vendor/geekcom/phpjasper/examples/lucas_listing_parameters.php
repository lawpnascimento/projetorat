<?php
echo "oi";

require_once("../../../autoload.php");

use JasperPHP\JasperPHP;

$input = __DIR__ . '/hello_world_params.jrxml';

$jasper = new JasperPHP;
$output = $jasper->listParameters($input)->execute();

foreach($output as $parameter_description)
    print $parameter_description . '<pre>';