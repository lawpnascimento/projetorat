<!DOCTYPE html>
<html>
  <head>
    <title>PROJETO RAT</title>
    <meta charset="utf-8">
    <script type="text/javascript" src="../../lib/jquery/jquery.min.js"></script>
    <script type="text/javascript" src="../../lib/jquery/jquery.mask.js"></script>
    <script type="text/javascript" src="../../js/geral.js"></script>
    <link rel="stylesheet" href="../../lib/bootstrap/css/bootstrap.min.css">
    <script type="text/javascript" src="../../js/alerta.js"></script>
    <script type="text/javascript" src="../../js/despesa.js"></script>
    <link href="../../css/alerta.css" rel="stylesheet" media="screen" />
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
    </div>
  </body>
</html>
