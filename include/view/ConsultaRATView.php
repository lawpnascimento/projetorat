<!DOCTYPE html>
<html>
  <head>
    <title>Consulta RAT</title>
    <meta charset="utf-8">
    <script type="text/javascript" src="../../js/geral.js"></script>
    <script type="text/javascript" src="../../js/alerta.js"></script>
    <script type="text/javascript" src="../../js/ConsultaRAT.js"></script>
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
                    <input id="txbCodRat" type="text" class="form-control" name="txbCodRat"></input>
                </div>
                <div class="col-md-2">
                  <label for="nomUsu">Usuário</label>
                    <input id="txbNomUsu" type="text" class="form-control" name="txbNomUsu" maxlength="50"></input>
                </div>
                <div class="col-md-2">
                  <label for="nomCli">Cliente</label>
                    <input id="txbNomCli" type="text" class="form-control" name="txbNomCli"></input>
                </div>
                <div class="col-md-2">
                  <label for="nomRes">Responsável</label>
                    <input id="txbNomRes" type="text" class="form-control" name="txbNomRes"></input>
                </div>
                <div class="col-md-2">
                  <label for="nomPrj">Projeto</label>
                    <input id="txbNomPrj" type="text" class="form-control" name="txbNomPrj"></input>
                </div>
                <div class="col-md-2">
                  <label for="nomPrj">Produto</label>
                    <input id="txbNomPro" type="text" class="form-control" name="txbNomPro"></input>
                </div>
                <div class="col-md-1">
                  <label for="sitRAT">Situação</label>
                    <input id="txbSitRAT" type="text" class="form-control" name="txbSitRAT"></input>
                </div>
              </div>

              <!-- BOTÕES -->
              <div id="actions" class="row">
                <div class="col-md-12">
                  <button id="btnBuscar" type="button" class="btn btn-info">Buscar</button>
                  <button id="btnCancelar" type="button" class="btn btn-warning">Cancelar</button>
                </div>
              </div>
            </form>
      </div>
    </div>

    <div class="panel panel-default" style="overflow-y: scroll; height:200px !important;">
          <!-- Tabela da consulta -->
          <table class="table table-hover table-condensed table-striped table-bordered">
            <thead>
              <tr>
                <th>
                  Código
                </th>
                <th>
                  Usuário
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

    <!-- PANEL ATIVIDADES -->
    <div class="panel panel-default">
        <div class="panel-body">
        <legend class="scheduler-border">Atividades</legend>
          teste
        </div>
    </div>


    <!-- PANEL DESPESAS -->
    <div class="panel panel-default">
        <div class="panel-body">
        <legend class="scheduler-border">Despesas</legend>
          teste
        </div>
    </div>
      
  </body>
</html>
