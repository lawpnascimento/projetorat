function consultaRAT(codigo){

var vUsuario = 4;
var vCliente = 1;
var vResponsavel = 1;
var vProjeto = 1;
var vSituacao = 3;

  $.ajax({
      //Tipo de envio POST ou GET
      type: "POST",
      dataType: "text",
      data: {
          codigo: codigo,
          usuario: vUsuario,
          cliente: vCliente,
          projeto: vProjeto,
          situacao: vSituacao,
          action: "buscar"
      },

      url: "../controller/ConsultaRATController.php",

      //Se der tudo ok no envio...
      success: function (dados) {
        var json = $.parseJSON(dados);
        var rat = null;

        //Carregando a grid
        if(codigo == null){
          var grid = "";
          for (var i = 0; i < json.length; i++) {
            rat = json[i];

            grid = grid + "<tr>";
            grid = grid + "<td>" + rat.codRAT + "</td>";
            grid = grid + "<td>" + rat.codUsu + "</td>";
            grid = grid + "<td>" + rat.codCli + "</td>";
            grid = grid + "<td>" + rat.codPrj + "</td>";
            grid = grid + "<td>" + rat.codSit + "</td>";
            //grid = grid + "<td>" + des.codDes + "</td>";
            //grid = grid + "<td>" + ati.codAti + "</td>";
            grid = grid + "</tr>";

          }

          $("#grdConsultaRAT").html(grid);
        }
      }
  });
}