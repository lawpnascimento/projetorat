$("#document").ready(function(){
	$("#txbValorUnitario").mask('###0,00', {reverse: true});

  $("#formDespesa #btnCadastrar").click(function () {
      
    var txbDescricaoDespesa = $("#txbDescricaoDespesa").val();
    var txbValorUnitario = $("#txbValorUnitario").val();
    var txbTipoDespesa = $("#txbTipoDespesa").val();

    var msgErro = validaCampos(txbDescricaoDespesa, txbValorUnitario, txbTipoDespesa);

    if(msgErro !== ""){
      jbkrAlert.alerta('Alerta!',msgErro);
    }
    else {
      $.ajax({
          //Tipo de envio POST ou GET
          type: "POST",
          dataType: "text",
          data: {
            tipoDespesa: txbTipoDespesa,
            descricao: txbDescricaoDespesa,
            valorUnitario: txbValorUnitario,

            action: "cadastrar"
          },

          url: "../controller/DespesaController.php",

          //Se der tudo ok no envio...
          success: function (dados) {
              jbkrAlert.sucesso('Despesa', 'Despesa cadastrada com sucesso!');
              $("#formDespesa #btnCancelar").trigger("click");
          }
      });
    }

  });

  $("#formDespesa #btnCancelar").click(function () {
    limpaCampos($(this).closest("form"));
    formularioModoInserir();
    buscaDespesas();

   });

  $("#formDespesa #btnAtualizar").click(function () {

    var codigo = $("#hidCodDsp").val();
    var txbDescricaoDespesa = $("#txbDescricaoDespesa").val();
    var txbValorUnitario = $("#txbValorUnitario").val();
    var txbTipoDespesa = $("#txbTipoDespesa").val();

    var msgErro = validaCampos(txbDescricaoDespesa, txbValorUnitario, txbTipoDespesa);

    if(msgErro !== ""){
        jbkrAlert.alerta('Alerta!',msgErro);
    }
    else{
      $.ajax({
        //Tipo de envio POST ou GET
        type: "POST",
        dataType: "text",
        data: {
            codigo: codigo,
            tipoDespesa: txbTipoDespesa,
            descricao: txbDescricaoDespesa,
            valorUnitario: txbValorUnitario,
            action: "atualizar"
        },

        url: "../controller/DespesaController.php",

        //Se der tudo ok no envio...
        success: function (dados) {
          jbkrAlert.sucesso('Despesa', 'Despesa atualizada com sucesso!');
          $("#formDespesa #btnCancelar").trigger("click");
        }
      });
    }
  });

});


function buscaDespesas(codigo){
    var txbDescricaoDespesa = $("#txbDescricaoDespesa").val();
    var txbValorUnitario = $("#txbValorUnitario").val();
    var txbTipoDespesa = $("#txbTipoDespesa").val();

  $.ajax({
      //Tipo de envio POST ou GET
      type: "POST",
      dataType: "text",
      data: {
          codigo: codigo,
          tipoDespesa: txbTipoDespesa,
          descricao: txbDescricaoDespesa,
          valorUnitario: txbValorUnitario,

          action: "buscar"
      },

      url: "../controller/DespesaController.php",

      //Se der tudo ok no envio...
      success: function (dados) {
        var json = $.parseJSON(dados);
        var despesa = null;

        //Carregando a grid
        if(codigo == null){
          var grid = "";
          for (var i = 0; i < json.length; i++) {
            despesa = json[i];

            grid = grid + "<tr>";
            grid = grid + "<td>" + despesa.codDsp + "</td>";      
            grid = grid + "<td>" + despesa.Tipodespesa_CodTipDsp + "</td>";
            grid = grid + "<td>" + despesa.desDsp + "</td>";
            grid = grid + "<td>" + despesa.vlrUni + "</td>";
            grid = grid + "<td href='javascript:void(0);' onClick='buscaDespesas(" + despesa.codDsp + ")'><a>Editar <span class='glyphicon glyphicon-pencil'></span></a></td>";
            grid = grid + "</tr>";

          }

          $("#grdDespesa").html(grid);
        }else{
          formularioModoAtualizar();
          for (var j = 0; j < json.length; j++) {
              despesa = json[j];
              $("#hidCodDsp").val(despesa.codDsp);
              $("#txbTipoDespesa").val(despesa.Tipodespesa_CodTipDsp);
              $("#txbDescricaoDespesa").val(despesa.desDsp);
              $("#txbValorUnitario").val(despesa.vlrUni);
          }

        }

      }
  });

}

function validaCampos(txbTipoDespesa, txbDescricaoDespesa, txbValorUnitario){
    msgErro = "";
    if(txbTipoDespesa === ""){
        msgErro = msgErro + "<b>Tipo da despesa</b> é um campo de preenchimento obrigatorio<br/>";
    }
    if(txbDescricaoDespesa === ""){
        msgErro = msgErro + "<b>Descrição da despesa</b> é um campo de preenchimento obrigatorio<br/>";
    }
    if(txbValorUnitario === ""){
        msgErro = msgErro + "<b>Valor Unitário</b> é um campo de preenchimento obrigatorio<br/>";
    }

    return msgErro;

}