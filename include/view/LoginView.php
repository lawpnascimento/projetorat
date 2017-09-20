<!DOCTYPE html>
<html>
<head>
	<title>PROJETO RAT</title>
	<meta charset="utf-8">
	<script type="text/javascript" src="../../lib/jquery/jquery.min.js"></script>
	<script type="text/javascript" src="../../lib/bootstrap/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="../../js/geral.js"></script>
	<script type="text/javascript" src="../../js/login.js"></script>

	<script type="text/javascript" src="../../js/alerta.js"></script>
	<link rel="stylesheet" href="../../lib/bootstrap/css/bootstrap.min.css">
</head>
<body>
	<div class="container-fluid">
		<div id="loginbox" style="margin-top:50px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
			<div class="panel panel-info" >
				<div class="panel-heading">
					<div class="panel-title">Entrar</div>
				</div>
				<div style="padding-top:30px" class="panel-body" >

					<div style="display:none" id="divErro" class="alert alert-danger col-sm-12"></div>

					<form id="loginform" class="form-horizontal" role="form">

						<div style="margin-bottom: 25px" class="input-group">
							<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
							<input id="txbLogin" type="text" class="form-control" name="username" value="" placeholder="Usuário" maxlength="50"/>
						</div>
						<div style="margin-bottom: 25px" class="input-group">
							<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
							<input id="txbSenha" type="password" class="form-control" name="password" placeholder="Senha">
						</div>
						<div style="margin-top:10px" class="form-group">
							<!-- Button -->
							<div class="col-sm-12 controls">
								<a id="btnLogin" href="#" class="btn btn-success">Entrar  </a>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</body>
</html>
