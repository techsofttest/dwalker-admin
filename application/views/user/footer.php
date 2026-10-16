
  <div class="footer"> 
  <div class="foooverflow"></div>
    <!-- start container -->
    <div class="container">
      <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-4 myfooterContent">
         <!-- <h2>Testimonials</h2>-->
           <h2>About Us</h2>
          <hr />
          <!--<div class="row">
      <div class="col-lg-12">
      <div class="owl-carousel owl-theme serviceSlider"> 
        <?php

            foreach($testimonial as $prod){

		  ?>

      <div class="item">
      <div class=" sfeature-item">
       
          
         
         <?php echo $prod->testi_description; ?>
          <h4><?php echo $prod->testi_name; ?></h4>
           <?php if($prod->testi_location!=''){
			   ?><h3><i class="fa fa-map-marker" aria-hidden="true"></i> <?php echo $prod->testi_location; ?></h3> <?php } ?>
          </div>
      </div>
       <?php

			   }

		    ?>
      
      
      
      
      </div>
      
      
      
      
        
      </div>
    </div>-->
          
          
          
          
        <?php echo $cmsfooter_data['pageDescription']; ?>
        </div>
        <div class="col-lg-8 col-md-8 col-sm-8">
          <div class="row">
            <div class="col-lg-7 col-md-6 col-sm-5 quickLinks">
              <h2>Quick Links</h2>
              <hr />
              <ul>
                <li><a href="<?php echo base_url()?>">Home</a></li>
                <li><a href="<?php echo base_url()?>About">About Us</a></li>
                <li><a href="<?php echo base_url()?>Product">Products</a></li>
                <li><a href="<?php echo base_url()?>Contact">Contact Us</a></li>
              </ul>
              <ul>
                <li><a href="<?php echo  base_url()?>ReturnPolicy">Return Policy</a></li>
                <li><a href="<?php echo  base_url()?>GuaranteePolicy">Guarantee Policy</a></li>
                <li><a href="<?php echo  base_url()?>DeliveryPolicy">Delivery Policy</a></li>
              </ul>
            </div>
            <div class="col-lg-5 col-md-6 col-sm-7 quickLinks noBorderRight">
              <h2>Contact Us</h2>
              <hr />
              <div class="footerContent">
                <p class="footAddress"> Clover park , Auckland, Newzealand  </p>
                <p class="footPhone">Phone: NZ 64+ 092501890</p>
                <p class="footEmail">Email: dwalkerjewels@gmail.com</p>
              </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 copyRight">

              <ul class="socialMedia">

          <li> <a style="color: blue;" href="https://www.facebook.com/people/D-Walker-Jewellery/61577297165217" target="_blank"><i class="fab fa-facebook" aria-hidden="true"></i></a></li>

          <li><a style="color: red;" href="https://www.instagram.com/dwalkerjewellery" target="_blank"><i class="fab fa-instagram" aria-hidden="true"></i></a></li>

          <li><a style="color: #008dbb;" href="https://www.linkedin.com/company/d-walker-jewellery" target="_blank"><i class="fab fa-linkedin" aria-hidden="true"></i></a></li>

          <li><a style="color: red;" href="https://in.pinterest.com/dwalkerjewellery" target="_blank"><i class="fab fa-pinterest" aria-hidden="true"></i></a></li>

              </ul>

              <p>Copyright © <!--2021--><?= date('Y'); ?>. <span> D Walker Jewelry </span>.  All rights reserved. </p>
			  
			  
			  <!-- <br />
                Web designed by <a href="http://www.techsoftweb.com/" target="_blank">Techsoft</a> -->
			  
            </div>
          </div>
        </div>
      </div>
      <a href="#" class="go-top"><i class="fa fa-angle-up" aria-hidden="true"></i></a> </div>
    <!-- end container --> 
  </div>
  
 
   
<script type="text/javascript">
	$(document).ready(function(){
		$('.add_cart').click(function(){
			var product_id    = $(this).data("productid");
			var product_name  = $(this).data("productname");
			var product_price = $(this).data("productprice");
			var product_image = $(this).data("productimage");
			var productcode = $(this).data("productcode");
			
			var productNameSlug = $(this).data("productnameslug");
			var quantity   	  = $('#quantity').val();
          
	
				
			$.ajax({
				url : "<?php echo base_url('Cart/Add_to_cart');?>",
				method : "POST",
				data : {product_id: product_id, productNameSlug: productNameSlug, product_name: product_name, product_price: product_price, product_image: product_image, quantity: quantity, productcode: productcode},
				success: function(data){
				
		   window.location = "<?php echo base_url(); ?>Cart/MyCart";
	
				
				}
			}); 
	
		});

		 

		$('#detail_cart').load("<?php echo base_url('Cart/load_cart');?>");
		$('#count_cart').load("<?php echo base_url('Cart/count_load');?>");
		$('#count_cart_new').load("<?php echo base_url('Cart/count_load_new');?>");
		

		
		$(document).on('click','.romove_cart',function(){
			var row_id=$(this).attr("id"); 
			$.ajax({
				url : "<?php echo base_url('Cart/delete_cart');?>",
				method : "POST",
				data : {row_id : row_id},
				success :function(data){
					$('#detail_cart').html(data);
					$('#count_cart').html(data);
					
					//window.location = "<?php echo base_url(); ?>Product/Cart";
				}
			});
		});
	});
</script> 
  
  <!----------start navbar------------------>
 <script>
  /* Set the width of the sidebar to 250px and the left margin of the page content to 250px */
function openNav() {
  document.getElementById("mySidebar").style.width = "250px";
  document.getElementById("main").style.marginLeft = "250px";
}

/* Set the width of the sidebar to 0 and the left margin of the page content to 0 */
function closeNav() {
  document.getElementById("mySidebar").style.width = "0";
  document.getElementById("main").style.marginLeft = "0";
}
</script>

<?php if($this->session->flashdata('notification')){?>
    <script>
    alertify.set('notifier','position', 'top-center');   
    alertify.error('Please fill valid details');
    </script>
    <?php } ?> 

    <?php if($this->session->flashdata('Emailexist')){?>
    <script>
    alertify.set('notifier','position', 'top-center');   
    alertify.error('Email address is already in use, Please use forgot password option to recover password!');  
    </script>
    <?php } ?> 

    <?php if($this->session->flashdata('Phoneexist')){?>
    <script>
    alertify.set('notifier','position', 'top-center');   
    alertify.error('Phone number is already in use, Please use forgot password option to recover password!');
    </script>
    <?php } ?> 

    <?php if($this->session->flashdata('login')){?>
    <script>
    alertify.set('notifier','position', 'top-center');   
    alertify.success('Logged In Successfully');
    </script>
    <?php } ?> 
    
    <?php if($this->session->flashdata('notlogin')){?>
    <script>
    alertify.set('notifier','position', 'top-center');   
    alertify.error('Invalid Credentials');
    </script>
    <?php } ?> 

    <?php if($this->session->flashdata('update')){?>
    <script>
    alertify.set('notifier','position', 'top-center');   
    alertify.success('Your changes have been applied successfully');
    </script>
    <?php } ?> 
    
    
    <?php if($this->session->flashdata('missing')){?>
    <script>
    alertify.set('notifier','position', 'top-center');   
    alertify.error('Try again with valid details');
    </script>
    <?php } ?> 
    <?php if($this->session->flashdata('fornotfound')){?>
    <script>
    alertify.set('notifier','position', 'top-center');   
    alertify.error('User with this email address not found');
    </script>
    <?php } ?>

    <?php if($this->session->flashdata('Forget')){?>
    <script>
    alertify.set('notifier','position', 'top-center');   
    alertify.success('A password reset link has been sent to your email, Use that link to reset your password');
    </script>
    <?php } ?> 

    <?php if($this->session->flashdata('linkexpired')){?>
    <script>
    alertify.set('notifier','position', 'top-center');   
    alertify.error('Link Expired');
    </script>
    <?php } ?> 

    <?php if($this->session->flashdata('Reseted')){?>
    <script>
    alertify.set('notifier','position', 'top-center');   
    alertify.success('Password Reset Successfully');
    </script>
    <?php } ?> 


    <?php if($this->session->flashdata('Invalidlink')){?>
    <script>
    alertify.set('notifier','position', 'top-center');   
    alertify.error('Invalid Link');
    </script>
    <?php } ?> 
    

    <?php if($this->session->flashdata('regi')){?>

<script>

const Toast = Swal.mixin({

  toast: true,

  position: 'center',

  showConfirmButton: false,

  timer: 3000,

  timerProgressBar: true,

  didOpen: (toast) => {

    toast.addEventListener('mouseenter', Swal.stopTimer)

    toast.addEventListener('mouseleave', Swal.resumeTimer)

  }

})



Toast.fire({

  icon: 'success',

  title: 'Congratulations! Account Created Successfully'

})

</script>

<?php } ?>

<script>

// Add a placeholder after .topBar to prevent layout shift
if ($('.topBar').length && !$('#topBar-placeholder').length) {
    $('<div id="topBar-placeholder" style="display:none; height:' + $('.topBar').outerHeight() + 'px;"></div>').insertAfter('.topBar');
}

$(window).on('scroll', function() {
    if ($(this).scrollTop() > 120) {
        $('.topBar').addClass("sticky2");
        $('.navbtn').addClass("sticky2");
        $('#topBar-placeholder').show();
    } else {
        $('.topBar').removeClass("sticky2");
        $('.navbtn').removeClass("sticky2");
        $('#topBar-placeholder').hide();
    }
});
  
  </script>
