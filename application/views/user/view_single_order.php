<?php $this->load->view('admin/includes/header');?>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
       <?php $this->load->view('admin/includes/sidebar');?>
      </aside>

      <style>

    .dcenter{
    display: flex;
    justify-content: center;
    align-items: center;
    }


    .pill
    {
    height: 100%;
    padding: 0px 5px;
    font-size: 13px;
    margin:0px 5px;
    }



  /* Tracking */

    .tracking-detail {
  padding: 3rem 0;
}
#tracking {
  margin-bottom: 1rem;
}
[class*="tracking-status-"] p {
  margin: 0;
  font-size: 1.1rem;
  color: #fff;
  text-transform: uppercase;
  text-align: center;
}
[class*="tracking-status-"] {
  padding: 1.6rem 0;
}
.tracking-list {
  border: 1px solid #e5e5e5;
}
.tracking-item {
  border-left: 4px solid #00ba0d;
  position: relative;
  padding: 2rem 1.5rem 0.5rem 2.5rem;
  font-size: 0.9rem;
  margin-left: 3rem;
  min-height: 5rem;
}
.tracking-item:last-child {
  padding-bottom: 4rem;
}
.tracking-item .tracking-date {
  margin-bottom: 0.5rem;
}
.tracking-item .tracking-date span {
  color: #888;
  font-size: 85%;
  padding-left: 0.4rem;
}
.tracking-item .tracking-content {
  padding: 0.5rem 0.8rem;
  background-color: #f4f4f4;
  border-radius: 0.5rem;
}
.tracking-item .tracking-content span {
  display: block;
  color: #767676;
  font-size: 13px;
}
.tracking-item .tracking-icon {
  position: absolute;
  left: -0.7rem;
  width: 1.1rem;
  height: 1.1rem;
  text-align: center;
  border-radius: 50%;
  font-size: 1.1rem;
  background-color: #fff;
  color: #fff;
}

.tracking-item-pending {
  border-left: 4px solid #d6d6d6;
  position: relative;
  padding: 2rem 1.5rem 0.5rem 2.5rem;
  font-size: 0.9rem;
  margin-left: 3rem;
  min-height: 5rem;
}
.tracking-item-pending:last-child {
  padding-bottom: 4rem;
}
.tracking-item-pending .tracking-date {
  margin-bottom: 0.5rem;
}
.tracking-item-pending .tracking-date span {
  color: #888;
  font-size: 85%;
  padding-left: 0.4rem;
}
.tracking-item-pending .tracking-content {
  padding: 0.5rem 0.8rem;
  background-color: #f4f4f4;
  border-radius: 0.5rem;
}
.tracking-item-pending .tracking-content span {
  display: block;
  color: #767676;
  font-size: 13px;
}
.tracking-item-pending .tracking-icon {
  line-height: 2.6rem;
  position: absolute;
  left: -0.7rem;
  width: 1.1rem;
  height: 1.1rem;
  text-align: center;
  border-radius: 50%;
  font-size: 1.1rem;
  color: #d6d6d6;
}
.tracking-item-pending .tracking-content {
  font-weight: 600;
  font-size: 17px;
}

.tracking-item .tracking-icon.status-current {
  width: 1.9rem;
  height: 1.9rem;
  left: -1.1rem;
}
.tracking-item .tracking-icon.status-intransit {
  color: #00ba0d;
  font-size: 0.6rem;
}
.tracking-item .tracking-icon.status-current {
  color: #00ba0d;
  font-size: 0.6rem;
}
@media (min-width: 992px) {
  .tracking-item {
    margin-left: 5rem;
  }
  .tracking-item .tracking-date {
    position: absolute;
    left: -10rem;
    width: 7.5rem;
    text-align: right;
  }
  .tracking-item .tracking-date span {
    display: block;
  }
  .tracking-item .tracking-content {
    padding: 0;
    background-color: transparent;
  }

  .tracking-item-pending {
    margin-left: 10rem;
  }
  .tracking-item-pending .tracking-date {
    position: absolute;
    left: -10rem;
    width: 7.5rem;
    text-align: right;
  }
  .tracking-item-pending .tracking-date span {
    display: block;
  }
  .tracking-item-pending .tracking-content {
    padding: 0;
    background-color: transparent;
  }
}

.tracking-item .tracking-content {
  font-weight: 600;
  font-size: 17px;
}

.blinker {
  border: 7px solid #e9f8ea;
  animation: blink 1s;
  animation-iteration-count: infinite;
}
@keyframes blink { 50% { border-color:#fff ; }  }

    /* Tracking End */



      </style>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1 style="display:inline-block">
           Order ID : <?= $order['OrderID'] ?>
          </h1>

          <?php if($order['Codflag'] == 0) { $pmode="COD"; } else { $pmode = "Online"; } ?>

          <span class="btn btn-warning pill"><?= $pmode ?></span>



          <ol class="breadcrumb">
            <li><a href="<?php echo base_url();?>admin/home"><i class="fa fa-dashboard"></i>Admin Home</a></li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">  
			<form name="add_menu" id="add_menu" method="POST" enctype="multipart/form-data" >
			<div class="box">
                <div class="box-body">
				<!-- Form Element sizes -->
				  <div class="box box-success">

					<div class="box-body">

          <div class="row">

            <div class="col-12 text-right">

            <a class="btn btn-warning" href="<?php echo base_url(); ?>admin/CompletedOrders/GenerateInvoice/<?php echo $order['payID'] ?>" target="_blank"><i class="fa  fa-file-pdf-o"></i> Invoice</a>

                
            <a class="btn btn-success" href="<?php echo base_url(); ?>admin/CompletedOrders/generateLabel/<?php echo $order['payID'] ?>" target="_blank"><i class="fa  fa-file-pdf-o"></i> Label</a>

            </div>

          </div>
						  
                          <div class="row ">
						        
                    
                          <div class="col-xs-8 col-sm-8 row-seperate" style="
    border-right: 3px solid;
">

                            <h4><b>Order Items</b></h4>

                            <div class="col-12 1dcenter">

                            <?php /*
                            <div class="col-lg-4">
                              
                              <style>
                                .img-prod
                                {
                                  height:130px;
                                }
                              </style>
                              <img class="img-prod" src="<?php echo base_url();?>uploads/Products/<?= $order['ProductdefaultImage']; ?>">
                            </div>
                            */ ?>

                            <?php foreach($order_products as $product) { ?>

                            <div class="row">

                            <div class="col-lg-4">

                            <h4><?= $product->payProduct ?></h4>
  
                            </div>


                            <div class="col-lg-4">

                            <p><?= $product->payPrice; ?> X <?= $product->payQuantity ?></b></p>
                            
                            </div>


                            </div>

                            <?php } ?>

                            </div>


                            <hr class="mt-4">



                            <?php if(!empty($order['giftmodel'])){ ?>

                            <h4><b>Complimentary Details</b></h4>

                            <div class="row dcenter">

                            <div class="col-lg-4">
                              <style>
                                .img-prod
                                {
                                  height:130px;
                                  width: 100%;
                                  object-fit: contain;
                                }
                              </style>
                              
                              <img class="img-prod" src="<?php echo base_url();?>uploads/Gift/<?= $order['Image']; ?>">
                            </div>

                            <div class="col-lg-4">

                            <h5><?= $order['code'] ?></h5>
                            
                            <?php if(!empty($order['Mugtype'])) { ?>
                              <h5>Mug Type : <?= $order['Mugtype'] ?></h5>
                            <?php } ?>

                            <?php if(!empty($order['Mugsize'])) { ?>
                              <h5>Mugsize : <?= $order['Mugsize'] ?></h5>
                            <?php } ?>

                            <?php if(!empty($order['Photoarea'])) { ?>
                              <h5>Photo Area : <?= $order['Photoarea'] ?></h5>
                            <?php } ?>

                            <?php if(!empty($order['Colors'])) { ?>
                              <h5>Color : <?= $order['Colors'] ?></h5>
                            <?php } ?>

                            <?php if(!empty($order['Mugtext'])) { ?>
                            <h5>Text : <?= $order['Mugtext'] ?></h5>
                            <?php } ?>

                            </div>


                            <div class="col-lg-4">
                            <h5>Attachment</h5>
                            <img class="img-prod" src="<?php echo base_url();?>uploads/Gift/<?= $order['photo']; ?>">
                            <a download="<?php echo $order['photo'];?>" href="<?php echo base_url()?>uploads/Gift/<?php echo $order['photo'];?>"><i class="fa fa-download" aria-hidden="true"></i> Download</a>

                            </div>

                            </div>

                            <?php } ?>



                            <hr class="mt-4">

                            <div class="row dcenter">
                            
                            <div class="col-lg-12">
                            <h4><b>Payment Details</b></h4>
                            </div>

                            <div class="col-lg-12">
                            <table class="table table-striped">

                            <tr>

                            <td align="left">Sub Total</td>

                            <td align="right"><?= $order['payTotalbefore'] ?></td>

                            </tr>


                            <tr>

                            <td align="left">Shipping</td>

                            <td align="right"><?= $order['payShipping'] ?></td>

                            </tr>


                            <tr>

                            <td align="left">Total</td>

                            <td align="right"><b><?= $order['payTotal'] ?></b></td>

                            </tr>



                            </table>
                            </div>

                            </div>






							           
							            </div>




                          <div class="col-xs-4 col-sm-4 row-seperate">

                          <div class="row">

                              

                              <div class="col-lg-12">

                              <h5><b>Deliver To</b></h5>

                              <p><?= $order['payName'] ?></p>

                              <p><?= $order['payAddress'] ?></p>

                              <p>Phone : <?= $order['payPhone'] ?></p>

                              <p>Email : <?= $order['payEmail'] ?></p>


                              <hr>

                              <?php if(!empty($order['payInstruction'])) { ?>
                              <h5><b>Instructions</b></h5>

                              <p><?= $order['payInstruction'] ?></p>

                              <?php } ?>
                              


                              </div>



                            <?php
                            if(!empty($tracking['results']))
                            {
                            ?>
                            
                           

                            <div class="col-lg-12">

                            <hr class="mt-4">  

                            <h5><b>Tracking Details</b></h5>

                            <p>Consignment ID : <b><?= $order['consID'] ?? "" ?></b></p>

                            <p>Tracking No : <b><?= $order['orderTrackingRef'] ?? "" ?></b></p>

                              <!-- Track -->

                <div id="tracking-pre"></div>

                <div id="tracking">
                <div class="tracking-list">

                        <?php foreach($tracking['results']['tracking_events'] as $track) { ?>
                        <div class="tracking-item">
                          <div class="tracking-icon status-intransit">
                            <svg class="svg-inline--fa fa-circle fa-w-16" aria-hidden="true" data-prefix="fas" data-icon="circle" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg="">
                              <path fill="currentColor" d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8z"></path>
                            </svg>
                          </div>
                          <div class="tracking-content"><?= $track['status_description'] ?><span><?= date('d M Y h:i a',strtotime($track['event_datetime'])) ?></span></div>
                        </div>
                        <?php } ?>


                </div>
                </div>

                          </div>

                          <?php
                          }
                          ?>
                          


                          </div>

                          
							           
							            </div>



                          </div>
                                               
                                     
                          
                   
                          				
					</div><!-- /.box-body -->
				  </div><!-- /.box -->			  

                </div><!-- /.box-body -->
                 
              </div><!-- /.box -->
			  </form>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
 <?php $this->load->view('admin/includes/footer');?>

