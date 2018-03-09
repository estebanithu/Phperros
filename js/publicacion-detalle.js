$(document).ready(function(){
  $(".owl-carousel").owlCarousel({
  	responsive:{
  	    0:{
  	        items:1,
			loop:true,
			margin:10,
			responsiveClass:true,
			autoplay:true,
			center: true,
			nav:true,
			navText:['Anterior','Siguiente']
  	    }
  	}

  });
});