<?php
echo "oi";

require_once("../../../autoload.php");

use JasperPHP\JasperPHP;
	
$input = __DIR__ . '/hello_world.jasper';  
$output = __DIR__ . '/hello_world';    
$options = [ 
    'format' => ['pdf', 'rtf'] 
];

$jasper = new JasperPHP;

$jasper->process(
    $input,
    $output,
    $options
)->execute();