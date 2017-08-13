<?php
echo "oi";

require_once("../../../autoload.php");

use JasperPHP\JasperPHP;

$input = '/hello_world.jasper';   
$output = '/output_json';

$data_file = '/your_json_file.json';
$options = [
    'format' => ['pdf'],
    'params' => [],
    'locale' => 'en',
    'db_connection' => [
        'driver' => 'json',
        'data_file' => $data_file,
        'json_query' => 'your_json_query'
    ]
];

$jasper = new JasperPHP;

$jasper->process(
    $input,
    $output,
    $options
)->execute();
?>