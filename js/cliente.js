function submitCliente() {
  var txbNome = document.getElementById("txbNome").value;
  var txbResp = document.getElementById("txbResp").value; 
  var txbEmail = document.getElementById("txbEmail").value;
          
    if(validaCampos(txbNome, txbResp, txbEmail)){
        document.getElementById("htmlErro").innerHTML = msgErro;
      //JQuery para alterar o tipo do css de none para display
          $("#divMensagemCadastro").css("display","block");
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
            
            alert(callback); 
            $("#btnConsultar").click();
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
            alert(callback);
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

//JQuery para consultar (Abre um ajax com método POST para o controller chamar a persistencia, ler arquivo json e retornar o callback (body da tabela))
/*
$("#btnConsultar").click(function(){
  $.ajax({
          //Tipo de envio POST ou GET
          type: "POST",
          dataType: "text",
          data: {
             action: "consultar"
          },

          url: "../controller/ClienteController.php",

          //Se der tudo ok no envio...
          success: function (callback) {
            
            var json = $.parseJSON(callback); 
            var grid = "";
            for (var i = 0; i < json.length; i++) {
                var cliente = json[i];

                grid = grid + "<tr>";
                grid = grid + "<td>" + cliente.nome + "</td>";
                grid = grid + "<td>" + cliente.resp + "</td>";
                grid = grid + "<td>" + cliente.email + "</td>";
                grid = grid + "</tr>";

             }

             $("#grdCliente").html(grid);
              
          }
      });  
    
});
*/

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

