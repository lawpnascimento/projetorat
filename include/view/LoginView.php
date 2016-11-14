<!DOCTYPE html>
<html>
<head>
  <title>PROJETO RAT</title>
  
  <script src="../../lib/jquery/jquery.min.js"></script>
  <script type="text/javascript" src="../../js/login.js"></script>
  <link href="../../lib/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen" />
</head>

<body>
    <div class="container">    
        <div id="loginbox" style="margin-top:50px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">                    
            <div class="panel panel-info" >
                    <div class="panel-heading">
                        <div class="panel-title">Entrar</div>
                    </div>     

                    <div style="padding-top:30px" class="panel-body">

                        <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>
                            
                        <form id="loginform" class="form-horizontal" role="form">
                                    
                            <div style="margin-bottom: 25px" class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                        <input id="txbUsuario" type="text" class="form-control" placeholder="Usuario">                                        
                                    </div>
                                
                            <div style="margin-bottom: 25px" class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                        <input id="txbSenha" type="password" class="form-control" placeholder="Senha">
                                    </div>
                                        <!--Botoes-->
                                <div style="margin-top:10px" class="form-group">
                                    <div class="col-sm-12 controls">
                                      <button type="button" onclick="functionLogin()" id="btnLogin" class="btn btn-success">Login</button>
                                        <p id="demo"></p>

                           

                                    </div>
                                </div> 
                            </form>     
                        </div>                     
                    </div>  
        </div>
</body>
</html>