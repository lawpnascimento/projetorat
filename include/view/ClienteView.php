<!DOCTYPE html>
<html>
  <head>
    <title>PROJETO RAT</title>
    <meta charset="utf-8">
    <script type="text/javascript" src="../../lib/jquery/jquery-ui.min.js"></script>
    <script type="text/javascript" src="../../js/cliente.js"></script>
    <link rel="stylesheet" href="../../lib/jquery/jquery-ui.css">
  </head>
  <body>
    <div class="container-fluid">
      <div class="panel panel-default">
        <div class="panel-heading">
            <div class="panel-title">Cadastro de Cliente</div>
        </div>
        <div class="panel-body" >
          <form id="formCliente" class="form-horizontal" role="form">
            <input type="hidden" id="hidCodCli"></input>
            <fieldset>
              <legend class="scheduler-border">Empresa</legend>
              <div class="form-group">
                <div class="col-md-4">
                  <label for="razaoSocial">Razão Social*</label>
                  <input id="txbRazaoSocial" type="text" class="form-control" name="txbRazaoSocial" placeholder="Razão Social" maxlength="100"></input>
                </div>
                <div class="col-md-4">
                  <label for="nomeFantasia">Nome Fantasia*</label>
                  <input id="txbNomeFantasia" type="text" class="form-control" name="txbNomeFantasia" placeholder="Nome Fantasia" maxlength="40"></input>
                </div>
              </div>
              <div class="form-group">
                <div class="col-md-4">
                  <label for="cnpj">CNPJ</label>
                  <input id="txbCnpj" type="text" class="form-control" name="txbCnpj" placeholder="Número do CNPJ" maxlength="14"></input>
                </div>
                <div class="col-md-4">
                  <label for="inscricao">Inscricão Estadual</label>
                  <input id="txbInscricao" type="text" class="form-control" name="txbInscricao" placeholder="Nome da Inscrição Estadual" maxlength="9"></input>
                </div>
              </div>
            </fieldset>
            <br />
            <fieldset>
              <legend class="scheduler-border">Endereço</legend>
              <div class="form-group">
                <div class="col-md-4">
                  <label for="cidade">Cidade*</label>
                  <input id="txbCidade" type="text" class="form-control" name="txbCidade" placeholder="Nome da Cidade" maxlength="50"></input>
                </div>
                <div class="col-md-4">
                  <label for="estado">Estado*</label>
                  <input readonly id="txbEstado" type="text" class="form-control" name="txbEstado" placeholder="Nome do Estado"></input>
                </div>
                <div class="col-md-4">
                  <label for="cep">CEP</label>
                  <input id="txbCep" type="text" class="form-control" name="txbCep" placeholder="CEP" maxlength="9"></input>
                </div>
               </div>
            </fieldset>
            <br />
            <fieldset>
              <legend class="scheduler-border">Contato</legend>
              <div class="form-group">
                <div class="col-md-4">
                  <label for="telefone">Telefone</label>
                  <input id="txbTelefone" type="text" class="form-control" name="txbTelefone" placeholder="Telefone" maxlength="11"></input>
                </div>
              </div>
            </fieldset>
            <br />
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
                Código
              </th>
              <th>
                Razão Social
              </th>
              <th>
                Nome Fantasia
              </th>
              <th>
                CNPJ
              </th>
              <th>
                Cidade
              </th>
              <th>
                Estado
              </th>
              <th>
                Telefone
              </th>
            </tr>
          </thead>
          <tbody id="grdCliente"></tbody>
        </table>
      </div>
      <hr/>

    </div>
  </body>
</html>
