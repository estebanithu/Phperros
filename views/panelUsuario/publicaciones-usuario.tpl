<div>Estas son tus publicaciones en Phperros&Cia:</div>
<div class="table-responsive">
	<table class="table">
	  <thead>
	    <tr>
	      <th scope="col">Titulo</th>
	      <th scope="col">Tipo</th>
	      <th scope="col">Estado</th>
	      <th scope="col">Acciones</th>
	    </tr>
	  </thead>
	  <tbody>
	  	{foreach from=$publicaciones item=pub }
	    <tr>
	      <td scope="row">{$pub.titulo}</td>
	      <td>{$pub.tipo}</td>
	      <td>{$pub.estado}</td>
	      <td>
	      	<a href="Publicacion/verDetalle/{$pub.id}" target="_blank" class="btn btn-sm btn-primary"><i class="fa fa-external-link"></i> Ver </a>
	      	<a href="Publicacion/generarPublicacionPDF/{$pub.id}" target="_blank" class="btn btn-sm btn-primary"><i class="fa fa-file-pdf-o"></i> Generar PDF</a>
	      </td>
	    </tr>
	   {/foreach}
	  </tbody>
	</table>
</div>