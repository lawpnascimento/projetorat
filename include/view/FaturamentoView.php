<!DOCTYPE html>
<html>
  <head>
    <title>Faturamento</title>
    <meta charset="utf-8">
    <script type="text/javascript" src="../../js/geral.js"></script>
    <script type="text/javascript" src="../../js/alerta.js"></script>
    <link rel="stylesheet" href="../../css/alerta.css">
  </head>
  <body>
    <div class="container-fluid">
      <div class="panel panel-default">
        <div class="panel-heading">
            <div class="panel-title">Faturamento</div>
        </div>
          <div class="panel-body">
            <div class="col-md-2">
              <label for="datFec">Data Fechamento</label>
                <input id="datFec" type="date" class="form-control" name="txbDatFec"></input>
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
  </body>
</html>
