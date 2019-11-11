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
					<li data-id="{$esp.id}" data-tipo="especie">{$esp.nombre}</li>
				{/foreach}
			</ul>
		</div>
		<div class="filtros">
			<h3 data-toggle="collapse" data-target="#filtros-razas">Razas</h3>
			<ul id="filtros-razas">
				{foreach from=$razas item=raz}
					<li data-id="{$raz.id}" data-especieid="{$raz.especie_id}" data-tipo="raza">{$raz.nombre}</li>
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
	<div id="container-central" class="col-md-9 col-sm-9 col-xs-12">
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
			<div class="col">
				<div class="pull-right" style="margin-right: 50px;">
					<div id="cantidad-x-paginas-dd" class="dropdown col-md-5  pull-left" >
	                    <a class="btn btn-default dropdown-toggle mediumFont" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
	                        <span id="cantidad-x-paginas-selected" data-val="10">10</span>
	                        <span class="caret"></span>
	                    </a>
	                    <ul id="cantidad-x-paginas" class="dropdown-menu">
	                    	<li data-id="1" title="10"><a>10</a></li>
	                    	<li data-id="2" title="20"><a>20</a></li>
	                    	<li data-id="3" title="50"><a>50</a></li>
	                    	<li data-id="Todas" title="Todas"><a>Todas</a></li>
	                    </ul>
                	</div>
				</div>
			</div>
		</div>
		{include file='publicacion/publicacionesconpaginado.tpl'}
	</div>
</div>
	{include file='footer.tpl'}
</body>
