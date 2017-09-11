$("#btnExecutar").click(function(){

  gerarRelatorio();

});

function gerarRelatorio(){
  txbDatIni = $("#txbDatIni").val();
  txbDatFin = $("#txbDatFin").val();
  txbConsultor = $("#txbConsultor").val();
  txbCliente = $("#txbCliente").val();

  nmRelatorio = "ExtratoComissao_" + dataAtual() + '_' +  horaAtual();

  $.ajax({
      //Tipo de envio POST ou GET
      type: "POST",
      dataType: "text",
      data: {
        txbDatIni: txbDatIni,
        txbDatFin: txbDatFin,
        txbConsultor: txbConsultor,
        txbCliente: txbCliente,
        nmRelatorio: nmRelatorio
      },

      url: "../../phpjasper/vendor/geekcom/phpjasper/templates/AtividadeCliente.php",

      //Se der tudo ok no envio...
      success: function (dados) {
        downLoadExtratoComissao(nmRelatorio);
      }
  });

}
function downLoadExtratoComissao(nmRelatorio){

  window.open("http://localhost/projetorat/trunk/estrutura/downloadFile.php?nmRelatorio=" + nmRelatorio , "_blank");

}

function dataAtual() {
    var date = new Date();
    return String(date.getDate()) + String(date.getMonth()) + String(date.getFullYear());
}


function horaAtual() {
    var date = new Date();
    return String(date.getHours()) + String(date.getMinutes()) + String(date.getSeconds());
}
