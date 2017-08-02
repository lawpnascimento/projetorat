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
              <label for="nomPrj">Projeto</label>
                <input id="txbNomPrj" type="text" class="form-control" name="txbNomPrj"></input>
          </div>
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
                  Projeto
                </th>
                <th>
                  Situação
                </th>
                <th>
                  Despesa
                </th>
                <th>
                  Atividade
                </th>
              </tr>
            </thead>
            <tbody id="grdConsultaRAT"></tbody>
          </table>
      </div>
  </body>
</html>
