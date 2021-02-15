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
            centerMode: true,
            slidesToShow: 1
          }
        }
      ]
    });
    
    $('.slide-cursos').on("init", function(event, slick){
        console.log(slick.slideCount);
        if(slick.slideCount > 4) {
            $(this).addClass('slide-pad');
        }
    });    
    
    $('.slide-cursos').slick({
      dots: false,
      arrows: true,
      slidesToShow: 4,
      responsive: [
        {
          breakpoint: 768,
          settings: {
            slidesToShow: 3
          }
        },
        {
          breakpoint: 600,
          settings: {
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
    
    $('.item-evento ul').slick({
      dots: false,
      arrows: true,
      slidesToShow: 2,
      responsive: [
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
    
    $('.item-itinerario h4').click(function(e) {    
        e.preventDefault();
        $(this).toggleClass("active");   
        $(this).next('.lista-itinerario').slideToggle(500);
    });

    /*$('.wrapper-academica table').stacktable();*/
    
    $('#ico-filtro').on('click', function (e) {
		$(this).addClass('active');
        $('body').css('overflow', 'hidden');
        $('.sidebar-cursos').animate({left: 0});
        e.stopPropagation();
	}); //$('#navbar-toggle').on('click', function () {
    
    $('.close-sidebar').on('click', function () {
        $('#ico-filtro').removeClass('active');
        $('body').css('overflow', 'auto');
		$('.sidebar-cursos').animate({left: '-55%'});
    });
    
    $('#ico-tablero').on('click', function (e) {
		$(this).addClass('active');
        $('body').css('overflow', 'hidden');
        $('.sidebar-tablero').animate({left: 0});
        e.stopPropagation();
	}); //$('#navbar-toggle').on('click', function () {
    
    $('.close-tablero').on('click', function () {
        $('#ico-tablero').removeClass('active');
        $('body').css('overflow', 'auto');
		$('.sidebar-tablero').animate({left: '-55%'});
    });
    
    $('#ico-single').on('click', function (e) {
		$(this).addClass('active');
        $('body').css('overflow', 'hidden');
        $('.sidebar-single').animate({left: 0});
        e.stopPropagation();
	}); //$('#navbar-toggle').on('click', function () {
    
    $('.close-single').on('click', function () {
        $('#ico-single').removeClass('active');
        $('body').css('overflow', 'auto');
		$('.sidebar-single').animate({left: '-55%'});
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
    
    $('.item-programa a.toogle-plan').click(function(e) {    
        e.preventDefault();
        $(this).toggleClass('active-plan');   
        $(this).next('.row-planes').slideToggle(500);
    });
    
    $('.sidebar-tablero ul li.item-control a').click(function(e) {    
        e.preventDefault();
        $(this).toggleClass('active');   
        $(this).next('.sidebar-tablero ul li.item-control ul').slideToggle(500);
    });
    
    $('.delete').click(function(){
        $('#shadow-favorito').fadeIn(300); 
    });
    
    $('#edit-membresia').click(function(){
        $('#shadow-membresia').fadeIn(300); 
    });
    
    $('.close-shadow').click(function(){
        $('.shadow-favorito').fadeOut(300); 
    });
    
    $('.flex-lista').slick({
      dots: true,
      arrows: false,
      slidesToShow: 3,
      responsive: [
        {
          breakpoint: 768,
          settings: {
            slidesToShow: 2
          }
        },
        {
          breakpoint: 525,
          settings: {
            slidesToShow: 1
          }
        }
      ]
    });
    
});


$(document).click(function(e) { 
    if ($(window).width() < 767) {
        if($('.sidebar-cursos').is(':visible')&&!$(e.target).closest('.sidebar-cursos').length) {
            $('#ico-filtro').removeClass('active');
            $('body').css('overflow', 'auto');
            $('.sidebar-cursos').animate({left: '-55%'});
        }

        if($('.sidebar-tablero').is(':visible')&&!$(e.target).closest('.sidebar-tablero').length) {
            $('#ico-tablero').removeClass('active');
            $('body').css('overflow', 'auto');
            $('.sidebar-tablero').animate({left: '-55%'});
        }   

        if($('.sidebar-single').is(':visible')&&!$(e.target).closest('.sidebar-single').length) {
            $('#ico-single').removeClass('active');
            $('body').css('overflow', 'auto');
            $('.sidebar-single').animate({left: '-55%'});
        }   
    }
});