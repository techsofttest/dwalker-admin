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
<link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css" integrity="sha256-2XFplPlrFClt0bIdPgpz8H7ojnk10H69xRqd9+uTShA=" crossorigin="anonymous" />



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


<style>
.justify-content-center{
	
	    -webkit-box-pack: center;
    -ms-flex-pack: center;
    justify-content: center;
    justify-content: center!important;
    display: flex;
    -ms-flex-wrap: wrap;
    flex-wrap: wrap;
}

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

 .grid-container {
  display: flex;
    background-color: rgba(255, 255, 255, 0.4);   
    justify-content: center;
    align-items: center;
}
 @media screen and (min-width: 28.75rem) {
	 .grid-container {
		 grid-template-columns: repeat(2, 1fr);
		 grid-template-rows: repeat(2, 1fr);
	}
}
 @media screen and (min-width: 43.75rem) {
	 .grid-container {
		 grid-template-columns: repeat(3, 1fr);
	}
	 .grid-container .grid-item:nth-child(2), .grid-container .grid-item:nth-child(3), .grid-container .grid-item:nth-child(6), .grid-container .grid-item:nth-child(7) {
		 grid-column: span 2;
	}
}
 @media screen and (min-width: 61rem) {
	 .grid-container {
		 grid-template-columns: repeat(4, 1fr);
	}
	 .grid-container .grid-item:nth-child(2), .grid-container .grid-item:nth-child(3), .grid-container .grid-item:nth-child(6), .grid-container .grid-item:nth-child(7) {
		 grid-column: span 1;
	}
}
 .grid-item {
  background-color: #3f4a72;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: flex-start;
    padding: 25px 10px;
    color: #fff;
    min-width: 267px;
    font-size: 1.2rem;
    text-align: center;
    transition: 0.3s ease-in-out;
    border: solid 1px #3f4a7226;
    box-shadow: 0px 0px 2px 0px #80808085;
    cursor:pointer;
}
 .grid-item-content {
	 display: grid;
	 place-items: center;
}
 .grid-item img {
    max-width: 200px;
    width: 100%;
    height: 190px; /* 320px */
	  object-fit: contain;
    margin-bottom:10px;
	  transition: 0.3s ease-in-out;
  }
 
 .grid-item a {
	 transform: translatey(2.5em);
	 opacity: 1;
	 transition: 0.6s ease-in-out;
	 color: white;
   margin-bottom: 10px;
}

 .grid-item.active {
	 background: white;
	 color: #111;
   border: solid 1px #3f4a7226;
   box-shadow: 0px 0px 2px 0px #80808085;
}
 
 .grid-item.active img {
  width: 100%;
    /*height: 320px;*/
    margin-bottom: 10px;   
    transition: 0.3s ease-in-out;
}
 .grid-item.active a {
  opacity: 1;
    color: #071f75;
   
}

  .tb-sticky
  {
    position: fixed !important;
    z-index: 100;
  }

  #main.tb-sticky
  {
    top: 5%;
  }
 


.hero-slider {
  display: block;
  /*height:100vh;*/
}
 
.hero-slider .hs-item:not(:first-child) {
    display: none !important;
}

</style>


</head>



<body id="page-top">

<!-- start parallax -->

<div id="parallax">



  

 <?php

   /*$cond_cms=array('contentId' => 1);

   $data['cms_data'] 	= 	$this->Admin_model->fetch_one_row('dwalker_content',$cond_cms);*/

   //$data['main_category'] 	= 	$this->Admin_model->fetch_all('dwalker_category');

   $this->load->view('user/header'); 

 ?>



    <section class="hero-section">

      <div class="hero-slider owl-carousel">

        

        <div class="hs-item set-bg" data-setbg="<?php echo base_url(); ?>assets/images/ban2.jpg">

          <div class="boverlay"></div>

          <div class="container">

            <div class="row">

              <div class="col-xl-6 col-lg-2 col-md-2 col-sm-12"> </div>

              <div class="col-xl-6 col-lg-8 col-md-8 col-sm-12 col-xs-12  text-white">
<!--<h2>Crocoite x2</h2>-->
                <h2>incredible, fabulous, exquisite, stunning and beautiful jewellery pieces</h2>

                <!--<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>-->

                 </div>

            </div>

          </div>

        </div>

        <div class="hs-item set-bg" data-setbg="<?php echo base_url(); ?>assets/images/ban3.jpg">

          <div class="boverlay"></div>

          <div class="container">

            <div class="row">

              <div class="col-xl-6 col-lg-2 col-md-2 col-sm-12"> </div>

              <div class="col-xl-6 col-lg-8 col-md-8 col-sm-12 col-xs-12  text-white">
<!--<h2>Vivianite with Siderite</h2>-->
                <h2>sterling silver ornaments</h2>

               <!-- <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>-->

              </div>

            </div>

          </div>

        </div>

        <div class="hs-item set-bg" data-setbg="<?php echo base_url(); ?>assets/images/ban6.jpg">

          <div class="boverlay"></div>

          <div class="container">

            <div class="row">

              <div class="col-xl-6 col-lg-2 col-md-2 col-sm-5"> </div>

              <div class="col-xl-6 col-lg-8 col-md-8 col-sm-12 col-xs-12 text-white">
<!--<h2>Hessonite Garnets</h2>-->
                <h2>incredible, fabulous, exquisite, stunning and beautiful jewellery pieces .</h2>

<!--                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>-->

              </div>

            </div>

          </div>

        </div>

        <div class="hs-item set-bg" data-setbg="<?php echo base_url(); ?>assets/images/ban4.jpg">

          <div class="boverlay"></div>

          <div class="container">

            <div class="row">

              <div class="col-xl-6 col-lg-2 col-md-2 col-sm-12"> </div>

              <div class="col-xl-6 col-lg-8 col-md-8 col-sm-12 col-xs-12 text-white">
<!--<h2>Malachite</h2>-->
                <h2>traditional,simple, rarest feminine and  Rare peices .</h2>

<!--                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>-->

              </div>

            </div>

          </div>

        </div>

      </div>

    </section>
<section class="welcome-section updated" style="margin:50px 0px;">
  <div class="container">
    <div class="row clearfix">
    <div class="">
    <div class="col-lg-12">
    <div class="mybanh2">
    <h2>Beauty begins the moment you decide to be yourself</h2>
    
    </div>
    </div>
     <div class="image-column col-lg-3 col-md-3 col-sm-3 col-xs-12" >
        <div class="inner-column" data-wow-delay="0ms" data-wow-duration="1500ms">
          <div class="image-two animated" data-wow-delay="0ms" data-wow-duration="1500ms" style="visibility: visible; animation-duration: 1500ms; animation-delay: 0ms; animation-name: fadeInLeft;">  <img class="lazyload" src="<?= base_url(); ?>assets/images/images.png" data-src="<?php echo base_url(); ?>assets/images/ablady.jpg" alt="Awesome Image"></div>
          
        </div>
      </div>
     <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" >
      <div class="content-column ">
        <div class="inner-column">
          
          <div class="text abtestsec">
         
       
 <?php echo $cmshome_data['pageDescription']; ?>
          </div>
          
          </div>
      </div></div>
      
      <style>
        .image-two img
        {
          height:320px;
          object-fit:contain;
        }
      </style>
      <div class="image-column col-lg-3 col-md-3 col-sm-3 col-xs-12" >
        <div class="double-column" data-wow-delay="0ms" data-wow-duration="1500ms">
          <div class="image-two animated" data-wow-delay="0ms" data-wow-duration="1500ms" style="visibility: visible; animation-duration: 1500ms; animation-delay: 0ms; animation-name: fadeInLeft;">  <img src="<?php echo base_url(); ?>assets/images/about2.jpg" alt="Awesome Image"></div>
          
        </div>
      </div>
      
    </div> </div>
  </div>
</section>  


  <section class="Featuredsec">

  <div class="col-12">       
  <h2 class="head">Featured Products</h2>
<hr />
</div>

  <div class="grid-container">
    
  <?php 

foreach($moreproductlimit as $moreprod)

{

?>
    <div class="grid-item">
      <div class="grid-item-content">
      <img class="lazyload" src="<?= base_url(); ?>assets/images/images.png" data-src="<?php echo base_url(); ?>uploads/Products/<?php echo $moreprod->ProductImage; ?>" alt="">
        <h3><a href="<?php echo base_url(); ?>Products/<?php echo $moreprod->SlugName; ?>"><?php echo $moreprod->product_name; ?></a></h3>  
      </div>
    </div>

    <?php } ?>
    
  </div>
</section>  

<section>
 
  <div class="Featuredsec" style="margin-top:60px">
<div class="container">
                <div class="row justify-content-center">
                    <div class="col-12">                     
                        <h2 class="head">Our Latest Products</h2>       
                        <hr /> 
                    </div><!--end col-->
                </div><!--end row-->
                <div class="row justify-content-center">
               <?php  foreach($limitprod as $prod){?>
                    <div class="col-md-3 col-sm-3">
                        <div class="product-grid">
                            <div class="product-image">
                                <a href="<?php echo base_url();?>Products/<?php echo $prod->SlugName; ?>" class="image">
                                    <img class="pic-1 lazyload" src="<?= base_url(); ?>assets/images/images.png" data-src="<?php echo base_url(); ?>uploads/Products/<?php echo $prod->ProductdefaultImage; ?>">
                                    <img class="pic-2 lazyload" src="<?= base_url(); ?>assets/images/images.png" data-src="<?php echo base_url(); ?>uploads/Products/<?php echo $prod->ProductdefaultImage; ?>">
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




<style>

    .snip1533 {
    box-shadow: 0 0 5px rgba(0, 0, 0, 0.15);
    color: #9e9e9e;
    display: inline-block;
    font-family: 'Roboto', Arial, sans-serif;
    font-size: 16px;
    margin: 20px 10px 20px;
    height: 350px;
    max-height: 350px;
    position: relative;
    text-align: center;
    width: 100%;
    background-color: #ffffff;
    border-radius: 5px;
    border-top: 5px solid #071f75;
    }

    .snip1533 *,
    .snip1533 *:before {
      -webkit-box-sizing: border-box;
      box-sizing: border-box;
      -webkit-transition: all 0.1s ease-out;
      transition: all 0.1s ease-out;
    }

    .snip1533 figcaption {
      padding: 13% 10% 12%;
      position:relative;
    }

    .snip1533 figcaption:before {
      -webkit-transform: translateX(-50%);
      transform: translateX(-50%);
      background-color: #fff;
      border-radius: 50%;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.25);
      color: #071f75;
      content: "\f10e";
      font-family: 'FontAwesome';
      font-size: 32px;
      font-style: normal;
      left: 50%;
      line-height: 60px;
      position: relative;
      top: -30px;
      width: 60px;
    }

    .snip1533 h3 {
      color: #3c3c3c;
      font-size: 15px;
      font-weight: 600;
      line-height: 24px;
      margin: 10px 0 5px;
    }

    .snip1533 h4 {
      font-weight: 400;
      margin: 0;
      opacity: 1;
      color: grey;
      font-size: 11px;
    }

    .snip1533 blockquote {
      font-style: italic;
      font-weight: 300;
      margin: 0 0 20px;
      color: black;
    }

    .snip1533 p{
    color: #4d4442;
    font-size: 13px;
    line-height: 1.6;
    min-height: 150px;
    max-height: 150px;
    overflow: auto;
    }

</style>


 
<div class="Featuredsec" style="margin-top:60px">
<div class="container">

<div class="row justify-content-center">
      <div class="col-12">                     
          <h2 class="head">Hear from our customer's</h2>       
      <hr /> 
    </div>
</div>

<div class="owl-carousel owl-theme" id="testimonial-carousel">
<?php foreach($testimonial as $testi) { ?>
  <div class="item">
  <div class="col-lg-12">
<figure class="snip1533">
  <figcaption>
    <p>
      <?= strip_tags($testi->testi_description) ?>
    </p>
    <h3><?= $testi->testi_name ?></h3>
    <h4><?= $testi->testi_location ?></h4>
  </figcaption>
</figure>
  </div>
</div>
<?php } ?>
</div>




</div>
</div>







 <div class="facilitiesWrap"> 

    <!-- start container -->

    <div class="container">

      <div class="row">

        <div class="col-lg-4 col-md-4 col-sm-4 facilityDiv ">

          <div class="titleImg"><i class="fa fa-check-circle" aria-hidden="true"></i></div>

          <h3>100% Guarantee 
          <br>Kiwi Business
          <br>Windcave Payment Gateway
          </h3>

         <!-- <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore.</p>-->

        </div>

        <div class="col-lg-4 col-md-4 col-sm-4 facilityDiv">

          <div class="titleImg"><i class="fa fa-car" aria-hidden="true"></i></div>

          <h3>Orders over 130 NZD<br />Free Delivery</h3>

        <!--  <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore.</p>-->

        </div>

        <div class="col-lg-4 col-md-4 col-sm-4 facilityDiv ">

          <div class="titleImg"><i class="fa fa-mobile-phone" aria-hidden="true"></i></div>

          <h3>Risk Free Returns</h3>

         <!-- <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore.</p>-->

        </div>

      </div>

      <!-- end container --> 

    </div>

  </div>

   

   

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

   

   <div class="modal fade alertclass" id="modal-danger">

  <div class="modal-dialog modal-failure">

    <div class="modal-content">

      <div class="modal-header">

        <div class="icon-box"> <i class="fa fa-times-circle" aria-hidden="true"></i> </div>

      </div>

      <div class="modal-bodyy">

        <p class="text-center"><?php echo $this->session->flashdata('error');?></p>

      </div>

      <div class="modal-footer">

        <button class="btn btn-danger btn-block" data-dismiss="modal">OK</button>

      </div>

    </div>

  </div>

</div>

   

   

   

   <?php

     $seocond_cms=array('contentId' => 2);

	 $data['cmstwo_data'] 	= 	$this->Admin_model->fetch_one_row('dwalker_content',$seocond_cms);

     $this->load->view('user/footer', $data); 

  ?>

  <!-- end footer --> 

</div>



<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.js"></script> 

<script src="<?php echo base_url(); ?>assets/js/owl.carousel.min.js"></script> 

<!--<script type="text/javascript" src="js/xsparallax.js"></script>--> 

<script src="<?php echo base_url(); ?>assets/js/jquery.slicknav.js"></script> 

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>





<?php

 if($this->session->flashdata('success')){ 

      ?>

    <script>

	$(window).on('load',function(){

		

		$('#modal-success').modal('show');

		});

	</script>

    <?php

      }

   elseif($this->session->flashdata('error')){

	  

      ?>

<script>

     $(window).on('load',function(){

		

		$('#modal-danger').modal('show');

      });

      </script>

<?php

      }

    ?>



<script>


$(document).ready(function(){
    $("#testimonial-carousel").owlCarousel({
        loop: false,          // set to true if you want infinite loop
        margin: 20,
        nav: false,            // prev/next arrows
        dots: false,           // pagination dots
        autoplay: true,
        autoplayTimeout: 3500,
        smartSpeed: 1000,
        responsive: {
            0: { items: 1 },     // mobile
            576: { items: 2 },   // small screens
            992: { items: 4 }    // desktop
        }
    });
});




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

  <script>
    const cards = document.querySelectorAll(".grid-item");
cards.forEach((item) => {
  item.addEventListener("mouseover", () => {
    cards.forEach((el) => el.classList.remove("active"));
    item.classList.add("active");
  });
});

  </script>


<script src="https://cdn.jsdelivr.net/npm/lazyload@2.0.0-rc.2/lazyload.js"></script>

<script>
  lazyload();
</script>

</body>

</html>

