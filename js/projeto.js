$("#document").ready(function() {
  $("#formProjeto #btnCadastrar").click(function () {

    var txbProjeto = $("#txbProjeto").val();
    var txbProduto = $("#txbProduto").val();
    var txbDataInicio = $("#txbDataInicio").val();
    var txbCliente = $("#txbCliente").val();
    var txbValorHora = $("#txbValorHora").val();
    var txaObsProjeto = $("#txaObsProjeto").val();

    var msgErro = validaCampos(txbProjeto, txbProduto, txbDataInicio, txbCliente, txbValorHora);

    if(msgErro !== ""){
      jbkrAlert.alerta('Alerta!',msgErro);
    }
    else {
      $.ajax({
          //Tipo de envio POST ou GET
          type: "POST",
          dataType: "text",
          data: {
            projeto: txbProjeto,
            produto: txbProduto,
            dataInicio: txbDataInicio,
            cliente: txbCliente,
            valorHora: txbValorHora,
            obsProjeto: txaObsProjeto,
            action: "cadastrar"
          },

          url: "../controller/ProjetoController.php",

          //Se der tudo ok no envio...
          success: function (dados) {
              jbkrAlert.sucesso('Projeto', 'Projeto cadastrado com sucesso!');
              $("#formProjeto #btnCancelar").trigger("click");
          }
      });
    }


  });

  $("#formProjeto #btnCancelar").click(function(){
    limpaCampos($(this).closest("form"));
    formularioModoInserir();
    buscaProjetos();
  });

  $("#formProjeto #btnAtualizar").click(function () {
    var codigo = $("#hidCodPrj").val();
    var txbProjeto = $("#txbProjeto").val();
    var txbProduto = $("#txbProduto").val();
    var txbDataInicio = $("#txbDataInicio").val();
    var txbCliente = $("#txbCliente").val();
    var txbValorHora = $("#txbValorHora").val();
    var txaObsProjeto = $("#txaObsProjeto").val();

    var msgErro = validaCampos(txbProjeto, txbProduto, txbDataInicio, txbCliente, txbValorHora);

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
            projeto: txbProjeto,
            produto: txbProduto,
            dataInicio: txbDataInicio,
            cliente: txbCliente,
            valorHora: txbValorHora,
            obsProjeto: txaObsProjeto,
            action: "atualizar"
        },

        url: "../controller/ProjetoController.php",

        //Se der tudo ok no envio...
        success: function (dados) {
          jbkrAlert.sucesso('Projeto', 'Projeto atualizado com sucesso!');
          $("#formProjeto #btnCancelar").trigger("click");
        }
      });
    }
  });

  $("#formProjeto #btnBuscar").click(function () {
    buscaProjetos();

  });
  
});

function buscaProjetos(codigo){
    var txbProjeto = $("#txbProjeto").val();
    var txbProduto = $("#txbProduto").val();
    var txbDataInicio = $("#txbDataInicio").val();
    var txbCliente = $("#txbCliente").val();
    var txbValorHora = $("#txbValorHora").val();
    var txaObsProjeto = $("#txaObsProjeto").val();

  $.ajax({
      //Tipo de envio POST ou GET
      type: "POST",
      dataType: "text",
      data: {
            codigo: codigo,
            projeto: txbProjeto,
            produto: txbProduto,
            dataInicio: txbDataInicio,
            cliente: txbCliente,
            valorHora: txbValorHora,
            obsProjeto: txaObsProjeto,
            action: "buscar"
      },

      url: "../controller/ProjetoController.php",

      //Se der tudo ok no envio...
      success: function (dados) {
        var json = $.parseJSON(dados);
        var projeto = null;

        //Carregando a grid
        if(codigo == null){
          var grid = "";
          for (var i = 0; i < json.length; i++) {
            projeto = json[i];

            grid = grid + "<tr>";
            grid = grid + "<td>" + projeto.codPrj + "</td>";
            grid = grid + "<td>" + projeto.nomPrj + "</td>";
            grid = grid + "<td>" + projeto.Produto_codPro + "</td>";
            grid = grid + "<td>" + projeto.Cliente_codCli + "</td>";
            grid = grid + "<td>" + projeto.datIni + "</td>";
            grid = grid + "<td>" + projeto.vlrHor + "</td>";

            grid = grid + "<td href='javascript:void(0);' onClick='buscaProjetos(" + projeto.codPrj + ")'><a>Editar <span class='glyphicon glyphicon-pencil'></span></a></td>";
            grid = grid + "</tr>";

          }

          $("#grdProjeto").html(grid);
        }else{
          formularioModoAtualizar();
          for (var j = 0; j < json.length; j++) {
              projeto = json[j];
              $("#hidCodPrj").val(projeto.codPrj);
              $("#txbProjeto").val(projeto.nomPrj);
              $("#txbProduto").val(projeto.Produto_codPro);
              $("#txbCliente").val(projeto.Cliente_codCli);
              $("#txbDataInicio").val(projeto.datIni);
              $("#txbValorHora").val(projeto.vlrHor);
              $("#txaObsProjeto").val(projeto.obsPrj);
          }

        }

      }
  });

}

function validaCampos(txbProjeto, txbProduto, txbDataInicio, txbCliente, txbValorHora){
    msgErro = "";
    if(txbProjeto === ""){
        msgErro = msgErro + "<b>Projeto</b> é um campo de preenchimento obrigatorio<br/>";
    }
    if(txbProduto === ""){
        msgErro = msgErro + "<b>Produto</b> é um campo de preenchimento obrigatorio<br/>";
    }
    if(txbDataInicio === ""){
        msgErro = msgErro + "<b>Data Inicial</b> é um campo de preenchimento obrigatorio<br/>";
    }
    if(txbCliente === ""){
        msgErro = msgErro + "<b>Cliente</b> é um campo de preenchimento obrigatorio<br/>";
    }
    if(txbValorHora === ""){
        msgErro = msgErro + "<b>Valor Hora</b> é um campo de preenchimento obrigatorio";
    }
    return msgErro;

}
