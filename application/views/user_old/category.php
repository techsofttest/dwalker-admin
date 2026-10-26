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
 
  <div class="innerWrapDiv catsecs"> 
 
    <!-- start container -->
    <div class="container">
      <div class="row">
      
        <div class="col-lg-12 col-md-12 col-sm-12">
          <h2 class="center">Products</h2>
          <hr />
          <div class="row">
         <!-- <div class="col-lg-3">
          
          <div class="categoryspcs">
          
          <div class="head">
          
          <h2>Categories</h2>
          
          
          </div>
          
          <div class="top-select text-left">
          <label for="sorting" >Sort:</label>
          <select id="sort" class="selectpicker">
            
            <option value="Price -- Low to High">Best Selling</option>
            <option value="Price -- High to Low" selected>Featured</option>
            <option value="Newest First" selected>Lowest Price</option>
               <option value="Newest First" selected>Highest Price</option>
          </select>
        </div>
        
        <div class="category-menumain">
          <h4>Type</h4>
          <ul class="category-menu">
          
             <li><a href="#">Charm</a>
                
              </li>
             <li class=""><a href="#">Brooch</a>
                
              </li>
             <li class=""><a href="#">Earrings </a>
                
              </li>
             <li><a href="#">Rings</a>
                
             </li>
              <li><a href="#">None</a>
                
              </li>
             
            </ul>
          </div>
          <div class="category-menumain">
          <h4>Gemstone</h4>
          <ul class="category-menu">
           
             
              <li class=""><a href="#">Agate </a>
                
              </li>
              <li class=""><a href="#">Berly</a>
                
            
               <li><a href="#">None</a>
                
              </li>
            </ul>
          </div>
          <div class="category-menumain">
          <h4>Gemstone Color</h4>
          <ul class="category-menu">
              <li class=""><a href="#">Black</a>
                
              </li>
              <li><a href="#">Blue</a>
                
              </li>
              <li class=""><a href="#">Brwn</a>
                
              </li>
              <li class=""><a href="#">Gold</a>
                
              </li>
              <li><a href="#">None</a>
                
              </li>
            </ul>
          </div>
          <div class="category-menumain">
          <h4>Collection</h4>
          <ul class="category-menu">
              <li class=""><a href="#">Artemis</a>
                
              </li>
              <li><a href="#">Octavia</a>
                
              </li>
              <li class=""><a href="#">None</a>
                
              </li>

            </ul>
          </div>
          <div class="category-menumain">
          <h4>Gemstone Color</h4>
          <ul class="category-menu">
              <li class=""><a href="#">None</a>
                
              </li>
              <li><a href="#">Bi Tone </a>
                
              </li>
              <li class=""><a href="#">Platinum</a>
                
              </li>
              <li class=""><a href="#">Rose gold </a>
                
              </li>
              <li><a href="#">Strling silver</a>
                
              </li>
               </li>
              <li><a href="#">White Gold</a>
                
              </li>
               </li>
              <li><a href="#">yellow Gold</a>
                
              </li>
            </ul>
          </div>
           <div class="category-menumain">
          <h4>Price</h4>
       <div class="filter-widget mb-0">
        
          <div class="price-range-wrap">
        <br />
            <div class="price-range ui-slider ui-corner-all ui-slider-horizontal ui-widget ui-widget-content" data-min="10" data-max="270">
              <div class="ui-slider-range ui-corner-all ui-widget-header" style="left: 0%; width: 100%;"></div>
              <span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default" style="left: 0%;"> </span> <span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default" style="left: 90%; margin-left: -12px;"> </span> </div>
            <div class="range-slider">
              <div class="price-input">
                <input type="text" id="minamount">
                <input type="text" id="maxamount">
              </div>
            </div>
          </div>
        </div>
          </div>
          </div>
          
          
          
          
          </div>-->
      <div class="col-lg-12">
      <div class="row">
        <?php
        foreach($subcatsubprod as $prodsub){
			?>
          
            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-6">
              <div class="productItem">
                <div class="imgDiv"><a href="<?php echo base_url(); ?>Products/<?php echo $prodsub->SlugName; ?>"><img src="<?php echo base_url(); ?>/uploads/Products/<?php echo $prodsub->ProductImage; ?>" alt="" /></a></div>
                <div class="collection_info">
                  <h4 class="collection_name"><a href="<?php echo base_url(); ?>Products/<?php echo $prodsub->SlugName; ?>"><?php echo $prodsub->product_name; ?></a></h4>
                  <p class="collection_price">$<?php echo $prodsub->productPrice; ?> NZD</p>
                  <a href="<?php echo base_url(); ?>Products/<?php echo $prodsub->SlugName; ?>" class="btnContent view_btn">View Details</a> 
                  
                 
                </div>
              </div>
            </div>
              <?php
			}
		?>
           <!-- <div class="col-lg-4">
              <div class="productItem">
                <div class="imgDiv"><a href="product.html"><img src="<?php echo base_url(); ?>/assets/images/jewelry/j14.png" alt="" /></a></div>
                <div class="collection_info">
                  <h4 class="collection_name"><a href="product.html">Yutii Bracelet</a></h4>
                  <p class="collection_price">$50</p>
                  <a href="product.html" class="btnContent view_btn">View Details</a> 
                  
                
                </div>
              </div>
            </div>-->
            <!--<div class="col-lg-4">
              <div class="productItem">
                <div class="imgDiv"><a href="product.html"><img src="<?php echo base_url(); ?>/assets/images/jewelry/j3.jpg" alt="" /></a></div>
                <div class="collection_info">
                  <h4 class="collection_name"><a href="product.html">White Gold Ring</a></h4>
                  <p class="collection_price">$48</p>
                  <a href="product.html" class="btnContent view_btn">View Details</a> 
                  
                
                </div>
              </div>
            </div>-->
           <!-- <div class="col-lg-4">
              <div class="productItem">
                <div class="imgDiv"><a href="product.html"><img src="<?php echo base_url(); ?>/assets/images/jewelry/j10.jpg" alt="" /></a></div>
                <div class="collection_info">
                  <h4 class="collection_name"><a href="product.html">Curly Kale</a></h4>
                  <p class="collection_price">$30</p>
                  <a href="product.html" class="btnContent view_btn">View Details</a> 
                  
             
                </div>
              </div>
            </div>-->
          <!--  <div class="col-lg-4">
              <div class="productItem">
                <div class="imgDiv"><a href="product.html"><img src="<?php echo base_url(); ?>/assets/images/jewelry/j9.jpeg" alt="" /></a></div>
                <div class="collection_info">
                  <h4 class="collection_name"><a href="product.html">Shadow Bracelets</a></h4>
                  <p class="collection_price">$28</p>
                  <a href="product.html" class="btnContent view_btn">View Details</a> 
                  
                
                </div>
              </div>
            </div>-->
         <!--   <div class="col-lg-4">
              <div class="productItem">
                <div class="imgDiv"><a href="product.html"><img src="<?php echo base_url(); ?>/assets/images/jewelry/j8.jpg" alt="" /></a></div>
                <div class="collection_info">
                  <h4 class="collection_name"><a href="product.html">Paisly Pendant</a></h4>
                  <p class="collection_price">$50</p>
                  <a href="product.html" class="btnContent view_btn">View Details</a> 
                  
                
                </div>
              </div>
            </div>-->
           <!-- <div class="col-lg-4">
              <div class="productItem">
                <div class="imgDiv"><a href="product.html"><img src="<?php echo base_url(); ?>/assets/images/jewelry/j7.jpg" alt="" /></a></div>
                <div class="collection_info">
                  <h4 class="collection_name"><a href="product.html">Dolphin Necklace</a></h4>
                  <p class="collection_price">$48</p>
                  <a href="product.html" class="btnContent view_btn">View Details</a> 
                  
                
                </div>
              </div>
            </div>-->
           <!-- <div class="col-lg-4">
              <div class="productItem">
                <div class="imgDiv"><a href="product.html"><img src="<?php echo base_url(); ?>/assets/images/jewelry/j6.png" alt="" /></a></div>
                <div class="collection_info">
                  <h4 class="collection_name"><a href="product.html">Curly Earrings</a></h4>
                  <p class="collection_price">$30</p>
                  <a href="product.html" class="btnContent view_btn">View Details</a> 
                  
                
                </div>
              </div>
            </div>-->
           <!-- <div class="col-lg-4">
              <div class="productItem">
                <div class="imgDiv"><a href="product.html"><img src="<?php echo base_url(); ?>/assets/images/jewelry/j14.png" alt="" /></a></div>
                <div class="collection_info">
                  <h4 class="collection_name"><a href="product.html">Yutii Bracelet</a></h4>
                  <p class="collection_price">$50</p>
                  <a href="product.html" class="btnContent view_btn">View Details</a> 
                  
                
                </div>
              </div>
            </div>-->
          </div>
          </div>
          </div>
        </div>
      </div>
    </div>
    <!-- end container --> 
  </div>
 
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
<!--end paralax-->
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
</body>
</html>
