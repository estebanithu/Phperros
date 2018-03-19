{include file='header.tpl'}
<!--FILE UPLOAD-->
<link rel="stylesheet" href="vendor/fileupload/css/blueimp-gallery.min.css">
<!-- CSS to style the file input field as button and adjust the Bootstrap progress bars -->
<link rel="stylesheet" href="vendor/fileupload/css/jquery.fileupload.css">
<link rel="stylesheet" href="vendor/fileupload/css/jquery.fileupload-ui.css">
<!-- CSS adjustments for browsers with JavaScript disabled -->
<noscript><link rel="stylesheet" href="vendor/fileupload/css/jquery.fileupload-noscript.css"></noscript>
<noscript><link rel="stylesheet" href="vendor/fileupload/css/jquery.fileupload-ui-noscript.css"></noscript>
<!--FILE UPLOAD-->

<link rel="stylesheet" type="text/css" href="css/publicacionregistro.css">
 <!--GOOGLE MAP -->
 <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=
			    AIzaSyC1w02yNO4juQRBJBaSE20p2-CZMZlaP5A&callback=initMap">
 </script>
<!--GOOGLE MAP -->
<script type="text/javascript" src="js/publicacionregistro.js"></script>

<body>
	{include file='navBar.tpl'}
	<div id="modal-registro-publicacion" class="modal fade" data-backdrop="static">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4>Publicación finalizada con exito</h4>
                </div>
                <div id="modal-body-RegistroPublicacion" class="modal-body mediumFont">
	                <div class='row'>
	                    <a id="nueva-publicacion" class="btn btn-block btn-lg btn-success submit" type="button" href="Publicacion/registro/">Registrar nueva publicación</a>
	                </div>
	                <div class="row">
	                 	<a href='PanelUsuario' id="ver-publicaciones" class="btn btn-block btn-lg btn-primary submit" type="button">
	                 		Ver mis publicaciones
	                 	</a>
	                </div>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
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
			    	<option value="-1" data-especieid="-1">---</option>
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
			  <div class="form-group col-12">
			  	<label for="select-barrio">Ubicación</label>
			    <div id="map"></div>
			  </div>
			  </div>
			  <hr>
			  <form id="fileupload" action="https://jquery-file-upload.appspot.com/" method="POST" enctype="multipart/form-data">
				  <div class="row fileupload-buttonbar">
	            	<div class="col-lg-7">
						<span class="btn btn-success fileinput-button">
				            <i class="fa fa-plus-circle"></i>
				            <span>Agregue imagenes...</span>
				            <input type="file" name="files[]" multiple>
			         	</span>
			         	<span style="font-style: italic;"> Intente arrastrar las imagenes aquí </span>
			         	<button  id="upload-all-images" type="submit" class="btn btn-primary start" style="display:none">
		                    <i class="glyphicon glyphicon-upload"></i>
		                    <span >Start upload</span>
		                </button>
		                <!--<button type="reset" class="btn btn-warning cancel">
		                    <i class="glyphicon glyphicon-ban-circle"></i>
		                    <span>Cancel upload</span>
		                </button>
		                <button type="button" class="btn btn-danger delete">
		                    <i class="glyphicon glyphicon-trash"></i>
		                    <span>Delete</span>
		                </button>
		                <input type="checkbox" class="toggle">
		                <span class="fileupload-process"></span>-->
		                </div>
					</div>
		         	<table id="tabla-imagenes" role="presentation" class="table table-striped">
		         		<tbody class="files">
		         			
		         		</tbody>
		         	</table>
		         	<button id="btn-registrar" class="btn btn-block btn-lg btn-success submit" type="button"><i class='fa fa-pencil'></i> Registrar</button>
	    	</form>
		</div>
	</div>
	{include file='footer.tpl'}
</body>
{literal}
<!-- The template to display files available for upload -->
<script id="template-upload" type="text/x-tmpl">
	{% for (var i=0, file; file=o.files[i]; i++) { %}
	    <tr class="template-upload">
	        <td>
	            <span class="preview"></span>
	        </td>
	        <td>
	            <p class="name">{%=file.name%}</p>
	            <strong class="error text-danger"></strong>
	        </td>
	        <td>
	            <p class="size">Processing...</p>
	            {% if (!i) { %}
	                <button class="btn btn-warning cancel">
	                    <i class="glyphicon glyphicon-ban-circle"></i>
	                    <span>Cancel</span>
	                </button>
	            {% } %}
	        </td>
	        <td>
	            {% if (!i && !o.options.autoUpload) { %}
	                <button class="btn btn-primary start" disabled>
	                    <i class="glyphicon glyphicon-upload"></i>
	                    <span>Start</span>
	                </button>
	            {% } %}
	            
	        </td>
	    </tr>
	{% } %}
</script>
<!-- The template to display files available for download -->
<script id="template-download" type="text/x-tmpl">
{% for (var i=0, file; file=o.files[i]; i++) { %}
    <tr class="template-download">
        <td>
            <span class="preview">
                {% if (file.thumbnailUrl) { %}
                    <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" data-gallery><img src="{%=file.thumbnailUrl%}"></a>
                {% } %}
            </span>
        </td>
        <td>
            <p class="name">
                {% if (file.url) { %}
                    <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" {%=file.thumbnailUrl?'data-gallery':''%}>{%=file.name%}</a>
                {% } else { %}
                    <span>{%=file.name%}</span>
                {% } %}
            </p>
            {% if (file.error) { %}
                <div><span class="label label-danger">Error</span> {%=file.error%}</div>
            {% } %}
        </td>
        <td>
            <span class="size">{%=o.formatFileSize(file.size)%}</span>
        </td>
        <td>
            {% if (file.deleteUrl) { %}
                <button class="btn btn-danger delete" data-type="{%=file.deleteType%}" data-url="{%=file.deleteUrl%}"{% if (file.deleteWithCredentials) { %} data-xhr-fields='{"withCredentials":true}'{% } %}>
                    <i class="glyphicon glyphicon-trash"></i>
                    <span>Delete</span>
                </button>
                <input type="checkbox" name="delete" value="1" class="toggle">
            {% } else { %}
                <button class="btn btn-warning cancel">
                    <i class="glyphicon glyphicon-ban-circle"></i>
                    <span>Cancel</span>
                </button>
            {% } %}
        </td>
    </tr>
{% } %}
</script>
{/literal}
<!--FILE UPLOAD-->
<!-- ya se incluyo <script src="vendor/fileupload/js/jquery.min.js"></script>-->
<!-- The jQuery UI widget factory, can be omitted if jQuery UI is already included -->
<script src="vendor/fileupload/js/jquery.ui.widget.js"></script>
<!-- The Templates plugin is included to render the upload/download listings -->
<script src="vendor/fileupload/js/tmpl.min.js"></script>
<!-- The Load Image plugin is included for the preview images and image resizing functionality -->
<script src="vendor/fileupload/js/load-image.all.min.js"></script>
<!-- The Canvas to Blob plugin is included for image resizing functionality -->
<script src="vendor/fileupload/js/canvas-to-blob.min.js"></script>
<!-- blueimp Gallery script -->
<script src="vendor/fileupload/js/jquery.blueimp-gallery.min.js"></script>
<!-- The Iframe Transport is required for browsers without support for XHR file uploads -->
<script src="vendor/fileupload/js/jquery.iframe-transport.js"></script>
<!-- The basic File Upload plugin -->
<script src="vendor/fileupload/js/jquery.fileupload.js"></script>
<!-- The File Upload processing plugin -->
<script src="vendor/fileupload/js/jquery.fileupload-process.js"></script>
<!-- The File Upload image preview & resize plugin -->
<script src="vendor/fileupload/js/jquery.fileupload-image.js"></script>
<!-- The File Upload validation plugin -->
<script src="vendor/fileupload/js/jquery.fileupload-validate.js"></script>
<!-- The File Upload user interface plugin -->
<script src="vendor/fileupload/js/jquery.fileupload-ui.js"></script>
<script src="vendor/fileupload/js/main.js"></script>
<!--FILE UPLOAD-->


{literal}
<script>
  //ejemplo https://developers.google.com/maps/documentation/javascript/examples/marker-remove?hl=es-419
 /* var map;
  var marker;

  function initMap() {
    var pos={lat: -34.8859834,
      		 lng: -56.1336387}

    map = new google.maps.Map(document.getElementById('map'), {
      zoom: 10,
      center: pos
    });

    map.addListener('click', function(event) {
      addMarker(event.latLng);
    });
    // Adds a marker at the center of the map.
    //addMarker(pos);
  }

  // Adds a marker to the map and push to the array.
  function addMarker(location) {
  	google.maps.event.clearListeners(map, 'click');
    marker = new google.maps.Marker({
      position: location,
      animation: google.maps.Animation.DROP,
      draggable: true,
      map: map
    });
  }*/
 
</script>
 {/literal}

