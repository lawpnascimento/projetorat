<?php
session_start();
require_once("../../estrutura/iniciar_sessao.php");
?>
<!DOCTYPE html>
<html>
  <head>
    <title>PROJETO RAT</title>
    <meta charset="utf-8">
    <script type="text/javascript" src="../../lib/jquery/jquery-ui.min.js"></script>
    <script type="text/javascript" src="../../js/rat.js"></script>
    <script type="text/javascript" src="../../js/alerta.js"></script>
    <link rel="stylesheet" href="../../css/alerta.css">
    <link rel="stylesheet" href="../../css/rat.css">
    <link rel="stylesheet" href="../../css/editableTable.css">
    <link rel="stylesheet" href="../../lib/jquery/jquery-ui.css">
  </head>
    <body>
      <div class="container-fluid">
        <div class="panel panel-default">
          <div class="panel-heading">
            <div class="panel-title">Lançar RAT</div>
          </div>

          <div id="content" align="left">
          <ul id="tabs" class="nav nav-pills nav-justified" data-tabs="tabs">
            <li class="active"><a href="#tabGeral" data-toggle="tab">Geral</a></li>
            <li><a href="#tabAtividades" data-toggle="tab">Atividades</a></li>
            <li><a href="#tabDespesas" data-toggle="tab">Despesas</a></li>
            <li><a href="#tabLancar" data-toggle="tab">Lançar</a></li>
            <li><a href="#blue" data-toggle="tab">Blue</a></li>
          </ul>
          </div>

          <!-- TELA GERAL -->
          <div class="tab-content">
            <div class="tab-pane active" id="tabGeral">
             <div class="panel-body">
                <div class="col-md-2">
                  <label for="usuario">Usuario*</label>
                  <input id="txbUsuario" type="text" class="form-control" name="txbUsuario" value="<?php echo ucfirst($_SESSION["nomUsu"]) ?>" readonly ></input>
                </div>
                <div class="col-md-2">
                  <label for="cliente">Cliente*</label>
                  <input id="txbCliente" type="text" class="form-control" name="txbCliente" placeholder="Nome do Cliente"></input>
                </div>
                <div class="col-md-2">
                  <label for="responsavel">Responsavel*</label>
                  <input id="txbResponsavel" type="text" class="form-control" name="txbResponsavel" placeholder="Nome do Reponsável"></input>
                </div>
                <div class="col-md-2">
                  <label for="projeto">Projeto*</label>
                  <input id="txbProjeto" type="text" class="form-control" name="txbProjeto" placeholder="Nome do Projeto"></input>
                </div>
              </div>
            </div>
          <!-- TELA ATIVIDADES -->
          <div class="tab-pane" id="tabAtividades">
            <div id="tableAtividade" class="table-editable">
            <span id="addAtividade" class="table-add glyphicon glyphicon-plus"></span>
            <table id="tbAtividades" class="table table-condensed table-hover table-bordered">
              <tr class="notselect">
                <th class="col-sm-1">Data Atividade</th>
                <th class="col-sm-1">Hora Inicial</th>
                <th class="col-sm-1">Hora Final</th>
                <th>Descrição das Atividades</th>
                <th class="col-sm-1">Faturar Atividade</th>
                <th class="col-sm-1"></th>
              </tr>
              <tr>
                <td id="tdDataDaAtividade" contenteditable="true" class="col-sm-1"></td>
                <td id="tdHoraInicial" contenteditable="true" class="col-sm-1"></td>
                <td id="tdHoraFinal" contenteditable="true" onkeypress="return (this.innerText.length <= 4)" class="col-sm-1"></td>
                <td id="tdDescricaoAtividades" contenteditable="true" onkeypress="return (this.innerText.length <= 1000)"></td>
                <td class="checkbox col-sm-1"><label><input type="checkbox" value="">Faturar</label></td>
                <td class="col-sm-1">
                  <span class="table-up glyphicon glyphicon-arrow-up"></span>
                  <span class="table-down glyphicon glyphicon-arrow-down"></span>
                  <span class="table-remove glyphicon glyphicon-remove"></span>
                </td>
              </tr>
              <!-- Linha que será adicionada -->
              <tr class="hide">
                <td contenteditable="true" onkeypress="return (this.innerText.length <= 9)"></td>
                <td contenteditable="true" class="col-sm-1"></td>
                <td contenteditable="true"></td>
                <td contenteditable="true"></td>
                <td class="checkbox col-sm-1"><label><input type="checkbox" value="">Faturar</label></td>
                <td class="col-sm-1">
                  <span class="table-up glyphicon glyphicon-arrow-up"></span>
                  <span class="table-down glyphicon glyphicon-arrow-down"></span>
                  <span class="table-remove glyphicon glyphicon-remove"></span>
                </td>
              </tr>
            </table>
                <button id="btnExportarAtividade" class="btn btn-primary">Export Data</button>
                <p id="msgExportarAtividade"></p>
          </div>
          </div>
          <!-- TELA DESPESA -->
          <div class="tab-pane" id="tabDespesas">
              <div id="tableDespesa" class="table-editable">
                <span id="addDespesa" class="table-add glyphicon glyphicon-plus"></span>
                <table class="table table-condensed table-hover table-bordered">
                  <tr class="notselect">
                    <th class="col-sm-1">Data Despesa</th>
                    <th class="col-sm-1">Código</th>
                    <th class="col-sm-2">Tipo da Despesa</th>
                    <th class="col-sm-1">Valor Unitário</th>
                    <th class="col-sm-1">Quantidade</th>
                    <th class="col-sm-1">Total</th>
                    <th>Observações</th>
                    <th class="col-sm-1"></th>
                  </tr>
                  <tr>
                    <td contenteditable="true" class="col-sm-1" onkeypress="return (this.innerText.length <= 9)"></td>
                    <td contenteditable="true" class="col-sm-1"></td>
                    <td contenteditable="true" class="col-sm-2"></td>
                    <td contenteditable="true" class="col-sm-1"></td>
                    <td contenteditable="true" class="col-sm-1"></td>
                    <td contenteditable="true" class="col-sm-1"></td>
                    <td contenteditable="true"></td>
                    <td class="col-sm-1">
                      <span class="table-up glyphicon glyphicon-arrow-up"></span>
                      <span class="table-down glyphicon glyphicon-arrow-down"></span>
                      <span class="table-remove glyphicon glyphicon-remove"></span>
                    </td>
                  </tr>
                  <!-- Linha que será adicionada -->
                  <tr class="hide" >
                    <td contenteditable="true" onkeypress="return (this.innerText.length <= 9)"></td>
                    <td contenteditable="true"></td>
                    <td contenteditable="true"></td>
                    <td contenteditable="true"></td>
                    <td contenteditable="true"></td>
                    <td contenteditable="true"></td>
                    <td contenteditable="true"></td>
                    <td class="col-sm-1">
                      <span class="table-up glyphicon glyphicon-arrow-up"></span>
                      <span class="table-down glyphicon glyphicon-arrow-down"></span>
                      <span class="table-remove glyphicon glyphicon-remove"></span>
                    </td>
                  </tr>
                </table>
                <button id="btnExportarDespesa" class="btn btn-primary">Export Data</button>
                <p id="msgExportarDespesa"></p>
              </div>
          </div>

            <!-- TELA LANCAR -->
            <div class="tab-pane" id="tabLancar">
              <button id="btnLancarRAT" type="button" class="btn btn-success">Lançar RAT</button>
            </div>
            <!-- TELA -->
            <div class="tab-pane" id="blue">
              <h1>Blue</h1>
              <p>blue blue blue blue blue</p>
            </div>
          </div>
        </div>
    </div>

</body>
</html>
