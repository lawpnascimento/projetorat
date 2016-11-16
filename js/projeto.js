function submitProjeto() {
  var txbProjeto = $('#txbProjeto').val();
  var txbProduto = $('#txbProduto').val();
  var txbDataIni = $('#txbDataIni').val();
  var cbbCliente = $("#cbbCliente").val();
   
    if(validaCampos(txbProjeto, txbProduto, txbDataIni)){
          $("#htmlMensagem").html(msgErro);
          $("#divMensagemCadastro").css("display","block"); //JQuery para alterar o tipo do css de none para display
    }
    else {
      $.ajax({
          //Tipo de envio POST ou GET
          type: "POST",
          dataType: "text",
          data: {
                projeto: txbProjeto,
                produto: txbProduto,
                dataInicio: txbDataIni,
                cliente: cbbCliente,
              action: "inserir"
          },

          url: "../controller/ProjetoController.php",

          //Se der tudo ok no envio...
          success: function (callback) {
             $("#htmlMensagem").html("Cliente inserido com sucesso!");
             mensagemSucess();
             $("#btnConsultar").click();
             var form = $("#formCliente");
             limpaCampos(form);

            var json = JSON.stringify(callback);

          }
      }); 
    }
}

//JQuery para chamar função de limpar tela (geral) passando o parametro do formulario
$("#btnCancelar").click(function(){
//JQuery para limpar tela de erro
  $("#divMensagemCadastro").css("display","none");
  var form = $("#formProjeto");
  limpaCampos(form);
});

function buscaClienteDropdown(){
  $.ajax({
        //Tipo de envio POST ou GET
        type: "POST",
        dataType: "text",
        data: {
            action: "clientedropdown"
        },

        url: "../controller/ProjetoController.php",

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

$(document).ready(function(){
  var today = new Date();
  document.getElementById("txbDataIni").value = [today.getDate(), today.getMonth()+1, today.getFullYear()].join('-');
});

function validaCampos(projeto, produto, dataini){
    msgErro = "";
    if(projeto == ""){
        msgErro = msgErro + "<b>Projeto</b> &eacute; um campo de preenchimento obrigat&oacute;rio";
    }
    if(produto == ""){
        msgErro = msgErro + "</br><b>Produto</b> &eacute; um campo de preenchimento obrigat&oacute;rio";
    }
    if(dataini == ""){
        msgErro = msgErro + "</br><b>Data Inicial</b> &eacute; um campo de preenchimento obrigat&oacute;rio";
    }

    return msgErro;

}