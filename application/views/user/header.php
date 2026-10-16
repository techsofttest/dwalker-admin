<link rel="preload" href="<?php echo base_url(); ?>assets/images/logod.jpg">
<!-- Google tag (gtag.js) -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/AlertifyJS/1.13.1/css/alertify.min.css" />
<!-- Default theme for Alertify.js -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/AlertifyJS/1.13.1/css/themes/default.min.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/AlertifyJS/1.13.1/alertify.min.js"></script>
<script async src="https://www.googletagmanager.com/gtag/js?id=G-QFPXQTRRJ5"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-QFPXQTRRJ5');
</script>

 <div class="topBar"> 
 <div class="container">
        <div class="row">
 

        <div class="col-lg-2 col-md-2 col-sm-3 col-xs-6"> 
            <!-- start logo -->
          <div class=" logo " id="myheader-sticky"><a href="<?php echo  base_url()?>"><img src="<?php echo base_url(); ?>assets/images/logod.jpg"  /></a></div>
            <!-- end logo --> 
          </div>

           <div class="col-lg-3 col-md-2 col-sm-1 rtc"> </div>
        

           
          <div class="col-lg-4 col-md-4 col-sm-4 col-xs-5 "> 
           
           <form class="header-search-form" method="POST" action="<?php echo base_url(); ?>Search">
							<input type="text" placeholder="Search Product...." name="search">
							<button><i class="fa fa-search"></i></button>
						</form>
          
          </div>


          <style>

            .social-icons-header-lg a
            {
              font-size: 28px;
              margin: 10px 10px;
            }

            @media(max-width:525px)
            {
              .social-icons-header-lg a {
                  font-size: 20px;
                  margin: 5px 5px;
                  display: inline-block;
                  padding: 5px 10px;
              }


              .header-social-container-lg
              {
                display:none;
              }


            }

          </style>

          
          <div class="col-lg-3 col-md-12 col-sm-12 col-xs-12 epu header-social-container-lg"> 
           
          <div class="headrights head-icons social-icons-header-lg">

          <a style="color: blue;" href="https://www.facebook.com/people/D-Walker-Jewellery/61577297165217" target="_blank"><i class="fab fa-facebook" aria-hidden="true"></i></a>

          <a style="color: red;" href="https://www.instagram.com/dwalkerjewellery" target="_blank"><i class="fab fa-instagram" aria-hidden="true"></i></a>

          <a style="color: #008dbb;" href="https://www.linkedin.com/company/d-walker-jewellery" target="_blank"><i class="fab fa-linkedin" aria-hidden="true"></i></a>

          <a style="color: red;" href="https://in.pinterest.com/dwalkerjewellery" target="_blank"><i class="fab fa-pinterest" aria-hidden="true"></i></a>

          </div>

            
          </div>
         


          <?php /*
          <div class="col-lg-3 col-md-4 col-sm-5 col-xs-3 eru">

          <div class="up-item">
              <div class="shopping-card"> <i class="fa fa-shopping-bag"></i> <span><?php echo count($this->cart->contents());?></span> </div>
              <a href="<?php echo base_url(); ?>Cart/MyCart">Shopping Cart</a>  </div>
              <div class="Logobile-tt">
			    <a href="#" data-toggle="modal" data-target="#SigninModal"  class="as-btn"> <?php if(!$this->session->userdata('userid')){?><i class="fa fa-user" aria-hidden="true"></i>&nbsp;&nbsp;Login<?php } else{?><a href="<?php echo base_url()?>register/Profile" title="My Profile"><i class="fa fa-user" aria-hidden="true" style="padding: 3px;border-radius: 50%;border: solid 2px white;}"></i></a>&nbsp;&nbsp;<a href="<?php echo base_url()?>register/Logout"> Logout</a><?php } ?></a>
			  
			  
			      </div>
            </div> 
            */ ?>


            </div>
        </div>
      </div>
      <!-- end container --> 
      <!-- start navBar -->
      
      
          
          <!------------------start navbar--------------------------------------->

          <div id="mySidebar" class="sidebar">

              <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
                
          <ul class="sidemenu">



          <div class="row">
           
          <div class="col-lg-12">

          <div class="headrights head-icons social-icons-header-lg">

          <a style="color: blue;" href="https://www.facebook.com/people/D-Walker-Jewellery/61577297165217" target="_blank"><i class="fab fa-facebook" aria-hidden="true"></i></a>

          <a style="color: red;" href="https://www.instagram.com/dwalkerjewellery" target="_blank"><i class="fab fa-instagram" aria-hidden="true"></i></a>

          <a style="color: #008dbb;" href="https://www.linkedin.com/company/d-walker-jewellery" target="_blank"><i class="fab fa-linkedin" aria-hidden="true"></i></a>

          <a style="color: red;" href="https://in.pinterest.com/dwalkerjewellery" target="_blank"><i class="fab fa-pinterest" aria-hidden="true"></i></a>

          </div>

          </div>

          </div>
            
        
        
            <li><a href="<?php echo  base_url()?>">Home</a></li>
            <li><a href="<?php echo  base_url()?>About">About</a></li>
            <!--<li><a href="<?php echo base_url()?>Product">Jewellery</a></li>-->
             <?php foreach($categorys as $val){
				   ?>
                  
                <li><a href="<?php echo base_url()?>Product"><?php echo $val->cat_name; ?></a></li>
				 <?php
				   }?>
               
           
            <?php
           /*     foreach($categorys as $val){
				
					 ?>
            <li class="dropdown"> <a  href="javascript:void();" class="dropdown-toggle hvr-underline-from-center" data-toggle="dropdown"><?php echo $val->cat_name; ?><b class="caret"></b></a>
                      <ul  class="dropdown-menu">
                      <?php foreach($val->subcat as $vall){
					  ?>
                <li class="first dropdown"> <a  href="javascript:void();" class=" hvr-underline-from-center yysec" ><?php echo $vall->subcat_name; ?><b class="caret"></b> </a>
                         <?php
					  
					  } ?>
                          <ul  class="dropdown-menu mydropdown-menu">
                           <?php
					foreach($val->subcatsub as $valls){
						?>
                    <li class="first"><a href="<?php echo  base_url()?>Category/<?php echo $valls->SlugName; ?>"><?php echo $valls->subcatsub_name; ?></a></li>
                     <?php
						}
					?>
                  </ul>
                        </li>
                
                
                
                
                
              </ul>
                    </li>
                    
                    
                     <?php
				}*/
					
				?>
                <li><a href="<?php echo  base_url()?>UpcomingProducts">Upcoming Products</a></li>
                
                <li><a href="<?php echo  base_url()?>Contact">Contact Us</a></li>
                
                <li><a href="<?php echo  base_url()?>Track">Track</a></li>

                <li><a href="<?php echo  base_url()?>Cart/MyCart">Shopping Cart</a></li>

                
                  <?php if(!$this->session->userdata('userid')){?>

                  <li><a href="#" data-toggle="modal" data-target="#SigninModal"  class="as-btn">Login</a></li>
                    
                  <?php } 
                  
                  else{?>
                  
                  <li><a href="<?php echo base_url()?>register/Profile" title="My Profile">Profile</a></li>
                  
                  <li><a href="<?php echo base_url()?>register/Logout"> Logout</a></li>
                  
                  <?php } ?>
                

                </ul>
  
       

                 <!--<a href="#">Contact</a>-->
              </div>

        <div id="main" class="navbtn">
          <button class="openbtn" onclick="openNav()">&#9776;</button>
         <!-- <h2>Collapsed Sidebar</h2>
          <p>Content...</p>-->
        </div>
              
        <!-------------------end navbar-------------------------------------------------->
      
      
      
      
      
      <nav class="navbar" role="navigation" id="header-sticky">
        <div class="container">
          <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">

            <div class="sticky-logo" style="float:left;">
            <a href="<?php echo  base_url()?>"><img src="<?php echo base_url(); ?>assets/images/logod.jpg"  /></a>
            </div>        



            <div class="" style="float:right;">
              <ul id="menu" class="nav navbar-nav  main-menu">
                <li><a href="<?php echo  base_url()?>">Home</a></li>
                <li><a href="<?php echo  base_url()?>About">About Us</a></li>
               <?php foreach($categorys as $val){
				   ?>
                  
                <li><a href="<?php echo base_url()?>Product"><?php echo $val->cat_name; ?></a></li>
				 <?php
				   }?>
              
               <li><a href="<?php echo  base_url()?>UpcomingProducts">Upcoming Products</a></li>

                <li><a href="<?php echo  base_url()?>Contact">Contact Us</a></li>

                <li><a href="<?php echo  base_url()?>Track">Track</a></li>

              </ul>

             
              <div class="myicons">
              <?php 
              /*
               <ul >
                <li><a href="#"><i class="fa fa-facebook " aria-hidden="true"></i></a></li>
                <li><a href="#"><i class="fa fa-twitter " aria-hidden="true"></i></a></li>
                <li><a href="#"><i class="fa fa-instagram " aria-hidden="true"></i></a></li>
              </ul>
              */
              ?>
              
              </div>
              <div class="up-item">
              <div class="shopping-card"> <i class="fa fa-shopping-bag"></i> <span><?php echo count($this->cart->contents());?></span> </div>
              <a href="<?php echo base_url(); ?>Cart/MyCart">Shopping Cart</a> </div>
              <div class="Log-tt">
              <a href="#" data-toggle="modal" data-target="#SigninModal"  class="as-btn"> <?php if(!$this->session->userdata('userid')){?><i class="fa fa-user" aria-hidden="true"></i>&nbsp;&nbsp;Login<?php } else{?><a href="<?php echo base_url()?>register/Profile" title="My Profile"><i class="fa fa-user" aria-hidden="true" style="padding: 3px;border-radius: 50%;border: solid 2px white;}"></i></a>&nbsp;&nbsp;<a href="<?php echo base_url()?>register/Logout"> Logout</a><?php } ?></a>
			  			  </div>
            </div> </div>
          </div>
        </div>
      </nav>
      <!-- end navBar --> 
    </div>

     
<div class="modal fade singnup-modal" id="SigninModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
	<button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
      <div class="modelcontainer right-panel-active" id="container">
        <div class="form-container sign-up-container">
		<div class="formsec">
          <form  method ="post" action="<?php echo base_url()?>register/Login">
		  <h2>Sign in</h2>
            <span>Login and Buy Product</span>
            <input type="email" placeholder="Email" name="username"  required>
            <input type="password" placeholder="Password" name="password" required>
			
         
            <button class="as-btn" type="submit" name="Submit">Login</button>
			  <a href="#" data-toggle="modal" data-target="#forgotPassword" >Forgot your password?</a>
			<h6 style="margin-top:15px"><a href="<?php echo base_url()?>register">Register Now</a></h6>
          </form>
		  </div>
        </div>
       
     
      </div>
    </div>
  </div>
</div>

<div class="modal fade singnup-modal" id="forgotPassword" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
	<button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
      <div class="modelcontainer right-panel-active" id="container">
        <div class="form-container sign-up-container">
         <div class="formsec">
		 <form action="<?php echo base_url()?>forgot-password" method="post">
            <h2>Forgot Password</h2>         
		
            <input type="email" placeholder="Email Id" name="email_r" required/>
            <br>
            <button name="forgot_password" class="as-btn">Submit</button>
			
			<a href="#"></a>
			<h6><a href="<?php echo base_url()?>register">Register Now</a></h6>
          </form>
		  </div>
        </div>       
      </div>
    </div>
  </div>
</div>
  
  