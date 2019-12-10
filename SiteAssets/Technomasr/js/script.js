// for side menu in responsive
function openNav() {
    document.getElementById("mySidenav").style.width = "70%";
    // document.getElementById("flipkart-navbar").style.width = "50%";
    document.body.style.backgroundColor = "rgba(0,0,0,0.4)";
}
function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
    document.body.style.backgroundColor = "rgba(0,0,0,0)";
}


//-------------- Owl-Carousel --------------
$(document).ready(function() {
 
	$(".owl-demo").owlCarousel({
   
		autoPlay: 3000, //Set AutoPlay to 3 seconds
   
		items : 4,
		itemsDesktop : [1024,3], //5 items between 1000px and 901px
		itemsDesktopSmall : [900,2], // betweem 900px and 601px
		itemsTablet: [600,1], //2 items between 600 and 0;
		itemsMobile : false // itemsMobile disabled - inherit from itemsTablet option
   
	});
   
});



// counter //
//---------------- Number Count ---------------
/*$('.counter-value').each(function () {
	$(this).prop('Counter',0).animate({
		Counter: $(this).text()
	}, {
		duration: 5000,
		easing: 'swing',
		step: function (now) {
			$(this).text(Math.ceil(now));
		}
	});
});
*/

//------------------------ Owl Carousel -----------------
$(document).ready(function() {
 
  $(".partners-owl-demo").owlCarousel({
 
      autoPlay: 3000, //Set AutoPlay to 3 seconds
 
      items : 5,
      itemsDesktop : [1199,4],
      itemsDesktopSmall : [900,3], // betweem 900px and 601px
      itemsTablet: [640,3], //2 items between 600 and 0;
      itemsMobile : [360,2] //
 
  });
  $(".coursesSec-owl-demo").owlCarousel({
 
    items:5,
    itemsDesktop:[1199,6],
    itemsDesktopSmall:[991,3],
    itemsTablet:[768,2],
    nav:true,
    autoPlay:true,
    dots:false
  });

  $(".single-owl-demo").owlCarousel({
 
    autoPlay: 3000, //Set AutoPlay to 3 seconds

    items : 1,
    itemsDesktop : [1199,1],
    itemsDesktopSmall : [900,1], // betweem 900px and 601px
    itemsTablet: [640,1], //2 items between 600 and 0;
    itemsMobile : false //

  });

});


