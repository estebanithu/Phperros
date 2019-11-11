{include file='header.tpl'}
<link rel="stylesheet" type="text/css" href="css/login-registro.css">
<body>
{include file='navBar.tpl'}
<div class="container">
	<div class="login">
		<h4>Ingresar a {$nombreSitio}.</h4>
			<hr>
        		<form method="POST" action="Login/login" class="login-inner">
    				<input type="email" required class="form-control email" name="email" id="email-input" placeholder="Email">
    				<input type="password" required class="form-control password" name="password" id="password-input" placeholder="Contraseña">
					<label class="checkbox-inline">
						<!--<input type="checkbox" id="remember" value="Remember me"> Remember me-->
					</label>
					<button class="btn btn-block btn-lg btn-success submit" type="submit"><i class='fa fa-sign-in'></i> Ingresar </button>
				</form>
				{if isset($error)}
				<hr>
					<div class="alert alert-danger">
					  <strong>Error!</strong> {$error}.
					</div>
				{/if}
			<a href="Registro" class="btn btn-sm btn-primary register"><i class="fa fa fa-pencil"></i> Registrarse</a>
			<!--<a href="#" class="btn btn-sm btn-default forgot">Forgot your password?</a>-->
	</div>
</div>
	{include file='footer.tpl'}
</body>
