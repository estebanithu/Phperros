<!DOCTYPE html>
<html lang="en">
  
  {include file='header.tpl'}

  <body>

    {include file='navBar.tpl'}
    <!-- Page Content -->
    <div id="contenedor-panel" class="container">
    	<h3 class="my-4">
    		Estadisticas en Phperros&cia.
    	</h3>

	    <section id="counter" class="counter">

           <div class="container">
           		<div id="estadisticas-totales" class="row">
           			<div class="col-md-3">
           			    <div class="single_counter p-y-2 m-t-1">
           			        <i class="fa fa-newspaper-o m-b-1"></i>
           			        <h2 class="statistic-counter">{$totalPublicaciones}</h2>
           			        <p>Publicaciones en total</p>
           			    </div>
           			</div>
           			<div class="col-md-2">
           			    <div class="single_counter p-y-2 m-t-1">
           			        <i class="fa fa-check-circle-o m-b-1"></i>
           			        <h2 class="statistic-counter">{$totales['abiertas']}</h2>
           			        <p>Publicaciones abiertas</p>
           			    </div>
           			</div>
           			<div class="col-md-2">
           			    <div class="single_counter p-y-2 m-t-1">
           			        <i class="fa fa-times-circle-o m-b-1"></i>
           			        <h2 class="statistic-counter">{$totales['cerradas']}</h2>
           			        <p>Publicaciones cerradas</p>
           			    </div>
           			</div>
           			<div class="col-md-2">
           			    <div class="single_counter p-y-2 m-t-1">
           			        <i class="fa fa-thumbs-o-up m-b-1"></i>
           			        <h2 class="statistic-counter">{$totales['exitosas']}</h2>
           			        <p>Resultados exitosos</p>
           			    </div>
           			</div>
           			<div class="col-md-2">
           			    <div class="single_counter p-y-2 m-t-1">
           			        <i class="fa fa-thumbs-o-down m-b-1"></i>
           			        <h2 class="statistic-counter">{$totales['fracasadas']}</h2>
           			        <p>Resultados negativos</p>
           			    </div>
           			</div>
           		</div>
           		<hr>
           		<h5><i class="fa fa-filter"></i> Segregadas por especie</h5>
           		<div class="table-responsive">
					<table class="table">
						<thead>
						  <tr>
						    <th scope="col">Especie</th>
						    <th scope="col">Abiertas</th>
						    <th scope="col">Cerradas</th>
						    <th scope="col">Exitosas</th>
						    <th scope="col">Negativas</th>
						  </tr>
            			</thead>
            			<tbody>
            				{foreach from=$estadisticasPorEspecie item=est }
            				  <tr>
            				    <td scope="row">{$est.nombre}</td>
            				    <td>{$est.abiertas}</td>
            				    <td>{$est.cerradas}</td>
            				    <td>{$est.exitosas}</td>
            				    <td>{$est.fracasadas}</td>    
            				  </tr>
            				{/foreach}
            			</tbody>
					</table>
               </div>
               <a href="PanelUsuario" class="btn btn-danger"><i class="fa fa-backward"></i> Volver al panel de usuario </a>
           </div>
       </section><!-- End of counter Section -->
    		
    </div>
    {include file='footer.tpl'}
    <script type="text/javascript" src="vendor/jquery/jquery.waypoints.min.js"></script>
  	<script type="text/javascript" src="vendor/jquery/jquery.counterup.min.js"></script>
  	<script type="text/javascript" src="js/estadisticas.js"></script>
  </body>

</html>
