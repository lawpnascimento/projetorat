function submitCliente() {
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
         action: "inserir"
      },

      url: "../controller/ClienteController.php",

      //Se der tudo ok no envio...
      success: function (callback) {
        alert("chegou");
          //var json = $.parseJSON(callback);
            var json = JSON.stringify(callback);
          for (var i = 0; i < json.length; i++) {

              var perfil = json[i];
          }
      }
  });  
}

function validaEmail(email)
{
    var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    return regex.test(email);
}

function validaCampos(nome, resp, email){
    msgErro = "";
    if(nome == ""){
        msgErro = msgErro + "<b>Nome</b> e um campo de preenchimento obrigatorio";
    }
    if(resp == ""){
        msgErro = msgErro + "</br><b>Responsavel</b> e um campo de preenchimento obrigatorio";
    }
    if(email == ""){
        msgErro = msgErro + "</br><b>E-mail</b> e um campo de preenchimento obrigatorio";
    }

    return msgErro;

}