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
            <li><a href="#tabDespesas" data-toggle="tab" onclick="buscaDescricaoDespesa(false);">Despesas</a></li>
            <li><a href="#tabLancar" data-toggle="tab">Lançar</a></li>
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
                <form id="formGeral" class="form-horizontal" role="form">
                  <div class="col-md-2">
                    <label for="cliente">Cliente*</label>
                    <input id="txbCliente" type="text" class="form-control" name="txbCliente" placeholder="Nome do Cliente"></input>
                  </div>
                  <div class="col-md-2">
                    <label for="responsavel">Responsavel*</label>
                    <input id="txbResponsavel" type="text" class="form-control" name="txbResponsavel" placeholder="Nome do Responsável"></input>
                  </div>
                  <div class="col-md-2">
                    <label for="projeto">Projeto*</label>
                    <input id="txbProjeto" type="text" class="form-control" name="txbProjeto" placeholder="Nome do Projeto"></input>
                  </div>
                  <div class="col-md-2">
                    <label for="produto">Produto*</label>
                    <input id="txbProduto" type="text" class="form-control" name="txbProduto" placeholder="Nome do Produto"></input>
                  </div>
                  <div class="col-md-2">
                    <label for="datarat">Data RAT*</label>
                    <input id="txbDataRAT" type="date" class="form-control" name="txbDataRAT"></input>
                  </div>
                  <!--Botão para limpar formúlario da tela geral style="display:none;"-->
                  <button id="btnCancelar" type="button" class="btn btn-warning">Cancelar</button>
                </form>
            </div>
          </div>
          <!-- TELA ATIVIDADES -->
          <div class="tab-pane" id="tabAtividades">
            <div id="tableAtividade" class="table-editable">
            <span id="addAtividade" class="table-add glyphicon glyphicon-plus"></span>
            <table id="tbAtividades" class="table table-condensed table-hover table-bordered">
              <thead>
                <tr class="notselect">
                  <th class="col-sm-1">Data Ati.</th>
                  <th class="col-sm-1">Hora Inicial</th>
                  <th class="col-sm-1">Hora Final</th>
                  <th class="col-sm-1">Total Horas</th>
                  <th>Descrição das Atividades</th>
                  <th class="col-sm-1">Faturar Ati.</th>
                  <th class="col-sm-1"></th>
                </tr>
              </thead>
              <tbody id="tbodyAtividades">
                <tr class="fix">
                  <td id="tdDataAtividade" contenteditable="true" class="tdData"></td>
                  <td id="tdHoraInicial" contenteditable="true" name="tdHrInicial" class="tdHora"></td>
                  <td id="tdHoraFinal" contenteditable="true" name="tdHrFinal" class="tdHora"></td>
                  <td id="tdHoraTotal" bgcolor="#EBEBE4" contenteditable="false" name="tdHrTotal" readonly></td>
                  <td id="tdDescricaoAtividade" contenteditable="true" onkeypress="return (this.innerText.length <= 200)"></td>
                  <td id="tdFatAtividade" class="checkbox col-sm-1"><label><input type="checkbox" value="1">Faturar</label></td>
                  <td id="tdButtonsAtividade">
                    <span class="table-up glyphicon glyphicon-arrow-up"></span>
                    <span class="table-down glyphicon glyphicon-arrow-down"></span>
                  </td>
                </tr>
                <!-- Linha que será adicionada -->
                <tr class="hide">
                  <td id="tdDataAtividade" contenteditable="true" class="tdData"></td>
                  <td id="tdHoraInicial" contenteditable="true" name="tdHrInicial" class="tdHora"></td>
                  <td id="tdHoraFinal" contenteditable="true" name="tdHrFinal" class="tdHora"></td>
                  <td id="tdHoraTotal" bgcolor="#EBEBE4" contenteditable="false" name="tdHrTotal"></td>
                  <td id="tdDescricaoAtividade" contenteditable="true" onkeypress="return (this.innerText.length <= 200)"></td>
                  <td id="tdFatAtividade" class="checkbox col-sm-1"><label><input type="checkbox" value="1">Faturar</label></td>
                  <td id="tdButtonsAtividade">
                    <span class="table-up glyphicon glyphicon-arrow-up"></span>
                    <span class="table-down glyphicon glyphicon-arrow-down"></span>
                    <span class="table-remove glyphicon glyphicon-remove"></span>
                  </td>
                </tr>
              </tbody>
            </table>
                <button id="btnExportarAtividade" class="btn btn-primary">Export Data</button>
                <p id="msgExportarAtividade"></p>
            </div>
          </div>
          <!-- TELA DESPESA -->
          <div class="tab-pane" id="tabDespesas">
              <div id="tableDespesa" class="table-editable">
                <span id="addDespesa" class="table-add glyphicon glyphicon-plus" onclick="buscaDescricaoDespesa(true);"></span>
                <table class="table table-condensed table-hover table-bordered" id="tbDespesa">
                  <thead>
                    <tr class="notselect">
                      <th class="col-sm-1">Data Desp.</th>
                      <th class="col-sm-2">Descrição Desp.</th>
                      <th class="col-sm-2">Tipo Desp.</th>
                      <th class="col-sm-1">Valor Unitário</th>
                      <th class="col-sm-1">Quantidade</th>
                      <th class="col-sm-1">Total</th>
                      <th class="col-sm-1">Faturamento</th>
                      <th class="col-sm-2">Observações</th>
                      <th class="col-sm-1"></th>
                    </tr>
                  </thead>
                  <tbody id="tbodyDespesas">
                  <tr class="fix">
                    <td id="tdDataDespesa" contenteditable="true" class="tdData"></td>
                    <td id="tdDsDespesa" contenteditable="false">
                      <select class="selectDsDespesa" style="width:100%;" name="dsDespesa"></select>
                    </td>
                    <td id="tdTipoDespesa" bgcolor="#EBEBE4" contenteditable="false" readonly>
                      <select class="selectTipoDespesa" style="width:100%;" name="idDespesa"></select>
                    </td>
                    <td id="tdVlUni" bgcolor="#EBEBE4" contenteditable="false" readonly name="tdVlUni"></td>
                    <td id="tdQtdDespesa" contenteditable="true" name="tdQtdDespesa" class="tdNumerico"></td>
                    <td id="tdTotDespesa" bgcolor="#EBEBE4" contenteditable="false" name="totDespesa"></td>
                    <td id="tdFatDespesa" contenteditable="false">
                      <select style="width:100%;" id="cdFaturamento">
                        <option value="1"> FR </option>
                        <option value="2"> FN </option>
                        <option value="3"> NR </option>
                        <option value="4"> NN </option>
                      </select>
                    </td>
                    <td id="tdObsDespesa" contenteditable="true" onkeypress="return (this.innerText.length <= 200)"></td>
                    <td id="tdButtonsDespesa">
                      <span class="table-up glyphicon glyphicon-arrow-up"></span>
                      <span class="table-down glyphicon glyphicon-arrow-down"></span>
                    </td>
                  </tr>
                  <!-- Linha que será adicionada -->
                  <tr class="hide" >
                    <td id="tdDataDespesa" contenteditable="true" class="tdData"></td>
                    <td id="tdDsDespesa">
                      <select class="selectDsDespesa" style="width:100%;" name="dsDespesa"></select>
                    </td>
                    <td id="tdTipoDespesa" bgcolor="#EBEBE4" contenteditable="false" readonly>
                      <select class="selectTipoDespesa" style="width:100%;" name="idDespesa"></select>
                    </td>
                    <td id="tdVlUni" bgcolor="#EBEBE4" contenteditable="false" readonly name="tdVlUni"></td>
                    <td id="tdQtdDespesa" contenteditable="true" name="tdQtdDespesa" class="tdNumerico"></td>
                    <td id="tdTotDespesa" bgcolor="#EBEBE4" contenteditable="false" name="totDespesa"></td>
                    <td id="tdFatDespesa">
                      <select style="width:100%;" id="cdFaturamento">
                        <option value="1"> FR </option>
                        <option value="2"> FN </option>
                        <option value="3"> NR </option>
                        <option value="4"> NN </option>
                      </select>
                    </td>
                    <td id="tdObsDespesa" contenteditable="true" onkeypress="return (this.innerText.length <= 200)"></td>
                    <td id="tdButtonsDespesa">
                      <span class="table-up glyphicon glyphicon-arrow-up"></span>
                      <span class="table-down glyphicon glyphicon-arrow-down"></span>
                      <span class="table-remove glyphicon glyphicon-remove"></span>
                    </td>
                  </tr>
                </tbody>
                </table>
                <button id="btnExportarDespesa" class="btn btn-primary">Export Data</button>
                <p id="msgExportarDespesa"></p>
              </div>
              <input type="hidden" id="hidVlUni"></input>
          </div>

            <!-- TELA LANCAR -->
            <div class="tab-pane" id="tabLancar">
              <div id="actions" class="row">
                <div class="col-md-12">
                  <button id="btnLancarRAT" type="button" class="btn btn-success">Lançar RAT</button>
                </div>
              </div>
           </div>
    
</body>
</html>
