$("#document").ready(function(){ 

  $("#formConsultaAtividade #btnBuscar").click(function () {
    consultaAtiRAT();
  });

  $("#formConsultaAtividade #btnCancelar").click(function(){
    limpaCampos($(this).closest("form"));
    consultaAtiRAT();
  });

  $("#grdConsultaAtiRAT").on('click', 'tr', function () {
    var selected = $(this).hasClass("highlight");
    $("#grdConsultaAtiRAT tr").removeClass("highlight");

    if(!selected){
      $(this).addClass("highlight")
    };

    var tdCodRAT = $(this).closest('tr').find('td:first').text();
    var tdSitRAT = $(this).closest('tr').find('td:last').text().slice(0,1);

    consultaAtiAtividade(tdCodRAT);

  });

  $('#txbNomUsu').autocomplete({
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

  $('#txbNomCli').autocomplete({
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

  $('#txbNomRes').autocomplete({
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

  $('#txbNomPrj').autocomplete({
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

  $('#txbNomPro').autocomplete({
    minLength: 1,
    autoFocus: true,
    delay: 300,
    position: {
      my: 'bottom top',
      at: 'bottom'
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

function consultaAtiRAT(){

  var txbCodRat = $("#txbCodRat").val();
  var txbNomUsu = $("#txbNomUsu").val();
  var txbNomCli = $("#txbNomCli").val();
  var txbNomRes = $("#txbNomRes").val();
  var txbNomPrj = $("#txbNomPrj").val();
  var txbNomPro = $("#txbNomPro").val();
  var txbSitRAT = $("#txbSitRAT").val();

  $.ajax({
        //Tipo de envio POST ou GET
        type: "POST",
        dataType: "text",
        data: {
          codigo: txbCodRat,
          usuario: txbNomUsu,
          cliente: txbNomCli,
          responsavel: txbNomRes,
          projeto: txbNomPrj,
          produto: txbNomPro,
          situacao: txbSitRAT,
          action: "buscar"
        },

        url: "../controller/ConsultaAtividadeController.php",

        //Se der tudo ok no envio...
        success: function (dados) {
          var json = $.parseJSON(dados);
          var rat = null;

          //Carregando a grid
          var grid = "";
          for (var i = 0; i < json.length; i++) {
            rat = json[i];

            grid = grid + "<tr>";
            grid = grid + "<td>" + rat.codRat + "</td>";
            grid = grid + "<td>" + rat.codUsu + "</td>";
            grid = grid + "<td>" + rat.datRat + "</td>";
            grid = grid + "<td>" + rat.codCli + "</td>";
            grid = grid + "<td>" + rat.codRes + "</td>";
            grid = grid + "<td>" + rat.codPrj + "</td>";
            grid = grid + "<td>" + rat.codPro + "</td>";  
            grid = grid + "</tr>";

          }

          $("#grdConsultaAtiRAT").html(grid);
          
        }
      });
}

function consultaAtiAtividade(tdCodRAT){
  $.ajax({
          //Tipo de envio POST ou GET
          type: "POST",
          dataType: "text",
          data: {
            codigo: tdCodRAT,
            action: "buscaatividade"
          },

          url: "../controller/ConsultaAtividadeController.php",

          //Se der tudo ok no envio...
          success: function (dados) {
            var json = $.parseJSON(dados);
            var atividade = null;

                //Carregando a grid
                var grid = "";
                for (var i = 0; i < json.length; i++) {
                  atividade = json[i];

                  grid = grid + "<tr>";
                  grid = grid + "<td>" + atividade.codAti + "</td>";
                  grid = grid + "<td>" + atividade.datAti + "</td>";
                  grid = grid + "<td>" + atividade.horIni + "</td>";
                  grid = grid + "<td>" + atividade.horFin + "</td>";
                  grid = grid + "<td>" + atividade.horTot + "</td>";
                  grid = grid + "<td>" + atividade.desAti + "</td>";
                  grid = grid + "</tr>";

                }

                $("#grdConsultaAtiAtividade").html(grid);
              }
            });
}

function verificaPapelUsuario(){
  $.ajax({
        //Tipo de envio POST ou GET
        type: "POST",
        dataType: "text",
        data: {
          action: "verificapapelusuario"
        },

        url: "../controller/ConsultaAtividadeController.php",

        //Se der tudo ok no envio...
        success: function (dados) {
          var json = $.parseJSON(dados);

          if (json.status == 2) {
            telaModoConsultor();
          }
        }
      });

}