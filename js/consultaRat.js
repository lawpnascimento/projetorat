  $("#formConsultaRAT #btnBuscar").click(function () {
    alert("Teste");
    buscaUsuario();

  });

function consultaRAT(codigo){

var txbCodRat = $("#txbCodRat").val();
var txbNomUsu = $("#txbNomUsu").val();
var txbNomCli = $("#txbNomCli").val();
var txbNomRes = $("#txbNomRes").val();
var txbNomPrj = $("#txbNomPrj").val();
var txbSitRAT = $("#txbSitRAT").val();

  $.ajax({
      //Tipo de envio POST ou GET
      type: "POST",
      dataType: "text",
      data: {
          codigo: txbCodRat,
          usuario: txbNomUsu,
          cliente: txbNomCli,
          projeto: txbNomPrj,
          situacao: txbSitRAT,
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