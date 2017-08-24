<?php

require_once("../../estrutura/conexao.php");

class UsuarioPersistencia{
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

	public function inserirUsuario(){
		$this->getConexao()->conectaBanco();

    $nome = $this->getModel()->getNome();
    $sobrenome = $this->getModel()->getSobrenome();
    $senha = $this->getModel()->getSenha();
    $email = $this->getModel()->getEmail();
    $papel = $this->getModel()->getPapel();
    $situacao = $this->getModel()->getSituacao();
    $percentualComissao = $this->getModel()->getPercentualComissao();

		$sSql = "INSERT INTO tbusuario (nomUsu, sobrenomeUsu, senUsu, desEml, Papel_codPap, codSit, perCom)
                          VALUES ('". $nome ."'
                         		 ,'". $sobrenome ."'
                                 ,'". $senha ."'
                                 ,'". $email ."'
                                 ,'". $papel ."'
                                 ,'". $situacao ."'
                                 ,'". $percentualComissao ."')";

    $this->getConexao()->query($sSql);

    $this->getConexao()->fechaConexao();

  }

  public function buscaPapelDropDown(){
    $this->getConexao()->conectaBanco();

    $sSql = "SELECT pap.codPap codPap
                   ,pap.desPap desPap
               FROM tbpapel pap
              ORDER BY pap.desPap";

    $resultado = mysql_query($sSql);

    $qtdLinhas = mysql_num_rows($resultado);

    $contador = 0;

    $retorno = '[';
    while ($linha = mysql_fetch_assoc($resultado)) {

        $contador = $contador + 1;

        $retorno = $retorno . '{"codPap": "'.$linha["codPap"].'"
                               , "desPap" : "'.$linha["desPap"].'"}';
        //Para não concatenar a virgula no final do json
        if($qtdLinhas != $contador)
           $retorno = $retorno . ',';

    }
    $retorno = $retorno . "]";

    $this->getConexao()->fechaConexao();

    return $retorno;
	}

	public function buscaUsuario(){
		$this->getConexao()->conectaBanco();

	$codigo = $this->getModel()->getCodigo();
    $nome = $this->getModel()->getNome();
    $sobrenome = $this->getModel()->getSobrenome();
    $senha = $this->getModel()->getSenha();
    $email = $this->getModel()->getEmail();
    $papel = $this->getModel()->getPapel();
    $situacao = $this->getModel()->getSituacao();
    $percentualComissao = $this->getModel()->getPercentualComissao();

		if($codigo == null){

			$sSql = "SELECT usu.codUsu codUsu
                     ,usu.nomUsu nomUsu
                     ,usu.sobrenomeUsu sobrenomeUsu
                     ,usu.senUsu senUsu
                     ,usu.codSit codSit
                     ,usu.desEml desEml
                     ,pap.codPap codPap
                     ,pap.desPap desPap
                     ,concat(usu.perCom, '%') perCom
                     , if(usu.codsit = 1 ,'Ativo','Inativo') desSit
                 FROM tbusuario usu
                 JOIN tbpapel pap
                   ON pap.codPap = usu.Papel_codPap
						 	  WHERE 1 = 1";

			if($nome != null){
					$sSql = $sSql . " AND UPPER(usu.nomUsu) LIKE UPPER('%" . $nome ."%')";
			}

			if($sobrenome != null){
					$sSql = $sSql . " AND UPPER(usu.sobrenomeUsu) LIKE UPPER('%" . $sobrenome ."%')";
			}

			if($email != null){
					$sSql = $sSql . " AND UPPER(usu.desEml) LIKE UPPER('%" . $email ."%')";
			}

			if($situacao != null){
					$sSql = $sSql . " AND cli.codsit = " . $situacao ."";
			}

      		if($papel != null){
					$sSql = $sSql . " AND cli.codPap = " . $papel ."";
			}

			$sSql = $sSql . " ORDER BY usu.codUsu desc";
		}else{

			$sSql = "SELECT usu.codUsu codUsu
                     ,usu.nomUsu nomUsu
                     ,usu.sobrenomeUsu sobrenomeUsu
                     ,usu.senUsu senUsu
                     ,usu.codSit codSit
                     ,usu.desEml desEml
                     ,pap.codPap codPap
                     ,pap.desPap desPap
                     ,concat(usu.perCom, '%') perCom
                     , if(usu.codsit = 1 ,'Ativo','Inativo') desSit
                 FROM tbusuario usu
                 JOIN tbpapel pap
                   ON pap.codPap = usu.Papel_codPap
							  WHERE usu.codUsu = " . $codigo . "
								ORDER BY usu.codUsu desc";

    }

		$resultado = mysql_query($sSql);

		$qtdLinhas = mysql_num_rows($resultado);

		$contador = 0;

		$retorno = '[';
		while ($linha = mysql_fetch_assoc($resultado)) {

			$contador = $contador + 1;

			$retorno = $retorno . '{"codUsu": "'.$linha["codUsu"].'"
														, "nomUsu" : "'.$linha["nomUsu"].'"
														, "sobrenomeUsu" : "'.$linha["sobrenomeUsu"].'"
														, "senUsu" : "'.$linha["senUsu"].'"
														, "codSit" : "'.$linha["codSit"].'"
							                            , "desEml" : "'.$linha["desEml"].'"
							                            , "codPap" : "'.$linha["codPap"].'"
							                            , "desPap" : "'.$linha["desPap"].'"
							                            , "perCom" : "'.$linha["perCom"].'"
														, "desSit" : "'.$linha["desSit"].'"}';

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

		$codigo = $this->getModel()->getCodigo();
	    $nome = $this->getModel()->getNome();
	    $sobrenome = $this->getModel()->getSobrenome();
	    $senha = $this->getModel()->getSenha();
	    $email = $this->getModel()->getEmail();
	    $papel = $this->getModel()->getPapel();
	    $situacao = $this->getModel()->getSituacao();
	    $percentualComissao = $this->getModel()->getPercentualComissao();

			$sSql = "UPDATE tbusuario
									SET nomUsu = '" . $nome ."'
										 ,sobrenomeUsu = '" . $sobrenome ."'
										 ,senUsu = '" . $senha ."'
										 ,desEml = '" . $email ."'
										 ,Papel_codPap = '" . $papel ."'
										 ,codSit = '" . $situacao ."'
										 ,perCom= '" . $percentualComissao ."'
								WHERE codUsu = " . $codigo;

			$this->getConexao()->query($sSql);

			$this->getConexao()->fechaConexao();
	}

}

?>
