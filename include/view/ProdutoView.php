<!DOCTYPE html>
<html>
  <head>
    <title>PROJETO RAT</title>
    <meta charset="utf-8">
    <script src="../../lib/jquery/jquery.min.js"></script>
    <script type="text/javascript" src="../../js/geral.js"></script>
    <script type="text/javascript" src="../../js/alerta.js"></script>
    <link rel="stylesheet" href="../../lib/bootstrap/css/bootstrap.min.css">
    <link href="../../css/alerta.css" rel="stylesheet" media="screen" />
  </head>
  <body>
    <div class="container-fluid">
      <div class="panel panel-default">
        <div class="panel-heading">
            <div class="panel-title">Cadastro de Produto</div>
        </div>
        <div class="panel-body" >
          <form id="formDespesa" class="form-horizontal" role="form">
          <fieldset>
              <div class="form-group">
                <div class="col-md-4">
                  <label for="nomeDespesa">Descrição do Produto*</label>
                  <input id="txbNomeDespesa" type="text" class="form-control" name="txbNomeDespesa" placeholder="Descrição do Produto" maxlength="40"></input>
                </div>
              </div>
            </fieldset>

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
