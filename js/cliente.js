function submitCliente() {
  var txbNome = document.getElementById("txbNome").value;
  var txbResp = document.getElementById("txbResp").value; 
  var txbEmail = document.getElementById("txbEmail").value;
          
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
             $("#divMensagemCadastro").css("display","block");
             $("#divMensagemCadastro").removeClass("alert alert-danger");
             $("#divMensagemCadastro").addClass("alert alert-success");
             $("#btnConsultar").click();
             var form = $("#formCliente");
             limpaCampos(form);
          }
      });  
    }

}

function buscaCliente(){
  var txbNome = document.getElementById("txbNome").value;
  var txbResp = document.getElementById("txbResp").value; 
  var txbEmail = document.getElementById("txbEmail").value;

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

            //Carregando a grid
            /*if(cdAnimal == null){

                var grid = "";
                for (var i = 0; i < json.length; i++) {
                    animal = json[i];

                    grid = grid + "<tr>";
                    grid = grid + "<td>" + animal.dsNome + "</td>";
                    grid = grid + "<td>" + animal.dsRaca + "</td>";
                    grid = grid + "<td>" + animal.nrIdade + "</td>";
                    grid = grid + "<td>" + animal.dsPorte + "</td>";
                    grid = grid + "<td href='javascript:void(0);' onClick='buscaAnimais(" + animal.cdAnimal + ")'><a>Editar</a></td>";
                    grid = grid + "</tr>";
                }
                $("#tbanimal").html(grid);
            }
            //Carregando valor para atualizar
            else
            {
                formularioModoAtualizar();
                for (var i = 0; i < json.length; i++) {
                    animal = json[i];

                    $("#txbNome").val(animal.dsNome);
                    $("#txbRaca").val(animal.dsRaca);
                    $("#txbIdade").val(animal.nrIdade);

                    $("#ddlPorte:first-child").text(animal.dsPorte);
                    $("#ddlPorte:first-child").val(animal.cdPorte);
                    $("#hdfcdAnimal").val(animal.cdAnimal);
                }
            }*/
        }
    });

}

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

