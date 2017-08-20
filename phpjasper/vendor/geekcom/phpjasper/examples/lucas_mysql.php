<?php
require_once("../../../autoload.php");

 use JasperPHP\JasperPHP;

 //$input = __DIR__ . '/hello_world.jrxml';
 $input = __DIR__ . '/ExtratoComissao.jrxml';
 //$output = __DIR__ . '/hello_world_teste';
 $output = __DIR__ . '/ExtratoComissao';

 $conn = [
     'driver' => 'mysql',
     'username' => 'root',
     'password' => 'root',
     'host' => 'localhost',
     'database' => 'dbprojetorat',
     'port' => '3306'
 ];

 $jasper = new JasperPHP;

 $jasper->process(
     $input,
     $output,
     array("pdf", "rtf"),
     array("php_version" => phpversion()),
     $conn,
     true,
     true,
     'pt_BR' //LOCALE *note 2
 )->execute();