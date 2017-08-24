$("#document").ready(function(){ 
var $msgTeste = $('#msgTeste');
var $VgrdConsultaRAT = $('#grdConsultaRAT');

$("#formConsultaRAT #btnBuscar").click(function () {
    alert("Teste");
    consultaRAT();

  });

$("#grdConsultaRAT").on('click', 'tr', function (event) {
    alert("oi");

  });

$("#formConsultaRAT #btnTeste").click(function () {
  var $rows = $VgrdConsultaRAT.find('tr');
  var headers = [];
  var data = [];
  
  // Get the headers (add special header logic here)
  $($rows.shift()).find('th:not(:empty)').each(function () {
    headers.push($(this).text().toLowerCase());
  });

  // Turn all existing rows into a loopable array
  $rows.each(function () {
    var $td = $(this).find('td');
    var h = {};

    // Use the headers from earlier to name our hash keys
    headers.forEach(function (header, i) {
      h[header] = $td.eq(i).text();
    });

    data.push(h);
  });

  // Output the result
  $msgTeste.text(JSON.stringify(data));
});

});

function consultaRAT(codigo){

  var txbCodRat = $("#txbCodRat").val();
  var txbNomUsu = $("#txbNomUsu").val();
  var txbNomCli = $("#txbNomCli").val();
  var txbNomRes = $("#txbNomRes").val();
  var txbNomPrj = $("#txbNomPrj").val();
  var txbNomPro = $("#txbNomPro").val();
  var txbSitRAT = $("#txbSitRAT").val();

    $.ajax({
        //Tipo de envio POST ou GET
        type: "POST",
        dataType: "text",
        data: {
            codigo: codigo,
            usuario: txbNomUsu,
            cliente: txbNomCli,
            responsavel: txbNomRes,
            projeto: txbNomPrj,
            produto: txbNomPro,
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
              grid = grid + "<td>" + rat.codRat + "</td>";
              grid = grid + "<td>" + rat.codUsu + "</td>";
              grid = grid + "<td>" + rat.codCli + "</td>";
              grid = grid + "<td>" + rat.codRes + "</td>";
              grid = grid + "<td>" + rat.codPrj + "</td>";
              grid = grid + "<td>" + rat.codPro + "</td>";  
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