function submitCliente() {
  var txbNome = $('#txbNome').val();
  var txbResp = $('#txbResp').val();
  var txbEmail = $('#txbEmail').val();
          
    if(validaCampos(txbNome, txbResp, txbEmail)){
          $("#htmlMensagem").html(msgErro);
          $("#divMensagemCadastro").css("display","block"); //JQuery para alterar o tipo do css de none para display
    }
    else {
      $.ajax({
          //Tipo de envio POST ou GET
          type: "POST",
          dataType: "text",
          data: {
               nome: txbNome,
               resp: txbResp,
               email: txbEmail,
             action: "inserir"
          },

          url: "../controller/ClienteController.php",

          //Se der tudo ok no envio...
          success: function (callback) {
          //mensagemSucess();
             $("#htmlMensagem").html("Cliente inserido com sucesso!");
             mensagemSucess();
             $("#btnConsultar").click();
             var form = $("#formCliente");
             limpaCampos(form);
          }
      });  
    }

}

function consultarCliente(){
  var txbNome = $('#txbNome').val();
  var txbResp = $('#txbResp').val();
  var txbEmail = $('#txbEmail').val();

  $.ajax({
        //Tipo de envio POST ou GET
        type: "POST",
        dataType: "text",
        data: {
            nome: txbNome,
            resp: txbResp,
            email: txbEmail,
            action: "consultar"
        },

        url: "../controller/ClienteController.php",

        //Se der tudo ok no envio...
        success: function (callback) {
            var json = $.parseJSON(callback);
            var cliente = null;
            var grid = "";

            for (var i = 0; i < json.length; i++) {
                  cliente = json[i];

                  grid = grid + "<tr>";
                  grid = grid + "<td>" + cliente.nomCli + "</td>";
                  grid = grid + "<td>" + cliente.nomRes + "</td>";
                  grid = grid + "<td>" + cliente.emlRes + "</td>";
                  grid = grid + "</tr>";
            }
            $("#grdCliente").html(grid);
        }
    });

}

function buscarCliente() {
  var txbNome = $('#txbNome').val();
  var txbResp = $('#txbResp').val();
  var txbEmail = $('#txbEmail').val();

  $.ajax({

        type: "POST",
        dataType: "text",
        data: {
            nome: txbNome,
            resp: txbResp,
            email: txbEmail,
            action: "buscar"
        },

        url: "../controller/ClienteController.php",

        //Se der tudo ok no envio...
        success: function (callback) {

             alert(callback);
  }
  
        });

}

$("#btnBuscar").click(function () {
      buscarCliente();
    });

//JQuery para chamar função de limpar tela (geral) passando o parametro do formulario
$("#btnCancelar").click(function(){
//JQuery para limpar tela de erro
  $("#divMensagemCadastro").css("display","none");
  var form = $("#formCliente");
  limpaCampos(form);
});

function validaCampos(nome, resp, email){
    msgErro = "";
    if(nome == ""){
        msgErro = msgErro + "<b>Nome</b> &eacute; um campo de preenchimento obrigat&oacute;rio";
    }
    if(resp == ""){
        msgErro = msgErro + "</br><b>Respons&aacute;vel</b> &eacute; um campo de preenchimento obrigat&oacute;rio";
    }
    if(email == ""){
        msgErro = msgErro + "</br><b>E-mail</b> &eacute; um campo de preenchimento obrigat&oacute;rio";
    }
// Validação de e-mail   
 else {
         if(!validaEmail(email)){
        msgErro = msgErro + "</br><b>E-mail</b> invalido";
      }
    }
    return msgErro;

}

