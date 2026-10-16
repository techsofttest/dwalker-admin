<section class="sidebar">
  <!-- sidebar menu: : style can be found in sidebar.less -->
  
  <ul class="sidebar-menu">
    
    
      <li class="treeview <?php if($this->uri->segment(2)=="Categories")  :echo 'active'; endif; ?>"> <a href="#"> <i class="fa fa-asterisk" aria-hidden="true"></i> <span>Manage Main Categories</span> </a>
      <ul class="treeview-menu">
        <li class="<?php if($this->uri->segment(3)=="Category"):echo 'active'; endif; ?>" > <a href="<?php echo base_url();?>admin/Categories/Category"> <i class="fa fa-plus-square"></i><span>Edit / view Main Categories</span></a> </li>
      <!-- <li class="<?php //if(($this->uri->segment(3)=="EditCategories") || ($this->uri->segment(3)=="")):echo 'active'; endif; ?>" > <a href="<?php //echo base_url();?>admin/Categories"> <i class="fa fa-plus-square"></i> <span>View Categories</span></a> </li>-->
      </ul>
    </li> 
 
 
    <!-- <li class="treeview <?php //if($this->uri->segment(2)=="Subcategories")  :echo 'active'; endif; ?>"> <a href="#"> <i class="fa fa-cart-arrow-down" aria-hidden="true"></i> <span>Manage Subcategories</span> </a>
      <ul class="treeview-menu">
        <li class="<?php //if($this->uri->segment(3)=="AddSubcategories"):echo 'active'; endif; ?>" > <a href="<?php //echo base_url();?>admin/Subcategories/AddSubcategories"> <i class="fa fa-plus-square"></i><span>Add Subcategories</span></a> </li>
        <li class="<?php //if(($this->uri->segment(3)=="EditSubcategories") || ($this->uri->segment(3)=="")):echo 'active'; endif; ?>" > <a href="<?php //echo base_url();?>admin/Subcategories"> <i class="fa fa-plus-square"></i> <span>View Subcategories</span></a> </li>
      </ul>
    </li> -->
   
   
   
     <li class="treeview <?php if($this->uri->segment(2)=="Product")  :echo 'active'; endif; ?>"> <a href="#"> <i class="fa fa-cart-arrow-down" aria-hidden="true"></i> <span>Manage  
Product</span> </a>
      <ul class="treeview-menu">
        <li class="<?php if($this->uri->segment(3)=="AddProduct"):echo 'active'; endif; ?>" > <a href="<?php echo base_url();?>admin/Product/AddProduct"> <i class="fa fa-plus-square"></i><span>Add Product</span></a> </li>
        <li class="<?php if(($this->uri->segment(3)=="EditProduct") || ($this->uri->segment(3)=="")):echo 'active'; endif; ?>" > <a href="<?php echo base_url();?>admin/Product"> <i class="fa fa-plus-square"></i> <span>View Product</span></a> </li>
      </ul>
    </li> 
    

    <li class="treeview <?php if($this->uri->segment(2)=="Gift") :echo 'active'; endif; ?>"> <a href="#"> <i class="fa fa-cart-arrow-down" aria-hidden="true"></i> <span>Manage Gift</span></a>
      <ul class="treeview-menu">
        <li class="<?php if($this->uri->segment(3)=="AddGift"):echo 'active'; endif; ?>" > <a href="<?php echo base_url();?>admin/Gift/AddGift"> <i class="fa fa-plus-square"></i><span>Add Gift</span></a> </li>
        <li class="<?php if(($this->uri->segment(3)=="EditGift") || ($this->uri->segment(3)=="")):echo 'active'; endif; ?>" > <a href="<?php echo base_url();?>admin/Gift"> <i class="fa fa-plus-square"></i> <span>View Gift</span></a> </li>
      </ul>
    </li>    

    <li class="treeview <?php if($this->uri->segment(2)=="Promocode"):echo 'active'; endif; ?>"> <a href="#"> <i class="fa fa-cart-arrow-down" aria-hidden="true"></i> <span>Manage Promocode</span> </a>
      <ul class="treeview-menu">
        <li class="<?php if($this->uri->segment(3)=="AddPromocode"):echo 'active'; endif; ?>" > <a href="<?php echo base_url();?>admin/Promocode/AddPromocode"> <i class="fa fa-plus-square"></i><span>Add Promocode</span></a> </li>
        <li class="<?php if(($this->uri->segment(3)=="EditPromocode") || ($this->uri->segment(3)=="")):echo 'active'; endif; ?>" > <a href="<?php echo base_url();?>admin/Promocode"> <i class="fa fa-plus-square"></i> <span>View Promocode</span></a> </li>
      </ul>
    </li>  
    <li class="treeview <?php if($this->uri->segment(2)=="CompletedOrders"):echo 'active'; endif; ?>">
    <a href="#">
      <i class="fa fa-credit-card" aria-hidden="true"></i>
      <span>Manage Orders</span>
    </a>
    <ul class="treeview-menu">
<li class="<?php if($this->uri->segment(2)=="CompletedOrders") { echo 'active'; } ?>" >
<a href="<?php echo base_url();?>admin/CompletedOrders">
<i class="fa fa-eye"></i> <span>Online Paid Orders</span></a>
  </li>

  <!--<li class="<?php if($this->uri->segment(2)=="CompletedOrders") { echo 'active'; } ?>" >
<a href="<?php echo base_url();?>admin/CompletedOrders/3">
<i class="fa fa-eye"></i> <span>COD Orders</span></a>
  </li>--> 

    </ul></li>

     <li class="treeview <?php if($this->uri->segment(2)=="Users") :echo 'active'; endif; ?>"> <a href="#"> <i class="fa fa-cart-arrow-down" aria-hidden="true"></i> <span>Manage Users</span></a>
      <ul class="treeview-menu">
        <li class="<?php if($this->uri->segment(3)=="Users"):echo 'active'; endif; ?>" > <a href="<?php echo base_url();?>admin/Users"> <i class="fa fa-plus-square"></i><span>List Users</span></a> </li>
      </ul>
    </li>    
    

    
    <li class="treeview <?php if(($this->uri->segment(2)=="Template") || ($this->uri->segment(2)=="Users"))  :echo 'active'; endif; ?>"> <a href="#"> <i class="fa fa-truck" aria-hidden="true"></i> <span>Manage  
    News Letters</span> </a>

      <ul class="treeview-menu">
      <li class="<?php if($this->uri->segment(3)=="AddTemplate"):echo 'active'; endif; ?>" > <a href="<?php echo base_url();?>admin/Template/AddTemplate"> <i class="fa fa-plus-square"></i><span>Add Template</span></a> </li>
        <li class="<?php if(($this->uri->segment(3)=="EditTemplate") || ($this->uri->segment(3)=="")):echo 'active'; endif; ?>" > <a href="<?php echo base_url();?>admin/Template"> <i class="fa fa-plus-square"></i> <span>View Templates</span></a> </li>
    <li class="<?php if(($this->uri->segment(3)=="Team") || ($this->uri->segment(3)=="")):echo 'active'; endif; ?>" > <a href="<?php echo base_url();?>admin/Template/Teams"> <i class="fa fa-plus-square"></i> <span>View Teams</span></a> </li> 
        <li class="<?php if($this->uri->segment(3)=="Users"):echo 'active'; endif; ?>" > <a href="<?php echo base_url();?>admin/Template/Users"> <i class="fa fa-plus-square"></i><span>Send Mail</span></a> </li>
      </ul>
    </li>   
    
    
     <li class="treeview <?php if($this->uri->segment(2)=="Shippingcost")  :echo 'active'; endif; ?>"> <a href="#"> <i class="fa fa-truck" aria-hidden="true"></i> <span>Manage  
       Shipping Cost</span> </a>
      <ul class="treeview-menu">
        <li class="<?php if($this->uri->segment(3)=="AddShippingcost"):echo 'active'; endif; ?>" > <a href="<?php echo base_url();?>admin/Shippingcost/AddShippingcost"> <i class="fa fa-plus-square"></i><span>Add Shipping Cost</span></a> </li>
        <li class="<?php if(($this->uri->segment(3)=="EditShippingcost") || ($this->uri->segment(3)=="")):echo 'active'; endif; ?>" > <a href="<?php echo base_url();?>admin/Shippingcost"> <i class="fa fa-plus-square"></i> <span>View Shipping Cost</span></a> </li>
      </ul>
    </li> 
    
    
      <li class="treeview <?php if($this->uri->segment(2)=="Testimonials")  :echo 'active'; endif; ?>"> <a href="#"> <i class="fa fa-truck" aria-hidden="true"></i> <span>Manage  
Testimonials</span> </a>
      <ul class="treeview-menu">
        <li class="<?php if($this->uri->segment(3)=="AddTestimonials"):echo 'active'; endif; ?>" > <a href="<?php echo base_url();?>admin/Testimonials/AddTestimonials"> <i class="fa fa-plus-square"></i><span>Add Testimonials</span></a> </li>
        <li class="<?php if(($this->uri->segment(3)=="EditTestimonials") || ($this->uri->segment(3)=="")):echo 'active'; endif; ?>" > <a href="<?php echo base_url();?>admin/Testimonials"> <i class="fa fa-plus-square"></i> <span>View Testimonials</span></a> </li>
      </ul>
    </li> 
    
    
    
    <li class="treeview <?php if($this->uri->segment(2)=="SignatureCollection") :echo 'active'; endif; ?>"> 
      <a href="#"> <i class="fa fa-diamond" aria-hidden="true"></i> <span>Manage Collection Sections</span> </a>
      <ul class="treeview-menu">
        <li class="<?php if($this->uri->segment(3)=="AddCollection"):echo 'active'; endif; ?>" > <a href="<?php echo base_url();?>admin/SignatureCollection/AddCollection"> <i class="fa fa-plus-square"></i><span>Add New Section</span></a> </li>
        <li class="<?php if(($this->uri->segment(3)=="" || $this->uri->segment(3)=="index")):echo 'active'; endif; ?>" > <a href="<?php echo base_url();?>admin/SignatureCollection"> <i class="fa fa-eye"></i> <span>All Collection Sections</span></a> </li>
      </ul>
    </li>

    <li class="treeview <?php if($this->uri->segment(2)=="Banners") :echo 'active'; endif; ?>"> <a href="#"> <i class="fa fa-picture-o" aria-hidden="true"></i> <span>Manage Hero Banners</span> </a>
      <ul class="treeview-menu">
        <li class="<?php if($this->uri->segment(3)=="AddBanner"):echo 'active'; endif; ?>" > <a href="<?php echo base_url();?>admin/Banners/AddBanner"> <i class="fa fa-plus-square"></i><span>Add Banner Slide</span></a> </li>
        <li class="<?php if(($this->uri->segment(3)=="EditBanner") || ($this->uri->segment(3)=="")):echo 'active'; endif; ?>" > <a href="<?php echo base_url();?>admin/Banners"> <i class="fa fa-eye"></i> <span>View Banners</span></a> </li>
      </ul>
    </li>

    <li class="treeview <?php if($this->uri->segment(2)=="CMS")  :echo 'active'; endif; ?>"> <a href="#"> <i class="fa fa-file-code-o" aria-hidden="true"></i> <span>Manage CMS Pages</span> </a>
      <ul class="treeview-menu">
        <li class="<?php if(($this->uri->segment(3)=="ViewCMS") || ($this->uri->segment(3)=="EditCMS")):echo 'active'; endif; ?>" > <a href="<?php echo base_url();?>admin/CMS/ViewCMS"> <i class="fa fa-plus-square"></i> <span>Edit/View Pages</span></a> </li>
      </ul>
    </li>
    
 

 
  
   
   
    
    
     <li class="treeview <?php if($this->uri->segment(2)=="Seo")  :echo 'active'; endif; ?>"> <a href="#"> <i class="fa fa-file-text" aria-hidden="true"></i> <span>Manage Seo Page</span> </a>
      <ul class="treeview-menu">
        <li class="<?php if(($this->uri->segment(3)=="EditSeo") || ($this->uri->segment(3)=="")):echo 'active'; endif; ?>" > <a href="<?php echo base_url();?>admin/Seo"> <i class="fa fa-plus-square"></i> <span>View Seo Page</span></a> </li>
      </ul>
    </li>
    
    
     
     
    
 
   
    <li class="treeview <?php if($this->uri->segment(2)=="change_password" ):echo 'active'; endif; ?>"> <a href="#"> <i class="fa fa-cog"></i> <span>Settings</span> </a>
      <ul class="treeview-menu">
        <li class="<?php if($this->uri->segment(2)=="change_password"):echo 'active'; endif; ?>" > <a href="<?php echo base_url();?>admin/change_password"> <i class="fa fa-lock"></i> <span>Change Password</span></a> </li>
        <li> <a href="<?php echo base_url();?>admin/login/logout"> <i class="fa fa-sign-out"></i> <span>Logout</span></a> </li>
      </ul>
    </li>
  </ul>
</section>
<!-- /.sidebar -->