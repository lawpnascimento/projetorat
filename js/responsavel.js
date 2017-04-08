$("#document").ready(function() {
  $("#formResponsavel #btnCadastrar").click(function () {
    var txbNomRes = $("#txbNomRes").val();
    var txbEmail = $("#txbEmail").val();
    var cbbCliente = $("#cbbCliente").val();

    var msgErro = validaCampos(txbNomRes, txbEmail, cbbCliente);

    if(msgErro !== ""){
      jbkrAlert.alerta('Alerta!',msgErro);
    }
    else {
      $.ajax({
      	  //Tipo de envio POST ou GET
          type: "POST",
          dataType: "text",
          data: {
            nomRes: txbNomRes,
            email: txbEmail,
            codCli: cbbCliente,
            action: "cadastrar"
          },

          url: "../controller/ResponsavelController.php",

          //Se der tudo ok no envio...
          success: function (dados) {
            $("#formResponsavel #btnCancelar").trigger("click");
              jbkrAlert.sucesso('Responsavel', 'Responsavel cadastrado com sucesso!');
          }
      });
    }

  });

  $("#formResponsavel #btnCancelar").click(function(){
    limpaCampos($(this).closest("form"));
    formularioModoInserir();
    buscaResponsavel();
  });

  $("#formResponsavel #btnBuscar").click(function () {
    buscaResponsavel();

  });

  $("#formResponsavel #btnAtualizar").click(function () {
    var codigo = $("#hidCodRes").val();
    var txbNomRes = $("#txbNomRes").val();
    var txbEmail = $("#txbEmail").val();
    var cbbCliente = $("#cbbCliente").val();

    var msgErro = validaCampos(txbNomRes, txbEmail, cbbCliente);

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
          nomRes: txbNomRes,
          email: txbEmail,
          codCli: cbbCliente,
          action: "atualizar"
        },

        url: "../controller/ResponsavelController.php",

        //Se der tudo ok no envio...
        success: function (dados) {
          jbkrAlert.sucesso('Responsavel', 'Responsavel atualizado com sucesso!');
          $("#formResponsavel #btnCancelar").trigger("click");
        }
      });
    }
  });

});

function buscaClienteDropdown(){
  $.ajax({
        //Tipo de envio POST ou GET
        type: "POST",
        dataType: "text",
        data: {
            action: "clientedropdown"
        },

        url: "../controller/ResponsavelController.php",

        //Se der tudo ok no envio...
        success: function (dados) {
            var json = $.parseJSON(dados);

            var dropdown = "";
            for (var i = 0; i < json.length; i++) {

                var cliente = json[i];

                dropdown = dropdown + '<li role="presentation" value="' + cliente.codCli  + '"><a role="menuitem" tabindex="-1" href="#">' + cliente.nomCli + '</a></li>';

            }
            $("#ulCliente").html(dropdown);

            $("#ulCliente li a").click(function(){

                $("#cbbCliente:first-child").text($(this).text());

                $("#ulCliente li").each(function(){

                    if ($(this).text() == $("#cbbCliente").text().trim()){
                        $("#cbbCliente").val($(this).val());
                    }
                });

            });
        }

    });
}

function buscaResponsavel(codigo){
  var txbNomRes = $("#txbNomRes").val();
  var txbEmail = $("#txbEmail").val();
  var cbbCliente = $("#cbbCliente").val();

  $.ajax({
      //Tipo de envio POST ou GET
      type: "POST",
      dataType: "text",
      data: {
          codigo: codigo,
          nomRes: txbNomRes,
          email: txbEmail,
          codCli: cbbCliente,
          action: "buscar"
      },

      url: "../controller/ResponsavelController.php",

      //Se der tudo ok no envio...
      success: function (dados) {
        var json = $.parseJSON(dados);
        var responsavel = null;

        //Carregando a grid
        if(codigo == null){
          var grid = "";
          for (var i = 0; i < json.length; i++) {
            responsavel = json[i];

            grid = grid + "<tr>";
            grid = grid + "<td>" + responsavel.nomCli  + "</td>";
            grid = grid + "<td>" + responsavel.nomRes  + "</td>";
            grid = grid + "<td>" + responsavel.emlRes + "</td>";
            grid = grid + "<td href='javascript:void(0);' onClick='buscaResponsavel(" + responsavel.codRes + ")'><a>Editar</a></td>";
            grid = grid + "</tr>";

          }
          $("#grdResponsavel").html(grid);
        }else{
          formularioModoAtualizar();
          for (var j = 0; j < json.length; j++) {
              responsavel = json[j];

              $("#txbNomRes").val(responsavel.nomRes);
              $("#txbEmail").val(responsavel.emlRes);
              $("#cbbCliente:first-child").text(responsavel.nomCli);
              $("#cbbCliente:first-child").val(responsavel.codCli);
              $("#hidCodRes").val(responsavel.codRes);

          }

        }

      }
  });

}

function validaCampos(txbNomRes, txbEmail, cbbCliente){
    msgErro = "";
    if(txbNomRes === ""){
        msgErro = msgErro + "<b>Nome do responsavel</b> é um campo de preenchimento obrigatorio<br/>";
    }
    if(txbEmail === ""){
        msgErro = msgErro + "<b>E-mail</b> é um campo de preenchimento obrigatorio<br/>";
    }
    if(cbbCliente === ""){
        msgErro = msgErro + "<b>Cliente</b> é um campo de preenchimento obrigatorio";
    }

    return msgErro;

}
