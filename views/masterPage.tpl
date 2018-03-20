<!DOCTYPE html>
<html lang="en">
  
  {include file='header.tpl'}

  <body>

    {include file='navBar.tpl'}


    <!-- Page Content -->
    <div class="container" style="padding-bottom: 50px;">

      <!-- Page Heading -->
      <div class="row">
        <div class="col-md-10 col-sm-10 col-xs-12">
            <h1 class="my-4">Ahora!
                <small>Ultimos 10 anuncios en Phperros&Cia.</small> 
            </h1>
        </div>
        <div>
           <a href="Publicacion/vertodas" class="fa fa-search" style="position:relative;top:45%; font-size:23px">Ver todas</a>
        </div>
      </div>
      <div class="row my-4">

          {foreach from=$publicaciones item=pub}

              {include file='publicacion/publicacion.tpl'}
             
          {/foreach}

      </div>
      <!-- /.row -->
    </div>
    <!-- /.container -->
    {include file='footer.tpl'}


    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  </body>

</html>
