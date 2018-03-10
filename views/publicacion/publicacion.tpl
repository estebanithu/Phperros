<div class="col-md-4 col-sm-3 col-xs-12">
  <h5 class="card-title">
        {if ($pub.tipo == 'E')}
          <a href="#">Encontrado</a>
        {else}
          <a href="#">Perdido</a>
        {/if}
  </h5>
  <div class="card h-100">
    <a target="_blank" href="#"><img class="card-img-top" src="https://www.infobae.com/new-resizer/WCjc7Cx5cJjAqLCcf7gHcDelf-k=/600x0/filters:quality(100)/s3.amazonaws.com/arc-wordpress-client-uploads/infobae-wp/wp-content/uploads/2017/04/06155038/perro-beso-1024x576.jpg" alt=""></a>
    <div class="card-body">
      <h4 class="card-title">
        <a target="_blank" href="#">{$pub.titulo}</a>
      </h4>
      <p class="card-text">{$pub.descripcion}</p>
    </div>
  </div>
</div>