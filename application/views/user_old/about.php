<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8" content="<?php echo $seo_data['meta_description']; ?>" />
<meta http-equiv="X-UA-Compatible" content="<?php echo $seo_data['meta_keyword']; ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
<title><?php if(!empty($seo_data['meta_title'])){ echo $seo_data['meta_title'];} else{ echo "D WALKER JEWELRY"; } ?></title>
  <link rel="icon" href="<?php echo base_url(); ?>assets/images/favicon.png" type="image/png">
<!-- Bootstrap -->
<link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet" />
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/owl.carousel.min.css"/>
<link href="<?php echo base_url(); ?>assets/css/global.css" rel="stylesheet" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/responsive.css" />
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/font-awesome/css/font-awesome.css" />
<!-- For parallax Scrolling Effect -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/xsparallax.css" />
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/slicknav.css" />
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/animate.min.css"/>
<link href="<?php echo base_url(); ?>assets/css/animation.min.css" rel="stylesheet"/>
<script>
document.documentElement.addEventListener('touchstart', function (event) {
            if (event.touches.length > 1) {
                event.preventDefault();
            }
        }, false);
</script>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery-1.11.3.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/wow.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/main.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/custom.js"></script>


</head>

<body id="page-top">
<!-- start parallax -->
<div id="parallax">
  
<?php
  //$data['main_category'] 	= 	$this->Admin_model->fetch_all('dwalker_category');
  $this->load->view('user/header');
 ?>
    

    <!-- start innerbanner -->
    <section class="innerbanner">
   <img src="<?php echo base_url(); ?>assets/images/aboutbsanner.jpg" alt="" />
    
    </section>
    <!-- end innerbanner -->

    




<section class="welcome-section updated" style="margin:50px 0px;">
  <div class="container">
    <div class="row clearfix">
    <div class="">
    
      <div class="image-column col-lg-5 col-md-5 col-sm-6 col-xs-6 firstsub" >
        <div class="inner-column" data-wow-delay="0ms" data-wow-duration="1500ms">
          <div class="image-two animated" data-wow-delay="0ms" data-wow-duration="1500ms" style="visibility: visible; animation-duration: 1500ms; animation-delay: 0ms; animation-name: fadeInLeft;">  <img src="<?php echo base_url(); ?>assets/images/abstone.jpg" alt="Awesome Image"></div>
          
        </div>
      </div>
      <div class="content-column sub">
        <div class="inner-column">
          <div class="sec-title">
            <div class="title-inner">
              <div class="title">About Us</div>
              <h2>Dwalker  jewelry </h2>
            </div>
          </div>
          <div class="text abtestsec">
         
        <!--   <p >
      pounamu 
The stone- the legend of newzealad formed in the depths, delivered by water.with due respect to our culture and tradition.

we have tried to collect the pieces from all over the world-coloured gemstones on sterling silver

Dwalker jewlers is a manufacturer & exporter of sterling silver jewellery with coloured gemstones.

Our range includes: Rings, Earrings, Pendants, Bracelets, Necklaces Chains. We manufacture an exquisite range of ethnic & exotic designs that are compatible with the latest fashion trends.

Every piece of Dwalker jewelery - sterling silver ornaments with coloured gems embodies a new way of thinking. you can make it a part of your regular life . splendid, exquisite, magnificent, luxurious, queenly, divine pieces collected from all over the world –we set out to create the world's most unique designs.

"To create natural, luxurious and inexpensive jewelry that is sustainably thought out, is known in the industry as the hardest standard to meet. This is what makes Dwalker Jewwelry stand out from the rest.

We are doing nothing but bringing smiles to people's faces as we are adorning a lady with beautiful and Precious things. It's the best opportunity to adorn herself with Precious Metal. I have been working on my jewellery collections for a few years now and I am really excited to be able to share my work with you all. I love our beautiful little country New Zealand and I get inspired by the beauty of it.

It's ok to be a little obsessed with jewelry.

I deserve it.

It is my statement and it is a part of my daily routine.

MIX AND MATCH
These semi precious stones can be used with any type of chain, to match your dress-ups and styling
</p>-->
<?php echo $cms_data['pageDescription']; ?>
          </div>
          
          </div>
      </div>
    </div> </div>
  </div>
</section>
  
  

  
 
<?php $this->load->view('user/footer'); ?>
  <!-- end footer --> 
</div>

<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.js"></script> 
<script src="<?php echo base_url(); ?>assets/js/owl.carousel.min.js"></script> 
<!--<script type="text/javascript" src="js/xsparallax.js"></script>--> 
<script src="<?php echo base_url(); ?>assets/js/jquery.slicknav.js"></script> 

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
