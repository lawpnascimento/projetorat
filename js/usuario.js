$("#document").ready(function() {
  $("#txbPerCom").mask('99%', {reverse: false});

  $("#formUsuario #btnCadastrar").click(function () {
    var txbNomUsu = $("#txbNomUsu").val();
    var txbSobrenomeUsu = $("#txbSobrenomeUsu").val();
    var txbSenUsu = $("#txbSenUsu").val();
    var txbDesEml = $("#txbDesEml").val();
    var cbbPapel = $("#cbbPapel").val();
    var cbbSituacao = $("#cbbSituacao").val();
    var txbPerCom = $("#txbPerCom").val();

    var msgErro = validaCampos(txbNomUsu, txbSobrenomeUsu, txbSenUsu, txbDesEml, cbbPapel, cbbSituacao);

    if(msgErro !== ""){
      jbkrAlert.alerta('Alerta!',msgErro);
    }
    else {
      $.ajax({
      	  //Tipo de envio POST ou GET
          type: "POST",
          dataType: "text",
          data: {
            nomUsu: txbNomUsu,
            sobrenomeUsu: txbSobrenomeUsu,
            senUsu: txbSenUsu,
            desEml: txbDesEml,
            codPap: cbbPapel,
            codSit: cbbSituacao,
            perCom: txbPerCom,
            action: "cadastrar"
          },

          url: "../controller/UsuarioController.php",

          //Se der tudo ok no envio...
          success: function (dados) {
            $("#formResponsavel #btnCancelar").trigger("click");
            jbkrAlert.sucesso('Usuario', 'Usuário cadastrado com sucesso!');
          }
      });
    }

  });

  $("#formUsuario #btnCancelar").click(function(){
    limpaCampos($(this).closest("form"));
    formularioModoInserir();
    buscaUsuario();
  });

  $("#formUsuario #btnBuscar").click(function () {
    buscaUsuario();

  });

  $("#formUsuario #btnAtualizar").click(function () {
    var codigo = $("#hidCodUsu").val();
    var txbNomUsu = $("#txbNomUsu").val();
    var txbSobrenomeUsu = $("#txbSobrenomeUsu").val();
    var txbSenUsu = $("#txbSenUsu").val();
    var txbDesEml = $("#txbDesEml").val();
    var cbbPapel = $("#cbbPapel").val();
    var cbbSituacao = $("#cbbSituacao").val();
    var txbPerCom = $("#txbPerCom").val();

    var msgErro = validaCampos(txbNomUsu, "senha", txbDesEml, cbbPapel, cbbSituacao);

    if(msgErro !== ""){
        jbkrAlert.alerta('Alerta!',msgErro);
    }
    else{
      $.ajax({
        //Tipo de envio POST ou GET
        type: "POST",
        dataType: "text",
        data: {
          codigo: codigo,
          nomUsu: txbNomUsu,
          sobrenomeUsu: txbSobrenomeUsu,
          senUsu: txbSenUsu,
          desEml: txbDesEml,
          codPap: cbbPapel,
          codSit: cbbSituacao,
          perCom: txbPerCom,
          action: "atualizar"
        },

        url: "../controller/UsuarioController.php",

        //Se der tudo ok no envio...
        success: function (dados) {
          jbkrAlert.sucesso('Usuário', 'Usuário atualizado com sucesso!');
          $("#formUsuario #btnCancelar").trigger("click");
        }
      });
    }
  });

});

function buscaPapelDropdown(){
  $.ajax({
        //Tipo de envio POST ou GET
        type: "POST",
        dataType: "text",
        data: {
            action: "papeldropdown"
        },

        url: "../controller/UsuarioController.php",

        //Se der tudo ok no envio...
        success: function (dados) {
            var json = $.parseJSON(dados);

            var dropdown = "";
            for (var i = 0; i < json.length; i++) {

                var papel = json[i];

                dropdown = dropdown + '<li role="presentation" value="' + papel.codPap  + '"><a role="menuitem" tabindex="-1" href="#">' + papel.desPap + '</a></li>';

            }
            $("#ulPapel").html(dropdown);

            $("#ulPapel li a").click(function(){

                $("#cbbPapel:first-child").text($(this).text());

                $("#ulPapel li").each(function(){

                    if ($(this).text() == $("#cbbPapel").text().trim()){
                        $("#cbbPapel").val($(this).val());
                    }
                });

            });
        }

    });
}

function buscaUsuario(codigo){
  var txbNomUsu = $("#txbNomUsu").val();
  var txbSobrenomeUsu = $("#txbSobrenomeUsu").val();
  var txbSenUsu = $("#txbSenUsu").val();
  var txbDesEml = $("#txbDesEml").val();
  var cbbPapel = $("#cbbPapel").val();
  var cbbSituacao = $("#cbbSituacao").val();
  var txbPerCom = $("#txbPerCom").val();

  $.ajax({
      //Tipo de envio POST ou GET
      type: "POST",
      dataType: "text",
      data: {
          codigo: codigo,
          nomUsu: txbNomUsu,
          sobrenomeUsu: txbSobrenomeUsu,
          senUsu: txbSenUsu,
          desEml: txbDesEml,
          codPap: cbbPapel,
          codSit: cbbSituacao,
          perCom: txbPerCom,
          action: "buscar"
      },

      url: "../controller/UsuarioController.php",

      //Se der tudo ok no envio...
      success: function (dados) {
        var json = $.parseJSON(dados);
        var usuario = null;

        //Carregando a grid
        if(codigo == null){
          var grid = "";
          for (var i = 0; i < json.length; i++) {
            usuario = json[i];

            grid = grid + "<tr>";
            grid = grid + "<td>" + usuario.codUsu  + "</td>";
            grid = grid + "<td>" + usuario.nomUsu  + "</td>";
            grid = grid + "<td>" + usuario.sobrenomeUsu  + "</td>";
            grid = grid + "<td>" + usuario.desEml  + "</td>";
            grid = grid + "<td>" + usuario.desPap + "</td>";
            grid = grid + "<td>" + usuario.perCom + "</td>";
            grid = grid + "<td>" + usuario.desSit + "</td>";
            grid = grid + "<td href='javascript:void(0);' onClick='buscaUsuario(" + usuario.codUsu + ")'><a>Editar <span class='glyphicon glyphicon-pencil'></span></a></td>";
            grid = grid + "</tr>";

          }
          $("#grdUsuario").html(grid);
        }else{
          formularioModoAtualizar();
          for (var j = 0; j < json.length; j++) {
              usuario = json[j];

              $("#hidCodUsu").val(usuario.codUsu);
              $("#txbNomUsu").val(usuario.nomUsu);
              $("#txbSenUsu").val(usuario.senUsu);
              $("#txbSobrenomeUsu").val(usuario.sobrenomeUsu);
              $("#txbDesEml").val(usuario.desEml);
              $("#cbbPapel:first-child").text(usuario.desPap);
              $("#cbbPapel:first-child").val(usuario.codPap);
              $("#cbbSituacao:first-child").text(usuario.desSit);
              $("#cbbSituacao:first-child").val(usuario.codSit);
              $("#txbPerCom").val(usuario.perCom);

          }

        }

      }
  });

}

function validaCampos(txbNomUsu, txbSobrenomeUsu, txbSenUsu, txbDesEml, cbbPapel, cbbSituacao){
    msgErro = "";

    if(txbNomUsu === ""){
        msgErro = msgErro + "<b>Nome do usuário</b> é um campo de preenchimento obrigatorio<br/>";
    }
    if(txbSobrenomeUsu === ""){
        msgErro = msgErro + "<b>Sobrenome do usuário</b> é um campo de preenchimento obrigatorio<br/>";
    }
    if(txbSenUsu === ""){
        msgErro = msgErro + "<b>Senha</b> é um campo de preenchimento obrigatorio<br/>";
    }
    if(txbDesEml === ""){
        msgErro = msgErro + "<b>E-mail</b> é um campo de preenchimento obrigatorio<br/>";
    }
    if(cbbPapel === ""){
        msgErro = msgErro + "<b>Papel</b> é um campo de preenchimento obrigatorio<br/>";
    }
    if(cbbSituacao === ""){
        msgErro = msgErro + "<b>Situação</b> é um campo de preenchimento obrigatorio";
    }

    return msgErro;

}

function validaEmail(txbDesEml) {
    var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(txbDesEml);
}