<?php $this->load->view('admin/includes/header');?>

<style>
.dt-button span{
        padding: 8px;
    background-color: #9a281a;
    color: white;
    font-weight: 500;
    font-size: 14px;
}
.dt-button span:before{
   content:'Export to ';
}


table.dataTable td, table.dataTable th{
  /*white-space: nowrap;*/
}

.d-block {
    display: block !important;
}

.m-0 {
    margin: 0 !important;
}
.m-1 {
    margin: 5px !important;
}
.m-2 {
    margin: 10px !important;
}
.m-3 {
    margin: 15px !important;
}
.mt-1 {
    margin-top: 5px !important;
}
.mt-2 {
    margin-top: 10px !important;
}
.mt-3 {
    margin-top: 15px !important;
}

  
</style>

<!-- Left side column. contains the logo and sidebar -->
	<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    	<?php $this->load->view('admin/includes/sidebar');?>
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
        <?php
		  
			?>
          	<h1>Orders</h1>
			
          	<ol class="breadcrumb">
            	<li><a href="<?php echo base_url();?>admin/home"><i class="fa fa-dashboard"></i> Admin Home</a></li>
          	</ol>
        </section>

        <!-- Main content -->
       
        <section class="content">
        	<div class="row">
            				 
            	<div class="col-xs-12">  
                <?php if($this->session->flashdata('success')) {?>
				<div class="alert alert-success">
					<a href="#" class="close" data-dismiss="alert">&times;</a>
			     	<?php echo $this->session->flashdata('success');?>
				</div>
            	<?php }?>
                <?php if($this->session->flashdata('error')) {?>
				<div class="alert alert-error">
					<a href="#" class="close" data-dismiss="alert">&times;</a>
			     	<?php echo $this->session->flashdata('error');?>
				</div>
            	<?php }?>

                <?php
             $fromdate="";
             $todate="";
             $order ="";            

             if(!empty($_POST['fromdate']))
             {
              $fromdate = $_POST['fromdate'];
             }
             if(!empty($_POST['todate']))
             {
              $todate = $_POST['todate'];
             }
             if(!empty($_POST['order']))
             {
              $order=$_POST['order'];
             }

             
             ?>

             
					<div class="box">
                		<div class="box-body">

                        <form action="#" method="Post">
                                        <div class="row" style="display:flex;align-items:center;justify-content: center;">                                          
                                          
                                            <div class="col-col-md-4 col-lg-2">
                                                <div>
                                                    <label for="labelInput" class="form-label">From</label>
                                                    <input type="date" name="fromdate" value="<?php echo $fromdate; ?>" class="form-control">
                                                </div>
                                            </div>

                                            <div class="col-col-md-4 col-lg-2">
                                                <div>
                                                    <label for="labelInput" class="form-label">To</label>
                                                    <input type="date" name="todate"  value="<?php echo $todate; ?>"  class="form-control">
                                                </div>
                                            </div>

                                            <div class="col-col-md-4 col-lg-2">
                                                <div>
                                                    <label for="labelInput" class="form-label">Order Id</label>
                                                    <input type="text" name="order"  value="<?php echo $order;?>" class="form-control">
                                                </div>
                                            </div>


                                            <div class="row">
                                            <div class="col-col-md-4 col-lg-2">
                                            <div style="margin-top: 15%;">
                                             <label for="labelInput" class="form-label"></label>
                                             <button class="btn btn-success">Search</button>                                          

                                            </div>
											</div>
                                            </div>
											  
                                            <!--end col-->
                                            
                                        </div>
                                        <!--end row-->
										</form>
                        
                          <!--<a href="<?php echo base_url(); ?>admin/CompletedOrders/export_excel" style="background: maroon;color: white;padding: 10px;float: right;margin-bottom: 5em;">Download</a>-->
			
                          <div style="overflow-x:auto">

                  			<table id="datatable" class="table table-bordered table-striped delTable">
                    			<thead>
                                    <tr>
                                        <th class="no-sort">Sl no</th>
                                        
                                         <th>Order Id</th>
                                        <th>User</th>
                                        <th>Instruction</th>
                                        <th>TransID</th>
                                        <th>Items</th>
                                        <th>Total</th>
                                        <!--<th>Comp Details</th> 
                                        <th>Attachments</th>-->
                                        <th>Grand Total</th>
                                        <th>Payment Status</th>
                                        <th>Pickup</th>
                                        <th class="noExport">Actions</th>
										
                                        
                                    </tr>
                    			</thead>
                    			
                                <tbody>
                                    
                                    <?php $i=1;?>
                    				<?php 
									
									foreach($all_orders as $item=>$val):
									?>
                       				<tr id="<?php echo $val->payID;?>">
                          			<td><?php echo $i++; ?></td>
                          			
                                    <td>
                                    <?php echo $val->OrderID; ?><br>
                                    <?php if($val->payDate == "0000-00-00"){?>
                                    0000-00-00
                                    <?php } else {?>
                                    <?php echo date('d-m-Y',strtotime($val->payDate)) ?>
                                    <?php } ?>
                                    </td>

                                    <td><?php echo $val->payName; ?><br />
                                    <?php echo $val->payCountry; ?><br />
                                     <?php echo $val->payPhone; ?><br />
                                     <?php echo $val->payEmail; ?><br />

                                    <?php echo str_replace("\n","<br>",$val->payAddress); ?><br />

                                    </td>
                                       
                                   <td><?php echo $val->payInstruction; ?></td>
                                   <td><?php echo $val->payOrderID; ?></td>
                                    
                                    <td>
                                      <b><?php echo htmlspecialchars($val->payProduct); ?></b>
                                      <br><small class="text-muted">Total Qty: <?php echo (int)$val->payQuantity; ?></small>
                                    </td>
                                   
                                    <td>Total Amount: $<?php echo $val->payTotalbefore; ?> NZD<br />
                                    Shipping Amount: $<?php echo $val->payShipping; ?> NZD</td>
                                    
                                    <?php /*
                                    <td><?php if(!empty($val->Image)){?>Model : <?php echo $val->code;?>
                                    <img src="<?php echo base_url()?>uploads/Gift/<?php echo $val->Image;?>" style="width:50px;height:50px;"></br>
                                    Type : <?php echo $val->Mugtype;?></br>
                                    Size : <?php echo $val->Mugsize;?></br>
                                    Area : <?php echo $val->Photoarea;?></br>
                                    Color : <?php echo $val->Colors;?></br><?php } ?>
                                   </td>
                                     <td > <?php if(!empty($val->Image)){?><img src="<?php echo base_url()?>uploads/Gift/<?php echo $val->photo;?>"style="width:70px;height:70px;">&nbsp;&nbsp;<a download="<?php echo $val->photo;?>" href="<?php echo base_url()?>uploads/Gift/<?php echo $val->photo;?>"><i class="fa fa-download" aria-hidden="true"></i></a><br>
                                    Text : <?php echo $val->Mugtext;?><?php } ?></td>
                                    */ ?>

                                     <td><b>$<?php echo $val->payTotal; ?> NZD</b></td>
                                     
                                     <td>

                                    
                                      <?php if($val->payStatus==1 && $val->Codflag==0){?>
                                     
                                      <span class="btn btn-success"><i class="fa fa-check"></i> Paid</span>

                                      <?php  } else{ ?>

                                      <?php if($val->Codflag==0){?><a class="btn btn-warning" style="color:rgb(102, 102, 102);" href="<?php echo base_url(); ?>admin/CompletedOrders/ChangeStatus/3/<?php echo $val->payID;?>" class="edit" data-toggle="tooltip" data-placement="top" title="" data-original-title="Change Status" onclick="return confirm('Change Status To Paid?');"><i style="" class="fa fa-clock-o"></i>Pending</a> <?php } ?>
                                    
                                      <?php } ?>  


                                      <?php if($val->Codflag==1){?>
                                       
                                        <span class="btn btn-warning"><i class="fa fa-check"></i> COD</span>
                                       
                                       
                                    <?php } ?>

                                       </td>


                                       <?php /*
                                       <td>

                                        <?php
                                        if($val->orderLabelStatus!=0)
                                        {

                                        if($val->orderApiStatus==0)
                                        {
                                        ?>

                                        <a class="btn btn-warning" style="background:red;" href="<?php echo base_url(); ?>admin/CompletedOrders/initiatePickup/<?php echo $val->payID;?>"  data-toggle="tooltip" data-placement="top" title="" data-original-title="Request pickup from NZ Post?" onclick="return confirm('Request pickup from NZ Post?');"><i style="" class="fa fa-clock-o"></i>Pending</a>

                                        <?php
                                        }
                                        else if($val->orderApiStatus==1)
                                        {
                                        ?>

                                        <span class="btn btn-success"><i class="fa fa-check"></i> Requested</span>

                                        <?php
                                        }
                                        }
                                        else
                                        {
                                        echo "Label Not Generated!";
                                        }
                                        ?>

                                        <a class="btn btn-warning" style="background:red;" href="<?php echo base_url(); ?>admin/CompletedOrders/sendToEship/<?php echo $val->payID;?>"  data-toggle="tooltip" data-placement="top" title="" data-original-title="Send to eship?" onclick="return confirm('Send to eship?');"><i style="" class="fa fa-clock-o"></i>Eship</a>

                                       </td>

                                       */ ?>


                                        <td>

                                        <?php

                                        if($val->orderApiStatus==0)
                                        {
                                        ?>

                                         <a class="btn btn-warning" style="background:red;" href="<?php echo base_url(); ?>admin/CompletedOrders/sendToEship/<?php echo $val->payID;?>"  data-toggle="tooltip" data-placement="top" title="" data-original-title="Send to eship?" onclick="return confirm('Send to eship?');"><i style="" class="fa fa-clock-o"></i>Eship</a>

                                        <?php
                                        }
                                        else if($val->orderApiStatus==1)
                                        {
                                        ?>

                                        <span class="btn btn-success"><i class="fa fa-check"></i> Sent to eShip</span>

                                        <?php
                                        }
                                        ?>

                                       

                                       </td>


                                      

									                    

                                        <td>

                                        <?php 
                                        /*
                                        if($val->orderLabelStatus==0){?>

                                        <a class="btn btn-primary d-block mt-1" href="<?php echo base_url(); ?>admin/CompletedOrders/generateLabel/<?php echo $val->payID ?>" target="_blank"><i class="fa  fa-file-pdf-o"></i> Label</a>

                                        <?php } else if(!empty($val->consID)){ ?>

                                        <a class="btn btn-primary d-block mt-1" href="<?php echo base_url(); ?>admin/CompletedOrders/generateLabel/<?php echo $val->payID ?>" target="_blank"><i class="fa  fa-file-pdf-o"></i> Label</a>

                                        <?php } 
                                        */
                                        ?>

                                        <a class="btn btn-primary d-block mt-1" href="<?php echo base_url()?>admin/CompletedOrders/GenerateInvoice/<?php echo $val->payID?>" target="_blank"><i class="fa fa-file" aria-hidden="true"></i> Invoice</a>
                                            
                                        <a class="btn btn-primary d-block mt-1" href="<?php echo base_url()?>admin/CompletedOrders/ViewOrder/<?php echo $val->payID?>" target="_    blank"><i class="fa fa-eye" aria-hidden="true"></i> View Order</a>
                                            
                                        </td>

                      				</tr>
					  				<?php endforeach;?> 
                    			</tbody> 
                   				
                  			</table>

                            </div>

                
                		</div><!-- /.box-body -->
              		</div><!-- /.box -->
            	</div><!-- /.col -->
        	</div><!-- /.row -->
        </section><!-- /.content -->
   	</div><!-- /.content-wrapper -->
   <?php $this->load->view('admin/includes/footer');?>
   
   
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.3.1/js/dataTables.buttons.min.js"></script> 
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.3.1/js/buttons.html5.min.js"></script>
<script>
$('#DataTable').DataTable({
    scrollX: true,
    dom: 'Blfrtip',
    buttons: [
     { extend: 'excelHtml5', footer: true,
      filename: 'dwalker_orders.xlsx'},
     
    ]
} );

</script>
