$("#document").ready(function(){

  $("#formTipoDespesa #btnCadastrar").click(function () {
    
    var txbDescricaoTipoDespesa = $("#txbDescricaoTipoDespesa").val();

    var msgErro = validaCampos(txbDescricaoTipoDespesa);

    if(msgErro !== ""){
      jbkrAlert.alerta('Alerta!',msgErro);
    }
    else {
      $.ajax({
          //Tipo de envio POST ou GET
          type: "POST",
          dataType: "text",
          data: {
            descricao: txbDescricaoTipoDespesa,
            
            action: "cadastrar"
          },

          url: "../controller/TipoDespesaController.php",

          //Se der tudo ok no envio...
          success: function (dados) {
            jbkrAlert.sucesso('TipoDespesa', 'Tipo da despesa cadastrado com sucesso!');
            $("#formTipoDespesa #btnCancelar").trigger("click");
          }
        });
    }

  });

  $("#formTipoDespesa #btnBuscar").click(function () {
    buscaTipoDespesas();

  });

});

$("#formTipoDespesa #btnAtualizar").click(function () {

  var codigo = $("#hidCodTipDsp").val();
  var txbDescricaoTipoDespesa = $("#txbDescricaoTipoDespesa").val();

  var msgErro = validaCampos(txbDescricaoTipoDespesa);

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
          descricao: txbDescricaoTipoDespesa,

          action: "atualizar"
        },

        url: "../controller/TipoDespesaController.php",

        //Se der tudo ok no envio...
        success: function (dados) {
          jbkrAlert.sucesso('TipoDespesa', 'Tipo da despesa atualizado com sucesso!');
          $("#formTipoDespesa #btnCancelar").trigger("click");
        }
      });
  }
});

$("#formTipoDespesa #btnCancelar").click(function () {
  limpaCampos($(this).closest("form"));
  formularioModoInserir();
  buscaTipoDespesas();

});

function buscaTipoDespesas(codigo){
  var txbDescricaoTipoDespesa = $("#txbDescricaoTipoDespesa").val();

  $.ajax({
      //Tipo de envio POST ou GET
      type: "POST",
      dataType: "text",
      data: {
        codigo: codigo,
        descricao: txbDescricaoTipoDespesa,

        action: "buscar"
      },

      url: "../controller/TipoDespesaController.php",

      //Se der tudo ok no envio...
      success: function (dados) {
        var json = $.parseJSON(dados);
        var tipodespesa = null;

        //Carregando a grid
        if(codigo == null){
          var grid = "";
          for (var i = 0; i < json.length; i++) {
            tipodespesa = json[i];

            grid = grid + "<tr>";
            grid = grid + "<td>" + tipodespesa.codTipDsp + "</td>";
            grid = grid + "<td>" + tipodespesa.desTipDsp + "</td>";
            grid = grid + "<td href='javascript:void(0);' onClick='buscaTipoDespesas(" + tipodespesa.codTipDsp + ")'><a>Editar <span class='glyphicon glyphicon-pencil'></span></a></td>";
            grid = grid + "</tr>";

          }

          $("#grdTipoDespesa").html(grid);
        }else{
          formularioModoAtualizar();
          for (var j = 0; j < json.length; j++) {
            tipodespesa = json[j];
            $("#hidCodTipDsp").val(tipodespesa.codTipDsp);
            $("#txbDescricaoTipoDespesa").val(tipodespesa.desTipDsp);
          }

        }

      }
    });

}

function validaCampos(txbDescricaoTipoDespesa){
  msgErro = "";
  if(txbDescricaoTipoDespesa === ""){
    msgErro = msgErro + "<b>Descrição do tipo da despesa</b> é um campo de preenchimento obrigatorio<br/>";
  }

  return msgErro;

}