<?php

class RATModel {

	private $codigo;
	private $usuario;
	private $cliente;
	private $responsavel;
	private $atividade;
	private $despesa;
	private $projeto;
	private $situacao;
	private $termo;
	private $produto;
	private $dtRAT;
	private $dtAtividade;
	private $hrInicial;
	private $hrFinal;
	private $hrTotal;
	private $dsAtividade;
	private $idFaturar;
	private $dtDespesa;
	private $idDespesa;
	private $vlDespesa;
	private $qtDespesa;
	private $totDespesa;
	private $cdFaturamento;
	private $dsOberservacao;
	private $cdDespesa;
	private $nmRelatorio;

	public function setCodigo($codigo){
		$this->codigo = $codigo;
	}

	public function getCodigo(){
		return $this->codigo;
	}

	public function setUsuario($usuario){
		$this->usuario = $usuario;
	}
	public function getUsuario(){
		return $this->usuario;
	}

	public function setCliente($cliente){
		$this->cliente = $cliente;
	}
	public function getCliente(){
		return $this->cliente;
	}

	public function getResponsavel(){
		return $this->responsavel;
	}

	public function setResponsavel($responsavel){
		$this->responsavel = $responsavel;
	}

	public function getAtividade(){
		return $this->atividade;
	}

	public function setAtividade($atividade){
		$this->atividade = $atividade;
	}

	public function getDespesa(){
		return $this->despesa;
	}

	public function setDespesa($despesa){
		$this->despesa = $despesa;
	}

	public function getProjeto(){
		return $this->projeto;
	}

	public function setProjeto($projeto){
		$this->projeto = $projeto;
	}

	public function getProduto(){
		return $this->produto;
	}

	public function setProduto($produto){
		$this->produto = $produto;
	}

	public function getDtRAT(){
		return $this->dtRAT;
	}

	public function setDtRAT($dtRAT){
		$this->dtRAT = $dtRAT;
	}

	public function getSituacao(){
		return $this->situacao;
	}

	public function setSituacao($situacao){
		$this->situacao = $situacao;
	}

	public function getTermo(){
		return $this->termo;
	}

	public function setTermo($termo){
		$this->termo = $termo;
	}

	public function getDtAtividade(){
		return $this->dtAtividade;
	}

	public function setDtAtividade($dtAtividade){
		$this->dtAtividade = $dtAtividade;
	}

	public function getHrInicial(){
		return $this->hrInicial;
	}

	public function setHrInicial($hrInicial){
		$this->hrInicial = $hrInicial;
	}

	public function getHrFinal(){
		return $this->hrFinal;
	}

	public function setHrFinal($hrFinal){
		$this->hrFinal = $hrFinal;
	}

	public function getHrTotal(){
		return $this->hrTotal;
	}

	public function setHrTotal($hrTotal){
		$this->hrTotal = $hrTotal;
	}

	public function getDsAtividade(){
		return $this->dsAtividade;
	}

	public function setDsAtividade($dsAtividade){
		$this->dsAtividade = $dsAtividade;
	}

	public function getIdFaturar(){
		return $this->idFaturar;
	}

	public function setIdFaturar($idFaturar){
		$this->idFaturar = $idFaturar;
	}

	public function getDtDespesa() {
		return $this->dtDespesa;
	}

	public function setDtDespesa($dtDespesa) {
		$this->dtDespesa = $dtDespesa;
	}

	public function getIdDespesa() {
		return $this->idDespesa;
	}

	public function setIdDespesa($idDespesa) {
		$this->idDespesa = $idDespesa;
	}

	public function getVlDespesa() {
		return $this->vlDespesa;
	}

	public function setVlDespesa($vlDespesa) {
		$this->vlDespesa = $vlDespesa;
	}

	public function getQtDespesa() {
		return $this->qtDespesa;
	}

	public function setQtDespesa($qtDespesa) {
		$this->qtDespesa = $qtDespesa;
	}

	public function getTotDespesa() {
		return $this->totDespesa;
	}

	public function setTotDespesa($totDespesa) {
		$this->totDespesa = $totDespesa;
	}

	public function getCdFaturamento() {
		return $this->cdFaturamento;
	}

	public function setCdFaturamento($cdFaturamento) {
		$this->cdFaturamento = $cdFaturamento;
	}

	public function getDsOberservacao() {
		return $this->dsOberservacao;
	}

	public function setDsOberservacao($dsOberservacao) {
		$this->dsOberservacao = $dsOberservacao;
	}

	public function getCdDespesa() {
		return $this->cdDespesa;
	}

	public function setCdDespesa($cdDespesa) {
		$this->cdDespesa = $cdDespesa;
	}

	public function getNmRelatorio() {
		return $this->nmRelatorio;
	}

	public function setNmRelatorio($NmRelatorio) {
		$this->nmRelatorio = $nmRelatorio;
	}

}
?>
