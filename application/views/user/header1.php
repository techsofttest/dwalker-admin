
           <div class="col-lg-3 col-md-3 col-sm-1 wow fadeInDown"> </div>
        
          <div class="col-lg-4 col-md-4 col-sm-4 wow fadeInDown"> 
           
           <form class="header-search-form" method="POST" action="<?php echo base_url(); ?>Search/searchkeyword">
							<input type="text" placeholder="Search Product...." name="search">
							<button><i class="fa fa-search"></i></button>
						</form>
                        
                        
           
          
          </div>
          <div class="col-lg-3 col-md-3 col-sm-4 wow fadeInDown"> 
           
           <div class="headrights">
        <h2><i class="fa fa-phone" aria-hidden="true"></i> Call Us: <span>+111 54645456</span></h2>
         
           </div>
            
          </div>
        </div>
      </div>
      <!-- end container --> 
      <!-- start navBar -->
      
      
                  <!------------------start navbar--------------------------------------->
           <div id="mySidebar" class="sidebar">
                  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
                  <a href="<?php echo  base_url()?>Home">Home</a>
                  <a href="<?php echo  base_url()?>About">About Us</a>
                 <a href="<?php echo  base_url()?>Contact">Contact Us</a>
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
            <div class="" style="float:right;">
              <ul id="menu" class="nav navbar-nav wow fadeInRight main-menu">
                <li><a href="<?php echo  base_url()?>Home">Home</a></li>
                <li><a href="<?php echo  base_url()?>About">About Us</a></li>
                <?php
                 foreach($categorys as $val){
				// foreach($val->subcat as $vall){
				 //foreach($vall->subcatsub as $valls){
					 ?>
               
                <li><a href="javascript:void(0)"><?php echo $val->cat_name; ?></a>
                
                  <ul class="sub-menu">
                  <?php foreach($val->subcat as $vall){
					  ?>
					 
                    <li> <a><?php echo $vall->subcat_name; ?></a> 
                     <?php
					  
					  } ?>
                    <ul class="mydropdown">
                    <?php
					foreach($val->subcatsub as $valls){
						?>
                       
                 <li> <a href="<?php echo  base_url()?>Category/categoryprod/<?php echo $valls->subcatsub_id?>/<?php echo $valls->subcatsub_name; ?>"><?php echo $valls->subcatsub_name; ?></a> </li>
                  <?php
						}
					?>
                <!-- <li> <a href="category.html">Earrings</a> </li>
                  <li> <a href="category.html">Braceklets</a> </li>
                  <li> <a href="category.html">Necklaces</a> </li>-->
                </ul>
                </li>
                   <!--<li> <a href="category.html">All Collections</a> 
                    <ul class="mydropdown">
                  <li> <a href="category.html">Rings</a> </li>
                  <li> <a href="category.html">Earrings</a> </li>
                  <li> <a href="category.html">Braceklets</a> </li>
                  <li> <a href="category.html">Necklaces</a> </li>
                </ul></li>-->
                   <!-- <li> <a href="category.html">New Arrivals</a>
                    <ul class="mydropdown">
                  <li> <a href="category.html">Rings</a> </li>
                  <li> <a href="category.html">Earrings</a> </li>
                  <li> <a href="category.html">Braceklets</a> </li>
                  <li> <a href="category.html">Necklaces</a> </li>
                </ul> </li>-->
                   <!-- <li> <a href="category.html">Featured</a>
                    <ul class="mydropdown">
                  <li> <a href="category.html">Rings</a> </li>
                  <li> <a href="category.html">Earrings</a> </li>
                  <li> <a href="category.html">Braceklets</a> </li>
                  <li> <a href="category.html">Necklaces</a> </li>
                </ul> </li>-->
                   <!-- <li> <a href="category.html">Sale</a>
                    <ul class="mydropdown">
                  <li> <a href="category.html">Rings</a> </li>
                  <li> <a href="category.html">Earrings</a> </li>
                  <li> <a href="category.html">Braceklets</a> </li>
                  <li> <a href="category.html">Necklaces</a> </li>
                </ul> </li>-->
                  </ul>
                </li>
                 <?php
				}
					//  }
					 // }
				?>
              <!--  <li><a href="javascript:void(0)">Gifts</a>
                  <ul class="sub-menu">
                    <li> <a href="category.html">Shop Gifts</a> 
                    
                    <ul class="mydropdown">
                  <li> <a href="category.html">Rings</a> </li>
                  <li> <a href="category.html">Earrings</a> </li>
                  <li> <a href="category.html">Braceklets</a> </li>
                  <li> <a href="category.html">Necklaces</a> </li>
                </ul>
                </li>
                    <li> <a href="category.html">Shop By Occasion</a> 
                    <ul class="mydropdown">
                  <li> <a href="category.html">Rings</a> </li>
                  <li> <a href="category.html">Earrings</a> </li>
                  <li> <a href="category.html">Braceklets</a> </li>
                  <li> <a href="category.html">Necklaces</a> </li>
                </ul></li>
                    
                    
                    
                  </ul>
                </li>-->
             <!--   <li><a href="javascript:void(0)">Engagement</a>
                  <ul class="sub-menu">
                    <li> <a href="category.html">Engagement Rings</a> 
                    
                    <ul class="mydropdown">
                  <li> <a href="category.html">Wedding Ring </a> </li>
                  <li> <a href="category.html">Custom Design</a> </li>
                  <li> <a href="category.html">Colored Stone Rings</a> </li>
                 
                </ul>
                </li>
                    <li> <a href="category.html">Expert Advising</a> 
                    <ul class="mydropdown">
                  <li> <a href="category.html">Ring Sizing</a> </li>
                  <li> <a href="category.html">Expert Advise</a> </li>
                  <li> <a href="category.html">Interest Free</a> </li>
                 
                </ul></li>
                    
                    
                    
                  </ul>
                </li>-->
                <li><a href="<?php echo  base_url()?>Contact">Contact Us</a></li>
              </ul>
              <div class="myicons">
               <ul >
                <li><a href="#"><i class="fa fa-facebook " aria-hidden="true"></i></a></li>
                <li><a href="#"><i class="fa fa-twitter " aria-hidden="true"></i></a></li>
                <li><a href="#"><i class="fa fa-instagram " aria-hidden="true"></i></a></li>
              </ul>
              
              </div>
              
            </div> </div>
          </div>
        </div>
      </nav>
      <!-- end navBar --> 
    </div>