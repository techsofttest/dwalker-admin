<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta charset="utf-8" content="<?php echo $productdet['meta_description']; ?>" />

<meta http-equiv="X-UA-Compatible" content="<?php echo $productdet['meta_keyword']; ?>" />

<meta name="viewport" content="width=device-width, initial-scale=1.0" />

<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

<title>

<?php if(!empty($productdet['meta_title'])){ echo $productdet['meta_title'];} else{ echo "D WALKER JEWELRY"; } ?>

</title>

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
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.js"></script> 

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css" integrity="sha256-2XFplPlrFClt0bIdPgpz8H7ojnk10H69xRqd9+uTShA=" crossorigin="anonymous" />

<script src="<?php echo base_url(); ?>assets/js/owl.carousel.min.js"></script> 

<!--<script type="text/javascript" src="js/xsparallax.js"></script>--> 

<script src="<?php echo base_url(); ?>assets/js/jquery.slicknav.js"></script> 

<script src="<?php echo base_url(); ?>assets/js/jquery.zoom.min.js"></script>
<style>

.pay_img

{

	width:225px!important;

	height:170px!important;

}

.productItem_pay

{

	min-height:300px!important;

}

.payment_btn {

	padding: 10px 30px 10px;

	border-radius: 6px;

	text-transform: uppercase;

	background: #0db4e9;

	color: #fff;

	line-height: normal;

	cursor: pointer;

	text-align: center;

	margin-top: 2em;

}

.paymentmodal .form-group {

	margin-bottom:3em;

}

.modal-header-pay

{

	background:#0db4e9;

	color:#FFF;

	text-align:center;

}

.modal-title-pay

{

	font-size: 18px;

    font-weight: bold;

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
  height: 250px;
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
table{
  font-size: 18px;
}
td{
  text-align:left;
  min-width: 90px;
}
tr{
    height: 35px;
}




.detail-sec
{

margin:20px 0px;

}


.detail-sec table
{

  border: 1px solid #ddd;
  width: 100%;
  max-width: 100%;
  border-collapse: collapse;
  border-spacing: 0;

}

.detail-sec td
{
    padding: 8px;
    line-height: 1.42857143;
    vertical-align: top;
    border-top: 1px solid #ddd;
}




</style>






</head>



<body id="page-top">

<!-- start parallax -->

<div id="parallax">

  <?php

   $this->load->view('user/header');

  ?>

  <!-- </div>--> 

  

  <!-- start aquaponics -->

  <section class="innerbanner">

<img src="<?php echo base_url(); ?>assets/images/productsbanner.jpg" alt="" />



  </section>

  <section class="product-section paddsec" style="padding:50px 0px 0px; ">

    <div class="container">

      <div class="row"> </div>

      <div class="row">

        <div class="col-lg-6  col-md-7 col-sm-7 col-12">

          <div class="row">

            

            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col-12">

              <div class="prosheadline">

                <div class="product-pic-zoom"> <img class="product-big-img prozooimg" src="<?php echo base_url(); ?>uploads/Products/<?php echo $productdet['ProductdefaultImage']; ?>" alt="" > </div>

              </div>

            </div>


            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col-12">

              <div class="product-thumbs myuthumb" tabindex="1" style="overflow: unset; outline: none;">

                <div class="product-thumbs-track">

                    <div class="pt active" data-imgbigurl="<?php echo base_url(); ?>uploads/Products/<?php echo $productdet['ProductdefaultImage']; ?>"><img src="<?php echo base_url(); ?>uploads/Products/<?php echo $productdet['ProductdefaultImage']; ?>" alt=""></div>
<!--<div class="pt active" data-imgbigurl="<?php echo base_url(); ?>uploads/Products/<?php echo $productdet['ProductImage']; ?>"><img src="<?php echo base_url(); ?>uploads/Products/<?php echo $productdet['ProductImage']; ?>" alt=""></div>-->
 
                  <?php foreach($prodmoreimage as $mi){ ?>

                <div class="pt active" data-imgbigurl="<?php echo base_url(); ?>uploads/Products/<?php echo $mi->ProductImage; ?>"><img src="<?php echo base_url(); ?>uploads/Products/<?php echo $mi->ProductImage; ?>" alt=""></div>

                  <?php } ?>

                </div>

              </div>

            </div>



          </div>

        </div>

          <div class="col-lg-6 col-md-5 col-sm-5 col-12 product-details ">

          <div class="tty">

            <h2 class="p-title"><?php echo $productdet['product_name']; ?></h2>

            <h5 class="pcode">Product Code:<?php echo $productdet['productCode']; ?></h5>

            <h3 class="p-price"><span class="strike"> $<?php echo $productdet['productPrice']; ?> NZD</span ></h3>

            <h4 class="p-stock">Available: <span><?php echo $productdet['productStock']; ?></span></h4>


            <div class="detail-sec" >
            <?php echo $productdet['ProductDesc']; ?>
            </div>
            
            
            
            <p style="color: #071f75;
    text-align: center;
    font-weight: 600;
    font-size:35px;
    font-family: 'GoodVibrations';">Beauty begins the moment you decide to be yourself</p>
            

            <div class="quantity">

              <p>Quantity</p>

              <div class="pro-qty">

                <input id="quantity" type="text" value="1" readonly>

              </div>




               <div class="" style="margin:0px 10px;"> 

        <?php

           if($productdet['productStock'] == "In Stock"){

			   ?>

           <button class="add_cart p1site-btn" type="button" data-productid="<?php echo $productdet['product_id'];?>" data-productname="<?php echo $productdet['product_name'];?>" data-productprice="<?php echo $productdet['productPrice'];?>" data-productimage="<?php echo $productdet['ProductdefaultImage'];?>" data-productcode="<?php echo $productdet['productCode'];?>" data-productnameslug="<?php echo $productdet['SlugName'];?>" > ADD TO CART</span> </button>

           <!-- <a href="#" data-toggle="modal" data-target="#myModal" onclick="SendEnquiry(this)" id="3" class="p1site-btn">Buy Now</a>--> </div>

             <?php

			   }

			   else{

				   ?>

				  <!--<a href="#" class="p1site-btn">OUT OF STOCK</a> </div>-->

                  <button class="p1site-btn">OUT OF STOCK</button>
                

             <?php 

				   }

		   ?>

          </div>






            </div>



           

          </div>

        </div>

        

        

        

        

        

        

        

        <?php /*
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

          <div class="kuy">

            <h2>Product Description</h2>

            <!--  <p>18ct rose gold Romanov ring from our signature 1899 collection featuring one rectangular step cut morganite secured by a double four claw setting with delicate detailed shoulders featuring two round brilliant cut diamonds.</p>

               <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco.</p>



       <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco.Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco.</p>-->

          </div>

        </div>

        */ ?>




      </div>

    </div>

  </section>


  <section>
 
 <div class="Featuredsec" style="margin-top:60px">
<div class="container">
               <div class="row justify-content-center">
                   <div class="col-12">                     
                       <h2 class="head">Related Products</h2>       
                       <hr /> 
                   </div><!--end col-->
               </div><!--end row-->
               <div class="row justify-content-center">
              <?php  foreach($relatedproduct as $relprod){
                if($relprod->ProductdefaultImage != $productdet['ProductdefaultImage'] ){?>
                   <div class="col-md-3 col-sm-6">
                       <div class="product-grid">
                           <div class="product-image">
                               <a href="<?php echo base_url();?>Products/<?php echo $relprod->SlugName; ?>" class="image">
                                   <img class="pic-1" src="<?php echo base_url(); ?>uploads/Products/<?php echo $relprod->ProductdefaultImage; ?>">
                                   <img class="pic-2" src="<?php echo base_url(); ?>uploads/Products/<?php echo $relprod->ProductdefaultImage; ?>">
                               </a>
                              
                               <!--<ul class="product-links">-->
                               <!--    <li><a href="<?php echo base_url();?>Products/<?php echo $relprod->SlugName; ?>"><i class="fa fa-search"></i></a></li>-->
                               <!--    <?php if($relprod->productStock == "In Stock"){?>-->
                               <!--    <li><a href="<?php echo base_url();?>Products/<?php echo $relprod->SlugName; ?>"><i class="fas fa-shopping-cart"></i></a></li>-->
                               <!--    <?php } ?>-->
                                 
                               <!--</ul>-->
                           </div>
                           <div class="product-content">
                               <h3 class="title"><a href="<?php echo base_url();?>Products/<?php echo $relprod->SlugName; ?>"><?php echo $relprod->product_name; ?></a></h3>
                               <div class="price">$<?php echo $relprod->productPrice; ?> NZD</div>
                           </div>
                       </div>
                   </div>

               <?php } }?>
                  
               </div>
           </div>
              </div>
</section>

  

  <!-- end aquaponics --> 

  <!-- start product --> 

  

  <!-- end product --> 

  

  <!-- start findProduct -->

  

  <?php

 $this->load->view('user/footer');

?>

  <div class="modal fade paymentmodal" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"



    aria-hidden="true">

    <div class="modal-dialog modal-lg">

      <div class="modal-content">

        <div class="modal-header modal-header-pay">

          <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>

          <h4 class="modal-title modal-title-pay" id="myModalLabel"> Pay Now </h4>

        </div>

        <div class="modal-body">

          <div class="row">

            <div class="col-md-6 col-sm-5 col-xs-5 dfgsec">

              <div class="productItem_pay">

              <div class="mydis">

              <div class="row">

              <div class="col-lg-5"><div class="imgDiv">

               <img class="" width="100%" src="<?php echo base_url(); ?>uploads/Products/<?php echo $productdet['ProductImage']; ?>" alt="" />

               </div></div>

                <div class="col-lg-7">

                <h4 class="mytitle">

                  <?php echo $productdet['product_name']; ?></h4>

                  <p class="myprice">

                 $<?php echo $productdet['productPrice']; ?> NZD

                  </p>

                  <p class="myquantity">Quantity: <span id="quantity_showfirst"> 1</span></p>

                  

               <p class="mytotal"> 

                  Total: $<span id="total_price_show"><?php echo $productdet['productPrice']; ?> </span><span> NZD</span>

              

              <!--<input type="text" name="total_price_show" id="total_price_show"  value="<?php echo $productdet['productPrice']; ?>"/>-->

                  </p>

                </div>

               </div>

               

               

               

               </div>

               

               <div class="myugcartsec"></div>

               

               <div class="ugcartsec" id="ugcartsecnew" >

          <h3 >Price Details </h3> 

    

     <p class="vv">Amount:

                  <span class="juc"> <span ></span> <span ></span></span>

                  </p>

	<p class="vv">Shipping Cost <span class="juc"><span ></span> <span ></span></span></p>

         <p class="collection_price koi">Total Amount:

                   <span class="juc"><span></span> <span ></span></span>

                  </p>

          

                     

            

          

        

          

        </div>

               

               

               

               

               

               

               

               <div class="ugcartsec" id="ugcartsec"  style="display:none;">

          <h3 >PRICE DETAILS </h3> 

    

     <p class="vv">Amount:

                  <span class="juc"> $<span id="currentamount"></span> <span id="shipppingcurrencyfirst"></span></span>

                  </p>

	<p class="vv">Shipping Cost <span class="juc">$<span id="shipppingtotprice"></span> <span id="shipppingcurrencysecond"></span></span></p>

         <p class="collection_price koi">Total Amount:

                   <span class="juc">$<span id="shipppingcost"></span> <span id="shipppingcurrency"></span></span>

                  </p>

          

                     

            

          

        

          

        </div>

                <div class="collection_info">



                  

                   </div>

              </div>

            </div>

            <div class="col-md-6 col-sm-7 col-xs-7">

            <div class="row">

              <div class="col-md-12">

              <div class="row">

                <div class="col-md-12 package-select" style="text-transform: none;">

                  <label class="control-label" for="nama"></label>

                  <br />

                  <br />

                </div>

              

              <form action="" method="post" id="myForm" name="myForm" enctype="multipart/form-data">

                <input type="hidden" name="payProID" value="<?php echo $productdet['product_id']; ?>"/>

                <input type="hidden" name="payProduct" value="<?php echo $productdet['product_name']; ?>"/>

                <input type="hidden" name="payQuantity" id="quantity_val" value="1" />

                <input type="hidden" name="total_price_full" id="total_price_full" value="<?php echo $productdet['productPrice']; ?>" />

                <input type="hidden" name="payPrice" id="payPrice" value="<?php echo $productdet['productPrice']; ?>" />

                <input type="hidden" name="shippping_cost_value" id="shippping_cost_value" value="" />

                <input type="hidden" name="paycurrency" id="shippping_cost_currency" value="" />

               <?php

               /*foreach($country as $shipcost){

				    $shippingcountry = $shipcost->country;

				   }

				   print_r($shippingcountry);

				   exit();*/

			   ?>

             

            

                <div class="col-md-12">

                <div class="row">

                  <div class="form-group">

                    <label class="col-md-4 col-sm-4 col-xs-4 control-label" for="nama">Name</label>

                    <div class="col-md-8 col-sm-8 col-xs-8">

                      <input id="nama" name="payName" class="form-control input-md" required type="text">

                    </div>

                  </div>

                </div></div>

                <div class="col-md-12">

                <div class="row">

                  <div class="form-group">

                    <label class="col-md-4 col-sm-4 col-xs-4 control-label" for="nama">Country</label>

                    <div class="col-md-8 col-sm-8 col-xs-8">

                    

                    

                    

                   <select class="form-control" name="country"  onchange="getsubcat(this.value);" required>

                    

        <option value="" selected disabled>Select Country</option>

        <?php 

		foreach($country as $item=>$val):

		 ?>

                       

       <option value="<?php echo $val->country_id;?>"><?php echo $val->country_name;?></option>

       

        <?php 

           endforeach

           ?>

       </select>

       

                    </div></div>

                  </div>

                </div>

                

               <!-- <div class="col-md-12" id="expert" style="display:none;">

                <div class="row">

                  <div class="form-group">

                    <label class="col-md-4 col-sm-4 col-xs-4 control-label" for="nama">Expert Shipping</label>

                    <div class="col-md-8 col-sm-8 col-xs-8">

                      <input type="checkbox" name="expertshipping" value="1" class="form-control input-md" >

                    </div>

                  </div>

                </div></div>-->

                

                

                

                

                <div class="col-md-12">

                <div class="row">

                  <div class="form-group">

                    <label class="col-md-4 col-sm-4 col-xs-4 control-label" for="nama">Contact No</label>

                    <div class="col-md-8 col-sm-8 col-xs-8">

                      <input id="nama" name="payPhone" class="form-control input-md" required type="text">

                    </div>

                  </div>

                </div></div>

                <div class="col-md-12">

                <div class="row">

                  <div class="form-group">

                    <label class="col-md-4 col-sm-4 col-xs-4 control-label" for="nama">Email</label>

                    <div class="col-md-8 col-sm-8 col-xs-8">

                      <input id="nama" name="payEmail" class="form-control input-md" required type="email">

                    </div></div>

                  </div>

                </div>

                <div class="col-md-12">

                <div class="row">

                  <div class="form-group">

                    <label class="col-md-4 col-sm-4 col-xs-4 control-label" for="nama">Address</label>

                    <div class="col-md-8 col-sm-8 col-xs-8">

                      <textarea class="form-control" rows="3" name="payAddress"></textarea>

                    </div></div>

                  </div>

                </div>

                <div class="col-md-12">

                <div class="row">

                  <div class="col-md-12" style=" padding-top:10px;text-align:center;">

                    <button onclick="clicked();" class="btn btn-default payment_btn" type="submit" name="make_payment">Make Payment</button>

                    <button type="button" class="btn btn-default payment_btn"  data-dismiss="modal" aria-hidden="true">Cancel</button>

                    <img src="<?php echo base_url();?>assets/images/paypal.png" class="img-responsive footerLogo" alt="Singergram payment" style="    text-align: center;

    margin: 0px auto;"/> </div>

                </div></div>

              </form>

            </div></div></div></div>

          </div>

        </div>

      </div>

    </div>

  </div>

  

  <!-- end footer --> 

</div>

 

<style>
  .tb-sticky
  {
    position: fixed;
    z-index: 100;
  }
</style>



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

    var tb = $('.topBar');

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

	 document.getElementById('quantity_val').value = newVal;

	 $('#quantity_show').html(newVal);  

	 $('#quantity_showfirst').html(newVal); 

	 var total_price = newVal*document.getElementById('payPrice').value; 

	 $('#total_price_show').html(total_price);

	  document.getElementById('total_price_full').value = total_price;

	 

	//alert(total_price);

		 



	});



	





/*$(document).ready(function(){

 $("#country").change(function(){

	//document.getElementById('country').value =  countryID;

countryID =	$("#country").val();

  alert("countryID");

});

});*/

	

	



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




$('.product-pic-zoom').zoom({
		touch :false,
		on:'mouseover',
	});




</script> 

<!--end paralax-->





<script type="text/javascript">

    function clicked() {

       if (confirm('Do you want to Continue?')) {

           yourformelement.submit();

       } else {

           return false;

       }

    }



</script>



<script>



	function getsubcat(val) {

	 var countryID = val;

  

    var payprice =document.getElementById('total_price_full').value;

	var payquantity =document.getElementById('quantity_val').value;

    //alert(payquantity);

   

 jQuery.ajax({

	type:'POST',

	dataType:'json',

     url:"<?php echo base_url('Home/GetSubcatt'); ?>",

	  data:{payprice:payprice, payquantity:payquantity, countryID:countryID},

	 success: function(data){

	/* alert(data.Amount);

	 exit();*/

	

		$("#shipppingcost").html(data.Amount);

		$("#shipppingcurrencyfirst").html(data.Currency);

		$("#shipppingcurrencysecond").html(data.Currency);

		$("#shipppingcurrency").html(data.Currency);

		$("#shipppingtotprice").html(data.Shippingprice);

		$("#currentamount").html(data.Currentamount);

		$('#shipppingcost').css('display', 'inline-block');ugcartsec

			$('#shipppingcurrency').css('display', 'inline-block');

			$('#ugcartsec').css('display', 'block');

			$('#ugcartsecnew').css('display', 'none');

		<!--$('#expert').css('display', 'block');-->

		//alert(document.getElementById('shipppingcost').value = data.shipping_cost_Price);

		document.getElementById('shippping_cost_value').value = data.Amount;  

		document.getElementById('shippping_cost_currency').value = data.Currency;  

		

	}

	 

	 

	 

	});

	

	

	

	

	

	

	

	

}



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


</body>

</html>

