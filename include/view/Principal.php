  <!DOCTYPE html>
<html>
<head>
  <title>PROJETO RAT</title>
  <meta charset="utf-8">
  <script src="../../lib/jquery/jquery.min.js"></script>
  <script src="../../lib/bootstrap/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="../../js/geral.js"></script>
  <script type="text/javascript" src="../../js/principal.js"></script>
  <script type="text/javascript" src="../../js/cliente.js"></script>
  <link rel="stylesheet" href="../../lib/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="../../css/menu.css">
</head>
<body>
  <div class="container-fluid">
    <header class="row">
      <nav class="navbar navbar-default">
        <div class="container-fluid">
          <div class="navbar-header">
            <a class="navbar-brand" href="Principal.php">Projeto RAT</a>
          </div>
          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Cadastro<span class="caret"></span></a>
                <ul class="dropdown-menu" role="menu">
                  <li>
                    <a id="cliente">Cliente</a>
                  </li>
                    <li class="divider"/>
                  <li>
                    <a id="projeto">Projeto</a>
                  </li>
                  <li>
                    <a id="responsavel">Responsavel</a>
                  </li>
                </ul>
              </li>
            </ul>
            <ul class="nav navbar-nav">
              <li>
                <a href="#">Operações</a>
              </li>
            </ul>
            <ul class="nav navbar-nav">
              <li>
                <a href="#">Consultas</a>
              </li>
            </ul>
            <ul class="nav navbar-nav">
              <li>
                <a href="#">Relatórios</a>
              </li>
            </ul>
            <ul class="nav navbar-nav">
              <li>
                <a href="LoginView.php">Sair</a>
              </li>
          </div>
        </div>
      </nav>
    </header>
<!--Navegaçao-->

<div class="row">
  <div id="divPrincipal" role="divPrincipal">
  View Inicial
  </div>
</div>

</body>
</html>
