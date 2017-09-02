function limpaCampos($form){
    $form.trigger('reset');
    $form.find('input:text, input:password, input:file, select, textarea').val('');
    $form.find('input:radio, input:checkbox').removeAttr('checked').removeAttr('selected');
    $form.find('.dropdown-toggle').each(function(){
        $(this).html($(this).attr('name') + "&nbsp<span class='caret'></span>");
        $(this).val('');
    });
};

function limpaCamposRAT($form){
    $form.trigger('reset');
    $("#tbodyAtividades tr td").not("#tdFatAtividade, #tdButtonsAtividade").empty();
    $("#tbodyDespesas tr td").not("#tdDsDespesa, #tdTipoDespesa, #tdFatDespesa, #tdButtonsDespesa").empty();
    $(".selectDsDespesa").val($(".selectDsDespesa option:first").val());
    $(".selectTipoDespesa").val($(".selectTipoDespesa option:first").val());
};

function validaEmail(email) {
    var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
}

function mensagemSucess(){
  $("#divMensagemCadastro").css("display","block");
  $("#divMensagemCadastro").removeClass("alert alert-danger");
  $("#divMensagemCadastro").addClass("alert alert-success");
}

function defaultDate(data){
  var today = new Date();
  document.getElementById("displayDate").value = [today.getDate(), today.getMonth()+1, today.getFullYear()].join('/');
}

function validaCpf(strCPF){
  var Soma;

  var Resto;

  Soma = 0;

  if (strCPF == "00000000000") return false;

  for (i=1; i<=9; i++) {
      Soma = Soma + parseInt(strCPF.substring(i-1, i)) * (11 - i);
  }

  Resto = (Soma * 10) % 11;

  if ((Resto == 10) || (Resto == 11)) Resto = 0;

  if (Resto != parseInt(strCPF.substring(9, 10)) ) return false;

  Soma = 0;

  for (i = 1; i <= 10; i++){
      Soma = Soma + parseInt(strCPF.substring(i-1, i)) * (12 - i);
  }

  Resto = (Soma * 10) % 11;

  if ((Resto == 10) || (Resto == 11)) Resto = 0;

  if (Resto != parseInt(strCPF.substring(10, 11) ) )
      return false;

  return true;
}

function formularioModoInserir(){
  $("#btnCadastrar").css("display","inline-block");
  $("#btnBuscar").css("display","inline-block");
  $("#btnExcluir").css("display","none");
  $("#btnAtualizar").css("display","none");

}

function formularioModoAtualizar(){
  $("#btnCadastrar").css("display","none");
  $("#btnBuscar").css("display","none");
  $("#btnExcluir").css("display","inline-block");
  $("#btnAtualizar").css("display","inline-block");

}

function validaSomenteNumerico(form, campo) {
//Key code 190: ponto
$(form).on('keydown', campo, function(e){-1!==$.inArray(e.keyCode,[46,8,9,27,13,110])||/65|67|86|88/.test(e.keyCode)&&(!0===e.ctrlKey||!0===e.metaKey)||35<=e.keyCode&&40>=e.keyCode||(e.shiftKey||48>e.keyCode||57<e.keyCode)&&(96>e.keyCode||105<e.keyCode)&&e.preventDefault()});
    }