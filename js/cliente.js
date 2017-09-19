$("#document").ready(function() {
  aplicaMascara();

  $("#formCliente #btnCadastrar").click(function () {
    removeMascara();
    var txbRazaoSocial = $("#txbRazaoSocial").val();
    var txbNomeFantasia = $("#txbNomeFantasia").val();
    var txbCnpj = $("#txbCnpj").val();
    var txbInscricao = $("#txbInscricao").val();
    var txbCep = $("#txbCep").val();
    var txbCidade = $("#txbCidade").val();
    var seqCidade = txbCidade.split("-");
    var seqEstado = seqEstado.split("-");
    var txbTelefone = $("#txbTelefone").val(); 

    var msgErro = validaCampos(txbRazaoSocial, txbNomeFantasia, txbCnpj, txbInscricao, txbCep, txbCidade, txbTelefone);

    if(msgErro !== ""){
      jbkrAlert.alerta('Alerta!',msgErro);
      aplicaMascara();
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
            cidade: seqCidade[0],
            estado: seqEstado[0],
            telefone: txbTelefone,
            action: "cadastrar"
          },

          url: "../controller/ClienteController.php",

          //Se der tudo ok no envio...
          success: function (dados) {
            jbkrAlert.sucesso('Cliente', 'Cliente cadastrado com sucesso!');
            $("#formCliente #btnCancelar").trigger("click");
          }
        });
    }


  });

  $("#formCliente #btnCancelar").click(function(){
    limpaCampos($(this).closest("form"));
    formularioModoInserir();
    buscaClientes();
    aplicaMascara();
  });

  $("#formCliente #btnAtualizar").click(function () {
    removeMascara();

    var codigo = $("#hidCodCli").val();
    var txbRazaoSocial = $("#txbRazaoSocial").val();
    var txbNomeFantasia = $("#txbNomeFantasia").val();
    var txbCnpj = $("#txbCnpj").val();
    var txbInscricao = $("#txbInscricao").val();
    var txbCep = $("#txbCep").val();
    var txbCidade = $("#txbCidade").val();
    var seqCidade = txbCidade.split("-");
    var txbTelefone = $("#txbTelefone").val();

    var msgErro = validaCampos(txbRazaoSocial, txbNomeFantasia, txbCnpj, txbInscricao, txbCep, seqCidade, txbTelefone);

    if(msgErro !== ""){
      jbkrAlert.alerta('Alerta!',msgErro);
    }
    else{
      $.ajax({
        //Tipo de envio POST ou GET
        type: "POST",
        dataType: "text",
        data: {
          codigo: codigo,
          razaoSocial: txbRazaoSocial,
          nomeFantasia: txbNomeFantasia,
          cnpj: txbCnpj,
          inscricao: txbInscricao,
          cep: txbCep,
          cidade: seqCidade[0],
          telefone: txbTelefone,
          action: "atualizar"
        },

        url: "../controller/ClienteController.php",

        //Se der tudo ok no envio...
        success: function (dados) {
          jbkrAlert.sucesso('Clientes', 'Cliente atualizado com sucesso!');
          $("#formCliente #btnCancelar").trigger("click");
        }
      });
    }
  });

  $("#formCliente #btnBuscar").click(function () {
    buscaClientes();
  });

  $('#txbCidade').autocomplete({
    minLength: 2,
    autoFocus: true,
    delay: 300,
    position: {
      my: 'left top',
      at: 'right top'
    },
    appendTo: '#tabGeral',
    source: function(request, response){
      $.ajax({
        url: '../controller/ClienteController.php',
        type: 'POST',
        dataType: 'text',
        data: {
          termo: request.term,
          action: "autocompletecidade"
        }
      }).done(function(data){
        if(data.length > 0){
          data = data.split(',');
          response( $.each(data, function(key, item){
            return({
              label: item
            });
          }));
        }
      });
    }
  });

});

function buscaClientes(codigo){

  var txbRazaoSocial = $("#txbRazaoSocial").val();
  var txbNomeFantasia = $("#txbNomeFantasia").val();
  var txbCnpj = $("#txbCnpj").val();
  var txbInscricao = $("#txbInscricao").val();
  var txbCep = $("#txbCep").val();
  var txbCidade = $("#txbCidade").val();
  var txbTelefone = $("#txbTelefone").val();

  $.ajax({
      //Tipo de envio POST ou GET
      type: "POST",
      dataType: "text",
      data: {
        codigo: codigo,
        razaoSocial: txbRazaoSocial,
        nomeFantasia: txbNomeFantasia,
        cnpj: txbCnpj,
        inscricao: txbInscricao,
        cep: txbCep,
        cidade: txbCidade,
        telefone: txbTelefone,
        action: "buscar"
      },

      url: "../controller/ClienteController.php",

      //Se der tudo ok no envio...
      success: function (dados) {
        var json = $.parseJSON(dados);
        var cliente = null;

        //Carregando a grid
        if(codigo == null){
          var grid = "";
          for (var i = 0; i < json.length; i++) {
            cliente = json[i];

            grid = grid + "<tr>";
            grid = grid + "<td>" + cliente.codCli  + "</td>";
            grid = grid + "<td>" + cliente.desRazaoSocial  + "</td>";
            grid = grid + "<td>" + cliente.nomCli + "</td>";
            grid = grid + "<td>" + cliente.numCNPJ + "</td>";
            grid = grid + "<td>" + cliente.Cidade_seqCid + "</td>";
            grid = grid + "<td>" + cliente.Estado_seqEst + "</td>";
            grid = grid + "<td>" + cliente.telCli + "</td>";
            grid = grid + "<td href='javascript:void(0);' onClick='buscaClientes(" + cliente.codCli + ")'><a>Editar <span class='glyphicon glyphicon-pencil'></span></a></td>";
            grid = grid + "</tr>";

          }

          $("#grdCliente").html(grid);
        }else{
          formularioModoAtualizar();
          for (var j = 0; j < json.length; j++) {
            cliente = json[j];

            $("#hidCodCli").val(cliente.codCli);
            $("#txbRazaoSocial").val(cliente.desRazaoSocial);
            $("#txbNomeFantasia").val(cliente.nomCli);
            $("#txbCnpj").val(cliente.numCNPJ);
            $("#txbInscricao").val(cliente.iesCli);
            $("#txbCep").val(cliente.numCEP);
            $("#txbCidade").val(cliente.Cidade_seqCid);
            $("#txbEstado").val(cliente.Estado_seqEst);
            $("#txbTelefone").val(cliente.telCli);
              // Para aplicar a máscara nos campos recebidos por ajax
              removeMascara();
              aplicaMascara();
            }

          }

        }
      });

}

function buscaEstado(cidade) {

  $.ajax({
      //Tipo de envio POST ou GET
      type: "POST",
      dataType: "text",
      data: {
        cidade: cidade[0],
        action: "buscaestado"
      },

      url: "../controller/ClienteController.php",
        success: function (dados) {
          var json = $.parseJSON(dados);
          var cliente = null;

          var estado = "";
          for (var i = 0; i < json.length; i++) {
            cliente = json[i];

            estado = estado + cliente.seqEst + "-" + cliente.desEst;

          }

          $("#txbEstado").val(estado);
          
        }

    });

}

function validaCampos(txbRazaoSocial, txbNomeFantasia, txbCnpj, txbInscricao, txbCep, txbCidade, txbTelefone){
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

function aplicaMascara(){
  $('#txbCnpj').mask('00.000.000/0000-00', {reverse: true});
  $('#txbCep').mask('00000-000');
  $('#txbTelefone').mask('(00) 0000-0000');
}

function removeMascara(){
  $('#txbCnpj').unmask();
  $('#txbCep').unmask();
  $('#txbTelefone').unmask();
}

$("#txbCidade").focusout(function() {
  var txbCidade = $("#txbCidade").val();
  cidade = txbCidade.split("-");
  buscaEstado(cidade);
});