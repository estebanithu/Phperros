{include file='header.tpl'}
<link rel="stylesheet" type="text/css" href="css/publicacionregistro.css">
<script type="text/javascript" src="js/publicacionregistro.js"></script>
<body>
	{include file='navBar.tpl'}
	<div id="container-principal" class="row">
		<h3 style="margin:auto">Registro publicacion</h3>
		<div id="container-error" class="alert alert-danger oculto">
			<span id="close-error" class="fa fa-times"></span>
		    <strong>Error!</strong>
		    <p id="error"></p>
		</div>
		<div id="form-registro">
			 <div id="container-form-fields" class="row">
			  <div class="form-group col-12">
			    <label for="titulo" class="obligatorio">Titulo</label>
			    <input type="text" class="form-control" id="titulo">
			  </div>
			  <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6">
			    <label for="descripcion" class="obligatorio">Descripcion</label>
			    <textarea class="form-control" id="descripcion" rows="3"></textarea>
			  </div>
			  <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6">
			    <label for="select-tipo" class="obligatorio">Tipo</label>
			    <select class="form-control" id="select-tipo">
			    	<option value="-1">---</option>
			    	<option value="P">Perdido</option>
			    	<option value="E">Encontrado</option>
			    </select>
			  </div>
			  <div class="form-group col-6 ">
			    <label for="select-especie" class="obligatorio">Especie</label>
			    <select class="form-control" id="select-especie">
			    	<option value="-1">---</option>
			    	{foreach from=$especies item=esp}
						<option value="{$esp.id}">{$esp.nombre}</option>
					{/foreach}
			    </select>
			  </div>
			  <div class="form-group col-6">
			    <label for="select-raza" class="obligatorio">Raza</label>
			    <select class="form-control" id="select-raza">
			    	<option value="-1">---</option>
			     	{foreach from=$razas item=raz}
						<option value="{$raz.id}" data-especieid="{$raz.especie_id}">{$raz.nombre}</option>
					{/foreach}
			    </select>
			  </div>
			  <div class="form-group col-12">
			    <label for="select-barrio" class="obligatorio">Barrio</label>
			    <select class="form-control" id="select-barrio">
			     	<option value="-1">---</option>
			      	{foreach from=$barrios item=bar}
			      		<option value="{$bar.id}">{$bar.nombre}</option>
					{/foreach}
			    </select>
			  </div>
			  </div>
			  <hr>
			  <input id="btn-registrar" class="btn btn-block btn-lg btn-success submit" type="button" value="Registrar"><br>
		</div>
	</div>
	{include file='footer.tpl'}
</body>
