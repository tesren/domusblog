//Comportamiento navbar
$(window).scroll(function () {

  var scrolled = $(this).scrollTop();

  let navHeigth = $('#mainHeader').height();

  //console.log(scrolled);
  //console.log(navHeigth);

  if ($(window).width() > 768) {

      if (scrolled > (navHeigth) ) {
          $('#fixedTopMsg').addClass('fixed-top');
      } 
      else {
          $('#fixedTopMsg').removeClass('fixed-top');
      }

  }else{}

});
