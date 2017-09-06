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
            <input type="hidden" id="hidCodPrj"></input>
          <fieldset>
          <legend class="scheduler-border">Projeto</legend>
              <div class="form-group">
                <div class="col-md-4">
                  <label for="projeto">Projeto*</label>
                  <input id="txbProjeto" type="text" class="form-control" name="txbProjeto" placeholder="Nome do Projeto" maxlength="40"></input>
                </div>
                <div class="col-md-2">
                  <label for="DataInicio">Data de Início*</label>
                  <input id="txbDataInicio" type="date" class="form-control" name="txbDataInicio"></input>
                </div>
              </div>
              <!--Combobox -->
              <div class="form-group">  
              <!--Combobox Cliente-->
                <div class="col-md-2">
                    <label for="nomecliente">Nome do Cliente*</label>
                    <div class="dropdown">
                        <button class="btn btn-default dropdown-toggle form-control" type="button" id="cbbCliente" data-toggle="dropdown" aria-expanded="false" name="Cliente">
                            Cliente
                            <span class="caret"></span>
                        </button>
                        <ul id="ulCliente" class="dropdown-menu" role="menu" aria-labelledby="cbbCliente">
                        </ul>
                    </div>
                </div>
                <!--Combobox Produto-->
                <div class="col-md-2">
                    <label for="nomeproduto">Nome do Produto*</label>
                    <div class="dropdown">
                        <button class="btn btn-default dropdown-toggle form-control" type="button" id="cbbProduto" data-toggle="dropdown" aria-expanded="false" name="Produto">
                            Produto
                            <span class="caret"></span>
                        </button>
                        <ul id="ulProduto" class="dropdown-menu" role="menu" aria-labelledby="cbbProduto">
                        </ul>
                    </div>
                </div>
              </div>
              </fieldset>
              <fieldset>
              <legend class="scheduler-border">Valores</legend>
              <div class="form-group">
                <div class="col-md-2">
                  <label for="ValorHoraCom">Valor Hora Comissão*</label>
                    <input id="txbValorHoraCom" type="text" class="form-control" name="txbValorHoraCom" placeholder="Ex: 100.00" maxlength="8"></input>
                  </div>
                  <div class="col-md-2">
                    <label for="ValorHoraFat">Valor Hora Faturamento</label>
                    <input id="txbValorHoraFat" type="text" class="form-control" name="txbValorHoraFat" maxlength="8"></input>
                  </div>
              </div>
              </fieldset>
              <fieldset>
              <legend class="scheduler-border">Etc</legend>
              <div class="form-group">
                <div class="col-md-4">
                  <label for="observacaoprojeto">Observação</label>
                  <textarea rows="4" cols="50" id="txaObsProjeto" type="text" class="form-control" name="txaObsProjeto" maxlength="200"></textarea>
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
              <th>
                Vlr. Hor. Comissão
              </th>
              <th>
                Vlr. Hor. Faturamento
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
