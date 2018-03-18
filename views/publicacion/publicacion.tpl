<div class="col-md-4 col-sm-3 col-xs-12">
  <h5 class="card-title">
  </h5>
  <div class="card h-100">
    <a target="_blank" href="Publicacion/verDetalle/{$pub.id}"><img class="card-img-top" src="{$pub.img}" alt=""></a>
      {if $pub.tipo == 'E'}
        <div class="alert alert-success" role="alert" style="text-align: center;padding: 0;" ><i class='fa fa-check-circle'></i> Encontrado</div>
      {else}
        <div class="alert alert-danger" role="alert"  style="text-align: center;padding: 0;"><i class='fa fa-search'></i> Perdido</div>
      {/if}
    <div class="card-body">
      <h4 class="card-title">
        <a target="_blank" href="Publicacion/verDetalle/{$pub.id}">{$pub.titulo}</a>
      </h4>
      <p class="card-text">{$pub.descripcion}</p>
    </div>
  </div>
</div>


