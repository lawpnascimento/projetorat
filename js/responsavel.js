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
