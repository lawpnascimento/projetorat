<!DOCTYPE html>
<html>
  <head>
    <title>Consulta RAT</title>
    <meta charset="utf-8">
    <script type="text/javascript" src="../../js/geral.js"></script>
    <script type="text/javascript" src="../../js/alerta.js"></script>
    <script type="text/javascript" src="../../js/ConsultaRAT.js"></script>
    <link rel="stylesheet" href="../../css/tabela.css">
    <link rel="stylesheet" href="../../css/alerta.css">
  </head>
  <body>
    <div class="container-fluid">
      <div class="panel panel-default">
        <div class="panel-heading">
            <div class="panel-title">Consulta RAT</div>
        </div>
          <div class="panel-body">
            <form id="formConsultaRAT" class="form-horizontal" role="form">
              <div class="form-group">
                <div class="col-md-1">
                  <label for="codRat">Código</label>
                    <input id="txbCodRat" type="text" class="form-control" name="txbCodRat" placeholder="Cod RAT"></input>
                </div>
                <div class="col-md-2">
                  <label for="nomUsu">Usuário</label>
                    <input id="txbNomUsu" type="text" class="form-control" name="txbNomUsu" maxlength="50" placeholder="Nome do usuario"></input>
                </div>
                <div class="col-md-2">
                  <label for="nomCli">Cliente</label>
                    <input id="txbNomCli" type="text" class="form-control" name="txbNomCli" placeholder="Nome do cliente"></input>
                </div>
                <div class="col-md-2">
                  <label for="nomRes">Responsável</label>
                    <input id="txbNomRes" type="text" class="form-control" name="txbNomRes" placeholder="Nome do responsável"></input>
                </div>
                <div class="col-md-2">
                  <label for="nomPrj">Projeto</label>
                    <input id="txbNomPrj" type="text" class="form-control" name="txbNomPrj" placeholder="Nome do projeto"></input>
                </div>
                <div class="col-md-2">
                  <label for="nomPrj">Produto</label>
                    <input id="txbNomPro" type="text" class="form-control" name="txbNomPro" placeholder="Nome do produto"></input>
                </div>
                <div class="col-md-1">
                  <label for="sitRAT">Situação</label>
                    <input id="txbSitRAT" type="text" class="form-control" name="txbSitRAT" placeholder="Cod Sit"></input>
                </div>
              </div>
              <!-- BOTÕES -->
              <div id="actions" class="row">
                <div class="col-md-12">
                  <button id="btnBuscar" type="button" class="btn btn-info">Buscar</button>
                  <button id="btnEmail" type="button" class="btn btn-info">Enviar e-mail</button>
                  <button id="btnAlterar" type="button" class="btn btn-primary">Alterar RAT</button>
                  <button id="btnCancelar" type="button" class="btn btn-warning">Cancelar</button>
                  <button id="btnAprovar" type="button" class="btn btn-success">Aprovar</button>
                  <button id="btnReprovar" type="button" class="btn btn-danger">Reprovar</button>
                </div>
              </div>
            </form>
      </div>
    </div>

    <div class="panel panel-default" style="overflow-y: scroll; height:200px !important;">
          <!-- Tabela da consulta -->
          <table id="tableConsultaRAT" class="table table-condensed table-bordered">
            <thead>
              <tr>
                <th>
                  Código
                </th>
                <th>
                  Usuário
                </th>
                <th>
                  Data
                </th>
                <th>
                  % Com. Cli.
                </th>
                <th>
                  % Com. Int.
                </th>
                <th>
                  Cliente
                </th>
                <th>
                  Responsável
                </th>
                <th>
                  Projeto
                </th>
                <th>
                  Vlr. Hor. Com.
                </th>
                <th>
                  Vlr. Hor. Fat.
                </th>
                <th>
                  Produto
                </th>
                <th>
                  Situação
                </th>
              </tr>
            </thead>
            <tbody id="grdConsultaRAT"></tbody>
          </table>
    </div>

    <legend class="scheduler-border">Atividades</legend>
        <div class="panel panel-default" style="overflow-y: scroll; height:100px !important;">
          <table id="tableConsultaAtividade" class="table table-condensed table-bordered">
            <thead>
              <tr>
                <th class="col-sm-1">
                  Código
                </th>
                <th class="col-sm-1">
                  Data
                </th>
                <th class="col-sm-1">
                  Hora Inicial
                </th>
                <th class="col-sm-1">
                  Hora Final
                </th>
                <th class="col-sm-1">
                  Total Horas
                </th>
                <th>
                  Descrição
                </th>
                <th class="col-sm-1">
                  Tip. Fat.
                </th>
              </tr>
            </thead>
            <tbody id="grdConsultaAtividade"></tbody>
          </table>
    </div>

    <legend class="scheduler-border">Despesas</legend>
        <div class="panel panel-default" style="overflow-y: scroll; height:100px !important;">
          <table id="tableConsultaDespesa" class="table table-condensed table-bordered">
            <thead>
              <tr>
                <th class="col-sm-1">
                  Código
                </th>
                <th class="col-sm-1">
                  Data
                </th>
                <th class="col-sm-2">
                  Descrição
                </th>
                <th class="col-sm-2">
                  Tip. Desp.
                </th>
                <th class="col-sm-1">
                  Valor Unitário
                </th>
                <th class="col-sm-1">
                  Quantidade
                </th>
                <th class="col-sm-1">
                  Total
                </th>
               <th>
                  Observações
                </th>
               <th class="col-sm-1">
                  Tip. Fat.
                </th>
              </tr>
            </thead>
            <tbody id="grdConsultaDespesa"></tbody>
          </table>
    </div>
      
  </body>
</html>
