<!DOCTYPE html>
<html>
  <head>
    <title>PROJETO RAT</title>
    <meta charset="utf-8">
    <script type="text/javascript" src="../../js/produto.js"></script>
    <script type="text/javascript" src="../../js/alerta.js"></script>
    <link rel="stylesheet" href="../../css/alerta.css">
  </head>
  <body>
    <div class="container-fluid">
      <div class="panel panel-default">
        <div class="panel-heading">
            <div class="panel-title">Cadastro de Produto</div>
        </div>
        <div class="panel-body">
          <form id="formProduto" class="form-horizontal" role="form">
          <fieldset>
              <div class="form-group">
                <div class="col-md-4">
                  <label for="descricaoProduto">Descrição do Produto*</label>
                  <input id="txbDescricaoProduto" type="text" class="form-control" name="txbDescricaoProduto" placeholder="Descrição do Produto" maxlength="40"></input>
                </div>
              </div>
          </fieldset>

            <!-- BOTÕES -->
            <div id="actions" class="row">
              <div class="col-md-12">
                <button id="btnCadastrar" type="button" class="btn btn-success">Cadastrar</button>
                <button id="btnBuscar" type="button" class="btn btn-info">Buscar</button>
                <button id="btnAtualizar" type="button" style="display:none;" class="btn btn-primary">Atualizar</button>
                <button id="btnExcluir" type="button" style="display:none;" class="btn btn-danger">Excluir</button>
                <button id="btnCancelar" type="button" class="btn btn-warning">Cancelar</button>
              </div>
            </div>
          </form>
        </div>
      </div>

      <!-- Tabela da consulta -->
      <div class="panel panel-default" style="overflow-y: scroll; height:200px !important;">
        <table class="table">
          <thead>
            <tr>
              <th>
                Código do Produto
              </th>
              <th>
                Descrição do Produto
              </th>
            </tr>
          </thead>
          <tbody id="grdProduto"></tbody>
        </table>
      </div>
      <hr/>

    </div>
  </body>
</html>
