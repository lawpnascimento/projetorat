$("#document").ready(function() {

//para chamar a data atual depois de buscar todos os projetos para a grid
$.ajax({
   url:buscaProjetos(),
   success:function(){
   setaDataAtual("#txbDataInicio");
}
})

  $("#txbValorHora").mask('###0.00', {reverse: true});

  $("#formProjeto #btnCadastrar").click(function () {

    var txbProjeto = $("#txbProjeto").val();
    var cbbProduto = $("#cbbProduto").val();
    var txbDataInicio = $("#txbDataInicio").val();
    var cbbCliente = $("#cbbCliente").val();
    var txbValorHora = $("#txbValorHora").val();
    var txaObsProjeto = $("#txaObsProjeto").val();

    var msgErro = validaCampos(txbProjeto, cbbProduto, txbDataInicio, cbbCliente, txbValorHora);

    if(msgErro !== ""){
      jbkrAlert.alerta('Alerta!',msgErro);
    }
    else {
      $.ajax({
          //Tipo de envio POST ou GET
          type: "POST",
          dataType: "text",
          data: {
            projeto: txbProjeto,
            produto: cbbProduto,
            dataInicio: txbDataInicio,
            cliente: cbbCliente,
            valorHora: txbValorHora,
            obsProjeto: txaObsProjeto,
            action: "cadastrar"
          },

          url: "../controller/ProjetoController.php",

          //Se der tudo ok no envio...
          success: function (dados) {
              jbkrAlert.sucesso('Projeto', 'Projeto cadastrado com sucesso!');
              $("#formProjeto #btnCancelar").trigger("click");
          }
      });
    }


  });

  $("#formProjeto #btnCancelar").click(function(){
    limpaCampos($(this).closest("form"));
    formularioModoInserir();
    buscaProjetos();
  });

  $("#formProjeto #btnAtualizar").click(function () {
    var codigo = $("#hidCodPrj").val();
    var txbProjeto = $("#txbProjeto").val();
    var cbbProduto = $("#cbbProduto").val();
    var txbDataInicio = $("#txbDataInicio").val();
    var cbbCliente = $("#cbbCliente").val();
    var txbValorHora = $("#txbValorHora").val();
    var txaObsProjeto = $("#txaObsProjeto").val();

    var msgErro = validaCampos(txbProjeto, cbbProduto, txbDataInicio, cbbCliente, txbValorHora);

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
            projeto: txbProjeto,
            produto: cbbProduto,
            dataInicio: txbDataInicio,
            cliente: cbbCliente,
            valorHora: txbValorHora,
            obsProjeto: txaObsProjeto,
            action: "atualizar"
        },

        url: "../controller/ProjetoController.php",

        //Se der tudo ok no envio...
        success: function (dados) {
          jbkrAlert.sucesso('Projeto', 'Projeto atualizado com sucesso!');
          $("#formProjeto #btnCancelar").trigger("click");
        }
      });
    }
  });

  $("#formProjeto #btnBuscar").click(function () {
    buscaProjetos();

  });
  
});

function buscaProjetos(codigo){
    var txbProjeto = $("#txbProjeto").val();
    var cbbProduto = $("#cbbProduto").val();
    var txbDataInicio = $("#txbDataInicio").val();
    var cbbCliente = $("#cbbCliente").val();
    var txbValorHora = $("#txbValorHora").val();
    var txaObsProjeto = $("#txaObsProjeto").val();

    $.ajax({
        //Tipo de envio POST ou GET
        type: "POST",
        dataType: "text",
        data: {
              codigo: codigo,
              projeto: txbProjeto,
              produto: cbbProduto,
              dataInicio: txbDataInicio,
              cliente: cbbCliente,
              valorHora: txbValorHora,
              obsProjeto: txaObsProjeto,
              action: "buscar"
        },

        url: "../controller/ProjetoController.php",

        //Se der tudo ok no envio...
        success: function (dados) {
          var json = $.parseJSON(dados);
          var projeto = null;

          //Carregando a grid
          if(codigo == null){
            var grid = "";
            for (var i = 0; i < json.length; i++) {
              projeto = json[i];

              grid = grid + "<tr>";
              grid = grid + "<td>" + projeto.codPrj + "</td>";
              grid = grid + "<td>" + projeto.nomPrj + "</td>";
              grid = grid + "<td>" + projeto.codPro + "</td>";
              grid = grid + "<td>" + projeto.codCli + "</td>";
              grid = grid + "<td>" + projeto.datIni + "</td>";
              grid = grid + "<td>" + projeto.vlrHor + "</td>";

              grid = grid + "<td href='javascript:void(0);' onClick='buscaProjetos(" + projeto.codPrj + ")'><a>Editar <span class='glyphicon glyphicon-pencil'></span></a></td>";
              grid = grid + "</tr>";

            }

            $("#grdProjeto").html(grid);
          }else{
            formularioModoAtualizar();
            for (var j = 0; j < json.length; j++) {
                projeto = json[j];
                $("#hidCodPrj").val(projeto.codPrj);
                $("#txbProjeto").val(projeto.nomPrj);
                $("#cbbCliente:first-child").text(projeto.nomCli);
                $("#cbbCliente:first-child").val(projeto.codCli);
                $("#cbbProduto:first-child").text(projeto.desPro);
                $("#cbbProduto:first-child").val(projeto.codPro);
                $("#txbDataInicio").val(projeto.datIni);
                $("#txbValorHora").val(projeto.vlrHor);
                $("#txaObsProjeto").val(projeto.obsPrj);
            }

          }

        }
    });

}

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

function buscaProdutoDropdown(){
  $.ajax({
        //Tipo de envio POST ou GET
        type: "POST",
        dataType: "text",
        data: {
            action: "produtodropdown"
        },

        url: "../controller/ProjetoController.php",

        //Se der tudo ok no envio...
        success: function (dados) {
            var json = $.parseJSON(dados);

            var dropdown = "";
            for (var i = 0; i < json.length; i++) {

                var produto = json[i];

                dropdown = dropdown + '<li role="presentation" value="' + produto.codPro  + '"><a role="menuitem" tabindex="-1" href="#">' + produto.desPro + '</a></li>';

            }
            $("#ulProduto").html(dropdown);

            $("#ulProduto li a").click(function(){

                $("#cbbProduto:first-child").text($(this).text());

                $("#ulProduto li").each(function(){

                    if ($(this).text() == $("#cbbProduto").text().trim()){
                        $("#cbbProduto").val($(this).val());
                    }
                });

            });
        }

    });
}

function validaCampos(txbProjeto, cbbProduto, txbDataInicio, cbbCliente, txbValorHora){
    msgErro = "";
    if(txbProjeto === ""){
        msgErro = msgErro + "<b>Projeto</b> é um campo de preenchimento obrigatorio<br/>";
    }
    if(cbbProduto === ""){
        msgErro = msgErro + "<b>Produto</b> é um campo de preenchimento obrigatorio<br/>";
    }
    if(txbDataInicio === ""){
        msgErro = msgErro + "<b>Data Inicial</b> é um campo de preenchimento obrigatorio<br/>";
    }
    if(cbbCliente === ""){
        msgErro = msgErro + "<b>Cliente</b> é um campo de preenchimento obrigatorio<br/>";
    }
    if(txbValorHora === ""){
        msgErro = msgErro + "<b>Valor Hora</b> é um campo de preenchimento obrigatorio";
    }
    return msgErro;

}

function setaDataAtual(input){
  var date = new Date();

  var day = date.getDate();
  var month = date.getMonth() + 1;
  var year = date.getFullYear();

  if (month < 10) month = "0" + month;
  if (day < 10) day = "0" + day;

  inputToday = year + "-" + month + "-" + day;

  $(input).val(inputToday);
}