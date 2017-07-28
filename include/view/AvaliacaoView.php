<!DOCTYPE html>
<html>
  <head>
    <title>PROJETO RAT</title>
    <meta charset="utf-8">
    <script type="text/javascript" src="../../js/rat.js"></script>
    <script type="text/javascript" src="../../js/alerta.js"></script>
    <link rel="stylesheet" href="../../css/alerta.css">
    <link rel="stylesheet" href="../../css/rat.css">
  </head>
    <body>
      <div class="container-fluid">
        <div class="panel panel-default">
          <div class="panel-heading">
            <div class="panel-title">Avaliar RAT</div>
          </div>
          Teste    
        </div>

       <div class="panel panel-default" style="overflow-y: scroll; height:500px !important;">
        <!-- Tabela da consulta -->
        <table class="table table-hover table-condensed table-striped table-bordered">
          <thead>
            <tr>
              <th>Código</th>
              <th>Usuário</th>
              <th>Data Lançamento</th>
              <th>Cliente</th>
              <th>Responsável</th>
              <th>Situação</th>
              <th>Avaliação</th>
            </tr>
            </thead>
            <tr>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td>
                <a href="#">
                  <span class="glyphicon glyphicon-ok"></span> Aprovar
                </a>
              </td>
              <td>
                <a href="#">
                  <span class="glyphicon glyphicon-remove"></span> Cancelar
                </a>
              </td>
            </tr>
          <tbody id="grdAvaliacao"></tbody>
        </table>
      </div>
      </div>
</body>
</html>