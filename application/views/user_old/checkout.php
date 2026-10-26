<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8" content="" />
<meta http-equiv="X-UA-Compatible" content="" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />

<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

<title>Dwalker</title>
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
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/AlertifyJS/1.13.1/css/alertify.min.css" />
<!-- Default theme for Alertify.js -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/AlertifyJS/1.13.1/css/themes/default.min.css" />

<!-- Alertify.js JavaScript -->

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
<script src="https://cdnjs.cloudflare.com/ajax/libs/AlertifyJS/1.13.1/alertify.min.js"></script>
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
.amsec{
	border: 1px solid #353d97;
    padding: 4px 4px;
}
.amsec p{
	color: #071f75;
    font-weight: 600!important;
}
.amsec h6{
	color: #141414;
    font-weight: 600!important;
    font-size: 15px;
    margin-bottom: 5px;
}
.amsec p span{
	color: #2d0ddb;
    font-weight: 600;
}
.iucc{
    font-size: 14px;
    font-weight: 600;
    margin-bottom: 14px;
    color: #071f75;
}
.radio-buttons 
{
  width: 100%;
  margin: 0 auto;
  text-align: center;
}

.custom-radio input 
{
  display: none;
}

.radio-btn 
{ 
  margin: 10px;
  width: 100%;
  padding: 5px;
  height: 100%;
  border: 3px solid transparent;
  display: block;  
  border-radius: 10px;
  position: relative;
  text-align: center;
  box-shadow: 0 0 20px #c3c3c367;
  cursor: pointer;
}

.radio-btn > i {
  color: #ffffff;
  background-color:#9c9106;
  font-size: 20px;
  position: absolute;
  top: -15px;
  left: 50%;
  transform: translateX(-50%) scale(2) !important;
  border-radius: 50px;
  padding: 3px;
  transition: 0.5s;
  pointer-events: none;
  opacity: 0;
}

.radio-btn .hobbies-icon 
{
  width: 150px;
  height: 150px;
  position: absolute;
  top: 40%;
  left: 50%;
  transform: translate(-50%, -50%);
}
.radio-btn .hobbies-icon img
{
  display:block;
  width:100%;
  margin-bottom:20px;
  
}
.radio-btn .hobbies-icon i 
{
  color: #FFDAE9;
  line-height: 80px;
  font-size: 60px;
}

.radio-btn .hobbies-icon h3 
{
  color: #555;
  font-size: 18px;
  font-weight: 300;
  text-transform: uppercase;
  letter-spacing:1px;
}

.custom-radio input:checked + .radio-btn 
{
  border: 2px solid #b0a614;
}

.custom-radio input:checked + .radio-btn > i 
{
  opacity: 1;
  transform: translateX(-50%) scale(1);
}
.coupon-btn{
  width:100%;
  background-color:#071f75;
  color:white;
  padding: 10px;
    border-radius: 5px;
    position: relative;
    top: 8px;
    left: -8px;
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
          <h2 class="center">Checkout</h2>
          <hr>
        </div>
      </div>
    </div>
  </div>
  <form class="checkout-form" method="post">
	<!-- checkout section  -->
	<section class="checkout-section spad">
		<div class="container">
			<div class="row">
				<div class="col-lg-8  order-lg-1">
					
						<div class="cf-title">Billing Address</div>
						
						<div class="row address-inputs">
                        
                         <div class="col-md-6">
                         <label>Name</label>
						<input name="Name" type="text" readonly placeholder="Name" value="<?php echo $user_details_order['payName'];?>">
						</div> 
                        <div class="col-md-6">
                         <label>Country</label>
					<input name="Country" type="text" readonly placeholder="Country" value="<?php echo $user_details_order['payCountry'];?>">
						</div> 
                        
                         <div class="col-md-6">
                         <label>Contact No</label>
					<input name="Contact" type="text" readonly placeholder="Contact NO" value="<?php echo $user_details_order['payPhone'];?>">
						</div>
                         <div class="col-md-6">
                          <label>Email</label>
					<input name="Email" type="text" readonly placeholder="Email" id="Uemail" value="<?php echo $user_details_order['payEmail'];?>">
						</div>                            
							<div class="col-md-6">
                             <label>Address</label>
								<textarea name="Address" readonly class="textareaclass" placeholder="Address"><?php echo $user_details_order['payAddress'];?></textarea>
                              </div>
                               
                              <div class="col-md-6">
                               <label>Delivery Instruction</label>
								<textarea name="Instruction" readonly class="textareaclass" placeholder="Delivery Instruction"><?php echo $user_details_order['payInstruction'];?></textarea>
                                <br /><br>
                              </div> 
                               
							
						</div>		

            <?php if(!empty($user_gift_details['Image'])){?>				
						
            <div class="cf-title">Complimentary Details</div>

            <div class="row address-inputs">  
                               
             <div class="col-md-6">
                        <label>Mug Model</label>
                        </div>
            
           
           <?php /*                        
           <div class="col-md-3">
           <input name="Name" type="text" readonly placeholder="" value="<?php echo $user_gift_details['code'];?>">
           </div> 
           */ ?>

           <div class="col-md-6">
            
           <img title="<?php echo $user_gift_details['code'];?>" src="<?php echo base_url()?>uploads/Gift/<?php echo $user_gift_details['Image'];?>" style="width:100px;height:100px;">
           
           </div>
                   

              <?php /*
                       <div class="col-md-6">
                        <label>Type</label>
              </div>
              <div class="col-md-6">
         <input name="Country" type="text" readonly placeholder="" value="<?php echo $user_gift_details['Mugtype'];?>">
           </div> 
        
                       
                        <div class="col-md-6">
                        <label>Size</label>
                        </div>
                        <div class="col-md-6">
         <input name="Contact" type="text" readonly placeholder="" value="<?php echo $user_gift_details['Mugsize'];?>">
           </div>

                        <div class="col-md-6">
                         <label>Photo area</label>
                         </div>
                         <div class="col-md-6">
         <input name="" type="text" readonly placeholder="" value="<?php echo $user_gift_details['Photoarea'];?>">
           </div>


           <div class="col-md-6">
                         <label>Color</label>
                         </div>
         <div class="col-md-6">
         <input name="" type="text" readonly placeholder="" value="<?php echo $user_gift_details['Colors'];?>">
           </div>

           */ ?>



           <?php if(!empty($user_gift_details['photo'])){?>
           <div class="col-md-6">
                         <label> Image</label>
          </div>
          <div class="col-md-6">
       
        <img src="<?php echo base_url()?>uploads/Gift/<?php echo $user_gift_details['photo'];?>" style="width:100px;height:100px;">
    
           </div>
           <?php } ?>

           <div class="col-md-6">
                         <label>Text</label>
            </div>
            <div class="col-md-6">
         <input name="" type="text" readonly placeholder="" value="<?php echo $user_gift_details['Mugtext'];?>">
           </div>
                        					
				</div>
        <?php } ?>
        </div>
    
				<div class="col-lg-4 col-md-4 card-right dfgsecnew"> 
            
            <!--<form class="promo-code-form">
          <input type="text" placeholder="Enter promo code">
          <button>Submit</button>
        </form>-->
            <div class="ugcartsec">
              <h3 style="font-size: 15px;
    margin-bottom: 10px;">PRICE DETAILS (<?php echo count($cartproduct) ?> Item)</h3>
    <h6 class="iucc">Shipping cost(free above 130 NZD)</h6>
                          </div>


    <?php /*                        
    <div class="row">
    <div class="col-lg-9">
    <input type="text" name="promocode" placeholder="Promo Code" id="promo"> 
    </div>
    <div class="col-lg-3">
     <input type="submit" name="apply" value="Apply" class="coupon-btn Promoapply">
    </div>
    </div>
    */?>


         <div class="myugcartsec">
            
            <?php

              foreach($cartproduct as $val){?>
             <div class="amsec">
              <p style="font-weight:500;"> <?php echo $val->payProduct; ?>
              
               <span style="float:right;">$<?php echo $val->payPrice; ?> NZD</span></span> </p>
           <h6> Quantity: <?php echo $val->payQuantity; ?></h6>
           </div>
             <?php

				  }

			?>
            </div>
            <div class="myugcartsec">
            
            <input type="hidden" class="TotalAmount" value="<?php echo $user_details_order['payTotalbefore'];?>">
            <input type="hidden" class="shipping" value="<?php echo $user_details_order['payShipping'];?>">
              <p style="font-weight:500;">Total Price <span style="float:right;">$<?php echo $user_details_order['payTotalbefore'];?> NZD</span></span> </p>
              <p class="vv">Shipping Cost <span class="juc">$<span id="shipppingtotprice"><?php echo $user_details_order['payShipping'];?> NZD </span> <span id="currency2"></span></span></p>
             </div>
                <div class="myugcartsec"></div>
              
              <input type="hidden" class="" name="discount" value="<?php echo $user_details_order['payTotal'];?>">
              <input type="hidden" class="" name="final_db" id="final_total_db">
             <div class="Mbsec"> <p>Total Amount<span>$<span id="final_total_amount"><?php echo $user_details_order['payTotal'];?>&nbsp; </span>NZD <span id="currency1"></span></span></p></div>
           

  <div class="radio-buttons">
  <div class="row">

  <?php 
    /*
    <div class="col-lg-6">
    <label class="custom-radio">
    <input type="radio" name="mode" checked value="3">
    <span class="radio-btn"><i class="las la-check"></i>  
    <img src="<?php echo base_url()?>assets/images/cash.png" style="width:16%"> <br>   
        <h3 class="">Cash On Delivery</h3>      
    </span>
    </label>
    </div>
    */
    ?>

    <div class="col-lg-6">

    <label class="custom-radio">
      <input type="radio" name="mode" checked value="1">
      <span class="radio-btn"><i class="las la-check"></i> 
      <img src="<?php echo base_url()?>assets/images/online.png" style="width:16%"> <br>       
          <h3 class="">Pay Online</h3>
      
      </span>
    </label>
    </div>


    </div>

  

                             <input style="width:100%" type="submit" name="place_order" value="Place Order" class="site-btn" onClick="return confirm('Are you absolutely want to Place this Order?');">
                             <img src="https://www.dwalker.co.nz/assets/images/paypal.png" class="img-responsive footerLogo" alt="Windcave payment" style="padding:10px;text-align: center;

    margin: 0px auto;">
                           </div>
          </div>
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
	$('.keyy').click(function(){
  var quantity = $(this).val();
  <!-- var quantity = $(this).val();-->
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

		

	$button.parent().find('input').val(newVal);

	 document.getElementById('quantity_val').value = newVal;

	 $('#quantity_show').html(newVal);  

	 $('#quantity_showfirst').html(newVal); 

	 var total_price = newVal*document.getElementById('payPrice').value; 

	 $('#total_price_show').html(total_price);

	  document.getElementById('total_price_full').value = total_price;

	 

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
$(document).on("change", "#promo", function() {    
      var Promo = $(this).val(); 
      var email = $('#Uemail').val(); 
		$.ajax({
			url: "<?php echo base_url("Checkout/CheckPromo");?>",
			method: "POST",  
			data:{Promo : Promo, email : email},
		  success: function(data){   
      var data = JSON.parse(data);
        if(data.status == 0){         
                alertify.set('notifier','position', 'middle-center');  
                alertify.error('Invalid Promocode').delay(2).dismissOthers(); 
                $('#promo').val("");  
        }else if(data.status == 1){
          alertify.set('notifier','position', 'middle-center');  
          alertify.error('This promo code already redeemed!').delay(2).dismissOthers(); 
          $('#promo').val("");  
        }     
      }           
		});
    });
    </script>  

<script>  
$(document).on("click", ".Promoapply", function(e) {    
      var Promo = $('#promo').val();
      var total = $('.TotalAmount').val();
      var shipping = $('.shipping').val();
      e.preventDefault();   
		$.ajax({
			url: "<?php echo base_url("Checkout/CalculatePromo");?>",
			method: "POST",  
			data:{Promo : Promo,total : total,shipping : shipping},
		  success: function(data){   
      var data = JSON.parse(data);        
        if(data.status == 0){         
        alertify.set('notifier','position', 'middle-center');  
        alertify.error('Invalid Promocode').delay(2).dismissOthers(); 
        $('#promo').val("");  
       }  else{
        $('#final_total_amount').text(data.TotalA);
        $('#final_total_db').val(data.TotalA);
       }      
      }           
		});
    });
    </script>  

</body>
</html>
