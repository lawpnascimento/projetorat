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
    $senha = $this->getModel()->getSenha();
    $email = $this->getModel()->getEmail();
    $perfil = $this->getModel()->getPerfil();
    $situacao = $this->getModel()->getSituacao();

		$sSql = "INSERT INTO tbusuario (nomUsu, senUsu, desEml, Perfil_codPer, codsit)
                          VALUES ('". $nome ."'
                                 ,'". $senha ."'
                                 ,'". $email ."'
                                 ,". $perfil ."
                                 ,". $situacao .")";

    $this->getConexao()->query($sSql);

    $this->getConexao()->fechaConexao();

  }

  public function buscaPerfilDropDown(){
    $this->getConexao()->conectaBanco();

    $sSql = "SELECT per.codPer codPer
                   ,per.desPer desPer
               FROM tbperfil per
              ORDER BY per.desPer";

    $resultado = mysql_query($sSql);

    $qtdLinhas = mysql_num_rows($resultado);

    $contador = 0;

    $retorno = '[';
    while ($linha = mysql_fetch_assoc($resultado)) {

        $contador = $contador + 1;

        $retorno = $retorno . '{"codPer": "'.$linha["codPer"].'"
                               , "desPer" : "'.$linha["desPer"].'"}';
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
    $senha = $this->getModel()->getSenha();
    $email = $this->getModel()->getEmail();
    $perfil = $this->getModel()->getPerfil();
    $situacao = $this->getModel()->getSituacao();

		if($codigo == null){

			$sSql = "SELECT usu.codUsu codUsu
                     ,usu.nomUsu nomUsu
                     ,usu.senUsu senUsu
                     ,usu.codSit codSit
                     ,usu.desEml desEml
                     ,per.codPer codPer
                     ,per.desPer desPer
                     , if(usu.codsit = 1 ,'Ativo','Inativo') desSit
                 FROM tbusuario usu
                 JOIN tbperfil per
                   ON per.codPer = usu.Perfil_codPer
						 	  WHERE 1 = 1";

			if($nome != null){
					$sSql = $sSql . " AND UPPER(usu.nomUsu) LIKE UPPER('%" . $nome ."%')";
			}

			if($email != null){
					$sSql = $sSql . " AND UPPER(usu.desEml) LIKE UPPER('%" . $email ."%')";
			}

			if($situacao != null){
					$sSql = $sSql . " AND cli.codsit = " . $situacao ."";
			}

      if($perfil != null){
					$sSql = $sSql . " AND cli.codPer = " . $perfil ."";
			}

			$sSql = $sSql . " ORDER BY usu.nomUsu";
		}else{

			$sSql = "SELECT usu.codUsu codUsu
                     ,usu.nomUsu nomUsu
                     ,usu.senUsu senUsu
                     ,usu.codSit codSit
                     ,usu.desEml desEml
                     ,per.codPer codPer
                     ,per.desPer desPer
                     , if(usu.codsit = 1 ,'Ativo','Inativo') desSit
                 FROM tbusuario usu
                 JOIN tbperfil per
                   ON per.codPer = usu.Perfil_codPer
							  WHERE usu.codUsu = " . $codigo . "
								ORDER BY usu.nomUsu";

    }
  
		$resultado = mysql_query($sSql);

		$qtdLinhas = mysql_num_rows($resultado);

		$contador = 0;

		$retorno = '[';
		while ($linha = mysql_fetch_assoc($resultado)) {

			$contador = $contador + 1;

			$retorno = $retorno . '{"codUsu": "'.$linha["codUsu"].'"
														, "nomUsu" : "'.$linha["nomUsu"].'"
														, "senUsu" : "'.$linha["senUsu"].'"
														, "codSit" : "'.$linha["codSit"].'"
                            , "desEml" : "'.$linha["desEml"].'"
                            , "codPer" : "'.$linha["codPer"].'"
                            , "desPer" : "'.$linha["desPer"].'"
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
