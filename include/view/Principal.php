<!DOCTYPE html>
<html>
<head>
  <title>PROJETO RAT</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <script src="../../lib/jquery/jquery.min.js"></script>
  <script src="../../lib/bootstrap/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="../../lib/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="../../css/menu.css">
</head>
<body>

<!--Navegaçao-->
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="Principal.php">Projeto RAT</a>
    </div>
<!--Itens na barra de navegação-->   
    <ul class="nav navbar-nav">
      <li class="dropdown"><a href=#>Cadastro</a>
        <!--Dropdown-->   
        <div class="dropdown-content">
          <a id="cliente">Cliente</a>
          <a id="projeto">Projeto</a>
      </li>
      <li><a href="#">Operações</a></li>
      <li><a href="#">Consultas</a></li>
      <li><a href="#">Relatórios</a></li>
      <li align=><a href="LoginView.php">Sair</a></li>
    </ul>
  </div>
</nav>
  
<div id="divPrincipal" class="container">
View Inicial
</div>

  <script>
  $("#cliente").click(function(){
    $.ajax({

        type: "POST",
        dataType: "text",

        url: "ClienteView.php",

        success: function(callback){
            $("#divPrincipal").html(callback);
         
        }
    });    

  });

  $("#projeto").click(function(){
    $.ajax({

        type: "POST",
        dataType: "text",

        url: "ProjetoView.php",

        success: function(callback){
            $("#divPrincipal").html(callback);
            buscaClienteDropdown();
         
        }
    });    

  });


  </script> 
</body>
</html>
