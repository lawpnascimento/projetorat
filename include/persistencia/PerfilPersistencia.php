<?php

require_once("../../estrutura/conexao.php");

class PerfilPersistencia {

    protected $conexao;
    protected $Model;

    function __construct(){
        $this->conexao = new Conexao();
    }

    public function getModel(){
        return $this->Model;
    }

    public function setModel($Model){
        $this->Model = $Model;
    }

    public function getConexao(){
        return $this->conexao;
    }

    public function buscaPerfil(){
        $this->getConexao()->conectaBanco();

        $codigo = $this->getModel()->getCodigo();
        $nome = $this->getModel()->getNome();
        $sobrenome = $this->getModel()->getSobrenome();
        $senha = $this->getModel()->getSenha();
        $email = $this->getModel()->getEmail();

              $sSql = "SELECT usu.codUsu
                             ,usu.nomUsu
                             ,usu.sobrenomeUsu
                             ,usu.senUsu
                             ,usu.desEml
                             ,pap.codPap
                             ,pap.desPap
                         FROM tbusuario usu
                          JOIN tbpapel pap
                          ON usu.Papel_codpap = pap.codPap
                        WHERE usu.codUsu = " . $codigo;

        $resultado = mysql_query($sSql);

        $qtdLinhas = mysql_num_rows($resultado);

        $contador = 0;

        $retorno = '[';

        while ($linha = mysql_fetch_assoc($resultado)) {

            $contador = $contador + 1;

            $retorno = $retorno . '{"nomUsu": "'.$linha["nomUsu"].'"
                                   , "sobrenomeUsu" : "'.$linha["sobrenomeUsu"].'"
                                   , "senUsu" : "'.$linha["senUsu"].'"
                                   , "desEml" : "'.$linha["desEml"].'"
                                   , "desPap" : "'.$linha["desPap"].'"}';

            //Para não concatenar a virgula no final do json
            if($qtdLinhas != $contador)
                $retorno = $retorno . ',';

        }
        $retorno = $retorno . "]";

        return $retorno;

        $this->getConexao()->fechaConexao();
    }

    public function AtualizarPerfil(){
        $this->getConexao()->conectaBanco();

        $codigo = $this->getModel()->getCodigo();
        $nome = $this->getModel()->getNome();
        $sobrenome = $this->getModel()->getSobrenome();
        $senha = $this->getModel()->getSenha();
        $email = $this->getModel()->getEmail();

        $sSql = "UPDATE tbusuario usu
                    SET usu.nomUsu = '" . $nome ."'
                       ,usu.sobrenomeUsu = '" . $sobrenome ."'
                       ,usu.senUsu = '" . $senha ."'
                       ,usu.desEml = '". $email ."'
                  WHERE usu.codUsu = " . $codigo;

        $this->getConexao()->query($sSql);

        $this->getConexao()->fechaConexao();
    }
}
?>