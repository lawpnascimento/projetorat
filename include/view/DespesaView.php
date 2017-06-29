<!DOCTYPE html>
<html>
  <head>
    <title>PROJETO RAT</title>
    <meta charset="utf-8">
    <script type="text/javascript" src="../../js/despesa.js"></script>
    <script type="text/javascript" src="../../js/alerta.js"></script>
  </head>
  <body>
    <div class="container-fluid">
      <div class="panel panel-default">
        <div class="panel-heading">
            <div class="panel-title">Cadastro de Despesa</div>
        </div>
        <div class="panel-body" >
          <form id="formDespesa" class="form-horizontal" role="form">
          
            <div class="form-group">
              <div class="col-md-4">
                <label for="nomeDespesa">Descrição da despesa*</label>
                <input id="txbDescricaoDespesa" type="text" class="form-control" name="txbDescricaoDespesa" placeholder="Descrição da despesa" maxlength="40"></input>
              </div>
            </div>
            <div class="form-group">
              <div class="col-md-4">
                <label for="nomeDespesa">Valor unitário*</label>
                <input id="txbValorUnitario" type="text" class="form-control" name="txbValorUnitario" placeholder="Valor unitário" maxlength="8"></input>
              </div>
            </div>
           

            <!-- BOTÕES -->
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

      <!-- Tabela da consulta -->
      <div class="panel panel-default" style="overflow-y: scroll; height:200px !important;">
        <table class="table table-hover table-condensed table-striped table-bordered">
          <thead>
            <tr>
              <th>
                Código da Despesa
              </th>
              <th>
                Descrição da Despesa
              </th>
              <th>
                Valor Unitário
              </th>
            </tr>
          </thead>
          <tbody id="grdDespesa"></tbody>
        </table>
      </div>
      <hr/>

    </div>
  </body>
</html>
