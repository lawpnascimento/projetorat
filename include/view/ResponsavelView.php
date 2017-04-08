<!DOCTYPE html>
<html>
  <head>
    <title>PROJETO RAT</title>
    <meta charset="utf-8">
    <script type="text/javascript" src="../../js/responsavel.js"></script>
    <script type="text/javascript" src="../../js/geral.js"></script>
    <link rel="stylesheet" href="../../lib/bootstrap/css/bootstrap.min.css">
    <script type="text/javascript" src="../../js/alerta.js"></script>
    <link href="../../css/alerta.css" rel="stylesheet" media="screen" />
  </head>
  <body>
    <div class="container-fluid">
      <div class="panel panel-default">
        <div class="panel-heading">
            <div class="panel-title">Cadastro de Responsavel</div>
        </div>
        <div class="panel-body" >
          <form id="formResponsavel" class="form-horizontal" role="form">
            <input type="hidden" id="hidCodRes">
            <fieldset>
              <div class="form-group">
                <div class="col-md-4">
                  <label for="nomRes">Nome do Responsavel*</label>
                  <input id="txbNomRes" type="text" class="form-control" name="txbNomRes" placeholder="Nome do Responsavel" maxlength="40"></input>
                </div>
              </div>
              <div class="form-group">
                <div class="col-md-4">
                  <label for="email">E-mail*</label>
                  <input id="txbEmail" type="text" class="form-control" name="txbEmail" placeholder="Endereco de e-mail" maxlength="40"></input>
                </div>
              </div>
            </fieldset>
            <!--Combo box-->
                <div class="form-group">
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
                </div>

            <br />
            <br />
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
      <div class="panel panel-default" style="overflow-y: scroll; height:200px !important;">
        <!-- Tabela da consulta -->
        <table class="table">
          <thead>
            <tr>
              <th>
                Cliente
              </th>
              <th>
                Responsável
              </th>
              <th>
                E-mail
              </th>
            </tr>
          </thead>
          <tbody id="grdResponsavel"></tbody>
        </table>
      </div>
    </div>
  </body>
</html>
