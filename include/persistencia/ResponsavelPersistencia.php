<?php

require_once("../../estrutura/conexao.php");

class ResponsavelPersistencia{
	protected $model;
	protected $conexao;

	function __construct(){
        $this->conexao = new Conexao();
    }

	public function getModel(){

		return $this->model;

	}

	public function setModel($model){

		$this->model = $model;
	}

	public function getConexao(){
        return $this->conexao;
    }

	public function inserirResponsavel(){
		$this->getConexao()->conectaBanco();

		$nome = $this->getModel()->getNome();
    $email = $this->getModel()->getEmail();
    $cliente = $this->getModel()->getCliente();

		$sSql = "INSERT INTO tbresponsavel (nomRes, emlRes, cliente_codCli)
                          VALUES ('". $nome ."'
                                 ,'". $email ."'
                                 ,". $cliente .")";

        $this->getConexao()->query($sSql);

        $this->getConexao()->fechaConexao();

    }

	public function buscaClienteDropDown(){
    $this->getConexao()->conectaBanco();

    $sSql = "SELECT cli.codCli codCli
                   ,cli.nomCli nomCli
               FROM tbcliente cli
               ORDER BY cli.nomCli";

    $resultado = mysql_query($sSql);

    $qtdLinhas = mysql_num_rows($resultado);

    $contador = 0;

    $retorno = '[';
    while ($linha = mysql_fetch_assoc($resultado)) {

        $contador = $contador + 1;

        $retorno = $retorno . '{"codCli": "'.$linha["codCli"].'"
                               , "nomCli" : "'.$linha["nomCli"].'"}';
        //Para não concatenar a virgula no final do json
        if($qtdLinhas != $contador)
           $retorno = $retorno . ',';

    }
    $retorno = $retorno . "]";

    $this->getConexao()->fechaConexao();

    return $retorno;
	}

	public function buscaResponsavel(){
		$this->getConexao()->conectaBanco();

	$codigo = $this->getModel()->getCodigo();
	$nome = $this->getModel()->getNome();
    $email = $this->getModel()->getEmail();
    $cliente = $this->getModel()->getCliente();

		if($codigo == null){

			$sSql = "SELECT res.codRes codRes
									 	 ,res.nomRes nomRes
										 ,res.emlRes emlRes
										,cli.nomCli nomCli
										,cli.codCli codCli
								 FROM tbresponsavel res
								 JOIN tbcliente cli
							     ON cli.codcli = res.Cliente_codCli
						 	  WHERE 1 = 1";

			if($nome != null){
					$sSql = $sSql . " AND UPPER(res.nomRes) LIKE UPPER('%" . $nome ."%')";
			}

			if($email != null){
					$sSql = $sSql . " AND UPPER(res.emlRes) LIKE UPPER('%" . $email ."%')";
			}

			if($cliente != null){
					$sSql = $sSql . " AND cli.codCli = " . $cliente ."";
			}

			$sSql = $sSql . " ORDER BY cli.nomCli, res.nomRes";
		}else{
			$sSql = "SELECT res.codRes codRes
									 	 ,res.nomRes nomRes
										 ,res.emlRes emlRes
										 ,cli.nomCli nomCli
										 ,cli.codCli codCli
								 FROM tbresponsavel res
								 JOIN tbcliente cli
							     ON cli.codcli = res.Cliente_codCli
							  WHERE res.codRes = " . $codigo . "
								ORDER BY cli.nomCli, res.nomRes";
		}

		$resultado = mysql_query($sSql);

		$qtdLinhas = mysql_num_rows($resultado);

		$contador = 0;

		$retorno = '[';
		while ($linha = mysql_fetch_assoc($resultado)) {

			$contador = $contador + 1;

			$retorno = $retorno . '{"codRes": "'.$linha["codRes"].'"
														, "nomRes" : "'.$linha["nomRes"].'"
														, "emlRes" : "'.$linha["emlRes"].'"
														, "codCli" : "'.$linha["codCli"].'"
														, "nomCli" : "'.$linha["nomCli"].'"}';

			//Para não concatenar a virgula no final do json
			if($qtdLinhas != $contador)
					$retorno = $retorno . ',';

		}
		$retorno = $retorno . "]";

		$this->getConexao()->fechaConexao();

		return $retorno;

	}

	public function Atualizar(){
			$this->getConexao()->conectaBanco();

			$codigo = intval($this->getModel()->getCodigo());
			$nome = $this->getModel()->getNome();
	    $email = $this->getModel()->getEmail();
	    $cliente = $this->getModel()->getCliente();

			$sSql = "UPDATE tbresponsavel
									SET emlRes = '" . $email ."'
										 ,nomRes = '" . $nome ."'
										 ,cliente_codCli = " . $cliente ."
								WHERE codRes = " . $codigo;

			$this->getConexao()->query($sSql);

			$this->getConexao()->fechaConexao();
	}

}

?>
