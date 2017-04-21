<!DOCTYPE html>
<html>
  <head>
    <title>PROJETO RAT</title>
    <meta charset="utf-8">
    <script type="text/javascript" src="../../js/rat.js"></script>
    <script type="text/javascript" src="../../js/alerta.js"></script>
    <link rel="stylesheet" href="../../css/alerta.css">
    <link rel="stylesheet" href="../../css/rat.css">
  </head>
    <body>
      <div class="container-fluid">
        <div class="panel panel-default">
          <div class="panel-heading">
                Lançamento de RAT
          </div>
          <div class="container">

          <div id="content" align="left">
          <ul id="tabs" class="nav nav-pills nav-justified" data-tabs="tabs">
            <li class="active"><a href="#geral" data-toggle="tab">Geral</a></li>
            <li><a href="#atividades" data-toggle="tab">Atividades</a></li>
            <li><a href="#despesas" data-toggle="tab">Despesas</a></li>
            <li><a href="#lancar" data-toggle="tab">Lançar</a></li>
            <li><a href="#blue" data-toggle="tab">Blue</a></li>
          </ul>
          <div id="my-tab-content" class="tab-content">
            <div class="tab-pane active" id="geral">
            <fieldset>
              <legend class="scheduler-border">Geral</legend>
              <div class="form-group">
                <div class="col-md-4">
                  <label for="codigoRAT">Código do RAT*</label>
                  <input id="txbCodigoRAT" type="text" class="form-control" name="txbCodigoRAT"></input>
                </div>
                <div class="col-md-4">
                  <label for="consultor">Consultor*</label>
                  <input id="txbConsultor" type="text" class="form-control" name="txbConsultor" placeholder="Nome do Consultor"></input>
                </div>
              <div class="form-group">
                <div class="col-md-4">
                  <label for="cliente">Cliente*</label>
                  <input id="txbCliente" type="text" class="form-control" name="txbCliente" placeholder="Nome do Cliente"></input>
                </div>
                <div class="col-md-4">
                  <label for="inscricao">Responsavel*</label>
                  <input id="txbResponsavel" type="text" class="form-control" name="txbResponsavel" placeholder="Nome do Reponsável"></input>
                </div>
              </div>
            </fieldset>
            </div>
            <div class="tab-pane" id="atividades">
                <legend class="scheduler-border">Atividades</legend>
                <div class="form-group">
                <div class="col-md-2">
                  <label for="dataAtividade">Data da atividade</label>
                  <input id="txbDataAtividade" type="date" class="form-control" name="txbDataAtividade"></input>
                </div>
                <div class="col-md-2">
                  <label for="horaInicial">Hora Inicial</label>
                  <input id="txbHoraInicial" class="form-control" name="txbHoraInicial" maxlength="5"></input>
                </div>
                <div class="col-md-2">
                  <label for="horaFinal">Hora Final</label>
                  <input id="txbHoraFinal" class="form-control" name="txbHoraFinal" maxlength="5"></input>
                </div>
                </div>
                <br />
                <div class="col-md-4">
                  <label id="txbDescricaoAtividades" for="descricaoAtividades">Descrição das atividades</label>
                  <textarea rows="10" cols="50" placeholder="Descrição das atividades"> </textarea>
                </div>
                  <div class="col-md-2">
                  <button id="btnAdicionarRAT" type="button" class="btn btn-success">Adicionar atividade</button>
                  <button id="btnAlterarRAT" type="button" class="btn btn-primary">Alterar atividade</button>
                  <button id="btnExcluirRAT" type="button" class="btn btn-danger">Excluir atividade</button>
                </div>
            </div>
            <div class="tab-pane" id="despesas">
               <legend class="scheduler-border">Despesas</legend>
               <div class="col-md-2">
                  <label for="dataDespesa">Data da Despesa</label>
                  <input id="txbDataDespesa" type="date" class="form-control" name="txbDataDespesa"></input>
                </div>
                <div class="form-group">
                    <div class="col-md-3">
                    <!-- COMBO BOX DESPESA -->
                        <label for="tipodespesa">Tipo da Despesa</label>
                        <div class="dropdown">
                            <button class="btn btn-default dropdown-toggle form-control" type="button" id="cbbDespesa" data-toggle="dropdown" aria-expanded="false" name="Despesa">
                                Despesa
                                <span class="caret"></span>
                            </button>
                            <ul id="ulDespesa" class="dropdown-menu" role="menu" aria-labelledby="cbbDespesa">
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-md-2">
                  <button id="btnAdicionarDespesa" type="button" class="btn btn-success">Adicionar despesa</button>
                  <button id="btnAlterarDespesa" type="button" class="btn btn-primary">Alterar despesa</button>
                  <button id="btnExcluirDespesa" type="button" class="btn btn-danger">Excluir despesa</button>
                </div>

            </div>
            <div class="tab-pane" id="lancar">
                <legend class="scheduler-border">Resumo do RAT</legend>
                 <div class="col-md-3">
                   <ul>
                     <li id="LabelResumoCliente">Cliente: </li>
                     <li>Responsável:</li>
                   </ul>
                 </div>
                 <br /><br /><br />
                  <div class="col-md-3">
                  <p>Confirma lançamento do RAT?</p>
                     <button id="btnLancarRAT" type="button" class="btn btn-success">Lançar RAT</button>
                  </div>
            </div>
            <div class="tab-pane" id="blue">
                <h1>Blue</h1>
                <p>blue blue blue blue blue</p>
            </div>
          </div>
          </div>

          </div>
          </div>
       
       </div>

</body>
</html>