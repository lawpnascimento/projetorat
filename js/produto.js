$("#document").ready(function(){
  $("#formProduto #btnCadastrar").click(function () {

    var txbDescricaoProduto = $("#txbDescricaoProduto").val();

    var msgErro = validaCampos(txbDescricaoProduto);

    if(msgErro !== ""){
      jbkrAlert.alerta('Alerta!',msgErro);
    }
    else {
      $.ajax({
          //Tipo de envio POST ou GET
          type: "POST",
          dataType: "text",
          data: {
                  descricao: txbDescricaoProduto,
                  action: "cadastrar"
          },

          url: "../controller/ProdutoController.php",

          //Se der tudo ok no envio...
          success: function (dados) {
              jbkrAlert.sucesso('Produto', 'Produto cadastrado com sucesso!');
              $("#formProduto #btnCancelar").trigger("click");
          }
      });
    }
  });

  $("#formProduto #btnAtualizar").click(function () {
    var codigo = $("#hidCodPro").val();
    var txbDescricaoProduto = $("#txbDescricaoProduto").val();

    var msgErro = validaCampos(txbDescricaoProduto);

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
          descricao: txbDescricaoProduto,
          action: "atualizar"
        },

        url: "../controller/ProdutoController.php",

        //Se der tudo ok no envio...
        success: function (dados) {
          jbkrAlert.sucesso('Produto', 'Produto atualizado com sucesso!');
          $("#formProduto #btnCancelar").trigger("click");
        }
      });
    }
  });


  $("#formProduto #btnBuscar").click(function () {
    buscaProdutos();
  });

  $("#formProduto #btnCancelar").click(function(){
    limpaCampos($(this).closest("form"));
    formularioModoInserir();
    buscaProdutos();
  });
  
});


function buscaProdutos(codigo){
  var txbDescricaoProduto = $("#txbDescricaoProduto").val();

  $.ajax({
      //Tipo de envio POST ou GET
      type: "POST",
      dataType: "text",
      data: {
          codigo: codigo,
          descricao: txbDescricaoProduto,
          action: "buscar"
      },

      url: "../controller/ProdutoController.php",

      //Se der tudo ok no envio...
      success: function (dados) {
        var json = $.parseJSON(dados);
        var produto = null;

        //Carregando a grid
        if(codigo == null){
          var grid = "";
          for (var i = 0; i < json.length; i++) {
            produto = json[i];

            grid = grid + "<tr>";
            grid = grid + "<td>" + produto.codPro  + "</td>";
            grid = grid + "<td>" + produto.desPro  + "</td>";
            grid = grid + "<td href='javascript:void(0);' onClick='buscaProdutos(" + produto.codPro + ")'><a>Editar <span class='glyphicon glyphicon-pencil'></span></a></td>";
            grid = grid + "</tr>";

          }

          $("#grdProduto").html(grid);
        }else{
          formularioModoAtualizar();
          for (var j = 0; j < json.length; j++) {
              produto = json[j];
              $("#hidCodPro").val(produto.codPro);
              $("#txbDescricaoProduto").val(produto.desPro);
          }

        }

      }
  });

}

function validaCampos(txbDescricaoProduto){
    msgErro = "";
    if(txbDescricaoProduto === ""){
        msgErro = msgErro + "<b>Descrição do produto</b> é um campo de preenchimento obrigatorio<br/>";
    }

    return msgErro;

}
