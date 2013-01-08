// JavaScript Document
//-------------Login panel start-----------------------------------------------------

		$(document).ready(function() {
  $('#login').click(function() {
   $("#login_form").toggleClass('ocultar');
  });
});

//-------------Login panel fin----------------------------------------------------
<!-----------------------------------------------------
	<!-- II_V draggable
	
	$(document).ready(function(){
		 $(".II-V_2 img").mouseover(function () {
      $(this).css("cursor","move");
    });
	 $(".II-V_1 img").mouseover(function () {
      $(this).css("cursor","move");
    }); 
	
		$('.II-V_2 img').draggable();
		$('.II-V_1 img').draggable();
		$('.ritmo img').draggable();
	});
	<!-- II_V draggable fin
<!-----------------------------------------------------
	
//----------------Aleatorios -------------------------------------------------------
$(document).ready(function() {
  $('#elemento .boton').hover(function() {
    $(this).addClass('hover');
  }, function() {
    $(this).removeClass('hover');
  });
});

/*
$(document).ready(function() {
  $('#elemento .titulo').hover(function() {
    $(this).addClass('titulo');
  }, function() {
    $(this).removeClass('titulo');
  });
});*/
$(document).ready(function() {
  $('.titulo').click(function() {
   $(this).next().toggleClass('ocultar');
  });
});
$(document).ready(function() {
  $('.titulo').trigger('click');
});
/*
$(document).ready(function() {
  $('#elemento .titulo').click .toggle(function() {
    $('.ocultar').addClass('#elemento .objeto');
  }, function() {
    $('.ocultar').removeClass('#elemento .objeto');
  });
});
*/

//-------------------Aleatorios fin ----------------------------------------------------


