$("#document").ready(function() {
  $("#formResponsavel #btnCadastrar").click(function () {

    var txbNomRes = $("#txbNomRes").val();
    var txbEmail = $("#txbEmail").val();
    var txbCnpj = $("#cbbCliente").val();

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
            cliente: cbbCliente,
            action: "cadastrar"
          },

          url: "../controller/ResponsavelController.php",

          //Se der tudo ok no envio...
          success: function (dados) {
              alert(dados);
              jbkrAlert.sucesso('Responsavel', 'Responsavel cadastrado com sucesso!');
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

        url: "../controller/ReponsavelController.php",

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

