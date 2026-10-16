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

<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery-1.11.3.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/wow.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/main.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/custom.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/AlertifyJS/1.13.1/css/alertify.min.css" />
<!-- Default theme for Alertify.js -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/AlertifyJS/1.13.1/css/themes/default.min.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/AlertifyJS/1.13.1/alertify.min.js"></script>

</head>

<body id="page-top">
<!-- start parallax -->
<div id="parallax">
  
<?php
  //$data['main_category'] 	= 	$this->Admin_model->fetch_all('dwalker_category');
  $this->load->view('user/header');
 ?>
    

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<style>

    .swal2-popup.swal2-toast {

        padding: 2em 1em 1em 1em !important;
        height:100px !important;
       

    }
    body.swal2-toast-shown .swal2-container {
      width:max-content !important;
    }

.justify-content-center{
	
	  -webkit-box-pack: center;
    -ms-flex-pack: center;
    justify-content: center;
    justify-content: center!important;
    display: flex;
    -ms-flex-wrap: wrap;
    flex-wrap: wrap;
}

</style>

<body id="page-top">
<!-- start parallax -->
<div id="parallax"> 
   
<div class="innerWrapDiv ">
<div class="container">

<div class="row justify-content-center">
						
						<div class="col-sm-10 col-lg-7">
							<div class="contact-form-new pbmit-bg-color-white">
							<h2 class="center">Register Now</h2>
								<form action="#" method="post">
									<div class="row">
										<div class="col-sm-6">
											<input type="text" class="form-control" placeholder="Name *" name="name" required>
										</div>
										<div class="col-sm-6">
											<input type="email" class="form-control" placeholder="Email *" name="email" required>
										</div>
										<div class="col-sm-6">
											<input type="text" class="form-control" placeholder="Contact No *" name="phone" required>
										</div>
										<div class="col-sm-6">
											<select class=" form-control" name="country" id="country"  required="">
                        <option value="" selected="" disabled="">Select Country *</option>
                                                <option value="New Zealand">New Zealand</option>
                                                <option value="Australia">Australia</option>
                                                <option value="USA">USA</option>
                                                <option value="Singapore">Singapore</option>
                                                <option value="United Kingdom">United Kingdom</option>
                                                <option value="Rest of the world">Rest of the world</option>
                                              </select>
										</div>

                    <div class="col-sm-6">
											<input type="password" class="form-control" placeholder="Password*" id="pass" name="password" required>
										</div>
                    <div class="col-sm-6">
											<input type="password" class="form-control" placeholder="Confirm Password *" id="c_pass" name="cpassword" required>
										</div>

										<div class="col-md-12">
											<textarea name="address" cols="40" rows="10" class="form-control" placeholder="Address *" required></textarea>
										</div>
										<div class="col-md-12">
											<div class="text-center">
												<button class="btn style1">Submit Now</button>
										</div></div>
									</div>
					</form>
					</div>
					</div>
					</div></div>


</div>
   

   <?php $this->load->view("user/footer")?>

   <script>
      $("body").on('change','#c_pass', function(){ 
      var pass = $('#pass').val();
      var cpass = $('#c_pass').val();
      if(pass != cpass){
        alertify.set('notifier','position', 'top-center');   
        alertify.error('Inconsistent Passwords').delay(8).dismissOthers();
        $('#pass').val("");
        $('#c_pass').val("");            
      } else{
        alertify.set('notifier','position', 'top-center');   
        alertify.success('Password Confirmed').delay(8).dismissOthers();
      }        
      });
    </script> 