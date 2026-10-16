<div class="col-lg-3 col-md-4">
      <div class="mainlinkall ">
      
        <div >
         <div class="proimageemp"> <img src="<?php echo base_url()?>assets/images/user.jpg">  </div>
    <p> <?php echo $this->session->userdata('Username') ?></p>
        </div>
       
          <ul class="tab">
            <li> <a class="tablinks active" onClick="location.href = '<?php echo base_url()?>register/profile'" ><i class="fa fa-cog"></i> Dashboard</a></li>
            
     
               <li> <a class="tablinks" onClick="javascript:void();'" ><i class="fa fa-file-text" aria-hidden="true"></i>Order </a>
			   
			   <ul class="sideray">
                <li> <a class="tablinks " onclick="location.href = '<?php echo base_url()?>register/Paidorders'"><i class="fa fa-eye" aria-hidden="true"></i> Paid orders</a></li>
                <li> <a class="tablinks " onclick="location.href = '<?php echo base_url()?>register/Cash_on_delivery'"><i class="fa fa-eye" aria-hidden="true"></i> Cash On Delivery</a></li>
              </ul>
			   </li>
            <li><a class="tablinks" onClick="location.href = '<?php echo base_url()?>register/Address'"><i class="fa fa-user" aria-hidden="true"></i>Address</a></li>
          
            <li> <a class="tablinks  " onClick="location.href = '<?php echo base_url()?>register/Changepassword'"><i class="fa fa-key" aria-hidden="true"></i> Change Password </a></li>
            <li> <a class="tablinks" onClick="location.href = '<?php echo base_url()?>register/Logout'"><i class="fa fa-file" aria-hidden="true"></i> Logout </a></li>
          </ul>
        </div>
          </div>