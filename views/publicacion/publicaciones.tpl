{include file='header.tpl'}
<link rel="stylesheet" type="text/css" href="css/publicaciones.css">
<script type="text/javascript" src="js/publicaciones.js"></script>
<body>
{include file='navBar.tpl'}
<div id="container-principal" class="row">
	<div id="container-filtros" class="col-md-3 col-sm-3 col-xs-12">
		<div class="filtros">
			<h3 data-toggle="collapse" data-target="#filtros-especies">Especies</h3>
			<ul id="filtros-especies">
				{foreach from=$especies item=esp}
					<li data-id="{$esp.id}">{$esp.nombre}</li>
				{/foreach}
			</ul>
		</div>
		<div class="filtros">
			<h3 data-toggle="collapse" data-target="#filtros-razas">Razas</h3>
			<ul id="filtros-razas">
				{foreach from=$razas item=raz}
					<li data-id="{$raz.id}">{$raz.nombre}</li>
				{/foreach}
			</ul>
		</div>
		<div class="filtros">
			<h3 data-toggle="collapse" data-target="#filtros-barrios">Barrios</h3>
			<ul id="filtros-barrios">
				{foreach from=$barrios item=bar}
					<li data-id="{$bar.id}">{$bar.nombre}</li>
				{/foreach}
			</ul>
		</div>
	</div>
	<div id="container-publicaciones" class="col-md-9 col-sm-9 col-xs-12">
		<div class="row">
			 <div class="radio">
  				<label><input type="radio" name="encontradosperdidos" value=0 checked>Todos</label>
			</div>
			<div class="radio">
  				<label><input type="radio" name="encontradosperdidos" value=1 >Encontrados</label>
			</div>
			<div class="radio">
  				<label><input type="radio" name="encontradosperdidos" value=2 >Perdidos</label>
			</div>
		</div>
		<div class="row">
			{foreach from=$publicaciones item=pub}
				{include file='publicacion/publicacion.tpl'}
			{/foreach}
		</div>
			
	</div>
</div>
	{include file='footer.tpl'}
</body>
