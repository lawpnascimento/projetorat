<!DOCTYPE html>
<html>
  <head>
    <title>Relatório Despesas por Clientes</title>
    <meta charset="utf-8">
    <script type="text/javascript" src="../../js/geral.js"></script>
    <script type="text/javascript" src="../../js/alerta.js"></script>
    <link rel="stylesheet" href="../../css/alerta.css">
  </head>
  <body>
    <div class="container-fluid">
      <div class="panel panel-default">
        <div class="panel-heading">
            <div class="panel-title">Relatório Despesas por Clientes</div>
        </div>
        <div class="panel-body">
          <form id="formRelatorioDespesasClientes" class="form-horizontal" role="form">
            <legend class="scheduler-border">Filtros de entrada</legend>
              <div class="form-group">
                <div class="col-md-2">
                  <label for="DatIni">Período inicial</label>
                  <input id="txbDatIni" type="date" class="form-control" name="txbDatIni"></input>
                </div>
                <div class="col-md-2">
                  <label for="DatFin">Período final</label>
                  <input id="txbDatFin" type="date" class="form-control" name="txbDatFin"></input>
                </div>
              </div>
              <div class="form-group">
                <div class="col-md-3">
                  <label for="consultor">Consultor</label>
                  <input id="txbConsultor" type="text" class="form-control" name="txbConsultor" placeholder="Nome" maxlength="50"></input>
                </div>
              </div> 
              <div id="actions" class="row">
                <div class="col-md-12">
                  <button id="btnExecutar" type="button" class="btn btn-success">Executar</button>
                  <button id="btnCancelar" type="button" class="btn btn-warning">Cancelar</button>
                </div>
              </div>
          </form>
        </div>
      </div>
    </div>
  </body>
</html>
