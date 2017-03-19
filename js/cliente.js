$("#document").ready(function() {
  $("#formCliente #btnCadastrar").click(function () {

    var txbRazaoSocial = $("#txbRazaoSocial").val();
    var txbNomeFantasia = $("#txbNomeFantasia").val();
    var txbCnpj = $("#txbCnpj").val();
    var txbInscricao = $("#txbInscricao").val();
    var txbCep = $("#txbCep").val();
    var txbUf = $("#txbUf").val();
    var txbCidade = $("#txbCidade").val();
    var txbBairro = $("#txbBairro").val();
    var txbRua = $("#txbRua").val();
    var txbNumero = $("#txbNumero").val();
    var txbTelefone = $("#txbTelefone").val();

    var msgErro = validaCampos(txbRazaoSocial, txbNomeFantasia, txbCnpj, txbInscricao, txbCep, txbUf, txbCidade, txbBairro, txbRua, txbNumero, txbTelefone);

    if(msgErro !== ""){
      jbkrAlert.alerta('Alerta!',msgErro);
    }
    else {
      $.ajax({
          //Tipo de envio POST ou GET
          type: "POST",
          dataType: "text",
          data: {
            razaoSocial: txbRazaoSocial,
            nomeFantasia: txbNomeFantasia,
            cnpj: txbCnpj,
            inscricao: txbInscricao,
            cep: txbCep,
            uf: txbUf,
            cidade: txbCidade,
            bairro: txbBairro,
            rua: txbRua,
            numero: txbNumero,
            telefone: txbTelefone,
            action: "cadastrar"
          },

          url: "../controller/ClienteController.php",

          //Se der tudo ok no envio...
          success: function (dados) {
              alert(dados);
              jbkrAlert.sucesso('Cliente', 'Cliente cadastrado com sucesso!');
            /*  $("#formCliente #btnCancelar").trigger("click");*/
          }
      });
    }


  });
});

function buscaClientes(){
    $.ajax({
        //Tipo de envio POST ou GET
        type: "POST",
        dataType: "text",
        data: {
            action: "buscar"
        },

        url: "../controller/ClienteController.php",

        //Se der tudo ok no envio...
        success: function (dados) {
          var json = $.parseJSON(dados);
          var cliente = null;

          //Carregando a grid
          var grid = "";
          for (var i = 0; i < json.length; i++) {
            cliente = json[i];

            grid = grid + "<tr>";
            grid = grid + "<td>" + cliente.desRazaoSocial  + "</td>";
            grid = grid + "<td>" + cliente.nomCli + "</td>";
            grid = grid + "<td>" + cliente.numCNPJ         + "</td>";
            grid = grid + "<td href='javascript:void(0);' onClick='buscaClientes(" + cliente.codCli + ")'><a>Editar</a></td>";
            grid = grid + "</tr>";

          }

          $("#grdCliente").html(grid);

        }
    });

}

function validaCampos(txbRazaoSocial, txbNomeFantasia, txbCnpj, txbInscricao, txbCep, txbUf, txbCidade, txbBairro, txbRua, txbNumero, txbTelefone){
    msgErro = "";
    if(txbRazaoSocial === ""){
        msgErro = msgErro + "<b>Razão Social</b> é um campo de preenchimento obrigatorio<br/>";
    }
    if(txbNomeFantasia === ""){
        msgErro = msgErro + "<b>Nome Fantasia</b> é um campo de preenchimento obrigatorio<br/>";
    }
    if(txbCidade === ""){
        msgErro = msgErro + "<b>Cidade</b> é um campo de preenchimento obrigatorio";
    }

    return msgErro;

}
