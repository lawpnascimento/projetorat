function functionLogin(){
    var inputUser = document.getElementById("txbUsuario").value;
    var inputPass = document.getElementById("txbSenha").value;

    if (inputUser !="" && inputPass !=""){
        if (inputUser == 'admin' && 
            inputPass == 'admin'){
          
            document.getElementById("demo").innerHTML = "Bem vindo " + inputUser;
            $(location).attr("href","Principal.php");

        } 
        else {
            alert("Usuario ou senha incorretos.");
        }
    }
    else {
        alert("Favor definir usuario e senha");
    }

}
