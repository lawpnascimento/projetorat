<?php
session_start();
require_once("../../estrutura/iniciar_sessao.php");
$_SESSION['userid'] = "1" // You may want to set it on login
?>

<!DOCTYPE html>
<html>
<head>
  <title>PROJETO RAT</title>
  <meta charset="utf-8">
  <script type="text/javascript" src="../../lib/jquery/jquery.min.js"></script>
  <script type="text/javascript" src="../../lib/jquery/jquery-ui.min.js"></script>
  <script type="text/javascript" src="../../lib/jquery/jquery.mask.js"></script>
  <script type="text/javascript" src="../../lib/bootstrap/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="../../js/geral.js"></script>
  <script type="text/javascript" src="../../js/principal.js"></script>
  <script type="text/javascript" src="../../js/cliente.js"></script>
  <script type="text/javascript" src="../../js/responsavel.js"></script>
  <script type="text/javascript" src="../../js/rat.js"></script>
  <script type="text/javascript" src="../../js/usuario.js"></script>
  <script type="text/javascript" src="../../js/alerta.js"></script>
  <link rel="stylesheet" href="../../lib/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="../../css/alerta.css">
    <!-- start orangechat code -->
  <!--  <link type="text/css" rel="stylesheet" media="all" href="../../orangechat/orangechat/orangecss.php" />
    <script type="text/javascript" src="../../orangechat/orangechat/orangejs.php"></script> -->
  <!-- end orangechat code -->
</head>
<body>
  <div class="container-fluid">
    <header class="row">
      <nav class="navbar navbar-default">
        <div class="container-fluid">
          <div class="navbar-header">
            <a class="navbar-brand" href="Principal.php"><i class="glyphicon glyphicon-home"></i> Projeto RAT</a>
          </div>
          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Cadastros<span class="caret"></span></a>
                <ul class="dropdown-menu" role="menu">
                  <li>
                    <a id="usuario">Usuários</a>
                  </li>
                  </li>
                    <li class="divider"/>
                  <li>
                  <li>
                    <a id="cliente">Clientes</a>
                  </li>
                    <li class="divider"/>
                  <li>
                    <a id="projeto">Projetos</a>
                  </li>
                  <li class="divider"/>
                  <li>
                    <a id="responsavel">Responsaveis</a>
                  </li>
                  <li class="divider"/>
                  <li>
                    <a id="despesa">Despesas</a>
                  </li>
                  <li class="divider"/>
                  <li>
                    <a id="produto">Produto</a>
                  </li>
                </ul>
              </li>
            </ul>
            <ul class="nav navbar-nav">
              <li>
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Operacoes<span class="caret"></span></a>
                <ul class="dropdown-menu" role="menu">
                  <li>
                    <a id="rat">Lançamento RAT</a>
                  </li>
                  <li class="divider"/>
                  <li>
                    <a id="avaliacao">Avaliação RAT</a>
                  </li>
                </ul>
              </li>
            </ul>
            <ul class="nav navbar-nav">
              <li>
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Financeiro<span class="caret"></span></a>
                <ul class="dropdown-menu" role="menu">
                  <li>
                    <a id="rat">Faturamento</a>
                  </li>
                </ul>
              </li>
            </ul>
            <ul class="nav navbar-nav">
              <li>
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Relatórios<span class="caret"></span></a>
                <ul class="dropdown-menu" role="menu">
                  <li>
                    <li>
                    <a id="rat">Relatório de Comissões</a>
                    </li>
                  <li class="divider"/>
                    <li>
                    <a id="rat">Relatório de Despesas</a>
                    </li>
                  </ul>
                </li>
              </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><?php echo ucfirst($_SESSION["nomUsu"]) ?><span class="caret"></span></a>
                  <ul class="dropdown-menu" role="menu">
                      <li>
                          <a id="btnPerfil" href="#">Perfil</a>
                      </li>
                      <li class="divider"/>
                      <li>
                          <a id="btnAjuda" href="#">Ajuda</a>
                      </li>
                      <li class="divider"/>
                      <li>
                          <a href="Sair.php">Sair</a>
                      </li>
                     </ul>
                </li>
              </ul>

          </div>
        </div>
      </nav>
    </header>
<!--Navegaçao-->

<div class="row">
  <div id="divPrincipal" role="divPrincipal">
  </div>
</div>

</body>
</html>
