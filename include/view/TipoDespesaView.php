<!DOCTYPE html>
<html>
  <head>
    <title>PROJETO RAT</title>
    <meta charset="utf-8">
    <script type="text/javascript" src="../../js/alerta.js"></script>
    <script type="text/javascript" src="../../js/tipodespesa.js"></script>
  </head>
  <body>
    <div class="container-fluid">
      <div class="panel panel-default">
        <div class="panel-heading">
            <div class="panel-title">Cadastro de Tipo de Despesa</div>
        </div>
        <div class="panel-body" >
          <form id="formTipoDespesa" class="form-horizontal" role="form">
          <input type="hidden" id="hidCodTipDsp"></input>
            <div class="form-group">
              <div class="col-md-4">
                <label for="nomeTipoDespesa">Descrição do Tipo da Despesa*</label>
                <input id="txbDescricaoTipoDespesa" type="text" class="form-control" name="txbDescricaoTipoDespesa" maxlength="100"></input>
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
                Código do Tipo da Despesa
              </th>
              <th>
                Descrição do Tipo da Despesa
              </th>
            </tr>
          </thead>
          <tbody id="grdTipoDespesa"></tbody>
        </table>
      </div>
      <hr/>

    </div>
  </body>
</html>
