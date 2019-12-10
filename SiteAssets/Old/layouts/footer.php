    <footer class="dark-bg sec-padding">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-3 col-sm-7">
                    <h4 class="m-b-20 text-white">OPENING HOURS</h4>
                    <ul class="p-0 contact-info f-s-14">
                        <li>
                            <i class="fas fa-clock m-r-5"></i> From Thursday, December  - To Saturday, December
                            <br>
                            Daily opening hours:
                            <br>
                            11:00 AM – 08:00 PM
                        </li>
                    </ul>
                   
                </div>
                <div class="col-md-2 col-sm-5">
                    <h4 class="m-b-20 text-white">Site Map</h4>
                    <ul class="links p-0 f-s-15">
                        <li>
                            <a href="#">Book Stand Now</a>
                        </li>
                        <li>
                            <a href="attend.php">Attend</a>
                        </li>
                        <li>
                            <a href="#">Downloads</a>
                        </li>
                    </ul>
                   

                </div>
                <div class="col-md-3">
                    <h4 class="m-b-20 text-white">Subscribe</h4>
                    <ul class=" p-0 f-s-15 m-t-30">
                        <form>
                            <div class="form-row">
                                <input type="email" class="form-control col-10" placeholder="Your Email Address">
                                <button class="btn  gradient-top white-btn  col-2"><i class="far fa-envelope"></i></button>
                            </div>
                        </form>

                        <li class="text-white"> Get the latest industry news delivered to your inbox </li>
                       
                    </ul>
                </div>
                <div class="col-md-4">
                    <h4 class="m-b-20 text-white">Get In Touch</h4>
                    <li class="text-white">
                        <i class="fas fa-map-marker-alt  m-r-5"></i>
                        11 Author Ali Adham St., from Gad Elhak St. Sheraton Heliopolis, Cairo – Egypt
                    </li>
                    <li class="m-t-5">
                        <a href="mailto:info@example.com">
                            <i class="far fa-envelope  m-r-5"></i>
                            info@intradamena.com
                        </a>
                    </li>
                    <li class="m-t-5">
                        <a href="tel:010010001000">
                            <i class="fas fa-phone  m-r-5"></i>
                            +202 22663402 – 5
                        </a>
                    </li>
                    <li class="m-t-5">
                        <a href="tel:010010001000">
                            <i class=" fa fa-phone-square  m-r-5"></i>
                            +201063318394
                        </a>
                    </li>
                    <li class="m-t-5">
                        <a href="www.intrada.com">
                            <img src="Technomasr/images/intrada_LOGO.png" alt=""  class=" m-t-10" style="max-height:90px;">
                        </a>
                    </li>
                    
                    <!--
                        <form>
                            <div class="form-row">
                                <div class="form-group col-6">
                                    <input type="text" class="form-control" placeholder="Name">
                                </div>
                                <div class="form-group col-6">
                                    <input type="email" class="form-control" placeholder="Email Address">
                                </div>
                            </div>
                            <div class="form-group">
                                <textarea class="form-control" placeholder="Write your message"></textarea>
                            </div>
                            <button type="submit" class="btn gradient-top white-btn  bold w-100">Send</button>
                        </form>
                    -->
                </div>
            </div>
            <hr/>
           



            <div class="copyright text-center text-white ">
                <p>All rights reserved for <a href="www.intradamena.com">
                            <img src="Technomasr/images/Intrada_LOGO.png" alt=""  class="bg-white m-t-10 m-r-5 m-l-5" style="max-height:40px;"> &copy; 2019</p>
                
            </div>
        </div>
    </footer>
    

        <!-- scripts -->
            <!-- jquery file -->
            <script src="Technomasr/js/jquery.js"></script>
            <script src="Technomasr/js/script.js"></script>

        <!-- bootstrap js -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
        <script src="Technomasr/bootstrap4/js/bootstrap.min.js"></script>
        <script src="Technomasr/css/fonts/fontawesome/js/all.js"></script>

        <!-- include Owl Carousel plugin js-->
        <script src="Technomasr/owl-carousel/owl.carousel.min.js"></script>

        <script src="Technomasr/js/wow.js"></script>
        <script> wow = new WOW({
            boxClass: 'wow',      // default
            animateClass: 'animated', // default
            offset: 0,          // default
            mobile: true,       // default
            live: true        // default
            }
            )
            wow.init();
        </script>
        <script>
// Set the date we're counting down to
var countDownDate = new Date("Dec 12, 2019  10:00:00").getTime();

// Update the count down every 1 second
var x = setInterval(function() {

  // Get today's date and time
  var now = new Date().getTime();
    
  // Find the distance between now and the count down date
  var distance = countDownDate - now;
    
  // Time calculations for days, hours, minutes and seconds
  var days = Math.floor(distance / (1000 * 60 * 60 * 24));
  var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
  var seconds = Math.floor((distance % (1000 * 60)) / 1000);
    
  // Output the result in an element with id="demo"
  document.getElementById("demo").innerHTML = days + "days " + hours + "h "
  + minutes + "m " + seconds + "s ";
    
  // If the count down is over, write some text 
  if (distance < 0) {
    clearInterval(x);
    document.getElementById("demo").innerHTML = "EXPIRED";
  }
}, 1000);
</script>
        <!-- end scripts -->

    </body>
</html>