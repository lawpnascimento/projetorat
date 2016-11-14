<!DOCTYPE html>
<html>
<head>
  <title>PROJETO RAT</title>
  <meta charset="utf-8">
  <script type="text/javascript" src="../../js/cliente.js"></script>
  <script type="text/javascript" src="../../js/geral.js"></script>
  <link rel="stylesheet" href="../../lib/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="../../css/menu.css">
</head>
<body>

<!--Tabela (campos)-->
<div id="main" class="container-fluid">
 <h3 class="page-header">Cadastro de Cliente</h3>
</div>
        <div class="panel-body" >
            <form id="formCliente" class="form-horizontal" role="form">
                <div class="form-group">
                    <div class="col-md-4">
                        <label for="nome">Empresa*</label>
                        <input id="txbNome" type="text" class="form-control" name="txbNome" placeholder="Nome da empresa" maxlength="30"></input>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-4">
                        <label for="resp">Responsavel*</label>
                        <input id="txbResp" type="text" class="form-control" name="txbResp" placeholder="Nome do responsavel" maxlength="40"></input>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-4">
                        <label for="email">E-mail*</label>
                        <!-- type= email nao valida automatico -->
                        <input id="txbEmail" type="text" class="form-control" name="txbEmail" placeholder="E-mail do responsavel" maxlength="30"></input>
                    </div>
                </div>
              </form> 
                    <!-- DIV PARA MENSAGEM DO CADASTRO -->
                    <div id="divMensagemCadastro" class="alert alert-danger" style="display:none;">
                      <p id="htmlMensagem"></p>
                    </div>
            </div>

<div class="panel panel-default">
            <!-- Tabela da consulta -->
            <table class="table">
                <thead>
                    <tr>
                        <th>
                            Nome
                        </th>

                        <th>
                            Responsavel
                        </th>
                        <th>
                            E-mail
                        </th>
                    </tr>
                </thead>
                <tbody id="grdCliente">

                </tbody>
            </table>
        </div>

<!--Botoes-->
  <hr />
  <div id="actions" class="row">
    <div class="col-md-12">
      <button id="btnSalvar" style="margin-left: 25px" class="btn btn-primary" onclick="submitCliente()">Salvar</button>
      <button id="btnCancelar" class="btn btn-default">Cancelar</button>
      <button id="btnConsultar" style="margin-left: 25px" class="btn btn-primary" onclick="buscaCliente()">Consultar</button>
    </div>
  </div>
</body>
</html>