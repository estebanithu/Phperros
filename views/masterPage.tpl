<!DOCTYPE html>
<html lang="en">
  
  {include file='header.tpl'}

  <body>

    {include file='navBar.tpl'}


    <!-- Page Content -->
    <div class="container">

      <!-- Page Heading -->
      <h1 class="my-4">Ahora!
        <small>Ultimos 10 anuncios en Phperros&Cia.</small>
      </h1>

      <div class="row">
          {foreach from=$publicaciones item=pub}

              <div class="col-lg-4 col-sm-6 portfolio-item">
                <h5 class="card-title">
                      {if ($pub.tipo == 'E')}
                        <a href="#">Encontrado</a>
                      {else}
                        <a href="#">Perdido</a>
                      {/if}
                </h5>
                <div class="card h-100">
                  <a href="#"><img class="card-img-top" src="http://placehold.it/700x400" alt=""></a>
                  <div class="card-body">
                    <h4 class="card-title">
                      <a href="#">{$pub.titulo}</a>
                    </h4>
                    <p class="card-text">{$pub.descripcion}</p>
                  </div>
                </div>
              </div>
          {/foreach}



      </div>
      <!-- /.row -->

      <!-- Pagination -->
      <ul class="pagination justify-content-center">
        <li class="page-item">
          <a class="page-link" href="#" aria-label="Previous">
            <span aria-hidden="true">&laquo;</span>
            <span class="sr-only">Previous</span>
          </a>
        </li>
        <li class="page-item">
          <a class="page-link" href="#">1</a>
        </li>
        <li class="page-item">
          <a class="page-link" href="#">2</a>
        </li>
        <li class="page-item">
          <a class="page-link" href="#">3</a>
        </li>
        <li class="page-item">
          <a class="page-link" href="#" aria-label="Next">
            <span aria-hidden="true">&raquo;</span>
            <span class="sr-only">Next</span>
          </a>
        </li>
      </ul>

    </div>
    <!-- /.container -->



    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  </body>

</html>
