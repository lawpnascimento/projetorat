<?php
require_once("../model/PerfilModel.php");
require_once("../persistencia/PerfilPersistencia.php");
session_start();

switch($_POST["action"]){

    case 'buscar':
        $model = new PerfilModel();

        $model->setCodigo($_SESSION["codUsu"]);

        $persistencia = new PerfilPersistencia();

        $persistencia->setModel($model);

        $retorno = $persistencia->buscaPerfil();

        echo $retorno;

        break;
        
    case 'atualizar':
        $model = new PerfilModel();

        $model->setCodigo($_SESSION["codUsu"]);
        $model->setNome($_POST["email"]);
        $model->setSobrenome($_POST["sobrenome"]);
        $model->setSenha($_POST["senha"]);
        $model->setEmail($_POST["email"]);

        $persistencia = new PerfilPersistencia();
        
        $persistencia->setModel($model);

        $persistencia->atualizarPerfil();

        break;
}
?>
