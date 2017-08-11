$("#document").ready(function(){
	$("#txbValorUnitario").mask('#.##0,00', {reverse: true});

    $("#formDespesa #btnCadastrar").click(function () {
      
    var txbDescricaoDespesa = $("#txbDescricaoDespesa").val();
    var txbValorUnitario = $("#txbValorUnitario").val();

    var msgErro = validaCampos(txbDescricaoDespesa, txbValorUnitario);

    if(msgErro !== ""){
      jbkrAlert.alerta('Alerta!',msgErro);
    }
    else {
      $.ajax({
          //Tipo de envio POST ou GET
          type: "POST",
          dataType: "text",
          data: {
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

    $("#formDespesa #btnBuscar").click(function () {
    limpaCampos($(this).closest("form"));
    formularioModoInserir();
    buscaDespesas();

   });

});

function buscaDespesas(codigo){
    var txbDescricaoDespesa = $("#txbDescricaoDespesa").val();
    var txbValorUnitario = $("#txbValorUnitario").val();

  $.ajax({
      //Tipo de envio POST ou GET
      type: "POST",
      dataType: "text",
      data: {
          codigo: codigo,
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
            grid = grid + "<td>" + despesa.desDsp + "</td>";
            grid = grid + "<td>" + despesa.vlrUni + "</td>";
            grid = grid + "<td href='javascript:void(0);' onClick='buscaDespesas(" + despesa.desDsp + ")'><a>Editar <span class='glyphicon glyphicon-pencil'></span></a></td>";
            grid = grid + "</tr>";

          }

          $("#grdDespesa").html(grid);
        }else{
          formularioModoAtualizar();
          for (var j = 0; j < json.length; j++) {
              produto = json[j];
              $("#hidCodDsp").val(despesa.desDsp);
              $("#txbDescricaoDespesa").val(despesa.desDsp);
          }

        }

      }
  });

}

function validaCampos(txbDescricaoDespesa, txbValorUnitario){
    msgErro = "";
    if(txbDescricaoDespesa === ""){
        msgErro = msgErro + "<b>Descrição da despesa</b> é um campo de preenchimento obrigatorio<br/>";
    }
    if(txbValorUnitario === ""){
        msgErro = msgErro + "<b>Valor Unitário</b> é um campo de preenchimento obrigatorio<br/>";
    }

    return msgErro;

}