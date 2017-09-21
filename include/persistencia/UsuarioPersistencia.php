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
		$senha = $this->criptografaSenha($this->getModel()->getSenha());
		$email = $this->getModel()->getEmail();
		$papel = $this->getModel()->getPapel();
		$situacao = $this->getModel()->getSituacao();
		$percentualComissaoCli = $this->getModel()->getPercentualComissaoCli();
		$percentualComissaoInt = $this->getModel()->getPercentualComissaoInt();

		$sSql = "INSERT INTO tbusuario (nomUsu, sobrenomeUsu, senUsu, desEml, Papel_codPap, codSit, perComCli, perComInt)
		VALUES ('". $nome ."'
		,'". $sobrenome ."'
		,'". $senha ."'
		,'". $email ."'
		,'". $papel ."'
		,'". $situacao ."'
		,'". $percentualComissaoCli ."'
		,'". $percentualComissaoInt ."')";

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
		$email = $this->getModel()->getEmail();
		$papel = $this->getModel()->getPapel();
		$situacao = $this->getModel()->getSituacao();
		$percentualComissaoCli = $this->getModel()->getPercentualComissaoCli();
		$percentualComissaoInt = $this->getModel()->getPercentualComissaoInt();

		if($codigo == null){

			$sSql = "SELECT usu.codUsu codUsu
			,usu.nomUsu nomUsu
			,usu.sobrenomeUsu sobrenomeUsu
			,usu.codSit codSit
			,usu.desEml desEml
			,pap.codPap codPap
			,pap.desPap desPap
			,concat(usu.perComCli, '%') perComCli
			,concat(usu.perComInt, '%') perComInt
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
			,usu.codSit codSit
			,usu.desEml desEml
			,pap.codPap codPap
			,pap.desPap desPap
			,concat(usu.perComCli, '%') perComCli
			,concat(usu.perComInt, '%') perComInt
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
			, "codSit" : "'.$linha["codSit"].'"
			, "desEml" : "'.$linha["desEml"].'"
			, "codPap" : "'.$linha["codPap"].'"
			, "desPap" : "'.$linha["desPap"].'"
			, "perComCli" : "'.$linha["perComCli"].'"
			, "perComInt" : "'.$linha["perComInt"].'"
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
		$percentualComissaoCli = $this->getModel()->getPercentualComissaoCli();
		$percentualComissaoInt = $this->getModel()->getPercentualComissaoInt();

		if($senha == null){

			$sSql = "UPDATE tbusuario
			SET nomUsu = '" . $nome ."'
			,sobrenomeUsu = '" . $sobrenome ."'
			,desEml = '" . $email ."'
			,Papel_codPap = '" . $papel ."'
			,codSit = '" . $situacao ."'
			,perComCli = '" . $percentualComissaoCli ."'
			,perComInt = '" . $percentualComissaoInt ."'
			WHERE codUsu = " . $codigo;

		}else{
			$senhaCript = $this->criptografaSenha($senha);

			$sSql = "UPDATE tbusuario
			SET nomUsu = '" . $nome ."'
			,sobrenomeUsu = '" . $sobrenome ."'
			,senUsu = '" . $senhaCript ."'
			,desEml = '" . $email ."'
			,Papel_codPap = '" . $papel ."'
			,codSit = '" . $situacao ."'
			,perComCli = '" . $percentualComissaoCli ."'
			,perComInt = '" . $percentualComissaoInt ."'
			WHERE codUsu = " . $codigo;

		}

		$this->getConexao()->query($sSql);

		$this->getConexao()->fechaConexao();
	}

	public function criptografaSenha($senha){
		/*$options = [
			'cost' => 11,
			'salt' => mcrypt_create_iv(22, MCRYPT_DEV_URANDOM),
		];
		$senhaCript = password_hash($senha, PASSWORD_BCRYPT, $options)."\n";

		return $senhaCript;*/
		return sha1($senha);
	}
}

?>
