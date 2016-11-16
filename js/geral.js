function limpaCampos($form){
    $form.find('input:text, input:password, input:file, select, textarea').val('');
    $form.find('input:radio, input:checkbox').removeAttr('checked').removeAttr('selected');
    $form.find('.dropdown-toggle').each(function(){
        $(this).html($(this).attr('name') + "&nbsp<span class='caret'></span>");
        $(this).val('');
    });
};

function validaEmail(email)
{
    var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    return regex.test(email);
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