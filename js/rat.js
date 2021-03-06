//TABELA ATIVIDADE
var $tableAtividade = $('#tableAtividade');
var $tabDespesas = $('#tabDespesas');
var descricaocarregada = false;

aplicaMascaraRat();

//Campo somente numérico
validaSomenteNumerico("#tbodyDespesas", ".tdNumerico");

//Desabilita o select do tipo da despesa para cliques
$('.selectTipoDespesa').attr("disabled", true);

$("#formGeralCancelar #btnCancelar").click(function(){
  limpaCamposRAT($(this).closest("form"));
});

$('.table-remove').click(function () {
  $(this).parents('tr').not('.fix').detach();
});

$('.table-up').click(function () {
  var $row = $(this).parents('tr');
  if ($row.index() === 1) return; // Don't go above the header
  $row.prev().before($row.get(0));
});

$('.table-down').click(function () {
  var $row = $(this).parents('tr');
  $row.next().after($row.get(0));
});

$('#addAtividade').click(function () {
  var $clone = $tableAtividade.find('tr.hide').clone(true).removeClass('hide table-line');
  $tableAtividade.find('table').append($clone);
  aplicaMascaraRat();
});

//TABELA DESPESA
var $tableDespesa = $('#tableDespesa');

$('#addDespesa').click(function () {
  var $clone = $tableDespesa.find('tr.hide').clone(true).removeClass('hide table-line');
  $tableDespesa.find('table').append($clone);
  aplicaMascaraRat();
});

$("#document").ready(function(){
  var date = new Date();

  var day = date.getDate();
  var month = date.getMonth() + 1;
  var year = date.getFullYear();

  if (month < 10) month = "0" + month;
  if (day < 10) day = "0" + day;

  var inputToday = year + "-" + month + "-" + day;
  var tdToday = day + "/" + month + "/" + year;

  $("#txbDataRAT").val(inputToday);
  $(".tdData").val(tdToday);

  $("#tabLancar #btnLancarRAT").click(function () {
    var txbCliente = $("#txbCliente").val();
    var txbResponsavel = $("#txbResponsavel").val();
    var txbProjeto = $("#txbProjeto").val();
    var txbProduto = $("#txbProduto").val();
    var txbDataRAT = $("#txbDataRAT").val();

    msgErroGeral = validaCamposGeral(txbCliente, txbResponsavel, txbProjeto, txbProduto, txbDataRAT);

    if(msgErroGeral !== ""){
      jbkrAlert.alerta('Alerta!',msgErroGeral);
      return;
    }

    var $rowsAtividade = $tableAtividade.find('tr:not(.hide):not(.notselect)');
    var headersAtividade = [];
    var dataAtividade = [];

    headersAtividade.push("dtAtividade");
    headersAtividade.push("hrInicial");
    headersAtividade.push("hrFinal");
    headersAtividade.push("hrTotal");
    headersAtividade.push("dsAtividade");
    headersAtividade.push("idFaturar");

    // Turn all existing rows into a loopable array
    $rowsAtividade.each(function () {
      var $td = $(this).find('td');
      var h = {};


      // Use the headers from earlier to name our hash keys
      headersAtividade.forEach(function (header, i) {
        var $idFaturar = $td.eq(i).find('input:checkbox:first');

        if(typeof $idFaturar.val() !== "undefined") {
          if ($idFaturar.is(":checked"))
            h[header] = "1";
          else
            h[header] = "0";
        }
        else
          h[header] = $td.eq(i).text();
      });

      dataAtividade.push(h);

    });

    //Validando os campos para ver se está vazio
    for (var i = 0; i < dataAtividade.length; i++) {
      atividade = dataAtividade[i];

      var msgErroAtividade =  validaCamposAtividade(atividade.dtAtividade, atividade.hrInicial, atividade.hrFinal, atividade.hrTotal,atividade.dsAtividade);

      if(msgErroAtividade !== ""){
        jbkrAlert.alerta('Alerta!',msgErroAtividade);
        return;
      }
    }


    var $rowsDespesa = $tabDespesas.find('tr:not(.hide):not(.notselect)');
    var headersDespesa = [];
    var dataDespesa = [];

    headersDespesa.push("dtDespesa");
    headersDespesa.push("cdDespesa");
    headersDespesa.push("idDespesa");
    headersDespesa.push("vlDespesa");
    headersDespesa.push("qtDespesa");
    headersDespesa.push("totDespesa");
    headersDespesa.push("cdFaturamento");
    headersDespesa.push("dsOberservacao");

    // Turn all existing rows into a loopable array
    $rowsDespesa.each(function () {
      var $td = $(this).find('td');
      var h = {};

      // Use the headers from earlier to name our hash keys
      headersDespesa.forEach(function (header, i) {
        var $cdFaturamento = $td.eq(i).find('select#cdFaturamento');
        var $idDespesa = $td.eq(i).find("select[name='idDespesa']");
        var $cdDespesa = $td.eq(i).find("select[name='dsDespesa']");

        if($td.eq(i).text() !== ""){

          if(typeof $cdFaturamento.val() !== "undefined") {
            h[header] = $cdFaturamento.val();
          }
          else if(typeof $idDespesa.val() !== "undefined"){
            h[header] = $idDespesa.val();
          }
          else if(typeof $cdDespesa.val() !== "undefined"){
            h[header] = $cdDespesa.val();
          }
          else {
            if($td.eq(i).text() !== ""){
              h[header] = $td.eq(i).text();
            }
          }

        }
      });

      dataDespesa.push(h);

    });

    //Validando os campos para ver se está vazio
    for (var t = 0; t < dataDespesa.length; t++) {
      despesa = dataDespesa[t];

      var msgErroDespesa =  validaCamposDespesa(despesa.dtDespesa, despesa.cdDespesa, despesa.idDespesa,despesa.vlDespesa,despesa.qtDespesa,despesa.totDespesa,despesa.cdFaturamento,despesa.dsOberservacao);

      if(msgErroDespesa !== ""){
        jbkrAlert.alerta('Alerta!',msgErroDespesa);
        return;
      }
    }

    //Metodo para inserir no banco todas as informações coletadas
    lancarRat(txbCliente, txbResponsavel, txbProjeto, txbProduto, dataAtividade, dataDespesa, txbDataRAT);

  });

  $("#tabLancar #btnAlterarRAT").click(function () {

    var txbAlterarCodRat = $("#txbAlterarCodRat").val();
    var txbCliente = $("#txbCliente").val();
    var txbResponsavel = $("#txbResponsavel").val();
    var txbProjeto = $("#txbProjeto").val();
    var txbProduto = $("#txbProduto").val();
    var txbDataRAT = $("#txbDataRAT").val();

    msgErroGeral = validaCamposGeral(txbCliente, txbResponsavel, txbProjeto, txbProduto, txbDataRAT);

    if(msgErroGeral !== ""){
      jbkrAlert.alerta('Alerta!',msgErroGeral);
      return;
    }

    var $rowsAtividade = $tableAtividade.find('tr:not(.hide):not(.notselect)');
    var headersAtividade = [];
    var dataAtividade = [];

    headersAtividade.push("codAtividade");
    headersAtividade.push("dtAtividade");
    headersAtividade.push("hrInicial");
    headersAtividade.push("hrFinal");
    headersAtividade.push("hrTotal");
    headersAtividade.push("dsAtividade");
    headersAtividade.push("idFaturar");

    // Turn all existing rows into a loopable array
    $rowsAtividade.each(function () {
      var $td = $(this).find('td');
      var h = {};


      // Use the headers from earlier to name our hash keys
      headersAtividade.forEach(function (header, i) {
        var $idFaturar = $td.eq(i).find('input:checkbox:first');

        if(typeof $idFaturar.val() !== "undefined") {
          if ($idFaturar.is(":checked"))
            h[header] = "1";
          else
            h[header] = "0";
        }
        else
          h[header] = $td.eq(i).text();
      });

      dataAtividade.push(h);

    });

    //Validando os campos para ver se está vazio
    for (var i = 0; i < dataAtividade.length; i++) {
      atividade = dataAtividade[i];
      var msgErroAtividade =  validaCamposAlterarAtividade(atividade.codAtividade, atividade.dtAtividade, atividade.hrInicial, atividade.hrFinal, atividade.hrTotal,atividade.dsAtividade);

      if(msgErroAtividade !== ""){
        jbkrAlert.alerta('Alerta!',msgErroAtividade);
        return;
      }
    }


    var $rowsDespesa = $tabDespesas.find('tr:not(.hide):not(.notselect)');
    var headersDespesa = [];
    var dataDespesa = [];

    headersDespesa.push("seqDespesa");
    headersDespesa.push("dtDespesa");
    headersDespesa.push("cdDespesa");
    headersDespesa.push("idDespesa");
    headersDespesa.push("vlDespesa");
    headersDespesa.push("qtDespesa");
    headersDespesa.push("totDespesa");
    headersDespesa.push("cdFaturamento");
    headersDespesa.push("dsOberservacao");

    // Turn all existing rows into a loopable array
    $rowsDespesa.each(function () {
      var $td = $(this).find('td');
      var h = {};

      // Use the headers from earlier to name our hash keys
      headersDespesa.forEach(function (header, i) {
        var $cdFaturamento = $td.eq(i).find('select#cdFaturamento');
        var $idDespesa = $td.eq(i).find("select[name='idDespesa']");
        var $cdDespesa = $td.eq(i).find("select[name='dsDespesa']");

        if($td.eq(i).text() !== ""){

          if(typeof $cdFaturamento.val() !== "undefined") {
            h[header] = $cdFaturamento.val();
          }
          else if(typeof $idDespesa.val() !== "undefined"){
            h[header] = $idDespesa.val();
          }
          else if(typeof $cdDespesa.val() !== "undefined"){
            h[header] = $cdDespesa.val();
          }
          else {
            if($td.eq(i).text() !== ""){
              h[header] = $td.eq(i).text();
            }
          }

        }
      });

      dataDespesa.push(h);

    });

    //Validando os campos para ver se está vazio
    for (var t = 0; t < dataDespesa.length; t++) {
      despesa = dataDespesa[t];

      var msgErroDespesa =  validaCamposDespesa(despesa.dtDespesa, despesa.cdDespesa, despesa.idDespesa,despesa.vlDespesa,despesa.qtDespesa,despesa.totDespesa,despesa.cdFaturamento,despesa.dsOberservacao);

      if(msgErroDespesa !== ""){
        jbkrAlert.alerta('Alerta!',msgErroDespesa);
        return;
      }
    }

    //Metodo para inserir no banco todas as informações coletadas
    alterarRat(txbAlterarCodRat, txbCliente, txbResponsavel, txbProjeto, txbProduto, dataAtividade, dataDespesa, txbDataRAT);

  });

$('#txbCliente').autocomplete({
  minLength: 1,
  autoFocus: true,
  delay: 300,
  position: {
    my: 'left top',
    at: 'right top'
  },
  appendTo: '#tabGeral',
  source: function(request, response){
    $.ajax({
      url: '../controller/RATController.php',
      type: 'POST',
      dataType: 'text',
      data: {
        termo: request.term,
        action: "autocompletecliente"
      }
    }).done(function(data){
      if(data.length > 0){
        data = data.split(',');
        response( $.each(data, function(key, item){
          return({
            label: item
          });
        }));
      }
    });
  }
});

$('#txbUsuario').autocomplete({
  minLength: 1,
  autoFocus: true,
  delay: 300,
  position: {
    my: 'left top',
    at: 'right top'
  },
  appendTo: '#tabGeral',
  source: function(request, response){
    $.ajax({
      url: '../controller/RATController.php',
      type: 'POST',
      dataType: 'text',
      data: {
        termo: request.term,
        action: "autocompleteusuario"
      }
    }).done(function(data){
      if(data.length > 0){
        data = data.split(',');
        response( $.each(data, function(key, item){
          return({
            label: item
          });
        }));
      }
    });
  }
});

$('#txbResponsavel').autocomplete({
  minLength: 1,
  autoFocus: true,
  delay: 300,
  position: {
    my: 'left top',
    at: 'right top'
  },
  appendTo: '#tabGeral',
  source: function(request, response){
    $.ajax({
      url: '../controller/RATController.php',
      type: 'POST',
      dataType: 'text',
      data: {
        termo: request.term,
        cliente: $("#txbCliente").val().split("-")[0],
        action: "autocompleteresponsavel"
      }
    }).done(function(data){
      if(data.length > 0){
        data = data.split(',');
        response( $.each(data, function(key, item){
          return({
            label: item
          });
        }));
      }
    });
  }
});

$('#txbProjeto').autocomplete({
  minLength: 1,
  autoFocus: true,
  delay: 300,
  position: {
    my: 'left top',
    at: 'right top'
  },
  appendTo: '#tabGeral',
  source: function(request, response){
    $.ajax({
      url: '../controller/RATController.php',
      type: 'POST',
      dataType: 'text',
      data: {
        termo: request.term,
        action: "autocompleteprojeto"
      }
    }).done(function(data){
      if(data.length > 0){
        data = data.split(',');
        response( $.each(data, function(key, item){
          return({
            label: item
          });
        }));
      }
    });
  }
});

$('#txbProduto').autocomplete({
  minLength: 1,
  autoFocus: true,
  delay: 300,
  position: {
    my: 'left top',
    at: 'right top'
  },
  appendTo: '#tabGeral',
  source: function(request, response){
    $.ajax({
      url: '../controller/RATController.php',
      type: 'POST',
      dataType: 'text',
      data: {
        termo: request.term,
        action: "autocompleteproduto"
      }
    }).done(function(data){
      if(data.length > 0){
        data = data.split(',');
        response( $.each(data, function(key, item){
          return({
            label: item
          });
        }));
      }
    });
  }
});

$('#tdFaturamento').autocomplete({
  minLength: 1,
  autoFocus: true,
  delay: 300,
  position: {
    my: 'left top',
    at: 'right top'
  },
  appendTo: '#tabGeral',
  source: function(request, response){
    $.ajax({
      url: '../controller/RATController.php',
      type: 'POST',
      dataType: 'text',
      data: {
        termo: request.term,
        action: "autocompleteproduto"
      }
    }).done(function(data){
      if(data.length > 0){
        data = data.split(',');
        response( $.each(data, function(key, item){
          return({
            label: item
          });
        }));
      }
    });
  }
});

});

function buscaRAT(codigo){
  var txbUsuario = $("#txbUsuario").val();
  var txbCliente = $("#txbCliente").val();
  var txbResponsavel = $("#txbResponsavel").val();
  var txbProjeto = $("#txbProjeto").val();

  $.ajax({
      //Tipo de envio POST ou GET
      type: "POST",
      dataType: "text",
      data: {
        codigo: codigo,
        usuario: txbUsuario,
        cliente: txbCliente,
        responsavel: txbResponsavel,
        projeto: txbProjeto,

        action: "buscar"
      },

      url: "../controller/RATController.php",

      //Se der tudo ok no envio...
      success: function (dados) {
        var json = $.parseJSON(dados);


      }
    });

}

function validaCamposDespesa(dtDespesa, dsDespesa, idDespesa, vlDespesa, qtDespesa, totDespesa, cdFaturamento, dsOberservacao){

  var msgErro = "";
  if(typeof dtDespesa === "undefined"){
    msgErro = msgErro + "<b>Data de Despesa</b> é um campo de preenchimento obrigatorio<br/>";
  }

  if(typeof idDespesa === "undefined"){
    msgErro = msgErro + "<b>Tipo da Despesa</b> é um campo de preenchimento obrigatorio<br/>";
  }

  if(typeof vlDespesa === "undefined"){
    msgErro = msgErro + "<b>Valor da Unitário</b> é um campo de preenchimento obrigatorio<br/>";
  }

  if(typeof qtDespesa === "undefined"){
    msgErro = msgErro + "<b>Quantidade</b> é um campo de preenchimento obrigatorio<br/>";
  }

  if(typeof totDespesa === "undefined"){
    msgErro = msgErro + "<b>Total</b> é um campo de preenchimento obrigatorio<br/>";
  }

  if(typeof dsOberservacao === "undefined"){
    msgErro = msgErro + "<b>Observação</b> é um campo de preenchimento obrigatorio<br/>";
  }

  if(typeof cdFaturamento === "undefined"){
    msgErro = msgErro + "<b>Faturamento</b> é um campo de preenchimento obrigatorio<br/>";
  }

  if(typeof dsDespesa === "undefined"){
    msgErro = msgErro + "<b>Descrição da despesa</b> é um campo de preenchimento obrigatorio<br/>";
  }

  return msgErro;

}

function validaCamposAlterarDespesa(seqDespesa, dtDespesa, dsDespesa, idDespesa, vlDespesa, qtDespesa, totDespesa, cdFaturamento, dsOberservacao){

  var msgErro = "";

  if(seqDespesa === ""){
    msgErro = msgErro + "<b>Código da Despesa</b> é um campo de preenchimento obrigatorio<br/>";
  }
  if(typeof dtDespesa === "undefined"){
    msgErro = msgErro + "<b>Data de Despesa</b> é um campo de preenchimento obrigatorio<br/>";
  }

  if(typeof idDespesa === "undefined"){
    msgErro = msgErro + "<b>Tipo da Despesa</b> é um campo de preenchimento obrigatorio<br/>";
  }

  if(typeof vlDespesa === "undefined"){
    msgErro = msgErro + "<b>Valor da Unitário</b> é um campo de preenchimento obrigatorio<br/>";
  }

  if(typeof qtDespesa === "undefined"){
    msgErro = msgErro + "<b>Quantidade</b> é um campo de preenchimento obrigatorio<br/>";
  }

  if(typeof totDespesa === "undefined"){
    msgErro = msgErro + "<b>Total</b> é um campo de preenchimento obrigatorio<br/>";
  }

  if(typeof dsOberservacao === "undefined"){
    msgErro = msgErro + "<b>Observação</b> é um campo de preenchimento obrigatorio<br/>";
  }

  if(typeof cdFaturamento === "undefined"){
    msgErro = msgErro + "<b>Faturamento</b> é um campo de preenchimento obrigatorio<br/>";
  }

  if(typeof dsDespesa === "undefined"){
    msgErro = msgErro + "<b>Descrição da despesa</b> é um campo de preenchimento obrigatorio<br/>";
  }

  return msgErro;

}


function validaCamposAtividade(dtAtividade, hrInicial, hrFinal, hrTotal, dsAtividade){

  var msgErro = "";
  if(dtAtividade === ""){
    msgErro = msgErro + "<b>Data de Atividade</b> é um campo de preenchimento obrigatorio<br/>";
  }

  if(hrInicial === ""){
    msgErro = msgErro + "<b>Hora Inicial</b> é um campo de preenchimento obrigatorio<br/>";
  }

  if(hrFinal === ""){
    msgErro = msgErro + "<b>Hora Final</b> é um campo de preenchimento obrigatorio<br/>";
  }
  if(hrTotal === ""){
    msgErro = msgErro + "<b>Hora Total</b> é um campo de preenchimento obrigatorio<br/>";
  }
  if(dsAtividade === ""){
    msgErro = msgErro + "<b>Descrição da atividade</b> é um campo de preenchimento obrigatorio<br/>";
  }
  if (hrInicial >= hrFinal){
    msgErro = msgErro + "<b>Hora Inicial</b> deve ser antes que a hora final<br/>";
  }

  return msgErro;


}

function validaCamposAlterarAtividade(codAtividade, dtAtividade, hrInicial, hrFinal, hrTotal, dsAtividade){

  var msgErro = "";
  if(codAtividade === ""){
    msgErro = msgErro + "<b>Código da Atividade</b> é um campo de preenchimento obrigatorio<br/>";
  }

  if(dtAtividade === ""){
    msgErro = msgErro + "<b>Data de Atividade</b> é um campo de preenchimento obrigatorio<br/>";
  }

  if(hrInicial === ""){
    msgErro = msgErro + "<b>Hora Inicial</b> é um campo de preenchimento obrigatorio<br/>";
  }

  if(hrFinal === ""){
    msgErro = msgErro + "<b>Hora Final</b> é um campo de preenchimento obrigatorio<br/>";
  }
  if(hrTotal === ""){
    msgErro = msgErro + "<b>Hora Total</b> é um campo de preenchimento obrigatorio<br/>";
  }
  if(dsAtividade === ""){
    msgErro = msgErro + "<b>Descrição da atividade</b> é um campo de preenchimento obrigatorio<br/>";
  }
  if (hrInicial >= hrFinal){
    msgErro = msgErro + "<b>Hora Inicial</b> deve ser antes que a hora final<br/>";
  }

  return msgErro;


}

function validaCamposGeral(txbCliente, txbResponsavel, txbProjeto, txbProduto, txbDataRAT){
  var msgErro = "";
  if(txbCliente === ""){
    msgErro = msgErro + "<b>Cliente</b> é um campo de preenchimento obrigatorio<br/>";
  }

  if(txbResponsavel === ""){
    msgErro = msgErro + "<b>Responsavel</b> é um campo de preenchimento obrigatorio<br/>";
  }

  if(txbProjeto === ""){
    msgErro = msgErro + "<b>Projeto</b> é um campo de preenchimento obrigatorio<br/>";
  }

  if(txbProduto === ""){
    msgErro = msgErro + "<b>Produto</b> é um campo de preenchimento obrigatorio<br/>";
  }

  if(txbDataRAT === ""){
    msgErro = msgErro + "<b>Data do Lançamento</b> é um campo de preenchimento obrigatorio<br/>";
  }
  return msgErro;

}

function lancarRat(txbCliente, txbResponsavel, txbProjeto, txbProduto,  dataAtividade, dataDespesa, txbDataRAT) {
  var cliente, responsavel, projeto, atividade;

  cliente = txbCliente.split("-");
  responsavel = txbResponsavel.split("-");
  projeto = txbProjeto.split("-");
  produto = txbProduto.split("-");

  $.ajax({
      //Tipo de envio POST ou GET
      type: "POST",
      dataType: "text",
      data: {
        cliente: cliente[0],
        responsavel: responsavel[0],
        projeto: projeto[0],
        produto: produto[0],
        datarat: txbDataRAT,
        action: "inserirrat"
      },

      url: "../controller/RATController.php",

      //Se der tudo ok no envio...
      success: function (dados) {
        jbkrAlert.sucesso('RAT', 'RAT cadastrado com sucesso!');
        $("#formGeral #btnCancelar").trigger("click");
      }

    });

  for (var i = 0; i < dataAtividade.length; i++) {
    atividade = dataAtividade[i];

    $.ajax({
        //Tipo de envio POST ou GET
        type: "POST",
        dataType: "text",
        data: {
          dtAtividade: atividade.dtAtividade,
          hrInicial: atividade.hrInicial,
          hrFinal: atividade.hrFinal,
          hrTotal: atividade.hrTotal,
          dsAtividade: atividade.dsAtividade,
          idFaturar: atividade.idFaturar,
          action: "inseriratividade"
        },

        url: "../controller/RATController.php"

      });

  }

  for (var j = 0; j < dataDespesa.length; j++) {
    despesa = dataDespesa[j];
    $.ajax({
        //Tipo de envio POST ou GET
        type: "POST",
        dataType: "text",
        data: {
          cdDespesa: despesa.cdDespesa,
          dtDespesa: despesa.dtDespesa,
          idDespesa: despesa.idDespesa,
          vlDespesa: despesa.vlDespesa,
          qtDespesa: despesa.qtDespesa,
          totDespesa: despesa.totDespesa,
          cdFaturamento: despesa.cdFaturamento,
          dsOberservacao: despesa.dsOberservacao,
          action: "inserirdespesa"
        },

        url: "../controller/RATController.php"

      });

  }

  var enviar = confirm('Deseja enviar o RAT por e-mail ao responsável?');
  if (enviar){
    nmRelatorio = "RAT_" + dataAtual() + '_' +  horaAtual();

    $.ajax({
        //Tipo de envio POST ou GET
        type: "POST",
        dataType: "text",
        data: {
          cliente: cliente[0],
          responsavel: responsavel[0],
          nmRelatorio: nmRelatorio,
          action: "enviaemailrat"
        },

        url: "../controller/RATController.php",

        //Se der tudo ok no envio...
        success: function (dados) {

        }

      });
  }
  else{
    alert("E-mail não enviado.");
  }

}

function alterarRat(txbAlterarCodRat, txbCliente, txbResponsavel, txbProjeto, txbProduto,  dataAtividade, dataDespesa, txbDataRAT) {
  var cliente, responsavel, projeto, atividade;

  cliente = txbCliente.split("-");
  responsavel = txbResponsavel.split("-");
  projeto = txbProjeto.split("-");
  produto = txbProduto.split("-");

  $.ajax({
      //Tipo de envio POST ou GET
      type: "POST",
      dataType: "text",
      data: {
        codigo: txbAlterarCodRat,
        cliente: cliente[0],
        responsavel: responsavel[0],
        projeto: projeto[0],
        produto: produto[0],
        datarat: txbDataRAT,
        action: "alterarrat"
      },

      url: "../controller/RATController.php",

      //Se der tudo ok no envio...
      success: function (dados) {
        jbkrAlert.sucesso('RAT', 'RAT alterado com sucesso!');
        $("#formGeral #btnCancelar").trigger("click");

        /*voltar pra tela de consulta
        $.ajax({
          type: "POST",
          dataType: "text",
          url: "ConsultaRATView.php",
          success: function(callback){
            $("#divPrincipal").html(callback);
            consultaRAT();
          }
        });
        */
      }

    });

  for (var i = 0; i < dataAtividade.length; i++) {
    atividade = dataAtividade[i];

    $.ajax({
        //Tipo de envio POST ou GET
        type: "POST",
        dataType: "text",
        data: {
          codigo: txbAlterarCodRat,
          atividade: atividade.codAtividade,
          dtAtividade: atividade.dtAtividade,
          hrInicial: atividade.hrInicial,
          hrFinal: atividade.hrFinal,
          hrTotal: atividade.hrTotal,
          dsAtividade: atividade.dsAtividade,
          idFaturar: atividade.idFaturar,
          action: "alteraratividade"
        },

        url: "../controller/RATController.php"

      });

  }

  for (var j = 0; j < dataDespesa.length; j++) {
    despesa = dataDespesa[j];
    $.ajax({
        //Tipo de envio POST ou GET
        type: "POST",
        dataType: "text",
        data: {
          codigo: txbAlterarCodRat,
          despesa: despesa.seqDespesa,
          cdDespesa: despesa.cdDespesa,
          dtDespesa: despesa.dtDespesa,
          idDespesa: despesa.idDespesa,
          vlDespesa: despesa.vlDespesa,
          qtDespesa: despesa.qtDespesa,
          totDespesa: despesa.totDespesa,
          cdFaturamento: despesa.cdFaturamento,
          dsOberservacao: despesa.dsOberservacao,
          action: "alterardespesa"
        },

        url: "../controller/RATController.php"

      });

  }

  var enviar = confirm('Deseja enviar o RAT por e-mail ao responsável?');
  if (enviar){
    nmRelatorio = "RAT_" + dataAtual() + '_' +  horaAtual();

    $.ajax({
        //Tipo de envio POST ou GET
        type: "POST",
        dataType: "text",
        data: {
          codigo: txbAlterarCodRat,
          cliente: cliente[0],
          responsavel: responsavel[0],
          nmRelatorio: nmRelatorio,
          action: "enviaemailratalterado"
        },

        url: "../controller/RATController.php",

        //Se der tudo ok no envio...
        success: function (dados) {

        }

      });
  }
  else {
    alert("E-mail não enviado.");
  }

}

function buscaDescricaoDespesa(flgadd){
  $.ajax({
      //Tipo de envio POST ou GET
      type: "POST",
      dataType: "text",
      data: {
        action: "buscadescricaodespesa"
      },

      url: "../controller/RATController.php",
      success: function (dados) {
        var json = $.parseJSON(dados);

        var dropdown;
        dropdown = '<option value="0"></option>';
        for (var i = 0; i < json.length; i++) {

          var descricaoDespesa = json[i];

          dropdown = dropdown + '<option value="' + descricaoDespesa.codDsp  + '">'+ descricaoDespesa.desDsp +'</option>';

        }
        if(flgadd)
          $("#tbDespesa tr:last select[name='dsDespesa']").html(dropdown);

        else {
          if(descricaocarregada === false)  {
            descricaocarregada = true;
            $("select[name='dsDespesa']").html(dropdown);
          }

        }
      }

    });

}

function buscaTipoDespesa(codDsp, element) {

  $.ajax({
      //Tipo de envio POST ou GET
      type: "POST",
      dataType: "text",
      data: {
        codDsp: codDsp,
        action: "buscatipodespesadropdown"
      },

      url: "../controller/RATController.php",
      success: function (dados) {
        var json = $.parseJSON(dados);

        var dropdown;
        for (var i = 0; i < json.length; i++) {

          var tipoDespesa = json[i];

          dropdown = dropdown + '<option value="' + tipoDespesa.codTipDsp  + '">'+ tipoDespesa.desTipDsp +'</option>';

        }
        element.html(dropdown);

      }

    });


}

function buscaValorUnitarioDespesa(idDespesa, element){
  $.ajax({
      //Tipo de envio POST ou GET
      type: "POST",
      dataType: "text",
      data: {
        idDespesa: idDespesa,
        action: "buscavalorunitariodespesa"
      },

      url: "../controller/RATController.php",
      success: function (dados) {
        element.text(dados);
      }

    });
}

/*function gerarRelatorio(txbConsultor, txbCliente, txbResponsavel){

  nmRelatorio = "RAT_" + dataAtual() + '_' +  horaAtual();

  $.ajax({
      //Tipo de envio POST ou GET
      type: "POST",
      dataType: "text",
      data: {
        txbConsultor: txbConsultor,
        txbCliente: txbCliente,
        txbResponsavel: txbResponsavel,
        nmRelatorio: nmRelatorio
      },

      url: "../../phpjasper/vendor/geekcom/phpjasper/templates/EnvioRAT.php",
      //Se der tudo ok no envio...
      success: function (dados) {
        alert("gerou relatorio");
      }

    });

  }*/

  function dataAtual() {
    var date = new Date();
    return String(date.getDate()) + String(date.getMonth()) + String(date.getFullYear());
  }

  function horaAtual() {
    var date = new Date();
    return String(date.getHours()) + String(date.getMinutes()) + String(date.getSeconds());
  }

  $("select[name='idDespesa']").bind("DOMSubtreeModified",function(){
    buscaValorUnitarioDespesa($(this).find(":selected").val(),$(this).parent().parent().find("td[name='tdVlUni']"));
  });

  $("select[name='dsDespesa']").change(function() {
    buscaTipoDespesa($(this).find(":selected").val(),$(this).parent().parent().find("select[name='idDespesa']"));

  });

  $("select[name='idDespesa']").change(function() {
    buscaValorUnitarioDespesa($(this).find(":selected").val(),$(this).parent().parent().find("td[name='tdVlUni']"));

  });

//multiplica quantidade da despesa pelo seu valor unitário
$("td[name='tdQtdDespesa']").blur(function() {
  vlUni = $(this).parent().find("td[name='tdVlUni']").text();
  qtdDespesa = $(this).text();
  total = vlUni * qtdDespesa;

  $(this).parent().find("td[name='totDespesa']").text(total);


});

//calcula valor da hora total
$("td[name='tdHrFinal']").blur(function() {
  hrFinal = $(this).parent().find("td[name='tdHrFinal']").text();
  hrInicial = $(this).parent().find("td[name='tdHrInicial']").text();

  var hrTotal = moment.utc(moment(hrFinal,"HH:mm").diff(moment(hrInicial,"HH:mm"))).format("HH:mm");

  $(this).parent().find("td[name='tdHrTotal']").text(hrTotal);
});

$("#tabLancar #btnAlterarRAT").click(function () {
  var txbCliente = $("#txbCliente").val();
  var txbResponsavel = $("#txbResponsavel").val();
  var txbProjeto = $("#txbProjeto").val();
  var txbProduto = $("#txbProduto").val();
  var txbDataRAT = $("#txbDataRAT").val();

  /*msgErroGeral = validaCamposGeral(txbCliente, txbResponsavel, txbProjeto, txbProduto, txbDataRAT);

  if(msgErroGeral !== ""){
    jbkrAlert.alerta('Alerta!',msgErroGeral);
    return;
  }*/

  var $rowsAtividade = $tableAtividade.find('tr:not(.hide):not(.notselect)');
  var headersAtividade = [];
  var dataAtividade = [];

  headersAtividade.push("dtAtividade");
  headersAtividade.push("hrInicial");
  headersAtividade.push("hrFinal");
  headersAtividade.push("hrTotal");
  headersAtividade.push("dsAtividade");
  headersAtividade.push("idFaturar");

  // Turn all existing rows into a loopable array
  $rowsAtividade.each(function () {
    var $td = $(this).find('td');
    var h = {};


    // Use the headers from earlier to name our hash keys
    headersAtividade.forEach(function (header, i) {
      var $idFaturar = $td.eq(i).find('input:checkbox:first');

      if(typeof $idFaturar.val() !== "undefined") {
        if ($idFaturar.is(":checked"))
          h[header] = "1";
        else
          h[header] = "0";
      }
      else
        h[header] = $td.eq(i).text();
    });

    dataAtividade.push(h);

  });

  //Validando os campos para ver se está vazio
  /*for (var i = 0; i < dataAtividade.length; i++) {
    atividade = dataAtividade[i];

    var msgErroAtividade =  validaCamposAtividade(atividade.dtAtividade, atividade.hrInicial, atividade.hrFinal, atividade.hrTotal,atividade.dsAtividade);

    if(msgErroAtividade !== ""){
      jbkrAlert.alerta('Alerta!',msgErroAtividade);
      return;
    }
  }*/


  /*var $rowsDespesa = $tabDespesas.find('tr:not(.hide):not(.notselect)');
  var headersDespesa = [];
  var dataDespesa = [];

  headersDespesa.push("dtDespesa");
  headersDespesa.push("cdDespesa");
  headersDespesa.push("idDespesa");
  headersDespesa.push("vlDespesa");
  headersDespesa.push("qtDespesa");
  headersDespesa.push("totDespesa");
  headersDespesa.push("cdFaturamento");
  headersDespesa.push("dsOberservacao");

  // Turn all existing rows into a loopable array
  $rowsDespesa.each(function () {
    var $td = $(this).find('td');
    var h = {};

    // Use the headers from earlier to name our hash keys
    headersDespesa.forEach(function (header, i) {
      var $cdFaturamento = $td.eq(i).find('select#cdFaturamento');
      var $idDespesa = $td.eq(i).find("select[name='idDespesa']");
      var $cdDespesa = $td.eq(i).find("select[name='dsDespesa']");

      if($td.eq(i).text() !== ""){

        if(typeof $cdFaturamento.val() !== "undefined") {
          h[header] = $cdFaturamento.val();
        }
        else if(typeof $idDespesa.val() !== "undefined"){
          h[header] = $idDespesa.val();
        }
        else if(typeof $cdDespesa.val() !== "undefined"){
          h[header] = $cdDespesa.val();
        }
        else {
          if($td.eq(i).text() !== ""){
            h[header] = $td.eq(i).text();
          }
        }

      }
    });

    dataDespesa.push(h);

  });*/

  //Validando os campos para ver se está vazio
  /*for (var t = 0; t < dataDespesa.length; t++) {
    despesa = dataDespesa[t];

    var msgErroDespesa =  validaCamposDespesa(despesa.dtDespesa, despesa.cdDespesa, despesa.idDespesa,despesa.vlDespesa,despesa.qtDespesa,despesa.totDespesa,despesa.cdFaturamento,despesa.dsOberservacao);

    if(msgErroDespesa !== ""){
      jbkrAlert.alerta('Alerta!',msgErroDespesa);
      return;
    }
  }*/

});

function buscaTipoDespesaConsulta(e){
  buscaTipoDespesa($(e).find(":selected").val(),$(e).parent().parent().find("select[name='idDespesa']"));

}

function buscaValorUnitarioDespesaConsulta(e){
  buscaValorUnitarioDespesa($(e).find(":selected").val(),$(e).parent().parent().find("td[name='tdVlUni']"));
}

function calculaTotal(e){
  vlUni = $(e).parent().find("td[name='tdVlUni']").text();
  qtdDespesa = $(e).text();
  total = vlUni * qtdDespesa;

  $(e).parent().find("td[name='totDespesa']").text(total);
}

function aplicaMascaraRat(){
  $(".tdData").inputmask("date");
  $(".tdHora").inputmask("99:99");
}

function removeMascaraRat(){
  $(".tdData").inputmask("remove");
}

function excluiAtividade(codAti){

  var txbAlterarCodRat = $("#txbAlterarCodRat").val();

  var excluir = confirm('Deseja excluir a atividade PERMANENTEMENTE?');
  if (excluir){

    $.ajax({
        //Tipo de envio POST ou GET
        type: "POST",
        dataType: "text",
        data: {
          codigo: txbAlterarCodRat,
          atividade: codAti,
          action: "excluiratividade"
        },

        url: "../controller/RATController.php",

        //Se der tudo ok no envio...
        success: function (dados) {
         $(this).parents('tr').detach();
       }
     });
  }
  
  else {
   return;
 }
 
}

function excluiDespesa(codDsp){

  var txbAlterarCodRat = $("#txbAlterarCodRat").val();

  var excluir = confirm('Deseja excluir a despesa PERMANENTEMENTE?');
  if (excluir){

    $.ajax({
        //Tipo de envio POST ou GET
        type: "POST",
        dataType: "text",
        data: {
          codigo: txbAlterarCodRat,
          despesa: codDsp,
          action: "excluirdespesa"
        },

        url: "../controller/RATController.php",

        //Se der tudo ok no envio...
        success: function (dados) {
          $(this).parents('tr').not('.fix').detach();
        }
      });
  }
  
  else {
   return;
 }

}