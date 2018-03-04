<div class="col-md-4 col-sm-3 col-xs-12">
  <h5 class="card-title">
        {if ($pub.tipo == 'E')}
          <a href="#">Encontrado</a>
        {else}
          <a href="#">Perdido</a>
        {/if}
  </h5>
  <div class="card h-100">
    <a target="_blank" href="#"><img class="card-img-top" src="http://placehold.it/700x400" alt=""></a>
    <div class="card-body">
      <h4 class="card-title">
        <a target="_blank" href="#">{$pub.titulo}</a>
      </h4>
      <p class="card-text">{$pub.descripcion}</p>
    </div>
  </div>
</div>