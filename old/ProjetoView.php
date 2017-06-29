<!DOCTYPE html>
<html>
<head>
  <title>PROJETO RAT</title>
  <meta charset="utf-8">
  <script type="text/javascript" src="../../js/projeto.js"></script>
</head>
<body>

<!--Tabela (campos)-->
<div class="container-fluid">
<div class="panel panel-default">
        <div class="panel-heading">
            <div class="panel-title">Cadastro de Projeto</div>
        </div>
        <div class="panel-body" >
            <form id="formProjeto" class="form-horizontal" role="form">
                <div class="form-group">
                    <div class="col-md-4">
                        <label for="projeto">Projeto*</label>
                        <input id="txbProjeto" type="text" class="form-control" name="txbProjeto" placeholder="Nome do projeto" maxlength="30"></input>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-4">
                        <label for="produto">Produto*</label>
                        <input id="txbProduto" type="text" class="form-control" name="txbProduto" placeholder="Nome do produto" maxlength="30"></input>
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
              <!-- DIV PARA MENSAGEM DO CADASTRO -->
                <div id="divMensagemCadastro" class="alert alert-danger" style="display:none;">
                <p id="htmlMensagem"></p>
              </div>
            </div>

<!--Botoes-->
  <hr />
  <div id="actions" class="row">
    <div class="col-md-12">
      <button style="margin-left: 25px" class="btn btn-success" onclick="submitProjeto()">Cadastrar</button>
      <button id="btnCancelar" class="btn btn-default">Cancelar</button>
    </div>
  </div>
  </div>
</body>
</html>