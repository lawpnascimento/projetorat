<?php
//Caso o usuário não esteja autenticado, limpa os dados e redireciona
if (!isset($_SESSION['codUsu'])) {

    //Limpa
    session_destroy();

    //Redireciona para a página de autenticação
    header('location: /projetorat/index.php');
}

?>
