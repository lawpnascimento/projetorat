$("#document").ready(function() {
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

$("#formProduto #btnCancelar").click(function(){
    limpaCampos($(this).closest("form"));
    buscaProdutos();
});

$("#formProduto #btnBuscar").click(function () {
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
            grid = grid + "<td>" + produto.desPro  + "</td>";
            grid = grid + "<td href='javascript:void(0);' onClick='buscaProdutos(" + produto.desPro + ")'><a>Editar</a></td>";
            grid = grid + "</tr>";

          }

          $("#grdProduto").html(grid);
        }else{
          formularioModoAtualizar();
          for (var j = 0; j < json.length; j++) {
              produto = json[j];
              $("#hidCodPro").val(produto.codCli);
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