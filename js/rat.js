//TABELA ATIVIDADE
var $tableAtividade = $('#tableAtividade');
var $tabDespesas = $('#tabDespesas');
var $btnExportarAtividade = $('#btnExportarAtividade');
var $msgExportarAtividade = $('#msgExportarAtividade');

//$('.table-add').click(function () {
$('#addAtividade').click(function () {
  var $clone = $tableAtividade.find('tr.hide').clone(true).removeClass('hide table-line');

  $tableAtividade.find('table').append($clone);
});

$('.table-remove').click(function () {
  $(this).parents('tr').detach();
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

// A few jQuery helpers for exporting only
jQuery.fn.pop = [].pop;
jQuery.fn.shift = [].shift;

$btnExportarAtividade.click(function () {
  var $rows = $tableAtividade.find('tr:not(:hidden)');
  var headers = [];
  var data = [];

  // Get the headers (add special header logic here)
  $($rows.shift()).find('th:not(:empty)').each(function () {
    headers.push($(this).text().toLowerCase());
  });

  // Turn all existing rows into a loopable array
  $rows.each(function () {
    var $td = $(this).find('td');
    var h = {};

    // Use the headers from earlier to name our hash keys
    headers.forEach(function (header, i) {
      h[header] = $td.eq(i).text();
    });

    data.push(h);
  });

  // Output the result
  $msgExportarAtividade.text(JSON.stringify(data));
});

//TABELA DESPESA
var $tableDespesa = $('#tableDespesa');
var $btnExportarDespesa = $('#btnExportarDespesa');
var $msgExportarDespesa = $('#msgExportarDespesa');

$('#addDespesa').click(function () {
  var $clone = $tableDespesa.find('tr.hide').clone(true).removeClass('hide table-line');
  $tableDespesa.find('table').append($clone);
});

$('.table-remove').click(function () {
  $(this).parents('tr').detach();
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

// A few jQuery helpers for exporting only
jQuery.fn.pop = [].pop;
jQuery.fn.shift = [].shift;

$btnExportarDespesa.click(function () {
  var $rows = $tableDespesa.find('tr:not(:hidden)');
  var headers = [];
  var data = [];

  // Get the headers (add special header logic here)
  $($rows.shift()).find('th:not(:empty)').each(function () {
    headers.push($(this).text().toLowerCase());
  });

  // Turn all existing rows into a loopable array
  $rows.each(function () {
    var $td = $(this).find('td');
    var h = {};

    // Use the headers from earlier to name our hash keys
    headers.forEach(function (header, i) {
      h[header] = $td.eq(i).text();
    });

    data.push(h);
  });

  // Output the result
  $msgExportarDespesa.text(JSON.stringify(data));
});

$("#document").ready(function(){
  $('#tdDataDaAtividade').mask('00/00/0000');
  $('#tdHoraInicial').mask('00:00');
  $("#tabLancar #btnLancarRAT").click(function () {

    var txbCliente = $("#txbCliente").val();
    var txbResponsavel = $("#txbResponsavel").val();
    var txbProjeto = $("#txbProjeto").val();

    msgErroGeral = validaCamposGeral(txbCliente, txbResponsavel, txbProjeto );

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
    headersAtividade.push("dsAtividade");

    // Turn all existing rows into a loopable array
    $rowsAtividade.each(function () {
      var $td = $(this).find('td');
      var h = {};

      // Use the headers from earlier to name our hash keys
      headersAtividade.forEach(function (header, i) {
        h[header] = $td.eq(i).text();
      });

      dataAtividade.push(h);

    });

    //Validando os campos para ver se está vazio
    for (var i = 0; i < dataAtividade.length; i++) {
      atividade = dataAtividade[i];

      var msgErroAtividade =  validaCamposAtividade(atividade.dtAtividade, atividade.hrInicial,atividade.hrFinal,atividade.dsAtividade);

      if(msgErroAtividade !== ""){
        jbkrAlert.alerta('Alerta!',msgErroAtividade);
        break;
      }
    }


    var $rowsDespesa = $tabDespesas.find('tr:not(.hide):not(.notselect)');
    var headersDespesa = [];
    var dataDespesa = [];

    headersDespesa.push("dtDespesa");
    headersDespesa.push("idDespesa");
    headersDespesa.push("vlDespesa");
    headersDespesa.push("qtDespesa");
    headersDespesa.push("totDespesa");
    headersDespesa.push("dsOberservacao");

    // Turn all existing rows into a loopable array
    $rowsDespesa.each(function () {
      var $td = $(this).find('td');
      var h = {};

      // Use the headers from earlier to name our hash keys
      headersDespesa.forEach(function (header, i) {
        if($td.eq(i).text() !== ""){
          h[header] = $td.eq(i).text();
        }
      });

        dataDespesa.push(h);

    });

    //Validando os campos para ver se está vazio
    for (var t = 0; t < dataDespesa.length; t++) {
      despesa = dataDespesa[t];

      var msgErroDespesa =  validaCamposDespesa(despesa.dtDespesa, despesa.idDespesa,despesa.vlDespesa,despesa.qtDespesa,despesa.totDespesa,despesa.dsOberservacao);

      if(msgErroDespesa !== ""){
        jbkrAlert.alerta('Alerta!',msgErroDespesa);
        break;
      }
    }
    /*var msgErro = validaCampos(txbDescricaoProduto);

    if(msgErro !== ""){
      jbkrAlert.alerta('Alerta!',msgErro);
    }
   else {
      $.ajax({
    	  //Tipo de envio POST ou GET
        type: "POST",
        dataType: "text",
        data: {
                descricao: txbDescricaoProduto,
                action: "cadastrar"
        },

        url: "../controller/ProdutoController.php",

        //Se der tudo ok no envio...
        success: function (dados) {
            jbkrAlert.sucesso('Produto', 'Produto cadastrado com sucesso!');
            $("#formProduto #btnCancelar").trigger("click");
        }
      });
    }*/
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

function validaCamposDespesa(dtDespesa, idDespesa, vlDespesa, qtDespesa, totDespesa, dsOberservacao){

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

    return msgErro;

}

function validaCamposAtividade(dtAtividade, hrInicial, hrFinal, dsAtividade){

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

  if(dsAtividade === ""){
    msgErro = msgErro + "<b>Descrição da atividade</b> é um campo de preenchimento obrigatorio<br/>";
  }

  return msgErro;


}

function validaCamposGeral(txbCliente, txbResponsavel, txbProjeto){
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

  return msgErro;

}
