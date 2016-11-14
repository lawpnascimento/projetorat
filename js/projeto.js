function submitProjeto() {
  var txbProjeto = document.getElementById("txbProjeto").value;
  var txbProduto = document.getElementById("txbProduto").value; 
  var txbDataIni = document.getElementById("txbDataIni").value;
  var cbbCliente = $("#cbbCliente").val();
   
  $.ajax({
      //Tipo de envio POST ou GET
      type: "POST",
      dataType: "text",
      data: {
            projeto: txbProjeto,
            produto: txbProduto,
            dataInicio: txbDataIni,
            cliente: cbbCliente,
          action: "inserir"
      },

      url: "../controller/ProjetoController.php",

      //Se der tudo ok no envio...
      success: function (callback) {
        alert("chegou");
        //var json = $.parseJSON(callback);
        var json = JSON.stringify(callback);
/*              for (var i = 0; i < json.length; i++) {
                var perfil = json[i];
          }*/
      }
  }); 
}

function resetForm() {
    document.getElementById("formProjeto").reset();
}

/*TESTE - JQuery para alimentar combobox
$($.parseJSON(cliente.json)).map(function () {
    return $('<option>').val(this.value).text(this.label);
}).appendTo('#cbbCliente');*/

/*
function buscaClienteDropdown(){

    $.ajax({
        //Tipo de envio POST ou GET
        type: "POST",
        dataType: "text",
        data: {
            action: "portedropdown"
        },

        url: "../controller/ProjetoController.php",

        //Se der tudo ok no envio...
        success: function (dados) {
            var json = $.parseJSON(dados);

            var dropdown = "";
            for (var i = 0; i < json.length; i++) {

                var porte = json[i];

                dropdown = dropdown + '<li role="presentation" value="' + porte.cdPorte  + '"><a role="menuitem" tabindex="-1" href="#">' + porte.dsPorte + '</a></li>';

            }
            $("#ulPorte").html(dropdown);

            $("#ulPorte li a").click(function(){

                $("#ddlPorte:first-child").text($(this).text());

                $("#ulPorte li").each(function(){

                    if ($(this).text() == $("#ddlPorte").text().trim()){
                        $("#ddlPorte").val($(this).val());
                    }
                });

            });
        }

    });
}
*/

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