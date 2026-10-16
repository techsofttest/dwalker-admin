<?php $this->load->view('admin/includes/header');?>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
       <?php $this->load->view('admin/includes/sidebar');?>
      </aside>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          
         <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="overview-wrap">
                                    <h2 class="title-1">Dashboard</h2>
                                    <!--<button class="au-btn au-btn-icon au-btn--blue">
                                        <i class="zmdi zmdi-plus"></i>add item</button>-->
                                </div>
                            </div>
                        </div>
                        
                   <section class="content">

          <div class="col-lg-3 col-xs-6">
              <!-- small box -->
           <div class="small-box bg-yellow">
                <div class="inner">
                  <h3 style="color:rgba(0, 166, 39, 0)">0<?php //echo $max_order;?></h3>
                  <p>Change Password</p>
                </div>
                <div class="icon">
                 <!-- <i class="fa fa-shopping-cart"></i>-->
                  <a href="<?php echo base_url() ?>admin/change_password" style="color:rgba(0, 0, 0, 0.15)"><i class="fa fa-lock" style="padding-top:10px"></i></a>
                </div>
                <a href="<?php echo base_url() ?>admin/change_password" class="small-box-footer">
                  More info <i class="fa fa-arrow-circle-right"></i>
                </a>
              </div>
            </div>
         <!--<div class="col-lg-3 col-xs-6">
              <div class="small-box bg-yellow">
                <div class="inner">
                  <h3>62</h3>
                  <p>Free Users</p>
                </div>
                <div class="icon">
                  <a href="view_free_users.php" style="color:rgba(0, 0, 0, 0.15)"><i class="ion ion-person" style="padding-top:6px"></i></a>
                </div>
                <a href="view_free_users.php" class="small-box-footer">
                  More info <i class="fa fa-arrow-circle-right"></i>
                </a>
              </div>
            </div>
            <div class="col-lg-3 col-xs-6">
              <div class="small-box bg-yellow">
                <div class="inner">
                  <h3>4</h3>
                  <p>Paid Users</p>
                </div>
                <div class="icon">
                  <a href="view_paid_users.php" style="color:rgba(0, 0, 0, 0.15)"> <i class="ion ion-person" style="padding-top:6px"></i></a>
                </div>
                <a href="view_paid_users.php" class="small-box-footer">
                  More info <i class="fa fa-arrow-circle-right"></i>
                </a>
              </div>
            </div>
             <div class="col-lg-3 col-xs-6">
              <div class="small-box bg-yellow">
                <div class="inner">
                  <h3>3</h3>
                  <p>Payment Plans</p>
                </div>
                <div class="icon">
                  <a href="view_payment_plans.php" style="color:rgba(0, 0, 0, 0.15)"> <i class="fa fa-money" style="padding-top:6px"></i></a>
                </div>
                <a href="view_payment_plans.php" class="small-box-footer">
                  More info <i class="fa fa-arrow-circle-right"></i>
                </a>
              </div>
            </div>
-->
            
          
      

        </section>
                     
                        
                                            </div>
                </div>
         
        </section>

       
      </div><!--content-wrapper -->

      <?php $this->load->view('admin/includes/footer');?>
    
