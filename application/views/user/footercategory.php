<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">



<html xmlns="http://www.w3.org/1999/xhtml">



<head>



<meta charset="utf-8" content="<?php echo $seo_data['meta_description']; ?>" />



<meta http-equiv="X-UA-Compatible" content="<?php echo $seo_data['meta_keyword']; ?>" />



<meta name="viewport" content="width=device-width, initial-scale=1.0" />



<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->



<title><?php if(!empty($seo_data['meta_title'])){ echo $seo_data['meta_title'];} else{ echo "D WALKER JEWELRY"; } ?></title>



  <link rel="icon" href="<?php echo base_url(); ?>/assets/images/favicon.png" type="image/png">



<!-- Bootstrap -->



<link href="<?php echo base_url(); ?>/assets/css/bootstrap.min.css" rel="stylesheet" />



<link rel="stylesheet" href="<?php echo base_url(); ?>/assets/css/owl.carousel.min.css"/>



<link href="<?php echo base_url(); ?>/assets/css/global.css" rel="stylesheet" />



<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/assets/css/responsive.css" />



<link rel="stylesheet" href="<?php echo base_url(); ?>/assets/font-awesome/css/font-awesome.css" />



<!-- For parallax Scrolling Effect -->



<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/assets/css/xsparallax.css" />



<link rel="stylesheet" href="<?php echo base_url(); ?>/assets/css/slicknav.css" />



<link rel="stylesheet" href="<?php echo base_url(); ?>/assets/css/animate.min.css"/>



<link href="<?php echo base_url(); ?>/assets/css/animation.min.css" rel="stylesheet"/>







<link rel="stylesheet" href="https://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css" integrity="sha256-2XFplPlrFClt0bIdPgpz8H7ojnk10H69xRqd9+uTShA=" crossorigin="anonymous" />

























<link rel="stylesheet" href="css/jquery-ui.min.css"/>















<script>



document.documentElement.addEventListener('touchstart', function (event) {



            if (event.touches.length > 1) {



                event.preventDefault();



            }



        }, false);



</script>







<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->



<!-- Include all compiled plugins (below), or include individual files as needed -->



<script type="text/javascript" src="<?php echo base_url(); ?>/assets/js/jquery-1.11.3.min.js"></script>



<script type="text/javascript" src="<?php echo base_url(); ?>/assets/js/bootstrap.min.js"></script>



<script type="text/javascript" src="<?php echo base_url(); ?>/assets/js/wow.min.js"></script>



<script type="text/javascript" src="<?php echo base_url(); ?>/assets/js/main.js"></script>



<script type="text/javascript" src="<?php echo base_url(); ?>/assets/js/custom.js"></script>







</head>


<style>
    .product-grid {
    background-color: #fff;
    text-align: center;
    margin-bottom: 18px;
    border: solid 1px #80808047;
}
.product-grid .product-image{
  overflow: hidden;
  position: relative;
}
.product-grid .product-image a.image{ display: block; }
.product-grid .product-image img{
  width: 100%;
  height: auto;
}
.product-grid .product-image .pic-1{ transition: all 0.3s ease 0s; }
.product-grid .product-image:hover .pic-1{ transform: translateX(100%); }
.product-grid .product-image .pic-2{
  width: 100%;
  height: 100%;
  transform: translateX(-101%);
  position: absolute;
  top: 0;
  left: 0;
  transition: all 0.3s ease 0s;
}
.product-grid .product-image:hover .pic-2{ transform: translateX(0); }
.product-grid .product-sale-label{
  color: #fff;
  background: var(--bs-hover);
  font-size: 13px;
  text-transform: uppercase;
  letter-spacing: 1px;
  padding: 2px 8px;
  position: absolute;
  top: 15px;
  left: 15px;
}
.product-grid .product-like-icon{
  color: #696969;
  font-size: 22px;
  line-height: 20px;
  position: absolute;
  top: 15px;
  right: 15px;
}
.product-grid .product-like-icon:hover{ color: var(--bs-hover); }
.product-grid .product-like-icon:before,
.product-grid .product-like-icon:after{
  content: attr(data-tip);
  color: #fff;
  background-color: #000;
  font-size: 12px;
  line-height: 18px;
  padding: 7px 7px 5px;
  visibility: hidden;
  position: absolute;
  right: 0;
  top: 15px;
  transition: all 0.3s ease 0s;
}
.product-grid .product-like-icon:after{
  content: '';
  height: 15px;
  width: 15px;
  padding: 0;
  transform: translateX(-50%) rotate(45deg);
  right: auto;
  left: 50%;
  top: 15px;
  z-index: -1;
}
.product-grid .product-like-icon:hover:before,
.product-grid .product-like-icon:hover:after{
  visibility: visible;
  top: 30px;
}
.product-grid .product-links{
  width: 170px;
  padding: 0;
  margin: 0;
  list-style: none;
  opacity: 0;
  transform: translateX(-50%);
  position: absolute;
  bottom: -50px;
  left: 50%;
  transition: all 0.3s ease 0s;
}
.product-grid:hover .product-links{
  bottom: 40px;
  opacity: 1;
}
.product-grid .product-links li{
  display: inline-block;
  margin: 0 2px;
}
.product-grid .product-links li a{
  color: #fff;
  background: #192a56;
  font-size: 16px;
  line-height: 48px;
  width: 48px;
  height: 48px;
  border-radius: 50%;
  display: block;
  transition: all 0.3s ease 0s;
}
.product-grid:hover .product-links li a:hover{ background: #333; }
.product-grid .product-content{ 
  padding: 15px 0 0;
}
.product-grid .title{
font-size: 18px;
font-weight: 600;
padding-bottom: 10px;
}
.product-grid .price{
  color: #071f75;
    font-size: 16px;
    font-weight: 600;
    margin-bottom: 15px;
}
.product-grid .price span{
  color: #555;
  font-size: 14px;
  font-weight: 400;
  text-decoration: line-through;
  margin: 0 5px 0 0;

}
@media screen and (max-width: 990px){
  .product-grid{ margin: 0 0 30px; }
}
.fa-search{
  line-height:45px !important;
}

.fa-shopping-cart{
  line-height: 45px !important;
    background-color: red;
    width: 48px;
    height: 48px;
    border-radius: 50%;

}

 section header a, .grid-item a {
	font-size: 20px; 
    align-items: center;
    color: #fff;
    font-weight: 700; 
}
</style>








<body id="page-top">



<!-- start parallax -->



<div id="parallax">



        <?php



         $this->load->view('user/header');



		?>



 



  



















    <!-- start innerbanner -->



    <section class="innerbanner">



       <img src="<?php echo base_url(); ?>/assets/images/categorybanner.jpg" alt="" />



    </section>
  
<section>
 
 <div class="Featuredsec" style="margin-top:60px">
<div class="container">
               <div class="row justify-content-center">
                   <div class="col-12">                     
                       <h2 class="head">Products</h2>       
                       <hr /> 
                   </div><!--end col-->
               </div><!--end row-->
               <div class="row justify-content-center">
              <?php  foreach($allproduct as $prod){?>
                   <div class="col-md-3 col-sm-6">
                       <div class="product-grid">
                           <div class="product-image">
                               <a href="<?php echo base_url();?>Products/<?php echo $prod->SlugName; ?>" class="image">
                                   <img class="pic-1" src="<?php echo base_url(); ?>uploads/Products/<?php echo $prod->ProductdefaultImage; ?>">
                                   <img class="pic-2" src="<?php echo base_url(); ?>uploads/Products/<?php echo $prod->ProductdefaultImage; ?>">
                               </a>
                              
                               <!--<ul class="product-links">-->
                               <!--    <li><a href="<?php echo base_url();?>Products/<?php echo $prod->SlugName; ?>"><i class="fa fa-search"></i></a></li>-->
                               <!--    <?php if($prod->productStock == "In Stock"){?>-->
                               <!--    <li><a href="<?php echo base_url();?>Products/<?php echo $prod->SlugName; ?>"><i class="fas fa-shopping-cart"></i></a></li>-->
                               <!--    <?php } ?>-->
                                 
                               <!--</ul>-->
                           </div>
                           <div class="product-content">
                               <h3 class="title"><a href="<?php echo base_url();?>Products/<?php echo $prod->SlugName; ?>"><?php echo $prod->product_name; ?></a></h3>
                               <div class="price">$<?php echo $prod->productPrice; ?> NZD</div>
                           </div>
                       </div>
                   </div>

               <?php } ?>
                  
               </div>
           </div>
              </div>
</section>



 



<?php



 $this->load->view('user/footer');



?>



  <!-- end footer --> 



</div>







<script type="text/javascript" src="<?php echo base_url(); ?>/assets/js/jquery.js"></script> 



<script src="<?php echo base_url(); ?>/assets/js/owl.carousel.min.js"></script> 



<!--<script type="text/javascript" src="js/xsparallax.js"></script>--> 



<script src="<?php echo base_url(); ?>/assets/js/jquery.slicknav.js"></script> 



<script src="<?php echo base_url(); ?>/assets/js/jquery.zoom.min.js"></script> 











<script src="<?php echo base_url(); ?>/assets/js/jquery-ui.min.js"></script> 























<script>



var hero_s = $(".hero-slider");



    hero_s.owlCarousel({



        loop: true,



        margin: 0,



        nav: true,



        items: 1,



        dots: true,



        animateOut: 'fadeOut',



    	animateIn: 'fadeIn',



        navText: ['<i class="flaticon-left-arrow-1"></i>', '<i class="flaticon-right-arrow-1"></i>'],



        smartSpeed: 1200,



        autoHeight: false,



        autoplay: true,



        onInitialized: function() {



        	var a = this.items().length;



            $("#snh-1").html("<span>1</span><span>" + a + "</span>");



        }



    }).on("changed.owl.carousel", function(a) {



        var b = --a.item.index, a = a.item.count;



    	$("#snh-1").html("<span> "+ (1 > b ? b + a : b > a ? b - a : b) + "</span><span>" + a + "</span>");







    });







	hero_s.append('<div class="slider-nav-warp"><div class="slider-nav"></div></div>');



	$(".hero-slider .owl-nav, .hero-slider .owl-dots").appendTo('.slider-nav');







$('.set-bg').each(function() {



		var bg = $(this).data('setbg');



		$(this).css('background-image', 'url(' + bg + ')');



	});







/*------------------



		start sticky



	--------------------*/



	



	 var header = $('#header-sticky');



    var win = $(window);



    



    win.on('scroll', function() {



        if ($(this).scrollTop() > 120) {



            header.addClass("sticky");



        } else {



            header.removeClass("sticky");



        }



    });



	



	



	 var header2 = $('#myheader-sticky');



    var win = $(window);



    



    win.on('scroll', function() {



        if ($(this).scrollTop() > 120) {



            header2.addClass("sticky2");



        } else {



            header2.removeClass("sticky2");



        }



    });



   /*------------------



		end sticky



	--------------------*/



</script> 







<script>



	/*-------------------



		Range Slider



	--------------------- */



	var rangeSlider = $(".price-range"),



		minamount = $("#minamount"),



		maxamount = $("#maxamount"),



		minPrice = rangeSlider.data('min'),



		maxPrice = rangeSlider.data('max');



	rangeSlider.slider({



		range: true,



		min: minPrice,



		max: maxPrice,



		values: [minPrice, maxPrice],



		slide: function (event, ui) {



			minamount.val('$' + ui.values[0]);



			maxamount.val('$' + ui.values[1]);



		}



	});



	minamount.val('$' + rangeSlider.slider("values", 0));



	maxamount.val('$' + rangeSlider.slider("values", 1));



</script>


 <script>
  
  $(document).ready(function() {
           
			   var owl = $('.serviceSlider');
              owl.owlCarousel({
                margin: 30,
                nav: true,
                loop: true,
                dots: true,
                autoplay: true,
                responsive: {
                  0: {
                    items: 1
                  },
                  600: {
                    items: 1
                  },
                  1000: {
                    items: 1
                  }
                }
              })
			  
            
			
			

			
		});
		
  </script>
<!--end paralax-->







</body>



</html>



