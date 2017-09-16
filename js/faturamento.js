$("#document").ready(function(){ 
  setaDataAtual("#txbDatFec");

  $("#formFaturamento #btnBuscar").click(function () {
    consultaFatRAT();
  });

  $("#formFaturamento #btnCancelar").click(function(){
    limpaCampos($(this).closest("form"));
    consultaFatRAT();
  });

  $("#formFaturamento #btnProcessar").click(function () {
    var trSelecionado = $("#grdFatRAT tr").hasClass('highlight');
    if (trSelecionado == true){
      var txbDatFec = $("#txbDatFec").val();
      var tdCodRAT = $("#grdFatRAT tr.highlight").find('td:first').text();
      var tdCodUsu = $.trim($("#grdFatRAT tr.highlight").closest("tr").find("td:eq(1)").text().split("-"));
      var tdSitRAT = $("#grdFatRAT tr.highlight").find('td:last').text().slice(0,1);

      var msgErro = validaCampos(txbDatFec);

      if(msgErro !== ""){
        jbkrAlert.alerta('Alerta!',msgErro);
      }
      else {

        if (tdSitRAT != 3){
          jbkrAlert.alerta('Alerta', "O RAT precisa estar com a situação '3 - Aprovado' para ser faturado.");
        } else {
         inserirFatRAT(tdCodRAT, tdCodUsu, txbDatFec);
         inserirResumoAtividade(tdCodRAT);
         inserirResumoDespesa(tdCodRAT);
         processarFatRAT(tdCodRAT, tdSitRAT);
       }
     }

   } else {
    jbkrAlert.alerta('Alerta', "Favor selecionar o RAT para ser processado.");
  }
});

  $("#grdFatRAT").on('click', 'tr', function () {
    var selected = $(this).hasClass("highlight");
    $("#grdFatRAT tr").removeClass("highlight");
    if(!selected){
      $(this).addClass("highlight")
    };

    var tdCodRAT = $(this).closest('tr').find('td:first').text();
    var tdSitRAT = $(this).closest('tr').find('td:last').text().slice(0,1);

    consultaFatAtividade(tdCodRAT);
    consultaFatDespesa(tdCodRAT);

  });

  $('#txbNomUsu').autocomplete({
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

  $('#txbNomPrj').autocomplete({
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

function consultaFatRAT(){

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

        url: "../controller/FaturamentoController.php",

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

          $("#grdFatRAT").html(grid);
          
        }
      });
}

function consultaFatAtividade(tdCodRAT){
        //busca itens atividade
        $.ajax({
          //Tipo de envio POST ou GET
          type: "POST",
          dataType: "text",
          data: {
            codigo: tdCodRAT,
            action: "buscaatividade"
          },

          url: "../controller/FaturamentoController.php",

          //Se der tudo ok no envio...
          success: function (dados) {
            var json = $.parseJSON(dados);
            var atividade = null;

                //Carregando a grid
                var grid = "";
                for (var i = 0; i < json.length; i++) {
                  atividade = json[i];

                  grid = grid + "<tr>";
                  grid = grid + "<td>" + atividade.horTot + "</td>";
                  grid = grid + "<td>" + atividade.fatTot + "</td>";
                  grid = grid + "<td>" + atividade.basCalCom + "</td>";
                  grid = grid + "<td>" + atividade.comTot + "</td>";
                  grid = grid + "<td>" + atividade.vlrLiq + "</td>"; 
                  grid = grid + "</tr>";
                }

                $("#grdFatAtividade").html(grid);
              }
            });
        //busca total atividade
        $.ajax({
          //Tipo de envio POST ou GET
          type: "POST",
          dataType: "text",
          data: {
            codigo: tdCodRAT,
            action: "buscatotalatividade"
          },

          url: "../controller/FaturamentoController.php",

          //Se der tudo ok no envio...
          success: function (dados) {
            var json = $.parseJSON(dados);
            var totalatividade = null;

                //Carregando a grid
                var grid = "";
                for (var i = 0; i < json.length; i++) {
                  totalatividade = json[i];

                  grid = grid + "<tr>";
                  grid = grid + "<td>" + totalatividade.sumHorTot + "</td>";
                  grid = grid + "<td>" + totalatividade.sumFatTot + "</td>";
                  grid = grid + "<td>" + totalatividade.sumBasCalCom + "</td>";
                  grid = grid + "<td>" + totalatividade.sumComTot + "</td>";
                  grid = grid + "<td>" + totalatividade.sumVlrLiq + "</td>"; 
                  grid = grid + "</tr>";
                }
                
                $("#footFatAtividade").html(grid);
              }
            });
      }

      function consultaFatDespesa(tdCodRAT){
        //busca itens despesa
        $.ajax({
          //Tipo de envio POST ou GET
          type: "POST",
          dataType: "text",
          data: {
            codigo: tdCodRAT,
            action: "buscadespesa"
          },

          url: "../controller/FaturamentoController.php",

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

                $("#grdFatDespesa").html(grid);
              }
            });

        //busca total despesas a faturar
        $.ajax({
          //Tipo de envio POST ou GET
          type: "POST",
          dataType: "text",
          data: {
            codigo: tdCodRAT,
            action: "buscatotaldespesafat"
          },

          url: "../controller/FaturamentoController.php",

          //Se der tudo ok no envio...
          success: function (dados) {
            var json = $.parseJSON(dados);
            var totalDespesaFat = null;

            var grid = "";
            for (var i = 0; i < json.length; i++) {
              totalDespesaFat = json[i];

              grid = grid + "<td colspan='6'>" + "Total a faturar contra o cliente:" + "</td>";
              grid = grid + "<td>" + totalDespesaFat.TotDspFat + "</td>";

            }

            $("#footFatDespesaFat").html(grid);
          }

        });

        //busca total despesas a reembolsar
        $.ajax({
          //Tipo de envio POST ou GET
          type: "POST",
          dataType: "text",
          data: {
            codigo: tdCodRAT,
            action: "buscatotaldespesarem"
          },

          url: "../controller/FaturamentoController.php",

          //Se der tudo ok no envio...
          success: function (dados) {
            var json = $.parseJSON(dados);
            var totalDespesaRem = null;
            
            var grid = "";
            for (var i = 0; i < json.length; i++) {
              totalDespesaRem = json[i];

              grid = grid + "<td colspan='6'>" + "Total a reembolsar ao consultor:" + "</td>";
              grid = grid + "<td>" + totalDespesaRem.TotDspRem + "</td>";

            }

            $("#footFatDespesaRem").html(grid);
          }
        });

      }

      function processarFatRAT(tdCodRAT, tdSitRAT){
        $.ajax({
        //Tipo de envio POST ou GET
        type: "POST",
        dataType: "text",
        data: {
          codigo: tdCodRAT,
          situacao: tdSitRAT,
          action: "processar"
        },

        url: "../controller/FaturamentoController.php",

        //Se der tudo ok no envio...
        success: function (dados) {
          alert("atualizado");
            //jbkrAlert.sucesso('RAT', 'RAT atualizado com sucesso.');
            //$("#formFaturamento #btnCancelar").trigger("click");
          }
        });

      }

      function inserirFatRAT(tdCodRAT, tdCodUsu, txbDatFec){
        $.ajax({
        //Tipo de envio POST ou GET
        type: "POST",
        dataType: "text",
        data: {
          codigo: tdCodRAT,
          usuario: tdCodUsu,
          dataFechamento: txbDatFec,

          action: 'inserirfatrat'
        },

        url: "../controller/FaturamentoController.php",

        //Se der tudo ok no envio...
        success: function (dados) {
          jbkrAlert.sucesso('RAT', 'RAT faturado com sucesso');
          $("#formFaturamento #btnCancelar").trigger("click");
        }
      });

      }

      function inserirResumoAtividade(tdCodRAT){
        $.ajax({
        //Tipo de envio POST ou GET
        type: "POST",
        dataType: "text",
        data: {
          codigoRat: tdCodRAT,
          action: "inserirresumoatividade"
        },

        url: "../controller/FaturamentoController.php"

      });
      }

      function inserirResumoDespesa(tdCodRAT){
        $.ajax({
        //Tipo de envio POST ou GET
        type: "POST",
        dataType: "text",
        data: {
          codigoRat: tdCodRAT,
          action: "inserirresumodespesa"
        },

        url: "../controller/FaturamentoController.php"

      });
      }

      function setaDataAtual(input){
        var date = new Date();

        var day = date.getDate();
        var month = date.getMonth() + 1;
        var year = date.getFullYear();

        if (month < 10) month = "0" + month;
        if (day < 10) day = "0" + day;

        inputToday = year + "-" + month + "-" + day;

        $(input).val(inputToday);
      }

      function validaCampos(txbDatFec){
        msgErro = "";
        if(txbDatFec === ""){
          msgErro = msgErro + "<b>Data de Fechamento</b> é um campo de preenchimento obrigatorio<br/>";
        }

        return msgErro;

      }