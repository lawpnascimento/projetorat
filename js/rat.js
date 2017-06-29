//TABELA ATIVIDADE
var $tableAtividade = $('#tableAtividade');
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
	/*$("#LabelResumoCliente").html("TESTE");
	$("#txbHoraInicial").mask('00:00');
	$("#txbHoraFinal").mask('00:00');
  $("#txbUsuario").val("teste");*/

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
