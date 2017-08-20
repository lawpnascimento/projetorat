<?php
require_once("../model/PerfilModel.php");
require_once("../persistencia/PerfilPersistencia.php");

switch($_POST["action"]){

    case 'buscar':
        $model = new PerfilModel();

        if(isset($_POST["codigo"])){
                $model->setCodigo($_POST["codigo"]);
        }
        $model->setNome($_POST["email"]);
        $model->setSobrenome($_POST["sobrenome"]);
        $model->setSenha($_POST["cpf"]);
        $model->setEmail($_POST["telefone"]);

        $persistencia = new PerfilPersistencia();

        $persistencia->setModel($model);

        $retorno = $persistencia->buscaPerfil();

        echo $retorno;

        break;
        
    case 'atualizar':
        $model = new PerfilModel();

        $model->setCodigo($_POST["codigo"]);
        $model->setNome($_POST["email"]);
        $model->setSobrenome($_POST["sobrenome"]);
        $model->setSenha($_POST["cpf"]);
        $model->setEmail($_POST["telefone"]);

        $persistencia = new PerfilPersistencia();
        
        $persistencia->setModel($model);

        $persistencia->atualizarPerfil();

        break;
}
?>
