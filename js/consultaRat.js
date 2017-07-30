function consultaRAT(codigo){

  $.ajax({
      //Tipo de envio POST ou GET
      type: "POST",
      dataType: "text",
      data: {
          codigo: codigo,
          usuario: usuario,
          projeto: projeto,
          situacao: situacao,
          despesa: despesa,
          atividade: atividade,
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
            grid = grid + "<td>" + rat.Usuario_codUsu + "</td>";
            grid = grid + "<td>" + rat.Cliente_codCli + "</td>";
            grid = grid + "<td>" + rat.Projeto_codPrj + "</td>";
            grid = grid + "<td>" + rat.Situacao_codSit + "</td>";
            grid = grid + "<td>" + des.codDes + "</td>";
            grid = grid + "<td>" + ati.codAti + "</td>";
            grid = grid + "</tr>";

          }

          $("#grdConsultaRAT").html(grid);
        }
      }
  });
}