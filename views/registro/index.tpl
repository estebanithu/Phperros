{include file='header.tpl'}
<link rel="stylesheet" type="text/css" href="css/login-registro.css">
<script type="text/javascript" src="js/registro.js"></script>
<body>
{include file='navBar.tpl'}
<div class="container">
	<div class="login">
		<h4>Registrarse en Phperros&Cia.</h4>
			<hr>
        		<form id="formRegistro" method="POST" action="Registro/registro" class="login-inner">
    				<input type="text" required class="form-control" id="nombre-completo" name="nombre-completo" placeholder="Nombre Completo">
    				<input type="email" required class="form-control email" id="email" name="email" placeholder="Email">
    				<input type="password" required class="form-control password" id="password" name="password" placeholder="Contraseña">
    				<div id="error-password" class="alert alert-danger"><strong>Error!</strong> La contraseña debe contener al menos 8 caracteres, una letra y un número</div>
					<label class="checkbox-inline">
						<!--<input type="checkbox" id="remember" value="Remember me"> Remember me-->
					</label>
					<input class="btn btn-block btn-lg btn-success submit" type="submit" value="Registrarme!">
				</form>
				{if isset($mensaje)}
				<hr>
					{if $mensaje.es_error}
						<div class="alert alert-danger">
						  <strong>Error!</strong> 
					{else}
						<div class="alert alert-success">
						<strong>Felicitaciones!</strong> 		
					{/if}
					{$mensaje.feedback}
					</div>
				{/if}

			<!--<a href="#" class="btn btn-sm btn-default forgot">Forgot your password?</a>-->
	</div>
</div>
	{include file='footer.tpl'}
</body>
