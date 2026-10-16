
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

</style>


<body id="page-top">

<!-- start parallax -->

<div id="parallax">


<section class="Myaccountsec">
  <div class="container">
    <div class="row">
      
     <?php $this->load->view("user/sidebar")?>  
    
        <div class="col-lg-9 col-md-8">
      <div id="General" class="tabcontent profile">
          <div class="Address">
            
            <form class="pass_form" method="post">
          
            <div class="pass_content">
              <div class="row">
                <div class="col-md-6">
				
				<label>Old Password</label>
                  <input type="password" class="pass_in" id="c_pass" placeholder="" required>
                </div>
                <div class="col-md-6">
				<label>New Password</label>
                  <input type="password" class="pass_in" name="new_pass"  placeholder="" required>
                </div>
               
                
               <div class="col-lg-12 col-md-12">
               <div class="text-center">
                  <button class="rsite-btntt" type="submit">Reset</button></div>
                    </div>
              </div>
            </div>
          </form>
          </div>
          
          
         
        </div>

        
      </div>
    </div>
  </div>
</section>

   <?php $this->load->view("user/footer")?>

   <script>
      $("body").on('change','#c_pass', function(){     
      var cpass = $('#c_pass').val();      
			$.ajax({
				url : "<?php echo base_url('register/Fetchpass');?>",
				method : "POST",
				data : {cpass : cpass},
				success :function(data){
     var data = JSON.parse(data); 
     if(data.msg==0){
      alertify.set('notifier','position', 'top-center');  
      alertify.error('Password not located').delay(2).dismissOthers();
					$('#c_pass').val("");							
				}
    }
			});
		});
	
    </script> 