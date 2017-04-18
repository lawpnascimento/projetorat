<!DOCTYPE html>
<html>
  <head>
    <title>Usuários</title>
    <meta charset="utf-8">
    <script type="text/javascript" src="../../js/usuario.js"></script>
    <script type="text/javascript" src="../../js/geral.js"></script>
    <link rel="stylesheet" href="../../lib/bootstrap/css/bootstrap.min.css">
    <script type="text/javascript" src="../../js/alerta.js"></script>
    <link href="../../css/alerta.css" rel="stylesheet" media="screen" />
  </head>
  <body>
    <div class="container-fluid">
      <div class="panel panel-default">
        <div class="panel-heading">
            <div class="panel-title">Cadastro de Usuários</div>
        </div>
        <div class="panel-body" >
          <form id="formUsuario" class="form-horizontal" role="form">
            <input type="hidden" id="hidCodUsu"></input>
            <div class="form-group">
              <div class="col-md-4">
                <label for="nomUsu">Usuário</label>
                <input id="txbNomUsu" type="text" class="form-control" name="txbNomUsu" placeholder="Usuário" maxlength="50"></input>
              </div>
            </div>
            <div class="form-group">
              <div class="col-md-4">
                <label for="email">Senha</label>
                <input id="txbSenUsu" type="text" class="form-control" name="txbSenUsu" placeholder="Endereco de e-mail" maxlength="50"></input>
              </div>
            </div>
            <div class="form-group">
              <div class="col-md-4">
                <label for="email">E-mail*</label>
                <input id="txbDesEml" type="text" class="form-control" name="txbDesEml" placeholder="Endereco de e-mail" maxlength="50"></input>
              </div>
            </div>
            <!--Combo box-->
            <div class="form-group">
              <div class="col-md-2">
                <label for="perfil">Perfil</label>
                <div class="dropdown">
                  <button class="btn btn-default dropdown-toggle form-control" type="button" id="cbbPerfil" data-toggle="dropdown" aria-expanded="false" name="Perfil">
                      Perfil
                      <span class="caret"></span>
                  </button>
                  <ul id="ulPerfil" class="dropdown-menu" role="menu" aria-labelledby="cbbPerfil">
                  </ul>
                </div>
              </div>
              <div class="col-md-2">
                <label for="perfil">Situação</label>
                <div class="dropdown">
                  <button class="btn btn-default dropdown-toggle form-control" type="button" id="cbbSituacao" data-toggle="dropdown" aria-expanded="false" name="Situacao">
                      Situação
                      <span class="caret"></span>
                  </button>
                  <ul id="ulSituacao" class="dropdown-menu" role="menu" aria-labelledby="cbbSituacao">
                    <li role="presentation" value="1"><a role="menuitem" tabindex="-1" href="#">Ativo</a></li>
                    <li role="presentation" value="0"><a role="menuitem" tabindex="-1" href="#">Inátivo</a></li>
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
                Usuário
              </th>

              <th>
                E-mail
              </th>
              <th>
                Perfil
              </th>
              <th>
                Situação
              </th>
            </tr>
          </thead>
          <tbody id="grdUsuario"></tbody>
        </table>
      </div>
    </div>
  </body>
</html>