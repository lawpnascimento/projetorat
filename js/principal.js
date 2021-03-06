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
        buscaProdutoDropdown();
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
        buscaDespesaDropdown();
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
        buscaPapelDropdown();
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

  $("#perfil").click(function(){
    $.ajax({
      type: "POST",
      dataType: "text",
      url: "PerfilView.php",
      success: function(callback){
        $("#divPrincipal").html(callback);
        buscaPerfil();
      }
    });
  });

  $("#consultarat").click(function(){
    $.ajax({
      type: "POST",
      dataType: "text",
      url: "ConsultaRATView.php",
      success: function(callback){
        $("#divPrincipal").html(callback);
        consultaRAT();
      }
    });
  });

  $("#consultaatividade").click(function(){
    $.ajax({
      type: "POST",
      dataType: "text",
      url: "ConsultaAtividadeView.php",
      success: function(callback){
        $("#divPrincipal").html(callback);
        consultaAtiRAT();
      }
    });
  });

  $("#faturamento").click(function(){
    $.ajax({
      type: "POST",
      dataType: "text",
      url: "FaturamentoView.php",
      success: function(callback){
        $("#divPrincipal").html(callback);
        consultaFatRAT();
      }
    });
  });

  $("#extratocomissoes").click(function(){
    $.ajax({
      type: "POST",
      dataType: "text",
      url: "RelatorioExtratoComissoesView.php",
      success: function(callback){
        $("#divPrincipal").html(callback);
      }
    });
  });

  $("#despesaconsultor").click(function(){
    $.ajax({
      type: "POST",
      dataType: "text",
      url: "RelatorioDespesaConsultorView.php",
      success: function(callback){
        $("#divPrincipal").html(callback);
      }
    });
  });

  $("#despesacliente").click(function(){
    $.ajax({
      type: "POST",
      dataType: "text",
      url: "RelatorioDespesaClienteView.php",
      success: function(callback){
        $("#divPrincipal").html(callback);
      }
    });
  });

  $("#atividadesclientes").click(function(){
    $.ajax({
      type: "POST",
      dataType: "text",
      url: "RelatorioAtividadesClientesView.php",
      success: function(callback){
        $("#divPrincipal").html(callback);
      }
    });
  });

  $("#tipodespesa").click(function(){
    $.ajax({
      type: "POST",
      dataType: "text",
      url: "TipoDespesaView.php",
      success: function(callback){
        $("#divPrincipal").html(callback);
        buscaTipoDespesas();
      }
    });
  });

});
