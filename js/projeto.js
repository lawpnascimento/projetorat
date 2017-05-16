$("#document").ready(function() {
  $("#formProjeto #btnCadastrar").click(function () {

    var txbProjeto = $("#txbProjeto").val();
    var txbProduto = $("#txbProduto").val();
    var txbDataInicio = $("#txbDataInicio").val();
    var txbCliente = $("#txbCliente").val();

    var msgErro = validaCampos(txbProjeto, txbProduto, txbDataInicio, txbCliente);

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
    var txbProjeto = $("#txbProjeto").val();
    var txbProduto = $("#txbProduto").val();
    var txbDataInicio = $("#txbDataInicio").val();
    var txbCliente = $("#txbCliente").val();

    var msgErro = validaCampos(txbProjeto, txbProduto, txbDataInicio, txbCliente);

    if(msgErro !== ""){
        jbkrAlert.alerta('Alerta!',msgErro);
    }
    else{
      $.ajax({
        //Tipo de envio POST ou GET
        type: "POST",
        dataType: "text",
        data: {
            projeto: txbProjeto,
            produto: txbProduto,
            dataInicio: txbDataInicio,
            cliente: txbCliente,
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
            grid = grid + "<td>" + projeto.desRazaoSocial  + "</td>";
            grid = grid + "<td>" + projeto.nomCli + "</td>";
            grid = grid + "<td>" + projeto.numCNPJ         + "</td>";
            grid = grid + "<td>" + projeto.numCNPJ         + "</td>";
            grid = grid + "<td>" + projeto.numCNPJ         + "</td>";
            grid = grid + "<td href='javascript:void(0);' onClick='buscaProjetos(" + projeto.codCli + ")'><a>Editar <span class='glyphicon glyphicon-pencil'></span></a></td>";
            grid = grid + "</tr>";

          }

          $("#grdProjeto").html(grid);
        }else{
          formularioModoAtualizar();
          for (var j = 0; j < json.length; j++) {
              cliente = json[j];
              $("#hidCodCli").val(cliente.codCli);
              $("#txbProjeto").val(cliente.desRazaoSocial);
              $("#txbProduto").val(cliente.nomCli);
              $("#txbDataInicio").val(cliente.numCNPJ);
              $("#txbCliente").val(cliente.iesCli);
          }

        }

      }
  });

}

function validaCampos(txbProjeto, txbProduto, txbDataInicio, txbCliente){
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
        msgErro = msgErro + "<b>Cliente</b> é um campo de preenchimento obrigatorio";
    }

    return msgErro;

}
