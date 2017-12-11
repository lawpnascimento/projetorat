$("#document").ready(function(){ 

  $("#formRelatorioDespesasClientes #btnCancelar").click(function(){
    limpaCampos($(this).closest("form"));
  });

  $("#btnExecutar").click(function(){
    txbDatIni = $("#txbDatIni").val();
    txbDatFin = $("#txbDatFin").val();
    txbConsultor = $("#txbConsultor").val();
    txbCliente = $("#txbCliente").val();

    var msgErro = validaCampos(txbDatIni, txbDatFin);

    if(msgErro !== ""){
      jbkrAlert.alerta('Alerta!',msgErro);
    }
    else {  
      gerarRelatorio(txbDatIni, txbDatFin, txbConsultor, txbCliente);
    }
  });

  $('#txbConsultor').autocomplete({
    minLength: 1,
    autoFocus: true,
    delay: 300,
    position: {
      my: 'left top',
      at: 'right top'
    },
    appendTo: '#tabGeral',
    source: function(request, response){
      $.ajax({
        url: '../controller/RATController.php',
        type: 'POST',
        dataType: 'text',
        data: {
          termo: request.term,
          action: "autocompleteusuario"
        }
      }).done(function(data){
        if(data.length > 0){
          data = data.split(',');
          response( $.each(data, function(key, item){
            return({
              label: item
            });
          }));
        }
      });
    }
  });

  $('#txbCliente').autocomplete({
    minLength: 1,
    autoFocus: true,
    delay: 300,
    position: {
      my: 'left top',
      at: 'right top'
    },
    appendTo: '#tabGeral',
    source: function(request, response){
      $.ajax({
        url: '../controller/RATController.php',
        type: 'POST',
        dataType: 'text',
        data: {
          termo: request.term,
          action: "autocompletecliente"
        }
      }).done(function(data){
        if(data.length > 0){
          data = data.split(',');
          response( $.each(data, function(key, item){
            return({
              label: item
            });
          }));
        }
      });
    }
  });

});


function gerarRelatorio(txbDatIni, txbDatFin, txbConsultor, txbCliente){

  nmRelatorio = "DemonstrativoDespesaCliente_" + dataAtual() + '_' +  horaAtual();

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

      url: "../../phpjasper/vendor/geekcom/phpjasper/templates/DemonstrativoDespesaCliente.php",

      //Se der tudo ok no envio...
      success: function (dados) {
        downLoadDemonstrativoDespesaCliente(nmRelatorio);
      }
    });

}

function downLoadDemonstrativoDespesaCliente(nmRelatorio){

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

function validaCampos(txbDatIni, txbDatFin){
  msgErro = "";
  if(txbDatIni === ""){
    msgErro = msgErro + "<b>Data Inicial</b> é um campo de preenchimento obrigatorio<br/>";
  }
  if(txbDatFin === ""){
    msgErro = msgErro + "<b>Data Final</b> é um campo de preenchimento obrigatorio<br/>";
  }
  else if (txbDatIni > txbDatFin){
    msgErro = msgErro + "<b>Data Inicial</b> deve ser anterior a data final<br/>";
  }
  
  return msgErro;

}
