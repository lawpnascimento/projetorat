$("#document").ready(function() {
    buscaPerfil();

$("#formPerfil #btnAtualizar").click(function () {
    alert("teste");
    var txbNome = $("#txbNome");
    var txbSobrenome = $("#txbSobrenome");
    var txbSenha = $("#txbSenha");
    var txbEmail = $("#txbEmail");

    var msgErro = validaCampos(txbNome, txbSobrenome, txbSenha, txbEmail);

    if(msgErro != ""){
        jbkrAlert.alerta('Alerta!',msgErro);
    }
    else{
        $.ajax({
            //Tipo de envio POST ou GET
            type: "POST",
            dataType: "text",
            data: {
                email: txbEmail.val(),
                nome: txbNome.val(),
                sobrenome: txbSobrenome.val(),
                cpf: txbCpf.val(),
                telefone: txbTelefone.val(),
                action: "atualizar"
            },

            url: "../controller/PerfilController.php",

            //Se der tudo ok no envio...
            success: function (callback) {
                jbkrAlert.sucesso('Perfil', 'Perfil atualizado com sucesso!');
            }
        });
    }
});

});

function buscaPerfil(codigo){
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

                    $("#txbNome").val(perfil.dsNome);
                    $("#txbSobrenome").val(perfil.dsSobrenome);
                    $("#txbEmail").val(perfil.dsEmail);
                    $("#txbCpf").val(perfil.nrCpf);
                    $("#txbTelefone").val(perfil.nrTelefone);

                }
            }
        });

    };

function validaCampos(txbNome, txbSobrenome, txbSenha, txbEmail){
    msgErro = "";
    if(txbNome == ""){
        msgErro = msgErro + "<b>Nome</b> é um campo de preenchimento obrigatorio<br/>";
    }
    if(txbSobrenome == ""){
        msgErro = msgErro + "<b>Sobrenome</b> é um campo de preenchimento obrigatorio<br/>";
    }
    if(txbSenha == ""){
        msgErro = msgErro + "<b>Senha</b> é um campo de preenchimento obrigatorio<br/>";
    }
    if(txbEmail == ""){
        msgErro = msgErro + "<b>Email</b> é um campo de preenchimento obrigatorio<br/>";
    }
    return mensagem;

};
