$(document).ready(function(){
  $("#cliente").click(function(){
    $.ajax({

        type: "POST",
        dataType: "text",

        url: "ClienteView.php",

        success: function(callback){
            $("#divPrincipal").html(callback);
            buscaClientes();

        }
    });

  });

  $("#projeto").click(function(){
    $.ajax({

        type: "POST",
        dataType: "text",

        url: "ProjetoView.php",

        success: function(callback){
            $("#divPrincipal").html(callback);
            buscaClienteDropdown();
            buscaProjetos();

        }
    });

  });

  $("#responsavel").click(function(){
    $.ajax({

        type: "POST",
        dataType: "text",

        url: "ResponsavelView.php",

        success: function(callback){
            $("#divPrincipal").html(callback);
            buscaClienteDropdown();
            buscaResponsavel();
        }
    });

  });

  $("#lancarat").click(function(){
    $.ajax({

        type: "POST",
        dataType: "text",

        url: "RATView.php",

        success: function(callback){
            $("#divPrincipal").html(callback);
        }
    });

  });

  $("#despesa").click(function(){
    $.ajax({

        type: "POST",
        dataType: "text",

        url: "DespesaView.php",

        success: function(callback){
            $("#divPrincipal").html(callback);
            buscaDespesas();
        }
    });

  });

  $("#usuario").click(function(){
    $.ajax({
      type: "POST",
      dataType: "text",
      url: "UsuarioView.php",
      success: function(callback){
        $("#divPrincipal").html(callback);
        buscaPerfilDropdown();
        buscaUsuario();

        $("#ulSituacao li a").click(function(){

          $("#cbbSituacao:first-child").text($(this).text());

          $("#ulSituacao li").each(function(){

            if ($(this).text() == $("#cbbSituacao").text().trim()){
              $("#cbbSituacao").val($(this).val());
            }
          });
        });
      }
    });
  });

  $("#produto").click(function(){
    $.ajax({
      type: "POST",
      dataType: "text",
      url: "ProdutoView.php",
      success: function(callback){
          $("#divPrincipal").html(callback);
          buscaProdutos();
      }
    });
  });

  $("#avaliacaorat").click(function(){
    $.ajax({
      type: "POST",
      dataType: "text",
      url: "AvaliacaoRATView.php",
      success: function(callback){
          $("#divPrincipal").html(callback);
      }
    });
  });

  $("#btnPerfil").click(function(){
      $.ajax({
        type: "POST",
        dataType: "text",
        url: "PerfilView.php",
        success: function(callback){
            $("#divPrincipal").html(callback);
        }
      });
  });

});
