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
<!--<link rel="stylesheet" href="<?php //echo base_url();?>assets/css/magnific-popup.css" type="text/css">-->

<script src="https://www.google.com/recaptcha/api.js" async defer></script>

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
            $this->load->view('user/header');
		  ?>
    
   
  

  
   <section class="innerbanner">
      <img src="<?php echo base_url(); ?>assets/images/mcontact-us-banner.jpg" alt="" />
    </section>
    
  <section class="Contactse innerWrapDiv ">
  <div class="container ">
    <h2 class="head">Contact Us</h2>
   <hr />
    <div class="row">
    
    
  <div class="col-lg-12">
    
   
    <div class="row">
      <div class="col-lg-4 col-md-4 col-sm-4">
      <div class="contact-info-box">
  <div class="icon"><i class="fa fa-map-marker" aria-hidden="true"></i></div>
  <h3>Address</h3>
  <p> Clover park , Auckland, Newzealand </p>
</div>

      </div>
      
       <div class="col-lg-4 col-md-4 col-sm-4">
       <div class="contact-info-box">
  <div class="icon"><i class="fa fa-phone" aria-hidden="true"></i></div>
  <h3>Phone</h3>
  <p><a href="tel:64+ 092501890">NZ 64+ 092501890</a></p>
</div>
       </div>
        <div class="col-lg-4 col-md-4 col-sm-4">
        <div class="contact-info-box">
  <div class="icon"><i class="fa fa-envelope-o" aria-hidden="true"></i></div>
  <h3>Email</h3>
  <p><a href="mailto:dwalkerjewels@gmail.com">dwalkerjewels@gmail.com</a></p>
 
</div>

       </div>
        
      
      
      
      
      </div>
    
    </div>
    <div class="col-lg-6 col-md-6 col-sm-6">
       <?php
        if(!empty($this->session->flashdata('error')))
        {
        ?>

        <p class="text-danger" style="color:red;"><?= $this->session->flashdata('error') ?></p>

        <?php } ?>
      <div class="contactform">
            <form action="" method="post">
                      <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6">
                          <div class="form-group">
                    <label>Full Name</label>
                    <input  name="fname" type="text" id="name" placeholder="Full Name" class="form-control" required>
                  </div>
                        </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                          <div class="form-group">
                    <label>Email Address</label>
                    <input  name="email" type="text" id="email" placeholder="Email Address" class="form-control" required>
                  </div>
                        </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                          <div class="form-group">
                    <label>Contact No</label>
                    <input  name="phone" type="text" id="phone" placeholder="Phone" class="form-control" required>
                  </div>
                        </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                          <div class="form-group">
                    <label>Subject</label>
                    <input  name="subject" type="text" id="subject" placeholder="Subject" class="form-control" required>
                  </div>
                        </div>
                <div class="col-lg-12 col-md-12 col-sm-12">
                          <div class="form-group">
                    <label>Message</label>
                    <textarea name="messsage" placeholder="Message... " class="form-control" required></textarea>
                  </div>
                        </div>

                <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="g-recaptcha" data-sitekey="6LdwC4YrAAAAAGmNy7SvfclTMq0zG-kMTZQXy--Z"></div>
                </div>


                <div class="col-lg-12">
                          <button type="submit" class="default-btn" name="contact_submit">SUBMIT</button>
                        </div>
              </div>
                    </form>
          </div>
      
      </div>
      <div class="col-lg-6 col-md-6 col-sm-6">
      <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d25262047.486749507!2d157.31722957400797!3d-39.384624941411914!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x6d2c200e17779687%3A0xb1d618e2756a4733!2sNew%20Zealand!5e0!3m2!1sen!2sin!4v1617253612465!5m2!1sen!2sin" width="100%" height="429" style="border:0;" allowfullscreen="" loading="lazy"></iframe>

      </div>
      
    </div>
  </div>
</section>
   <!-- Message Modal -->



	<!-- Modal -->
<div class="modal  alertclass" id="modal-success" >
                                <div class="modal-dialog modal-confirm">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <div class="icon-box">
                                                <i class="fa fa-check-circle" aria-hidden="true"></i>
                                            </div>				
                                            
                                        </div>
                                        <div class="modal-bodyy">
                                            <p class="text-center"><?php echo $this->session->flashdata('success');?></p>
                                        </div>
                                        <div class="modal-footer">
                                            <button class="btn btn-success btn-block" data-dismiss="modal">OK</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
    
    
    
    
    
    <!-- Message Modal End-->

 <?php
   $this->load->view('user/footer');
 ?>
  <!-- end footer --> 
</div>

<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.js"></script> 
<script src="<?php echo base_url(); ?>assets/js/owl.carousel.min.js"></script> 
<!--<script type="text/javascript" src="js/xsparallax.js"></script>--> 
<script src="<?php echo base_url(); ?>assets/js/jquery.slicknav.js"></script> 
<script src="<?php echo base_url(); ?>assets/js/jquery.zoom.min.js"></script> 
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
<!--<script src="<?php //echo base_url(); ?>assets/js/jquery.magnific-popup.min.js"></script>-->

<?php
	 if($this->session->flashdata('success')){ 
	// echo "success view page";
	 //exit(); }
      ?>
    <script>
	$(window).on('load',function(){
		
		$('#modal-success').modal('show');
		});
	</script>
     <?php
      }  
      ?>
      
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

    var proQty = $('.pro-qty');
	proQty.prepend('<span class="dec qtybtn">-</span>');
	proQty.append('<span class="inc qtybtn">+</span>');
	proQty.on('click', '.qtybtn', function () {
		var $button = $(this);
		var oldValue = $button.parent().find('input').val();
		if ($button.hasClass('inc')) {
			var newVal = parseFloat(oldValue) + 1;
		} else {
			// Don't allow decrementing below zero
			if (oldValue > 0) {
				var newVal = parseFloat(oldValue) - 1;
			} else {
				newVal = 0;
			}
		}
		$button.parent().find('input').val(newVal);
	});



	/*------------------
		Single Product
	--------------------*/
	$('.product-thumbs-track > .pt').on('click', function(){
		$('.product-thumbs-track .pt').removeClass('active');
		$(this).addClass('active');
		var imgurl = $(this).data('imgbigurl');
		var bigImg = $('.product-big-img').attr('src');
		if(imgurl != bigImg) {
			$('.product-big-img').attr({src: imgurl});
			$('.zoomImg').attr({src: imgurl});
		}
	});


	$('.product-pic-zoom').zoom();


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
