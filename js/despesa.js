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

		});

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