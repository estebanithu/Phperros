<ul class="pagination justify-content-center">
        <li class="page-item">
          <a class="page-link" href="#" aria-label="Previous">
            <span aria-hidden="true">&laquo;</span>
            <span class="sr-only">Previous</span>
          </a>
        </li>
        {for $current=1 to $cantpages}  
          {if $paginaseleccionada==$current} 
            <li class="page-number page-item active">
                
          {else}
            <li class="page-number page-item">
          {/if}
              <span class="page-link">{$current}</span>
            </li>
        {/for}
        <li class="page-item">
          <a class="page-link" href="#" aria-label="Next">
            <span aria-hidden="true">&raquo;</span>
            <span class="sr-only">Next</span>
          </a>
        </li>
</ul>