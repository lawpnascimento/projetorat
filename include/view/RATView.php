<!DOCTYPE html>
<html>
  <head>
    <title>PROJETO RAT</title>
    <meta charset="utf-8">
    <script type="text/javascript" src="../../lib/jquery/jquery.min.js"></script>
    <script type="text/javascript" src="../../js/geral.js"></script>
    <script type="text/javascript" src="../../js/alerta.js"></script>
    <script type="text/javascript" src="../../lib/bootstrap/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="../../lib/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../css/rat.css">
    <link href="../../css/alerta.css" rel="stylesheet" media="screen" />
  </head>
    <body>
      <div class="container-fluid">
        <div class="panel panel-default">
          <div class="panel-heading">
                Lancar RAT
          </div>
          <div class="container">

          <div id="content" align="left">
          <ul id="tabs" class="nav nav-pills nav-justified" data-tabs="tabs">
            <li class="active"><a href="#red" data-toggle="tab">Geral</a></li>
            <li><a href="#orange" data-toggle="tab">Atividades</a></li>
            <li><a href="#yellow" data-toggle="tab">Despesas</a></li>
            <li><a href="#green" data-toggle="tab">Green</a></li>
            <li><a href="#blue" data-toggle="tab">Blue</a></li>
          </ul>
          <div id="my-tab-content" class="tab-content">
            <div class="tab-pane active" id="red">
                <h1>Geral</h1>
                <p>red red red red red red</p>
            </div>
            <div class="tab-pane" id="orange">
                <h1>Atividades</h1>
                <div class="form-group">
                <div class="col-md-2">
                  <label for="razaoSocial">Data Inicial</label>
                  <input id="txbRazaoSocial" type="date" class="form-control" name="txbRazaoSocial"></input>
                </div>
                <div class="col-md-2">
                  <label for="nomeFantasia">Data Final</label>
                  <input id="txbNomeFantasia" type="date" class="form-control" name="txbNomeFantasia" placeholder="Nome Fantasia" maxlength="40"></input>
                </div>
              </div>
            </div>
            <div class="tab-pane" id="yellow">
                <h1>Despesas</h1>
                <p>yellow yellow yellow yellow yellow</p>
            </div>
            <div class="tab-pane" id="green">
                <h1>Green</h1>
                <p>green green green green green</p>
            </div>
            <div class="tab-pane" id="blue">
                <h1>Blue</h1>
                <p>blue blue blue blue blue</p>
            </div>
          </div>
          </div>

          </div>
          </div>
       
       </div>

</body>
</html>