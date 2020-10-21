$(document).ready(function(){
    
    $('.lista-contenido').slick({
      arrows: false,
      dots: true,
      slidesToShow: 3,
      responsive: [
        {
          breakpoint: 1024,
          settings: {
            slidesToShow: 2
          }
        },
        {
          breakpoint: 700,
          settings: {
            slidesToShow: 1
          }
        }
      ]
    });
   
    $('.slide').slick({
      dots: false,
      arrows: true,
      slidesToShow: 3,
      responsive: [
        {
          breakpoint: 768,
          settings: {
            slidesToShow: 2
          }
        },
        {
          breakpoint: 480,
          settings: {
            dots: true,
            arrows: false,
            slidesToShow: 1
          }
        }
      ]
    });
    
    $('.slide-inicio').slick({
      dots: false,
      arrows: true,
      slidesToShow: 3,
      responsive: [
        {
          breakpoint: 768,
          settings: {
            slidesToShow: 2
          }
        },
        {
          breakpoint: 480,
          settings: {
            dots: true,
            arrows: false,
            slidesToShow: 1
          }
        }
      ]
    });
    
    $('.slide-cursos').slick({
      dots: false,
      arrows: true,
      slidesToShow: 6,
      responsive: [
        {
          breakpoint: 850,
          settings: {
            slidesToShow: 5
          }
        },
        {
          breakpoint: 768,
          settings: {
            slidesToShow: 4
          }
        },
        {
          breakpoint: 600,
          settings: {
            slidesToShow: 3
          }
        },
        {
          breakpoint: 480,
          settings: {
            arrows: false,
            dots: true,
            slidesToShow: 2
          }
        }
      ]
    });
    
    $('.slide-extra').slick({
      dots: false,
      arrows: false,
      slidesToShow: 7,
      responsive: [
        {
          breakpoint: 1024,
          settings: {
            arrows: false,
            slidesToShow: 6
          }
        },
        {
          breakpoint: 850,
          settings: {
            arrows: false,
            slidesToShow: 5
          }
        },
        {
          breakpoint: 768,
          settings: {
            arrows: false,
            slidesToShow: 4
          }
        },
        {
          breakpoint: 600,
          settings: {
            arrows: false,
            slidesToShow: 3
          }
        },
        {
          breakpoint: 480,
          settings: {
            arrows: false,
            slidesToShow: 2
          }
        }
      ]
    });
    
    $('.item-slide ul').slick({
      dots: false,
      arrows: true,
      slidesToShow: 4,
      responsive: [
        {
          breakpoint: 768,
          settings: {
            arrows: false,
            slidesToShow: 3
          }
        },
        {
          breakpoint: 480,
          settings: {
            arrows: false,
            slidesToShow: 1
          }
        }
      ]
    });
    
    $('.titulo-faq').click(function(e) {    
        e.preventDefault();
        $(this).toggleClass("arrow-tab");   
        $(this).next('.respuesta-faq').slideToggle(500);
    });

    $('.wrapper-academica table').stacktable();
    
    $('.ico-filtro').on('click', function () {
		$(this).addClass('active');
        $('body').css('overflow', 'hidden');
        $('.sidebar-cursos').animate({left: 0});
	}); //$('#navbar-toggle').on('click', function () {
    
    $('.close-sidebar').on('click', function () {
        $('.ico-filtro').removeClass('active');
        $('body').css('overflow', 'auto');
		$('.sidebar-cursos').animate({left: '-55%'});
    });
    
    $('.item-mensaje a').click(function(){
        if ( !$(this).hasClass('active') ) {
			$(this).addClass('active');
			$(this).prev('.txt-mensaje').css({ "height":'100%'}, "slow"); 
            $(this).text('Vista reducida');
		} else {
            $(this).removeClass('active');
			$(this).prev('.txt-mensaje').css({ "height":'86px'}, "slow"); 
            $(this).text('Ver mensaje completo');
		} //if ( !$(this).hasClass('navbar-toggle-active') ) {
    });
    
    $('.row-tabs ul li').click(function(){
        
        $('.row-tabs ul li').removeClass('tab-active');
       
        var id = $(this).data('id');
        
        $(this).addClass('tab-active');
        
        $.when($('.s-tab').hide()).done(function () {
			$('.tab-' + id).show();
		});
        
    });
    
    $('.boton-acordeon').click(function(e) {    
        e.preventDefault();
        $(this).toggleClass('active-acordeon');   
        $(this).next('.wrapper-acordeon').slideToggle(500);
    });
    
    $('.boton-alumno').click(function(e) {    
        e.preventDefault();
        $(this).toggleClass('active-acordeon');   
        $(this).next('.respuesta-alumno').slideToggle(500);
    });
    
    $('.item-programa a').click(function(e) {    
        e.preventDefault();
        $(this).toggleClass('active-plan');   
        $(this).next('.row-planes').slideToggle(500);
    });
    
});