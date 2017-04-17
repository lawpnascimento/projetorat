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

    $("#rat").click(function(){
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
        }
    });

  });


});
