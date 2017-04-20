$("#document").ready(function() {
  $("#formUsuario #btnCadastrar").click(function () {
    var txbNomUsu = $("#txbNomUsu").val();
    var txbSenUsu = $("#txbSenUsu").val();
    var txbDesEml = $("#txbDesEml").val();
    var cbbPerfil = $("#cbbPerfil").val();
    var cbbSituacao = $("#cbbSituacao").val();

    var msgErro = validaCampos(txbNomUsu, txbSenUsu, txbDesEml, cbbPerfil, cbbSituacao);

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
            senUsu: txbSenUsu,
            desEml: txbDesEml,
            codPer: cbbPerfil,
            codSit: cbbSituacao,
            action: "cadastrar"
          },

          url: "../controller/UsuarioController.php",

          //Se der tudo ok no envio...
          success: function (dados) {
            $("#formResponsavel #btnCancelar").trigger("click");
            jbkrAlert.sucesso('Responsavel', 'Responsavel cadastrado com sucesso!');
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
    var txbSenUsu = $("#txbSenUsu").val();
    var txbDesEml = $("#txbDesEml").val();
    var cbbPerfil = $("#cbbPerfil").val();
    var cbbSituacao = $("#cbbSituacao").val();

    var msgErro = validaCampos(txbNomUsu, "senha", txbDesEml, cbbPerfil, cbbSituacao);

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
          senUsu: txbSenUsu,
          desEml: txbDesEml,
          codPer: cbbPerfil,
          codSit: cbbSituacao,
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

function buscaPerfilDropdown(){
  $.ajax({
        //Tipo de envio POST ou GET
        type: "POST",
        dataType: "text",
        data: {
            action: "perfildropdown"
        },

        url: "../controller/UsuarioController.php",

        //Se der tudo ok no envio...
        success: function (dados) {
            var json = $.parseJSON(dados);

            var dropdown = "";
            for (var i = 0; i < json.length; i++) {

                var perfil = json[i];

                dropdown = dropdown + '<li role="presentation" value="' + perfil.codPer  + '"><a role="menuitem" tabindex="-1" href="#">' + perfil.desPer + '</a></li>';

            }
            $("#ulPerfil").html(dropdown);

            $("#ulPerfil li a").click(function(){

                $("#cbbPerfil:first-child").text($(this).text());

                $("#ulPerfil li").each(function(){

                    if ($(this).text() == $("#cbbPerfil").text().trim()){
                        $("#cbbPerfil").val($(this).val());
                    }
                });

            });
        }

    });
}

function buscaUsuario(codigo){
  var txbNomUsu = $("#txbNomUsu").val();
  var txbSenUsu = $("#txbSenUsu").val();
  var txbDesEml = $("#txbDesEml").val();
  var cbbPerfil = $("#cbbPerfil").val();
  var cbbSituacao = $("#cbbSituacao").val();

  $.ajax({
      //Tipo de envio POST ou GET
      type: "POST",
      dataType: "text",
      data: {
          codigo: codigo,
          nomUsu: txbNomUsu,
          senUsu: txbSenUsu,
          desEml: txbDesEml,
          codPer: cbbPerfil,
          codSit: cbbSituacao,
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
            grid = grid + "<td>" + usuario.nomUsu  + "</td>";
            grid = grid + "<td>" + usuario.desEml  + "</td>";
            grid = grid + "<td>" + usuario.desPer + "</td>";
            grid = grid + "<td>" + usuario.desSit + "</td>";
            grid = grid + "<td href='javascript:void(0);' onClick='buscaUsuario(" + usuario.codUsu + ")'><a>Editar</a></td>";
            grid = grid + "</tr>";

          }
          $("#grdUsuario").html(grid);
        }else{
          formularioModoAtualizar();
          for (var j = 0; j < json.length; j++) {
              usuario = json[j];

              $("#hidCodUsu").val(usuario.codUsu);
              $("#txbNomUsu").val(usuario.nomUsu);
              $("#txbDesEml").val(usuario.desEml);
              $("#cbbPerfil:first-child").text(usuario.desPer);
              $("#cbbPerfil:first-child").val(usuario.codPer);
              $("#cbbSituacao:first-child").text(usuario.desSit);
              $("#cbbSituacao:first-child").val(usuario.codSit);

          }

        }

      }
  });

}

function validaCampos(txbNomUsu, txbSenUsu, txbDesEml, cbbPerfil, cbbSituacao){
    msgErro = "";
    if(txbNomUsu === ""){
        msgErro = msgErro + "<b>Nome do usuário</b> é um campo de preenchimento obrigatorio<br/>";
    }
    if(txbSenUsu === ""){
        msgErro = msgErro + "<b>Senha</b> é um campo de preenchimento obrigatorio<br/>";
    }
    if(txbDesEml === ""){
        msgErro = msgErro + "<b>E-mail</b> é um campo de preenchimento obrigatorio<br/>";
    }
    if(cbbPerfil === ""){
        msgErro = msgErro + "<b>Perfil</b> é um campo de preenchimento obrigatorio<br/>";
    }
    if(cbbSituacao === ""){
        msgErro = msgErro + "<b>Situação</b> é um campo de preenchimento obrigatorio";
    }

    return msgErro;

}
