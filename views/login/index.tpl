{include file='header.tpl'}
<link rel="stylesheet" type="text/css" href="css/login.css">
<body>
{include file='navBar.tpl'}
<div class="container">
	<div class="login">
		<h4>Ingresar a Phperros&Cia.</h4>
			<hr>
        		<form method="POST" action="Login/login" class="login-inner">
    				<input type="email" class="form-control email" name="email" id="email-input" placeholder="Email">
    				<input type="password" class="form-control password" name="password" id="password-input" placeholder="Contraseña">
					<label class="checkbox-inline">
						<!--<input type="checkbox" id="remember" value="Remember me"> Remember me-->
					</label>
					<input class="btn btn-block btn-lg btn-success submit" type="submit" value="Ingresar">
				</form>
			<a href="Registro" class="btn btn-sm btn-primary register">Registrarse</a>
			<!--<a href="#" class="btn btn-sm btn-default forgot">Forgot your password?</a>-->
	</div>
</div>
	{include file='footer.tpl'}
</body>
