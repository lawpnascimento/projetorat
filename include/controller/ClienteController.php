<?php
require_once("../model/ClienteModel.php");
require_once("../persistencia/ClientePersistencia.php");

switch($_POST["action"]){

	case 'cadastrar':
		$model = new ClienteModel();

		$model->setRazaoSocial($_POST["razaoSocial"]);
		$model->setNomeFantasia($_POST["nomeFantasia"]);
		$model->setCnpj($_POST["cnpj"]);
		$model->setInscricao($_POST["inscricao"]);
		$model->setCep($_POST["cep"]);
		$model->setUf($_POST["uf"]);
		$model->setCidade($_POST["cidade"]);
		$model->setBairro($_POST["bairro"]);
		$model->setRua($_POST["rua"]);
		$model->setNumero($_POST["numero"]);
		$model->setTelefone($_POST["telefone"]);

		$persistencia = new ClientePersistencia();
		$persistencia->setModel($model);
		$persistencia->inserirCliente();
		break;

	case 'atualizar':
		$model = new ClienteModel();

		$model->setCodigo($_POST["codigo"]);
		$model->setRazaoSocial($_POST["razaoSocial"]);
		$model->setNomeFantasia($_POST["nomeFantasia"]);
		$model->setCnpj($_POST["cnpj"]);
		$model->setInscricao($_POST["inscricao"]);
		$model->setCep($_POST["cep"]);
		$model->setUf($_POST["uf"]);
		$model->setCidade($_POST["cidade"]);
		$model->setBairro($_POST["bairro"]);
		$model->setRua($_POST["rua"]);
		$model->setNumero($_POST["numero"]);
		$model->setTelefone($_POST["telefone"]);

		$persistencia = new ClientePersistencia();

		$persistencia->setModel($model);

		$persistencia->Atualizar();

		break;
		
	//select na tabela do cliente e concatena em json
	case 'buscar':
   	$model = new ClienteModel();

		if(isset($_POST["codigo"])){
				$model->setCodigo($_POST["codigo"]);
		}

		$model->setRazaoSocial($_POST["razaoSocial"]);
		$model->setNomeFantasia($_POST["nomeFantasia"]);
		$model->setCnpj($_POST["cnpj"]);
		$model->setInscricao($_POST["inscricao"]);
		$model->setCep($_POST["cep"]);
		$model->setUf($_POST["uf"]);
		$model->setCidade($_POST["cidade"]);
		$model->setBairro($_POST["bairro"]);
		$model->setRua($_POST["rua"]);
		$model->setNumero($_POST["numero"]);
		$model->setTelefone($_POST["telefone"]);

   	$persistencia = new ClientePersistencia();

  	$persistencia->setModel($model);

   	$retorno = $persistencia->buscaClientes();

  	echo $retorno;
   	break;
}


?>
