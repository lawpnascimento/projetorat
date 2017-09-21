$("#document").ready(function() {
    $("#formPerfil #btnAtualizar").click(function () {
        var txbNome = $("#txbNome").val();
        var txbSobrenome = $("#txbSobrenome").val();
        var txbSenha = $("#txbSenha").val();
        var txbSenhaConfirma = $("#txbSenhaConfirma").val();
        var txbEmail = $("#txbEmail").val();

        var msgErro = validaCampos(txbNome, txbSobrenome, txbSenha, txbSenhaConfirma, txbEmail);

        if(msgErro != ""){
            jbkrAlert.alerta('Alerta!',msgErro);
        }
        else{
            $.ajax({
                //Tipo de envio POST ou GET
                type: "POST",
                dataType: "text",
                data: {
                    nome: txbNome,
                    sobrenome: txbSobrenome,
                    senha: txbSenha,
                    email: txbEmail,
                    action: "atualizar"
                },

                url: "../controller/PerfilController.php",

                //Se der tudo ok no envio...
                success: function (callback) {
                    jbkrAlert.sucesso('Perfil', 'Perfil atualizado com sucesso!');
                    $("#formPerfil #btnCancelar").trigger("click");
                }
            });
        }
    });

    $("#formPerfil #btnCancelar").click(function(){
     limpaCampos($(this).closest("form"));
     buscaPerfil();
 });

});

function buscaPerfil(codigo){
  var txbNome = $("#txbNome").val();
  var txbSobrenome = $("#txbSobrenome").val();
  var txbSenha = $("#txbSenha").val();
  var txbEmail = $("#txbEmail").val();
  var txbPapel = $("#txbPapel").val();

  $.ajax({
            //Tipo de envio POST ou GET
            type: "POST",
            dataType: "text",
            data: {
                action: "buscar"
            },

            url: "../controller/PerfilController.php",

            //Se der tudo ok no envio...
            success: function (callback) {
                var json = $.parseJSON(callback);

                for (var i = 0; i < json.length; i++) {

                    var perfil = json[i];

                    $("#txbNome").val(perfil.nomUsu);
                    $("#txbSobrenome").val(perfil.sobrenomeUsu);
                    $("#txbEmail").val(perfil.desEml);
                    $("#txbPapel").val(perfil.desPap);
                }
            }
        });

};

function validaCampos(txbNome, txbSobrenome, txbSenha, txbSenhaConfirma, txbEmail){
    msgErro = "";
    if(txbNome == ""){
        msgErro = msgErro + "<b>Nome</b> é um campo de preenchimento obrigatorio<br/>";
    }
    if(txbSobrenome == ""){
        msgErro = msgErro + "<b>Sobrenome</b> é um campo de preenchimento obrigatorio<br/>";
    }
    if(txbEmail == ""){
        msgErro = msgErro + "<b>Email</b> é um campo de preenchimento obrigatorio<br/>";
    }
    else if(!validaEmail(txbEmail)){
        msgErro = msgErro + "<b>E-mail</b> deve ser válido<br/>";
    }
    if(txbSenha != txbSenhaConfirma){
        msgErro = msgErro + "<b>Senhas</b> não coincidem<br/>";
    }
    return msgErro;

};