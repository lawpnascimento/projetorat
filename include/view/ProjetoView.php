<!DOCTYPE html>
<html>
<head>
  <title>PROJETO RAT</title>
  <meta charset="utf-8">
  <script type="text/javascript" src="../../js/projeto.js"></script>
  <script type="text/javascript" src="../../js/geral.js"></script>
  <link rel="stylesheet" href="../../lib/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="../../css/menu.css">
</head>
<body>

<!--Tabela (campos)-->
<div id="main" class="container-fluid">
 <h3 class="page-header">Cadastro de Projeto</h3>
</div>
        <div class="panel-body" >
            <form id="formProjeto" class="form-horizontal" role="form">
                <div class="form-group">
                    <div class="col-md-3">
                        <label for="projeto">Projeto*</label>
                        <input id="txbProjeto" type="text" class="form-control" name="txbProjeto" placeholder="Nome do projeto" maxlength="25"></input>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-3">
                        <label for="produto">Produto*</label>
                        <input id="txbProduto" type="text" class="form-control" name="txbProduto" placeholder="Nome do produto" maxlength="25"></input>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-3">
                        <label for="datainicio">Data Inicio*</label>
                        <input id="txbDataIni" type="date" class="form-control" name="txbDataIni"></input>
                    </div>
                </div>
                <!--Combo box-->
                <div class="form-group">
                    <div class="col-md-2">
                        <label for="nomecliente">Nome do Cliente*</label>
                        <div class="dropdown">
                            <button class="btn btn-default dropdown-toggle form-control" type="button" id="cbbCliente" data-toggle="dropdown" aria-expanded="true" name="Cliente">
                                Cliente
                                <span class="caret"></span>
                            </button>
                            <ul id="ulCliente" class="dropdown-menu" role="menu" aria-labelledby="cbbCliente">
                            </ul>
                        </div>
                    </div>
                </div>
              </form>
            </div>

<!--Botoes-->
  <hr />
  <div id="actions" class="row">
    <div class="col-md-12">
      <button style="margin-left: 25px" class="btn btn-primary" onclick="submitProjeto()">Salvar</button>
      <input type="button" value="Cancelar" class="btn btn-default" onclick="resetForm()">
    </div>
  </div>
</body>
</html>