<ul class="pagination justify-content-center">
        
     {if $cantpages>1} 
        {if $paginaseleccionada!=1}
        <li class="page-item">
          <p class="page-back page-link" aria-label="Previous">
            <span aria-hidden="true">&laquo;</span>
            <span class="sr-only">Previous</span>
          </p>
        </li>
        {/if}
        {for $current=1 to $cantpages}  
          {if $paginaseleccionada==$current} 
            <li class="page-number page-item active">
                
          {else}
            <li class="page-number page-item">
          {/if}
              <span class="page-link">{$current}</span>
            </li>
        {/for}
        {if $paginaseleccionada<$cantpages}
          <li class="page-item">
            <p class="page-forward page-link"  aria-label="Next">
              <span aria-hidden="true">&raquo;</span>
              <span class="sr-only">Next</span>
            </p>
          </li>
        {/if}
      {/if}
</ul>