<!DOCTYPE html>
<html>
  <head>
    <title>Faturamento</title>
    <meta charset="utf-8">
    <script type="text/javascript" src="../../js/geral.js"></script>
    <script type="text/javascript" src="../../js/alerta.js"></script>
    <script type="text/javascript" src="../../js/faturamento.js"></script>
    <link rel="stylesheet" href="../../css/tabela.css">
  </head>
  <body>
    <div class="container-fluid">
      <div class="panel panel-default">
        <div class="panel-heading">
          <div class="panel-title">Faturamento</div>
        </div>
        <div class="panel-body">
          <form id="formFaturamento" class="form-horizontal" role="form">
            <legend class="scheduler-border">Busca</legend>
              <div class="form-group">
                <div class="col-md-2">
                  <label for="txbDatIni">Data Inicial</label>
                  <input id="txbDatIni" type="date" class="form-control" name="txbDatIni"></input>
                </div>
                <div class="col-md-2">
                  <label for="txbDatFin">Data Final</label>
                  <input id="txbDatFin" type="date" class="form-control" name="txbDatFin"></input>
                </div>
                <div class="col-md-2">
                  <label for="nomUsu">Usuário</label>
                  <input id="txbNomUsu" type="text" class="form-control" name="txbNomUsu" maxlength="50" placeholder="Nome do usuario"></input>
                </div>
                <div class="col-md-2">
                  <label for="nomCli">Cliente</label>
                  <input id="txbNomCli" type="text" class="form-control" name="txbNomCli" placeholder="Nome do cliente"></input>
                </div>
                <div class="col-md-2">
                  <label for="nomPrj">Projeto</label>
                  <input id="txbNomPrj" type="text" class="form-control" name="txbNomPrj" placeholder="Nome do projeto"></input>
                </div>
              </div>
              <!-- BOTÕES -->
              <div id="actions" class="row">
                  <div class="col-md-12">
                    <button id="btnBuscar" type="button" class="btn btn-info">Buscar</button>
                    <button id="btnCancelar" type="button" class="btn btn-warning">Cancelar</button>
                  </div>
              </div>
              <br />
              <legend class="scheduler-border">Processar</legend>
                <div class="form-group">
                  <div class="col-md-2">
                    <label for="txbDatFec">Data Fechamento</label>
                    <input id="txbDatFec" type="date" class="form-control" name="txbDatFec"></input>
                  </div>
                </div>
              <!-- BOTÕES -->
              <div id="actions" class="row">
                <div class="col-md-12">
                  <button id="btnProcessar" type="button" class="btn btn-success">Processar</button>
                </div>
              </div>
          </form>
      </div>
    </div>

        <legend class="scheduler-border">RAT a serem faturados</legend>
        <div class="panel panel-default" style="overflow-y: scroll; height:100px !important;">
              <!-- Tabela da consulta -->
              <table id="tableFatRAT" class="table table-condensed table-bordered">
                <thead>
                  <tr>
                    <th>
                      Código
                    </th>
                    <th>
                      Usuário
                    </th>
                    <th>
                      Data
                    </th>
                    <th>
                      % Com. Cli.
                    </th>
                    <th>
                      % Com. Int.
                    </th>
                    <th>
                      Cliente
                    </th>
                    <th>
                      Responsável
                    </th>
                    <th>
                      Projeto
                    </th>
                    <th>
                      Vlr. Hor. Com.
                    </th>
                    <th>
                      Vlr. Hor. Fat.
                    </th>
                    <th>
                      Produto
                    </th>
                    <th>
                      Situação
                    </th>
                  </tr>
                </thead>
                <tbody id="grdFatRAT"></tbody>
              </table>
        </div>

        <legend class="scheduler-border">Atividades</legend>
        <div class="panel panel-default" style="overflow-y: scroll; height:200px !important;">
          <table id="tableFatAtividade" class="table table-condensed table-bordered">
            <thead>
              <tr>
                <th class="col-sm-1">
                  Código Ati.
                </th>
                <th class="col-sm-1">
                  Horas Faturar
                </th>
                <!--<th class="col-sm-1">
                  Horas Não Faturar
                </th>-->
                <th class="col-sm-1">
                  Total Faturar
                </th>
                <th class="col-sm-1">
                  Base P/ Cálculo Comissão
                </th>
                <th class="col-sm-1">
                  Comissão
                </th>
                <th class="col-sm-1">
                  Valor Líquido
                </th>
              </tr>
            </thead>
            <tbody id="grdFatAtividade"></tbody>
            <tfoot id="footFatAtividade"></tfoot>
          </table>
        </div>

        <legend class="scheduler-border">Despesas</legend>
        <div class="panel panel-default" style="overflow-y: scroll; height:200px !important;">
          <table id="tableConsultaDespesa" class="table table-condensed table-bordered">
            <thead>
              <tr>
                <th class="col-sm-1">
                  Código Desp.
                </th>
                <th class="col-sm-1">
                  Data
                </th>
                <th class="col-sm-2">
                  Descrição
                </th>
                <th class="col-sm-2">
                  Tip. Desp.
                </th>
                <th class="col-sm-1">
                  Valor Unitário
                </th>
                <th class="col-sm-1">
                  Quantidade
                </th>
                <th class="col-sm-1">
                  Total
                </th>
                <th>
                  Observações
                </th>
                <th class="col-sm-1">
                  Tip. Fat.
                </th>
              </tr>
            </thead>
                <tbody id="grdFatDespesa"></tbody>
                <tfoot>
                  <tr id="footFatDespesaFat">
                  </tr>
                  <tr id="footFatDespesaRem">
                  </tr>    
                </tfoot>
          </table>
        </div>

  </body>
</html>
