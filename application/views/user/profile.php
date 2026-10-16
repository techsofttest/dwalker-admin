
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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

<body id="page-top">
<!-- start parallax -->
<div id="parallax">
<?php $this->load->view("user/header")?>
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
.swal2-popup.swal2-toast {
        padding: 2em 1em 1em 1em !important;
        height:100px !important;

    }
body.swal2-toast-shown .swal2-container {
  width:max-content !important;
}

</style>


<body id="page-top">

<!-- start parallax -->

<div id="parallax">




   <section class="Myaccountsec">
  <div class="container">
    <div class="row">

  <?php $this->load->view("user/sidebar")?>

  <form method="post" action="<?php echo base_url()?>register/Update">
    
      <div class="col-lg-9 col-md-8">
        <div id="General" class="tabcontent profile">
          <div class="Address">
          <div class="col-lg-12">
          
          <div class="row">
          
           <div class="col-lg-12">
           <div class="Dasdd-board">
		   
		  	<h5>Hello <?php echo $this->session->userdata('Username')?></h5>
         <div class="ee">
           <div class="row">
           <div class="col-lg-12">          
          </div>
          <div class="col-lg-6 col-md-6 col-sm-6"><h3>Name</h3>
          <input type="text" placeholder="" name="name" value="<?php echo $user_data['FULLNAME']?>">         
          </div>
            <div class="col-lg-6 col-md-6 col-sm-6"><h3>Contact No</h3>
            <input  name="phone" type="text" value="<?php echo $user_data['MOBILE_NO']?>" placeholder=""></div>
            <div class="col-lg-6 col-md-6 col-sm-6"><h3>Email </h3>
           <input  type="email" name="email" placeholder="" value="<?php echo $user_data['EMAIL_ID']?>"></div>        
            <div class="col-lg-6 col-md-6 col-sm-6"><h3>Country</h3>
            <select name="country" required>        
            <option value="New Zealand" <?php if($user_data['COUNTRY']=="New Zealand"){ echo "selected";}?>>New Zealand</option>
            <option value="Australia" <?php if($user_data['COUNTRY']=="Australia"){ echo "selected";}?>>Australia</option>
            <option value="USA" <?php if($user_data['COUNTRY']=="USA"){ echo "selected";}?>>USA</option>
            <option value="Singapore" <?php if($user_data['COUNTRY']=="Singapore"){ echo "selected";}?>>Singapore</option>
            <option value="United Kingdom" <?php if($user_data['COUNTRY']=="United Kingdom"){ echo "selected";}?>>United Kingdom</option>
            <option value="Rest of the world" <?php if($user_data['COUNTRY']=="Rest of the world"){ echo "selected";}?>>Rest of the world</option>
            </select>
            </div>
   
            <div class="col-lg-12"><div style="text-align:center;margin:10px 0px;"><button type="submit" class=" rsite-btntt">Edit Profile</button></div></div>
           </div>
           </div>
           </div>
           </div>
          
          
          </div>
          </div>
          </div>
          
          
         
        </div>

        
      </div>
    </div>
  </div>
</section>

   <?php $this->load->view("user/footer")?>