<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8" content="" />
<meta http-equiv="X-UA-Compatible" content="" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />

<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

<title>Dwalker</title>
<link rel="icon" href="<?php echo base_url(); ?>assets/images/favicon.png" type="image/png">
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css">


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
<script src="<?php echo base_url(); ?>assets/js/owl.carousel.min.js"></script>

<!--<script type="text/javascript" src="js/xsparallax.js"></script>-->

<script src="<?php echo base_url(); ?>assets/js/jquery.slicknav.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery.zoom.min.js"></script>
<style>
.pay_img {
	width:225px!important;
	height:170px!important;
}
.productItem_pay {
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
.modal-header-pay {
	background:#0db4e9;
	color:#FFF;
	text-align:center;
}
.modal-title-pay {
	font-size: 18px;
	font-weight: bold;
}
.asec p{
	text-align: left;
    padding-bottom: 5px;
}
.iucc{
    font-size: 14px;
    font-weight: 600;
    margin-bottom: 14px;
    color: #071f75;
}
ul {
  list-style-type: none;
}

li {
 /* display: inline-block;*/
}

input[type="radio"][id^="cb"] {
  display: none;
}

label {
  border: 1px solid #fff;
  margin-right: 10px;
  display: block;
  position: relative; 
  cursor: pointer;
}

label:before {
  color: white;
    content: " ";
    display: block;
    border-radius: 50%;
    border: 1px solid grey;
    position: absolute;
    top: -5px;
    left: -5px;
    width: 20px;
    height: 20px;
    text-align: center;
    line-height: 17px;
    transition-duration: 0.4s;
    transform: scale(0);
}

label img {
  height: 100px;
  width: 100px;
  transition-duration: 0.2s;
  transform-origin: 50% 50%;
}

:checked + label {
  border-color: #071f75;
}

:checked + label:before {
  content: "✓";
  background-color: #071f75;
  transform: scale(1);
}

.swatch {
	 position: relative;
	 margin: 0.5rem;
	 width: 30px;
	 height: 40px;
	 border-radius: 60px;
	 line-height: 60px;
	 display: inline-block;
}
 .swatch > [type="radio"], .swatch > [type="checkbox"] {
	 position: absolute;
	 width: 100%;
	 height: 100%;
	 left: 0;
	 top: 0;
	 opacity: 0;
}
 .swatch > [type="radio"] + label, .swatch > [type="checkbox"] + label {
	width: 24px;
    height: 24px;
    border-radius: 50%;
    line-height: 60px;
    border: dashed 2px #626367;
    text-align: center;
    position: absolute;
    transition: all 0.5s ease-in-out;
}
 .swatch > [type="radio"] + label i, .swatch > [type="checkbox"] + label i {
	 opacity: 0;
	 font-size: 3rem;
	 transition: opacity 0.5s;
}
 .swatch > [type="radio"]:checked + label i, .swatch > [type="checkbox"]:checked + label i {
	 opacity: 1;
}
 .swatch.pink > [type="radio"] + label, .swatch.pink > [type="checkbox"] + label {
	 background-color: #e4a9bb;
}
 .swatch.green > [type="radio"] + label, .swatch.green > [type="checkbox"] + label {
	 background-color: #a4d65e;
	 color: #fff;
}
 .swatch.red > [type="radio"] + label, .swatch.red > [type="checkbox"] + label {
	 background-color:#e92727;	 
}
 .swatch.blue > [type="radio"] + label, .swatch.blue > [type="checkbox"] + label {
	 background-color: #012169;	
}
 .swatch.white > [type="radio"] + label, .swatch.white > [type="checkbox"] + label {
	 background-color: #ffffff;	 
}
 .swatch.black > [type="radio"] + label, .swatch.black > [type="checkbox"] + label {
	 background-color:#2d2926;

}
.swatch.yellow > [type="radio"] + label, .swatch.yellow > [type="checkbox"] + label {
	 background-color:#fdd26e;

}
 .swatch > [type="radio"]:checked + label, .swatch > [type="checkbox"]:checked + label {
	width: 30px;
    height: 30px;
    border-radius: 50%;
    line-height: 72px;       
    transition: all 0.5s ease-in-out;
}
 .swatch > [type="radio"]:checked + label i, .swatch > [type="checkbox"]:checked + label i {
	 opacity: 1;
	 transition: opacity 0.5s;
}
.mug h3{
  
  text-align: center;
    padding: 5px;
    font-size: 15px;
}
.mug{
  margin-bottom:30px;
}
.NewForm label{
  margin:10px 0px;
}
.NewForm{
margin-bottom: 35px;
}
.NewForm .form-control{
  margin:6px 0;
  height:40px;
}
.comHead{
  margin-top: 40px;
    margin-bottom: 20px;
        font-size: 24px;
    color: red;
    font-weight: 700;

}
.comh6{
  font-size: 15px;
    line-height: 30px;
    margin-bottom: 18px;
}
table{
  
  font-size: 16px;
}
td{
  text-align:left;
  min-width: 90px;
}
.PP{
  position: absolute;
    left: 50%;
}
tr{
    height: 35px;
}



.select2-container {
    display: inline !important;
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


.product-name-cart
{
font-size: 25px !important;
}

.product-subtotal-cart p
{
font-size: 18px !important; 
font-weight: 800;
}


.product-cart-image
{
    object-fit: contain;
    box-shadow: 0px 0px 2px 0px #071f75;
    border-radius: 10px;
}

.quantitynew .pro-qty {
    width: 100%;
}

.pl-0
{
  padding-left:0;
}

.quantitynew .pro-qty .qtybtn
 {
    width: 25%;
 }

 .quantitynew .pro-qty input
 {
    width: 50%;
 }

@media(min-width:1000px) and (max-width:1200px)
{
  .product-subtotal-cart p
{
  font-size: 16px !important; 
}

.PP
{
    right: 0;
}

}


@media(max-width:525px)
{

.PP
{
  position:relative;
  left:0;
}

.product-name-cart
{
  margin: 15px 10px;
  text-align: center;
}

.product-subtotal-cart p
{
  text-align:center;
}


.product-cart-image
{
    height: 130px;
    object-fit: contain;
}

.quantitynew .pro-qty
 {
    width: 50%;
    margin: 0px auto;
 }

.quantitynew
{
  margin-bottom: 15px;
}

.mobile-center
{
  text-align:center;
}

.p-sm-unset
{
padding:unset;
}



}


</style>
</head>

<body id="page-top">

<!-- start parallax -->

<div id="parallax">
  <?php

   $this->load->view('user/header');

  ?>
  <div class="innerWrapDiv ">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
          <h2 class="center">Your Cart</h2>
          <hr>
        </div>
      </div>
    </div>
  </div>
  <form method="post" action="" enctype="multipart/form-data">
    <section class="cart-section spad">
      <div class="container">
        <div class="row">
          <div class="col-lg-8 col-md-8">
            <?php if(count($carts)>0)
		{
			?>
            <?php if(count($carts)>0)
		{
		$strike_totall=0;	
	    foreach($carts as $cart)
		{
		?>
            <?php
		
		//echo $cart['qty'] * $cart['productstrikeprice']; 
		$strike_total = $cart['qty'] * $cart['price'];
		$strike_totall = $strike_totall+$strike_total; 
		}}
		?>
            <div class="vicart1">
              <input type="hidden" name="cart_count" value="<?php echo count($carts);?>">
              <?php
						 foreach($carts as $cart) {
                        $subb = $cart['qty'] * $cart['price']; 
						  ?>
              <input type="hidden" name="PROD_ID[]" value="<?php echo $cart['id'];?>">
              <input type="hidden" name="PROD_NAME[]" value="<?php echo $cart['name'];?>">
              <input type="hidden" name="QTY[]" id="qtyupdate_<?php echo $cart['rowid'];?>" value="<?php echo $cart['qty'];?>">
              <input type="hidden" name="PRICE[]" value="<?php echo $cart['price'];?>">
              <input type="hidden" name="IMAGE[]" value="<?php echo $cart['image'];?>">
              <input type="hidden" name="productcode[]" value="<?php echo $cart['productcode'];?>">
              <input type="hidden" name="subtotal[]" id="subtotal_<?php echo $cart['rowid'];?>" value="<?php echo $subb;?>">
              <?php } ?>
              <p>My Shopping Cart (<?php echo count($carts);?> Items) </p>
              <span> Total : $<span id="sepetloadd"><?php echo number_format($this->cart->total());?> </span> NZD</span> <br>
              <br>
              <input id="Final_Strike_Price" type="hidden" name="Final_Strike_Price" value="<?php echo $strike_totall;?>">
            </div>
            <?php if(count($carts)>0)
		{
	    foreach($carts as $cart)
		{
		?>
            <div class="mycart-table">
              <div class="row">
                <div class="col-lg-3 col-md-4 col-sm-4"> <a href="<?php echo base_url()?>Products/<?php echo $cart['productNameSlug']?>"> <img class="product-cart-image" src="<?php echo  base_url()?>uploads/Products/<?php echo $cart['image'];?>" alt="" width="100%"> </a> </div>
                <div class="col-lg-9 col-md-8 col-sm-8">
                  <div class="row">


                    <div class="col-lg-12 col-md-12 col-sm-12">

                      <h3 class="product-name-cart"> <?php echo $cart['name'];?></h3>
                      
                     <div class="asec detail-sec">
                    <?php  foreach($allproduct as $item=>$vall): if($cart['productNameSlug']==$vall->SlugName){ echo $vall->ProductDesc; } endforeach; ?>
                 </div>  </div>
                    
                    <div class="col-lg-6 col-md-5 col-sm-3 PP"> <span class="product-subtotal-cart" id="sepetload<?php echo $cart['rowid'];?>">
                      <p>$<?php echo number_format($cart['price']).' x '.$cart['qty'];?> = $<?php echo number_format($cart['price'] * $cart['qty']);?> NZD</p>
                    </span> 
                    </div>

                    <div class="col-lg-3 col-md-12 col-sm-12">
                      <div class="quantitynew">
                       <div class="pro-qty">
                      <input  id="quantity_view" class="qty_set keyy" type="text" name="quantity" data-rowid="<?php echo $cart['rowid'];?>" value="<?php echo $cart['qty'];?>" readonly>
                      </div>
                      
                        <?php /*
                        <input  id="quantity_view" autocomplete="off" min="1" class="qty_set keyy" name="quantity" data-rowid="<?php echo $cart['rowid'];?>" type="number" value="<?php echo $cart['qty'];?>" style="width:60px">
                        */ ?>
                        
                        <input id="quantity_hide" name="quantity" value="<?php echo $cart['qty'];?>" style="width:60px;display:none" readonly>
                        <span>
                        </h5>
                        </span> </div>
                    </div>

                    <div class="col-lg-4 col-md-4 pl-0 mobile-center p-sm-unset"> <a href="<?php echo base_url();?>Cart/delete_cart/<?php echo $cart['rowid'];?>" class=" rsite-btn btn-danger" style="min-width:unset;background:red;">Remove</a> </div>
                  
                  </div>
                </div>
              </div>
            </div>
            
            <?php } } ?>
            <?php } else { ?>
            <div class="vicart">
              <p><span >Your Shopping Cart is empty!!.</span></p>
            </div>
            <?php } ?>

      
           <!-- 
Image Checkbox Bootstrap template for multiple image selection
https://www.prepbootstrap.com/bootstrap-template/image-checkbox
-->



<?php /*

<h4 class="comHead">Surprise Gift offer for a fixed time</h4>
<h6 class="comh6">With every Necklace you buy a free photo printed coffee cup of your choice--your kids or pets.</br>
Please email your preferred photo to get the free gift.
please add the order No. also.</h6>
<div class="container mb-50 mug">
<div class="row">
<label style="margin-bottom:10px">Select the Model</label>
  <ul>  
  <?php foreach($gift as $gif){?>    
    <li><input type="radio" name="GiftModel" id="cb<?php echo $gif->gift_id?>" class="MugModel" value="<?php echo $gif->gift_id?>" onclick='docheck(this);' checked/>
    <label for="cb<?php echo $gif->gift_id?>"><img src="<?php echo base_url()?>uploads/Gift/<?php echo $gif->Image?>" /></label>
    <h3><?php echo $gif->code?></h3>
  </li>  
  <?php } ?>   
  </ul>  
</div>
</div>

                <div class="col-md-12 NewForm">


                <?php /*
                <div class="row">
                  <div class="form-group">
                    <label class="col-md-4 col-sm-4 col-xs-4 control-label" for="nama">Type</label>
                    <div class="col-md-8 col-sm-8 col-xs-8">
                      <select id="MugType" name="Mugtype" class="form-control input-md" type="text" >
                      <option value="">Select</option>
                      <option  value="Classic Mug(Ceramic)">Classic Mug(Ceramic)</option>
                      <option value="Water Bottle">Water Bottle</option>
                      <option value="Porcelain Mug">Porcelain Mug</option>
                      <option value="Magic Mug(Heat Changing)">Magic Mug(Heat Changing)</option>
                      <option value="Enamel Mug">Enamel Mug</option>
                      <option value="Travel Mug">Travel Mug</option>
                      </select>
                    </div>
                  </div>
                </div>
                


                <div class="row">
                  <div class="form-group">
                    <label class="col-md-4 col-sm-4 col-xs-4 control-label" for="nama">Size</label>
                    <div class="col-md-8 col-sm-8 col-xs-8">
                      <select id="Mugsize" name="Mugsize" class="form-control input-md" type="text">
                      <option value="">Select</option>
                      <option value="11 oz (325 ml)">11 oz (325 ml)</option>
                      <option value="15 oz (443 ml)">15 oz (443 ml)</option>
                      <option value="17 oz (483 ml)">17 oz (483 ml)</option>               
                      </select>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="form-group">
                    <label class="col-md-4 col-sm-4 col-xs-4 control-label" for="nama">Photo area</label>
                    <div class="col-md-8 col-sm-8 col-xs-8">
                      <select id="Photoarea" name="Photoarea" class="form-control input-md" type="text">
                      <option value="">Select</option>
                      <option value="One side - Right">One side - Right</option>
                      <option value="Wrap around">Wrap around</option>
                      <option value="One side - Left">One side - Left</option>               
                      </select>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="form-group">
                    <label class="col-md-4 col-sm-4 col-xs-4 control-label" for="nama">Colors</label>
                    <div class="col-md-8 col-sm-8 col-xs-8">
                    <section>
  
  <div class="swatch white">
    <input type="radio" name="Colors" id="swatch_2" value="white"  checked/>
    <label for="swatch_2"><i class="icon ion-ios-checkmark"></i></label>
  </div>
  <div class="swatch black">
    <input type="radio" name="Colors" id="swatch_3" value="black" />
    <label for="swatch_3"><i class="icon ion-ios-checkmark"></i></label>
  </div>
  <div class="swatch blue">
    <input type="radio" name="Colors" id="swatch_1" value="blue"  />
    <label for="swatch_1"><i class="icon ion-ios-checkmark"></i></label>
  </div>
  <div class="swatch green">
    <input type="radio" name="Colors" id="swatch_5" value="green" />
    <label for="swatch_5"><i class="icon ion-ios-checkmark"></i></label>
  </div>
  <div class="swatch pink">
    <input type="radio" name="Colors" id="swatch_4" value="pink" />
    <label for="swatch_4"><i class="icon ion-ios-checkmark"></i></label>
  </div>
  <div class="swatch red">
    <input type="radio" name="Colors" id="swatch_6" value="red" />
    <label for="swatch_6"><i class="icon ion-ios-checkmark"></i></label>
  </div>
  <div class="swatch yellow">
    <input type="radio" name="Colors" id="swatch_7" value="yellow" />
    <label for="swatch_7"><i class="icon ion-ios-checkmark"></i></label>
  </div>
</section>
                    </div>
                  </div>
                </div>

                


                <div class="row">
                  <div class="form-group">
                    <label class="col-md-4 col-sm-4 col-xs-4 control-label" for="nama">Upload Image</label>
                    <div class="col-md-8 col-sm-8 col-xs-8">                         
							  <input class="form-control" name="Image[]" accept=".jpg,.jpeg,.png" id="CustImage" type="file">
							</div>
                          </div>
                          </div>
                          
                          

                <div class="row">
                  <div class="form-group">
                    <label class="col-md-4 col-sm-4 col-xs-4 control-label" for="nama">Type Text</label>
                    <div class="col-md-8 col-sm-8 col-xs-8">
                     <input type="text" name="Mugtext" id="Mugtext" class="form-control input-md">
                    </div>
                  </div>
                </div>
              </div>
              */ ?>

</div>

          <?php if(count($carts)>0){?>
     
          <div class="col-lg-4 col-md-4 card-right dfgsecnew" > 
            
          <!--<form class="promo-code-form">
          <input type="text" placeholder="Enter promo code">
          <button>Submit</button>
        </form>-->
            <div class="ugcartsec">
              <h3 style="font-size: 15px;
    margin-bottom: 10px;">PRICE DETAILS (<?php echo count($this->cart->contents());?> Item)</h3>
    <h6 class="iucc">Shipping cost(free above 130 NZD)</h6>
              <?php 
		 
		  ?>
            </div>
            <div class="myugcartsec"></div>
            <div class="row tcubv">
              <div class="col-md-12">
                <div class="row">
                  <div class="form-group">
                    <label class="col-md-4 col-sm-4 col-xs-4 control-label" for="nama">Name</label>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                    
                      <input id="nama" name="payName" class="form-control input-md" required type="text" value="<?php if($this->session->userdata('userid')){ echo $user_data['FULLNAME'];} ?>">
                    </div>
                  </div>
                </div>
              </div>
             
              <div class="col-md-12">
                <div class="row">
                  <div class="form-group">
                    <label class="col-md-4 col-sm-4 col-xs-4 control-label" for="nama">Contact No</label>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      <input id="nama" name="payPhone" class="form-control input-md" required type="text" value="<?php if($this->session->userdata('userid')){ echo $user_data['MOBILE_NO'];} ?>">
                    </div>
                  </div>
                </div>
              </div>



              <div class="col-md-12">
                <div class="row">
                  <div class="form-group">
                    <label class="col-md-4 col-sm-4 col-xs-4 control-label" for="nama">Email</label>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      <input id="nama" name="payEmail" class="form-control input-md" required type="email"  value="<?php if($this->session->userdata('userid')){ echo $user_data['EMAIL_ID'];} ?>">
                    </div>
                  </div>
                </div>
              </div>



              <div class="col-md-12">
                <div class="row">
                  <div class="form-group">
                    <label class="col-md-4 col-sm-4 col-xs-4 control-label" for="nama">Country</label>
                    <div class="col-md-12 col-sm-12 col-xs-12">

                      <select class=" form-control" name="country" id="country" onchange="getsubcat(this.value);"  required>
                        <option value="" selected>Select Country</option>
                        
                        <?php 

		                  foreach($country as $item=>$val):
                      if($val->isDefault!=1) {
                      continue;
                      }
		                    ?>
                        <option value="<?php echo $val->country_id;?>" <?php if($val->isDefault==1) { echo ""; } ?> data-code="<?= $val->country_code; ?>"><?php echo $val->country_name;?></option>
                        <?php 

                      endforeach

                      ?>
                      </select>
                    </div>
                  </div>
                </div>
              </div>


              <div class="col-md-12">
                <div class="row">

                  <!-- <p style="padding-right: 15px;padding-left: 15px;font-size: 12px;padding-bottom: 0px;color: red;">Enter min 4 characters to search</p> -->
                      
                  <div class="form-group">

                    <label class="col-md-4 col-sm-4 col-xs-4 control-label" for="nama">Address</label>

                    <div class="col-md-12 col-sm-12 col-xs-12 select2-parent">
                    
                      <input type="hidden" id="payAddressText" name="payAddressText" value="">

                      <select class="payAddress" name="payAddress" required>

                      </select>

                    </div>

                  </div>

                </div>
              </div>



              <div class="col-md-12">
                <div class="row">
                  <div class="form-group">
                    <label class="col-md-4 col-sm-4 col-xs-4 control-label" for="nama">Street</label>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                    
                      <input type="text" id="payStreet" class="form-control payStreet" name="payStreet" readonly>
                     
                    </div>
                  </div>
                </div>
              </div>


              <div class="col-md-12">
                <div class="row">
                  <div class="form-group">
                    <label class="col-md-4 col-sm-4 col-xs-4 control-label" for="nama">Suburb</label>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                    
                      <input type="text" id="paySuburb" class="form-control paySuburb" name="paySuburb" readonly>
                     
                    </div>
                  </div>
                </div>
              </div>


              <div class="col-md-12">
                <div class="row">
                  <div class="form-group">
                    <label class="col-md-4 col-sm-4 col-xs-4 control-label" for="nama">City</label>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                    
                      <input type="text" id="payCity" class="form-control payCity" name="payCity" readonly>
                     
                    </div>
                  </div>
                </div>
              </div>



              <div class="col-md-12">
                <div class="row">
                  <div class="form-group">
                    <label class="col-md-4 col-sm-4 col-xs-4 control-label" for="nama">Post Code</label>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                    
                      <input type="text" id="payPostCode" class="form-control payPostCode" name="payPostCode" readonly>
                     
                    </div>
                  </div>
                </div>
              </div>






              <div class="col-md-12">
                <div class="row">
                  <div class="form-group">
                    <label class="col-md-4 col-sm-4 col-xs-4 control-label" for="nama">Delivery instructions</label>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      <textarea class="form-control" rows="3" name="payInstruction"></textarea>
                      
                    <input type="hidden" name="cart_count" value="<?php echo count($carts);?>"> 
               <input id="Final_totalbefore" type="hidden" name="Final_totalbefore" value="<?php echo $this->cart->total();?>">
                <input id="Final_shippingprice" type="hidden" name="Final_shippingprice" value="0">
                 <input id="Final_Totalprice" type="hidden" name="Final_Totalprice" value="<?php echo $this->cart->total();?>">        
                      
                      
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="myugcartsec">
              <p style="font-weight:500;">Total Price <span style="float:right;">$<span id="sepetloaddlast"><?php echo number_format($this->cart->total());?> NZD </span> <span id="currency3"></span></span> </p>
              <p class="vv">Shipping Cost <span class="juc">$<span id="shipppingtotprice">0 NZD </span> <span id="currency2"></span></span></p>
             </div>
             
             <div class="Mbsec"> <p>Total Amount<span>$<span id="final_total_amount"><?php echo number_format($this->cart->total());?> NZD </span> <span id="currency1"></span></span></p>
              <?php if((count($this->cart->contents()) != '')) { ?>
              <input type="submit" name="checkout" class="site-btn" id="ProCheck" value="Proceed to checkout" onclick="return confirm('Are you absolutely want to Proceed to Checkout?');">
              <?php } else if($this->cart->contents() == '') { ?>
              <a href="<?php echo base_url();?>" class="site-btn">Proceed to checkout</a>
              <?php } else { ?>
              <a href="<?php echo base_url();?>" class="site-btn">Proceed to checkout</a>
              <?php } ?>
              <a href="<?php echo base_url();?>Product" class="sb-dark">Continue shopping</a> </div>
          </div>
          <?php } ?>
        </div>
      </div>
    </section>
  </form>
  <?php

 $this->load->view('user/footer');

?>
  
  <!-- end footer --> 
  
</div>
  <script type="text/javascript">

    $(document).ready(function() {
	//$('.keyy').change(function(){
  $('body').on('change','.keyy',function(){
   
  var quantity = $(this).val();
  var row_id = $(this).data("rowid");
  var countryID = document.getElementById('country').value;
	
	
   jQuery.ajax({
	  type:'POST',
		dataType:'json',
    url:"<?php echo base_url(); ?>Cart/qty_update",
    data:{row_id:row_id, quantity:quantity, countryID:countryID},
    success:function(data)
    {

    $('#sepetload'+row_id).html(data.AmountDescription);   
    $('#sepetloadd').html(data.Amount); 
    $('#sepetloaddlast').html(data.Amount);
    $('#right_amount').html(data.AmountRight); 
    $("#final_total_amount").html(data.Totalshipping);
    $('#shipppingtotprice').html(data.Shipping);
    $('#currency1').html(data.Currency);
    $('#currency2').html(data.Currency);
    $('#currency3').html(data.Currency);
    $('#currency4').html(data.Currency);
	
	 
	
	 
	document.getElementById('qtyupdate_'+row_id).value = data.Quantity;  
	document.getElementById('subtotal_'+row_id).value = data.QuantityPrice;  
	  
	document.getElementById('Final_shippingprice').value = data.Shipping;  
	document.getElementById('Final_Totalprice').value = data.Totalshipping; 
	document.getElementById('Final_totalbefore').value = data.AmountRight; 
	
  
    }
   });    
           
});

 
});
</script> 


<script>



	function getsubcat(val) {

	 var countryID = val;



   

 jQuery.ajax({

	type:'POST',

	dataType:'json',

     
	  url:"<?php echo base_url(); ?>Cart/shipping_update",

	  data:{countryID:countryID},

	 success: function(data){


 $('#sepetloadd').html(data.Amount); 
	 $('#sepetloaddlast').html(data.Amount);
	 $('#right_amount').html(data.AmountRight); 
	 $("#final_total_amount").html(data.Totalshipping);
	 $('#shipppingtotprice').html(data.Shipping);
	 $('#currency1').html(data.Currency);
	 $('#currency2').html(data.Currency);
	 $('#currency3').html(data.Currency);
	 $('#currency4').html(data.Currency);	

	 document.getElementById('Final_shippingprice').value = data.Shipping;  
	document.getElementById('Final_Totalprice').value = data.Totalshipping; 
	document.getElementById('Final_totalbefore').value = data.AmountRight;   		

	}
	});
}



</script> 



<script>



	

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

		

	 $button.parent().find('input').val(newVal).trigger('change');


	 document.getElementById('quantity_hide').value = newVal;

	 //$('#quantity_show').html(newVal);  

	 //$('#quantity_showfirst').html(newVal); 

	 //var total_price = newVal*document.getElementById('payPrice').value; 

	 //$('#total_price_show').html(total_price);

	 //document.getElementById('total_price_full').value = total_price;


	//alert(total_price);

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
  // image gallery
// init the state from the input
$(".image-checkbox").each(function () {
  if ($(this).find('input[type="checkbox"]').first().attr("checked")) {
    $(this).addClass('image-checkbox-checked');
  }
  else {
    $(this).removeClass('image-checkbox-checked');
  }
});

// sync the state to the input
$(".image-checkbox").on("click", function (e) {
  $(this).toggleClass('image-checkbox-checked');
  var $checkbox = $(this).find('input[type="checkbox"]');
  $checkbox.prop("checked",!$checkbox.prop("checked"))

  e.preventDefault();
});
  </script>
  <script>
  var checked = $(".colored-radio").first();
checked.css('background',checked.attr('data-color'));

$(".colored-radio:not(:checked)").click( function () {
  checked.prop('checked', false);
  checked.css('background', 'transparent');
  checked = $(this);
  checked.css('background',checked.attr('data-color'));
  displayIdChecked();
});

function displayIdChecked() {
    var id = $('.colored-radio:checked').attr('id');
  if (id == undefined)
    id = $(".colored-radio").first().attr('id');
  console.log(id);
}
  </script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script> 

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.9/css/select2.min.css" integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.9/js/select2.min.js" integrity="sha512-9p/L4acAjbjIaaGXmZf0Q2bV42HetlCLbv8EP0z3rLbQED2TAFUlDvAezy7kumYqg5T8jHtDdlm1fgIsr5QzKg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<!-- 
<script>
$("#ProCheck").on('click', function(){  
  if (typeof $("input[name='GiftModel']:checked").val() === "undefined") {       
}else{   
  $('#MugType').attr('required', true);   
  $('#Mugsize').attr('required', true); 
  $('#Photoarea').attr('required', true); 
  $('#CustImage').attr('required', true);  
}
});
</script> -->

<script>
$("#ProCheck").on('click', function(){     
  $('.MugModel').attr('required', true); 
  $('#MugType').attr('required', true);   
  $('#Mugsize').attr('required', true); 
  $('#Photoarea').attr('required', true); 
  $('#CustImage').attr('required', true);  
});
</script>



<script>

/*
$('.payAddress').on('input paste', function () {

  var address_input = $(this).val();


  $.ajax({

    url : "<?= base_url() ?>NZPost/parcelAddress",

    method : "POST",

    data : {address:address_input},

    success:function(data)
    {

     var data = JSON.parse(data);

    }


  });


})
  */

</script>


<script>

document.addEventListener("DOMContentLoaded", function(event) { 

  $('.payAddress').select2({  
    placeholder: "Search address",
    theme: "default",
    dropdownParent: $('.select2-parent'),
    minimumInputLength: 4,
    ajax: {
      url: "<?= base_url(); ?>NZPost/searchAddress",
      method: "POST",
      dataType: 'json',
      delay: 100  ,
      cache: false,
      allowClear: false,
      data: function(params) {
        // Get the selected option's data-code attribute
        var countryCode = $('#country option:selected').attr('data-code');
        return {
          term: params.term,
          page: params.page || 1,
          country_code: countryCode // Pass data-code attribute
        };
      },
      processResults: function(data, params) {
        var page = params.page || 1;
        return {
          results: $.map(data.addresses, function(item) {
            return {
              id: item.address_id,
              text: item.full_address
            }
          }),
          pagination: {
            more: (page * 10) <= data.total_count
          }
        };
      },
    }
  }).on('select2:open', function () {
    $('.select2-dropdown').css('min-width','300px');
  });

    $('.payAddress').change(function(){

      var sel_address_id = $(this).val();

      var sel_address_text = $('.payAddress option:selected').text();

      $.ajax({

        url: "<?php echo base_url(); ?>NZPost/getAddressDetails",

        method:"POST",

        data :{address_id:sel_address_id},

        success:function(data)
        {

        var data = JSON.parse(data);

        //console.log(data.address.street_number);

        $('#payAddressText').val(sel_address_text);

        $('#payStreet').val(data.address.street);

        $('#paySuburb').val(data.address.suburb);

        $('#payCity').val(data.address.city);

        $('#payPostCode').val(data.address.postcode);

        }

      })



      
    })





});

</script>


<!-- 
<script>
var checkedradio;
function docheck(thisradio) {
    if (checkedradio == thisradio) {
        thisradio.checked = false;
        checkedradio = null;
    }
    else {checkedradio = thisradio;}
}
</script> -->

</body>
</html>
