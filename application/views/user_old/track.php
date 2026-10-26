<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8" content="" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
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



<style>

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



    .rowcenter
    {

      display: flex
;
    align-items: center;
    justify-content: center;
    }

</style>



<script>
document.documentElement.addEventListener('touchstart', function (event) {
            if (event.touches.length > 1) {
                event.preventDefault();
            }
        }, false);
</script>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery-1.11.3.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/wow.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/main.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/custom.js"></script>


</head>

<body id="page-top">
<!-- start parallax -->
<div id="parallax">
<?php $this->load->view('user/header'); ?>
  
   <section class="innerbanner">
       <img src="<?php echo base_url(); ?>assets/images/categorybanner.jpg" alt="" />
    </div>
    
  <section class="Contactse innerWrapDiv ">
  <div class="container ">
    <h2 class="head">Track Order</h2>
   <hr />
    <div class="row rowcenter">
    
    
    <div class="col-lg-8 text-center mx-auto">

    <div class="row">

    <form action="">


    <div class="row">
    <div class="col-lg-12" >
    <input class="form-control" name="trackid" type="text" placeholder="Enter Order Id" value="<?= $_GET['trackid'] ?? "" ?>" required>
      </div>
      </div>

    <div class="row text-center my-3" style="margin:5px 0px;">

    <button type="submit" class="btn btn-primary">Track</button>
   
    </div>
    
    </form>

    </div>


    <div class="row" style="margin:5px 0px;">




                            <?php
                            if(!empty($tracking['results']))
                            {
                            ?>
                            

                            <div class="mt-3 col-lg-12">

                            <h5 style="margin:5px 0px;"><b>Tracking Details</b></h5>

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
                          else{
                          ?>
                          <?php
                          }
                          ?>



    </div>








    
    </div>
    
      
      
    </div>
  </div>
</section>
 
<?php $this->load->view('user/footer'); ?>
  <!-- end footer --> 
</div>

<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.js"></script> 
<script src="<?php echo base_url(); ?>assets/js/owl.carousel.min.js"></script> 
<!--<script type="text/javascript" src="js/xsparallax.js"></script>--> 
<script src="<?php echo base_url(); ?>assets/js/jquery.slicknav.js"></script> 

<script src="<?php echo base_url(); ?>assets/js/jquery.zoom.min.js"></script> 


</body>
</html>
