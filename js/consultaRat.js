$("#document").ready(function(){ 
  verificaPapelUsuario();

  $("#formConsultaRAT #btnBuscar").click(function () {
      consultaRAT();
    });

  $("#formConsultaRAT #btnEmail").click(function(){
    alert("teste");

    });

  $("#formConsultaRAT #btnCancelar").click(function(){
      limpaCampos($(this).closest("form"));
      consultaRAT();
    });

  $("#grdConsultaRAT").on('click', 'tr', function () {
      var selected = $(this).hasClass("highlight");
      $("#grdConsultaRAT tr").removeClass("highlight");
      if(!selected){
              $(this).addClass("highlight")
      };

      var tdCodRAT = $(this).closest('tr').find('td:first').text();
      var tdSitRAT = $(this).closest('tr').find('td:last').text().slice(0,1);

      consultaAtividade(tdCodRAT);
      consultaDespesa(tdCodRAT);

    });

  $("#formConsultaRAT #btnAprovar").click(function(){
      var trSelecionado = $("#grdConsultaRAT tr").hasClass('highlight');
      if (trSelecionado == true){
        var tdCodRAT = $("#grdConsultaRAT tr.highlight").find('td:first').text();
        var tdSitRAT = $("#grdConsultaRAT tr.highlight").find('td:last').text().slice(0,1);

          if (tdSitRAT != 2){
                              jbkrAlert.alerta('Alerta', "O RAT precisa estar com a situação '2 - Enviado' para ser aprovado.");
          } else {
                   aprovaRAT(tdCodRAT, tdSitRAT);
                   }     
      } else {
              jbkrAlert.alerta('Alerta', "Favor selecionar o RAT para ser aprovado.");
             }
    });

  $("#formConsultaRAT #btnReprovar").click(function(){
      var trSelecionado = $("#grdConsultaRAT tr").hasClass('highlight');
      if (trSelecionado == true){
        var tdCodRAT = $("#grdConsultaRAT tr.highlight").find('td:first').text();
        var tdSitRAT = $("#grdConsultaRAT tr.highlight").find('td:last').text().slice(0,1);

          if (tdSitRAT != 2){
                              jbkrAlert.alerta('Alerta', "O RAT precisa estar com a situação '2 - Enviado' para ser reprovado.");
          } else {
                   reprovaRAT(tdCodRAT, tdSitRAT);
                   }     
      } else {
              jbkrAlert.alerta('Alerta', "Favor selecionar o RAT para ser reprovado.");
             }
    });

});

function consultaRAT(){

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

        url: "../controller/ConsultaRATController.php",

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
              grid = grid + "<td>" + rat.perComCli + "</td>";
              grid = grid + "<td>" + rat.perComInt + "</td>";
              grid = grid + "<td>" + rat.codCli + "</td>";
              grid = grid + "<td>" + rat.codRes + "</td>";
              grid = grid + "<td>" + rat.codPrj + "</td>";
              grid = grid + "<td>" + rat.vlrHorCom + "</td>";
              grid = grid + "<td>" + rat.vlrHorFat + "</td>";
              grid = grid + "<td>" + rat.codPro + "</td>";  
              grid = grid + "<td>" + rat.codSit + "</td>";
              grid = grid + "</tr>";

            }

            $("#grdConsultaRAT").html(grid);
          
        }
    });
}

function aprovaRAT(tdCodRAT, tdSitRAT){
    $.ajax({
        //Tipo de envio POST ou GET
        type: "POST",
        dataType: "text",
        data: {
            codigo: tdCodRAT,
            situacao: tdSitRAT,
            action: "aprovar"
        },

        url: "../controller/ConsultaRATController.php",

        //Se der tudo ok no envio...
        success: function (dados) {
            jbkrAlert.sucesso('RAT', 'RAT aprovado com sucesso e enviado para o faturamento!');
            $("#formConsultaRAT #btnCancelar").trigger("click");
        }
    });
}

function reprovaRAT(tdCodRAT, tdSitRAT){
    $.ajax({
        //Tipo de envio POST ou GET
        type: "POST",
        dataType: "text",
        data: {
            codigo: tdCodRAT,
            situacao: tdSitRAT,
            action: "reprovar"
        },

        url: "../controller/ConsultaRATController.php",

        //Se der tudo ok no envio...
        success: function (dados) {
            jbkrAlert.sucesso('RAT', 'RAT reprovado com sucesso!');
            $("#formConsultaRAT #btnCancelar").trigger("click");
        }
    });
}

function consultaAtividade(tdCodRAT){
        $.ajax({
          //Tipo de envio POST ou GET
          type: "POST",
          dataType: "text",
          data: {
                  codigo: tdCodRAT,
                  action: "buscaatividade"
          },

          url: "../controller/ConsultaRATController.php",

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
                  grid = grid + "<td>" + atividade.tipFat + "</td>";  
                  grid = grid + "</tr>";

                }

                $("#grdConsultaAtividade").html(grid);
            }
          });
}

function consultaDespesa(tdCodRAT){
        $.ajax({
          //Tipo de envio POST ou GET
          type: "POST",
          dataType: "text",
          data: {
                  codigo: tdCodRAT,
                  action: "buscadespesa"
          },

          url: "../controller/ConsultaRATController.php",

          //Se der tudo ok no envio...
            success: function (dados) {
              var json = $.parseJSON(dados);
              var despesa = null;

                //Carregando a grid
                var grid = "";
                for (var i = 0; i < json.length; i++) {
                  despesa = json[i];

                  grid = grid + "<tr>";
                  grid = grid + "<td>" + despesa.seqDsp + "</td>";
                  grid = grid + "<td>" + despesa.datDsp + "</td>";
                  grid = grid + "<td>" + despesa.desDsp + "</td>";
                  grid = grid + "<td>" + despesa.desTipDsp + "</td>";
                  grid = grid + "<td>" + despesa.vlrUni + "</td>";
                  grid = grid + "<td>" + despesa.qtdDsp + "</td>";
                  grid = grid + "<td>" + despesa.totDsp + "</td>";
                  grid = grid + "<td>" + despesa.obsDsp + "</td>";
                  grid = grid + "<td>" + despesa.desFatDsp + "</td>";
                  grid = grid + "</tr>";

                }

                $("#grdConsultaDespesa").html(grid);
            }
          });

}

function telaModoConsultor(){
  $("#formConsultaRAT #btnAprovar").css("display","none");
  $("#formConsultaRAT #btnReprovar").css("display","none");
}

function verificaPapelUsuario(){
    $.ajax({
        //Tipo de envio POST ou GET
        type: "POST",
        dataType: "text",
        data: {
            action: "verificapapelusuario"
        },

        url: "../controller/ConsultaRATController.php",

        //Se der tudo ok no envio...
        success: function (dados) {
        var json = $.parseJSON(dados);

        if (json.status == 2) {
          telaModoConsultor();
                  }
        }
    });

}
/*
function aplicaCorRAT(){
  $("#grdConsultaRAT tr").each(function(){
    var tdSitRAT = $("#grdConsultaRAT tr").find('td:last').text().slice(0,1);
    alert(tdSitRAT);
    if (tdSitRAT = 1){
      $(this).addClass('digitado');
    }
    else if (tdSitRAT = 2){
      $(this).addClass('enviado');
    }
    else if (tdSitRAT = 3){
      $(this).addClass('aprovado');
    }
    else if (tdSitRAT = 4){
      $(this).addClass('faturado');
    } 
    else if (tdSitRAT = 6){
      $(this).addClass('reprovado');
    } 
  });
}*/