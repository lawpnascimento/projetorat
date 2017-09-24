$("#document").ready(function(){
  verificaPapelUsuario();

  $("#formConsultaRAT #btnBuscar").click(function () {
    consultaRAT();
  });

  $("#formConsultaRAT #btnEmail").click(function(){
    var trSelecionado = $("#grdConsultaRAT tr").hasClass('highlight');
    if (trSelecionado == true){
      var tdUsuRAT = $("#grdConsultaRAT tr.highlight").closest("tr").find("td:eq(1)").text().split("-");
      var tdCodRAT = $("#grdConsultaRAT tr.highlight").find('td:first').text();
      var tdSitRAT = $("#grdConsultaRAT tr.highlight").find('td:last').text().slice(0,1);

      if (tdSitRAT == 1 || tdSitRAT == 6){
        enviaEmailRAT(tdUsuRAT, tdCodRAT);
      } else {
       jbkrAlert.alerta('Alerta', "O RAT deve estar com a situação '1 - Digitado' ou '6 - Reprovado' para ser enviado.");
     }
   } else {
    jbkrAlert.alerta('Alerta', "Favor selecionar o RAT para ser enviado.");
  }
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

  $("#formConsultaRAT #btnAlterar").click(function(){
    var trSelecionado = $("#grdConsultaRAT tr").hasClass('highlight');
    if (trSelecionado == true){
      var tdCodRAT = $("#grdConsultaRAT tr.highlight").find('td:first').text();
      var tdSitRAT = $("#grdConsultaRAT tr.highlight").find('td:last').text().slice(0,1);

      if (tdSitRAT == 1 || tdSitRAT == 6){
        alteraRAT(tdCodRAT, tdSitRAT);
      } else {
       jbkrAlert.alerta('Alerta', "O RAT deve estar com a situação '1 - Digitado' ou '6 - Reprovado' para ser alterado.");
     }
   } else {
    jbkrAlert.alerta('Alerta', "Favor selecionar o RAT para ser alterado.");
  }
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

  $('#txbSitRAT').autocomplete({
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
        url: '../controller/ConsultaRATController.php',
        type: 'POST',
        dataType: 'text',
        data: {
          termo: request.term,
          action: "autocompletesituacao"
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

function enviaEmailRAT(tdUsuRAT, tdCodRAT){
  $.ajax({
        //Tipo de envio POST ou GET
        type: "POST",
        dataType: "text",
        data: {
          usuariorat: tdUsuRAT[0],
          codigorat: tdCodRAT,
          action: "enviaemailrat"
        },

        url: "../controller/ConsultaRATController.php",

        //Se der tudo ok no envio...
        success: function (dados) {
          var json = $.parseJSON(dados);

          if (json.status == 1) {
            jbkrAlert.alerta('Alerta', json.mensagem);
          }else {
            jbkrAlert.sucesso('Alerta', json.mensagem);
            $("#formConsultaRAT #btnCancelar").trigger("click");
          }

        }
      });

}

function alteraRAT(tdCodRAT, tdSitRAT){
 var trSelecionado = $("#grdConsultaRAT tr").hasClass('highlight');

 $.ajax({

  type: "POST",
  dataType: "text",

  url: "RATView.php",

  success: function(callback){
    $("#divPrincipal").html(callback);
    formularioModoAtualizar();

    $.ajax({
        //Tipo de envio POST ou GET
        type: "POST",
        dataType: "text",
        data: {
          codigo: tdCodRAT,
          situacao: tdSitRAT,
          action: "alterar"
        },

        url: "../controller/ConsultaRATController.php",

        success: function (dados) {
          var json = $.parseJSON(dados);
          var rat = null;

          for (var j = 0; j < json.length; j++) {
            rat = json[j];

            $("#txbCliente").val(rat.codCli);
            $("#txbResponsavel").val(rat.codRes);
            $("#txbProjeto").val(rat.codPrj);
            $("#txbProduto").val(rat.codPro);
            $("#txbDataRAT").val(rat.datRat);
            $("#txbAlterarCodRat").val(rat.codRat);
          }

        }

      });

    $.ajax({
          //Tipo de envio POST ou GET
          type: "POST",
          dataType: "text",
          data: {
            codigo: tdCodRAT,
            action: "buscaatividade"
          },

          url: "../controller/ConsultaRATController.php",

          success: function (dados) {
            var json = $.parseJSON(dados);
            var atividade = null;

            var grid = "";
            var tipFat = null;
            for (var j = 0; j < json.length; j++) {
              atividade = json[j];

              if(atividade.tipFat == 1)
                tipFat = "checked";
              else
                tipFat = "";

              grid = grid + '<tr>';
              grid = grid + '<input type="hidden" value="' + atividade.codAti + '"/>';
              grid = grid + '<td id="tdDataAtividade" contenteditable="true" class="tdData">' + atividade.datAti + '</td>';
              grid = grid + '<td id="tdHoraInicial" contenteditable="true" name="tdHrInicial" class="tdHora">' + atividade.horIni + '</td>';
              grid = grid + '<td id="tdHoraFinal" contenteditable="true" name="tdHrFinal" class="tdHora">' + atividade.horFin + '</td>';
              grid = grid + '<td id="tdHoraTotal" bgcolor="#EBEBE4" contenteditable="false" name="tdHrTotal" readonly>' + atividade.horTot + '</td>';
              grid = grid + '<td id="tdDescricaoAtividade" contenteditable="true" onkeypress="return (this.innerText.length <= 200)">' + atividade.desAti + '</td>';
              grid = grid + '<td id="tdFatAtividade" class="checkbox col-sm-1"> <label><input type="checkbox" value="' + atividade.tipFat + '" ' + tipFat + '   >Faturar</label></td>';
              grid = grid + '<td id="tdButtonsAtividade">';
              grid = grid + '<span class="table-up glyphicon glyphicon-arrow-up"></span>';
              grid = grid + '<span class="table-down glyphicon glyphicon-arrow-down"></span>';
              grid = grid + '<span class="table-remove glyphicon glyphicon-remove" onClick="ExcluiAtividade(' + atividade.codAti + ')"></span>';
              grid = grid + '</td>';
              grid = grid + '</tr>';
            }

            $("#tbAtividades #tbodyAtividades").html(grid);
          }

        });

        $.ajax({
          //Tipo de envio POST ou GET
          type: "POST",
          dataType: "text",
          data: {
            codigo: tdCodRAT,
            action: "buscadespesa"
          },

          url: "../controller/ConsultaRATController.php",

          success: function (dados) {
            var json = $.parseJSON(dados);
            var despesa = null;
            var grid = "";
            var fr = null;
            var fn = null;
            var nr = null;
            var nn = null;

            for (var j = 0; j < json.length; j++) {
              despesa = json[j];

              if(despesa.codFatDsp == 1)
                fr = "selected";
              else if(despesa.codFatDsp == 2)
                fn = "selected";
              else if(despesa.codFatDsp == 3)
                nr = "selected";
              else if(despesa.codFatDsp == 4)
                nn = "selected";

              grid = grid + '<tr class="fix">';
              grid = grid + '<td id="tdDataDespesa" contenteditable="true" class="tdData">' + despesa.datDsp + '</td>';
              grid = grid + '<td id="tdDsDespesa" contenteditable="false"><select class="selectDsDespesa" style="width:100%;" name="dsDespesa" onChange="buscaTipoDespesaConsulta(this);" onblur="buscaValorUnitarioDespesaConsulta(this);"></select></td>';
              grid = grid + '<td id="tdTipoDespesa" bgcolor="#EBEBE4" contenteditable="false" readonly><select class="selectTipoDespesa" style="width:100%;" name="idDespesa"></select></td>';
              grid = grid + '<td id="tdVlUni" bgcolor="#EBEBE4" contenteditable="false"readonly  name="tdVlUni">' + despesa.vlrUni + '</td>';
              grid = grid + '<td id="tdQtdDespesa" contenteditable="true" name="tdQtdDespesa" class="tdNumerico" onkeyup="javascript:calculaTotal(this);">' + despesa.qtdDsp + '</td>';
              grid = grid + '<td id="tdTotDespesa" bgcolor="#EBEBE4" contenteditable="false" name="totDespesa">' + despesa.totDsp + '</td>';
              grid = grid + '<td id="tdFatDespesa" contenteditable="false">';
              grid = grid + '<select style="width:100%;" id="cdFaturamento">';
              grid = grid + '<option value="1" ' + fr + '> FR </option>';
              grid = grid + '<option value="2" ' + fn + '> FN </option>';
              grid = grid + '<option value="3" ' + nr + '> NR </option>';
              grid = grid + '<option value="4" ' + nn + '> NN </option>';
              grid = grid + '</select>';
              grid = grid + '</td>';
              grid = grid + '<td id="tdObsDespesa" contenteditable="true" onkeypress="return (this.innerText.length <= 200)">' + despesa.obsDsp + '</td>';

                  /*<td id="tdTotDespesa" bgcolor="#EBEBE4" contenteditable="false" name="totDespesa"></td>
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
              </tbody>*/

            }
            $("#tbDespesa #tbodyDespesas").html(grid);
          }

        });
  }
});

}

/*
function aplicaCorRAT(){
  $("#grdConsultaRAT tr").each(function(){
    var tdSitRAT = $("#grdConsultaRAT tr").find('td:last').text().slice(0,1);
    alert (tdSitRAT);
    if (tdSitRAT = 1){
      $(this).closest('tr').addClass('digitado');
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
}
*/

function excluiAtividade(codAti){
  alert(codAti);

}

function alteraRat(){

}
