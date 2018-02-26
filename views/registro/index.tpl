{include file='header.tpl'}
<link rel="stylesheet" type="text/css" href="css/login.css">
<body>
{include file='navBar.tpl'}
<div class="container">
	<div class="login">
		<h4>Registrarse en Phperros&Cia.</h4>
			<hr>
        		<form method="POST" action="Registro/registro" class="login-inner">
    				<input type="text" class="form-control" id="nombre-completo" name="nombre-completo" placeholder="Nombre Completo">
    				<input type="email" class="form-control email" id="email" name="email" placeholder="Email">
    				<input type="password" class="form-control password" id="password" name="password" placeholder="Contraseña">
					<label class="checkbox-inline">
						<!--<input type="checkbox" id="remember" value="Remember me"> Remember me-->
					</label>
					<input class="btn btn-block btn-lg btn-success submit" type="submit" value="Registrarme!">
				</form>

			<!--<a href="#" class="btn btn-sm btn-default forgot">Forgot your password?</a>-->
	</div>
</div>
	{include file='footer.tpl'}
</body>
