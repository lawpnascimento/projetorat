$("#document").ready(function(){
	$("#txbValorUnitario").mask('###0.00', {reverse: true});

  $("#formDespesa #btnCadastrar").click(function () {
      
    var cbbTipoDespesa = $("#cbbTipoDespesa").val();  
    var txbDescricaoDespesa = $("#txbDescricaoDespesa").val();
    var txbValorUnitario = $("#txbValorUnitario").val();

    var msgErro = validaCampos(cbbTipoDespesa, txbDescricaoDespesa, txbValorUnitario);

    if(msgErro !== ""){
      jbkrAlert.alerta('Alerta!',msgErro);
    }
    else {
      $.ajax({
          //Tipo de envio POST ou GET
          type: "POST",
          dataType: "text",
          data: {
            tipoDespesa: cbbTipoDespesa,
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
    var cbbTipoDespesa = $("#cbbTipoDespesa").val();
    var txbDescricaoDespesa = $("#txbDescricaoDespesa").val();
    var txbValorUnitario = $("#txbValorUnitario").val();

    var msgErro = validaCampos(cbbTipoDespesa, txbDescricaoDespesa, txbValorUnitario);

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
            tipoDespesa: cbbTipoDespesa,
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
    var cbbTipoDespesa = $("#cbbTipoDespesa").val();

  $.ajax({
      //Tipo de envio POST ou GET
      type: "POST",
      dataType: "text",
      data: {
          codigo: codigo,
          tipoDespesa: cbbTipoDespesa,
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
            grid = grid + "<td>" + despesa.codTipDsp + "</td>";
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
              $("#cbbTipoDespesa:first-child").val(despesa.codTipDsp);
              $("#cbbTipoDespesa:first-child").text(despesa.desTipDsp);
              $("#txbDescricaoDespesa").val(despesa.desDsp);
              $("#txbValorUnitario").val(despesa.vlrUni);
          }

        }

      }
  });

}

function buscaDespesaDropdown(){
  $.ajax({
        //Tipo de envio POST ou GET
        type: "POST",
        dataType: "text",
        data: {
            action: "tipodespesadropdown"
        },

        url: "../controller/DespesaController.php",

        //Se der tudo ok no envio...
        success: function (dados) {
            var json = $.parseJSON(dados);

            var dropdown = "";
            for (var i = 0; i < json.length; i++) {

                var tipodespesa = json[i];

                dropdown = dropdown + '<li role="presentation" value="' + tipodespesa.codTipDsp  + '"><a role="menuitem" tabindex="-1" href="#">' + tipodespesa.desTipDsp + '</a></li>';

            }
            $("#ulTipoDespesa").html(dropdown);

            $("#ulTipoDespesa li a").click(function(){
                $("#cbbTipoDespesa:first-child").text($(this).text());

                $("#ulTipoDespesa li").each(function(){

                    if ($(this).text() == $("#cbbTipoDespesa").text().trim()){
                        $("#cbbTipoDespesa").val($(this).val());
                    }
                });

            });
        }

    });
}

function validaCampos(cbbTipoDespesa, txbDescricaoDespesa, txbValorUnitario){
    msgErro = "";
    if(cbbTipoDespesa === ""){
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