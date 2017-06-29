<!DOCTYPE html>
<html>
<head>
  <title>PROJETO RAT</title>
  <meta charset="utf-8">
  <script type="text/javascript" src="../../js/projeto.js"></script>
  <script type="text/javascript" src="../../js/alerta.js"></script>
  <link rel="stylesheet" href="../../css/alerta.css">
</head>
  <body>
    <div class="container-fluid">
      <div class="panel panel-default">
        <div class="panel-heading">
            <div class="panel-title">Cadastro de Projeto</div>
        </div>
        <div class="panel-body" >
          <form id="formProjeto" class="form-horizontal" role="form">
            <input type="hidden" id="hidCodCli">
            <fieldset>
              <div class="form-group">
                <div class="col-md-4">
                  <label for="projeto">Projeto*</label>
                  <input id="txbProjeto" type="text" class="form-control" name="txbProjeto" placeholder="Nome do Projeto"></input>
                </div>
                <div class="col-md-4">
                  <label for="produto">Produto*</label>
                  <input id="txbProduto" type="text" class="form-control" name="txbProduto" placeholder="Nome do Produto"></input>
                </div>
              </div>
              <div class="form-group">
                <div class="col-md-4">
                  <label for="cliente">Cliente*</label>
                  <input id="txbCliente" type="text" class="form-control" name="txbCliente" placeholder="Nome do Cliente"></input>
                </div>
                <div class="col-md-2">
                  <label for="DataInicio">Data de Início*</label>
                  <input id="txbDataInicio" type="date" class="form-control" name="txbDataInicio"></input>
                </div>
              </div>
            </fieldset>
            <div id="actions" class="row">
              <div class="col-md-12">
                <button id="btnCadastrar" type="button" class="btn btn-success"> Cadastrar</button>
                <button id="btnBuscar" type="button" class="btn btn-info">Buscar</button>
                <button id="btnAtualizar" type="button" style="display:none;" class="btn btn-primary">Atualizar</button>
                <button id="btnExcluir" type="button" style="display:none;" class="btn btn-danger">Excluir</button>
                <button id="btnCancelar" type="button" class="btn btn-warning">Cancelar</button>
              </div>
            </div>
          </form>
        </div>
      </div>
      <div class="panel panel-default" style="overflow-y: scroll; height:200px !important;">
        <!-- Tabela da consulta -->
        <table class="table table-hover table-condensed table-striped table-bordered">
          <thead>
            <tr>
              <th>
                Codigo
              </th>
              <th>
                Projeto
              </th>
              <th>
                Produto
              </th>
              <th>
                Cliente
              </th>
              <th>
                Data Inicio
              </th>
            </tr>
          </thead>
          <tbody id="grdProjeto"></tbody>
        </table>
      </div>
      <hr/>
    </div>
  </body>
</html>
