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
  
    $(".single-owl-demo").owlCarousel({
   
      autoPlay: 3000, //Set AutoPlay to 3 seconds
  
      items : 1,
      itemsDesktop : [1199,1],
      itemsDesktopSmall : [900,1], // betweem 900px and 601px
      itemsTablet: [640,1], //2 items between 600 and 0;
      itemsMobile : false //
  
  });
  
   
  });
  