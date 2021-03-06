<!DOCTYPE html>
<html>
<head>
    <title>PROJETO RAT</title>
    <meta charset="utf-8">
    <script type="text/javascript" src="../../js/alerta.js"></script>
    <script type="text/javascript" src="../../js/perfil.js"></script>
</head>
<body>
    <div class="container-fluid">
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="panel-title">Perfil</div>
            </div>
            <div class="panel-body" >
                <form id="formPerfil" class="form-horizontal" role="form">
                    <input type="hidden" id="hidCodUsu"></input>
                    <div class="form-group">
                        <label for="txbNome" class="col-md-1 control-label">Nome</label>
                        <div class="col-md-4">
                            <input id="txbNome" type="text" class="form-control" name="txbNome" placeholder="Nome" maxlength="50">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="txbSobrenome" class="col-md-1 control-label">Sobrenome</label>
                        <div class="col-md-4">
                            <input id="txbSobrenome" type="text" class="form-control" name="txbSobrenome" placeholder="Sobrenome" maxlength="100">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="txbSenha" class="col-md-1 control-label">Senha</label>
                        <div class="col-md-4">
                            <input id="txbSenha" type="password" class="form-control" name="txbSenha" placeholder="Senha" maxlength="50">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="txbSenhaConfirma" class="col-md-1 control-label">Confirmar</label>
                        <div class="col-md-4">
                            <input id="txbSenhaConfirma" type="password" class="form-control" name="txbSenhaConfirma" placeholder="Confirmar senha" maxlength="50">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="txbEmail" class="col-md-1 control-label">E-mail</label>
                        <div class="col-md-4">
                            <input id="txbEmail" type="text" class="form-control" name="txbEmail" placeholder="E-mail" maxlength="50">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="txbPapel" class="col-md-1 control-label">Papel</label>
                        <div class="col-md-4">
                            <input id="txbPapel" type="text" class="form-control" name="txbPapel" readonly>
                        </div>
                    </div>
                    <div id="actions" class="row">
                      <div class="col-md-12">
                        <button id="btnAtualizar" type="button" class="btn btn-primary">Atualizar</button>
                        <button id="btnCancelar" type="button" class="btn btn-warning">Cancelar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>

