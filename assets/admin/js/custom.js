$(function () {
     setTimeout(function(){
     if($("#project_hidden").val()=="1"){         
         $("#datatable_filter label").hide(); $("#datatable_length").append("<br>"+$("#sort").html());
     }
},100);		
	$(".fancybox-media").fancybox();
	$(".contactcomment").fancybox();
	$('#date').datetimepicker({
		format: 'dd-mm-yyyy hh:ii:ss',
		autoclose: true,
        todayBtn: true,
        pickerPosition: "bottom-left"
	});

     $(".formValidation").validationEngine({
          onkeyup: true,
          maxErrorsPerField: 1,
          promptPosition : "topRight:-85"
        });

    $("#add_banner").validationEngine();   
    $("#add_tesimonial").validationEngine();
	$("#add_page").validationEngine();
	$("#edit_page").validationEngine();
	$("#add_download").validationEngine();
	$("#add_news_events").validationEngine();
	$("#add_career").validationEngine();
	$("#add_service").validationEngine();
	$("#add_certification").validationEngine();
	$("#add_project").validationEngine();
	$("#add_award").validationEngine();
	$(".formValidation").validationEngine();
	$("#add_faq").validationEngine();
	$("#add_project_plan").validationEngine();
	$(".validation").validationEngine();
	$('.btn-bulk-delete').attr( 'title','delete')// change attribute for bulk delete button
	
});	

$.fn.dataTable.pipeline = function ( opts ) {
    // Configuration options
    var conf = $.extend( {
        pages: 5,     // number of pages to cache
        url: '',      // script url
        data: null,   // function or object with parameters to send to the server
                      // matching how `ajax.data` works in DataTables
        method: 'GET' // Ajax HTTP method
    }, opts );
 
    // Private variables for storing the cache
    var cacheLower = -1;
    var cacheUpper = null;
    var cacheLastRequest = null;
    var cacheLastJson = null;
 
    return function ( request, drawCallback, settings ) {
        var ajax          = false;
        var requestStart  = request.start;
        var drawStart     = request.start;
        var requestLength = request.length;
        var requestEnd    = requestStart + requestLength;
         
        if ( settings.clearCache ) {
            // API requested that the cache be cleared
            ajax = true;
            settings.clearCache = false;
        }
        else if ( cacheLower < 0 || requestStart < cacheLower || requestEnd > cacheUpper ) {
            // outside cached data - need to make a request
            ajax = true;
        }
        else if ( JSON.stringify( request.order )   !== JSON.stringify( cacheLastRequest.order ) ||
                  JSON.stringify( request.columns ) !== JSON.stringify( cacheLastRequest.columns ) ||
                  JSON.stringify( request.search )  !== JSON.stringify( cacheLastRequest.search )
        ) {
            // properties changed (ordering, columns, searching)
            ajax = true;
        }
         
        // Store the request for checking next time around
        cacheLastRequest = $.extend( true, {}, request );
 
        if ( ajax ) {
            // Need data from the server
            if ( requestStart < cacheLower ) {
                requestStart = requestStart - (requestLength*(conf.pages-1));
 
                if ( requestStart < 0 ) {
                    requestStart = 0;
                }
            }
             
            cacheLower = requestStart;
            cacheUpper = requestStart + (requestLength * conf.pages);
 
            request.start = requestStart;
            request.length = requestLength*conf.pages;
 
            // Provide the same `data` options as DataTables.
            if ( $.isFunction ( conf.data ) ) {
                // As a function it is executed with the data object as an arg
                // for manipulation. If an object is returned, it is used as the
                // data object to submit
                var d = conf.data( request );
                if ( d ) {
                    $.extend( request, d );
                }
            }
            else if ( $.isPlainObject( conf.data ) ) {
                // As an object, the data given extends the default
                $.extend( request, conf.data );
            }
 
            settings.jqXHR = $.ajax( {
                "type":     conf.method,
                "url":      conf.url,
                "data":     request,
                "dataType": "json",
                "cache":    false,
                "success":  function ( json ) {
                    cacheLastJson = $.extend(true, {}, json);
 
                    if ( cacheLower != drawStart ) {
                        json.data.splice( 0, drawStart-cacheLower );
                    }
                    json.data.splice( requestLength, json.data.length );
                     
                    drawCallback( json );
                }
            } );
        }
        else {
            json = $.extend( true, {}, cacheLastJson );
            json.draw = request.draw; // Update the echo for each response
            json.data.splice( 0, requestStart-cacheLower );
            json.data.splice( requestLength, json.data.length );
 
            drawCallback(json);
        }
    }
};
 
// Register an API method that will empty the pipelined data, forcing an Ajax
// fetch on the next draw (i.e. `table.clearPipeline().draw()`)
$.fn.dataTable.Api.register( 'clearPipeline()', function () {
    return this.iterator( 'table', function ( settings ) {
        settings.clearCache = true;
    } );
} );
 

////////////////////////////////////
$(function () {
	
	if ($('#datatable').length && !$('#datatable').hasClass('reorderTable')) {
		var table = $('#datatable').DataTable({
	   'aoColumnDefs': [{
			'bSortable': false,		
			'aTargets': [-1,0] /* 1st one, start by the right */
		}],
		'dom': "<'row'<'col-sm-4'l> <'col-sm-8'p>>" + 'Bfrtip',
		buttons: [
		   
			
			{
			extend:'excel',
			exportOptions: {
				columns: 'thead th:not(.noExport)'
				
			 }
		
			},       
		],  
		
		"aoColumnDefs" : [ {
		"bSortable" : false,
		"aTargets" : ["no-sort"]
	} ]
		});
		$('#datatable thead tr th:first-child').removeClass('sorting_asc');
	}
    
    $("#add_banner").validationEngine();   
    
		
});	


$(document).ready(function()
{

 	tinymce.init({
		selector: "textarea.tinymce",
		theme: "textareas",
		plugins: [
			"advlist autolink lists link image charmap print preview hr anchor pagebreak jbimages",
			"searchreplace wordcount visualblocks visualchars code fullscreen",
			"insertdatetime media nonbreaking save table contextmenu directionality",
			"emoticons template paste textcolor colorpicker textpattern  responsivefilemanager imagetools"
		],
		external_filemanager_path:base_url+"assets/admin/js/tinymce/filemanager/",
	   filemanager_title:"Browse files" ,
	   external_plugins: { "filemanager" : base_url+"assets/admin/js/tinymce/filemanager/plugin.min.js"},
	   relative_urls: true,
	   document_base_url: base_url,
     valid_children : "+a[figure|div|h1|h2|h3|h4|h5|h6|p|#text]",
     valid_elements : '*[*]',
	   convert_urls: false,


	   
		toolbar1: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link  jbimages",
		toolbar2: "print preview media | forecolor backcolor emoticons  |  code",
		image_advtab: true,
	
		file_browser_callback: myFileBrowser,
		file_browser_callback_types: 'image'
	
	   
	  
	
	});
	
	function myFileBrowser (field_name, url, type, win) {
	
		var w = window,
		d = document,
		e = d.documentElement,
		g = d.getElementsByTagName('body')[0],
		x = w.innerWidth || e.clientWidth || g.clientWidth,
		y = w.innerHeight|| e.clientHeight|| g.clientHeight;
		
	
		var cmsURL = base_url+'assets/admin/js/tinymce/filemanager/dialog.php?field_id='+field_name;
	
	
		$.fancybox.open({
			padding : 0,
			minHeight   : 500,
            fitToView   : false,
            autoSize    : true,
			href:cmsURL,
			type: 'iframe'
		});
	
		return false;
	}
	
	
    //tinymce.init({selector:'textarea'});
/*
	$(document).delegate('table.delTable td a.delete', 'click', function() {
       
		var id = $(this).parent().parent().attr('id');
		
		
		var parent = $(this).parent().parent();
		var href = $(this).attr('href');	
		alertify.confirm("Do you want to delete this record?", function (e) {
		if (e) {
			var data = 'id=' + id ;		
	
			$.ajax(
			{
				   type: "POST",
				   url: href,                
				   data: data,
				   cache: false,					
				   success: function()
				   {
						parent.fadeOut('slow', function() {$("#"+id).remove();});
						alertify.success("Record has been successfully removed.");
						setTimeout(function(){
							window.location.reload(1);
						}, 3000);
				   }
			 });
			} else {
	
			}
		});
		return false;   	
	});
    */
	$(document).delegate('.btn-bulk-delete', 'click', function() {
        var ids 	= [];
        var i 	 	= 0;
        var link 	= $(this).data('link');	

		var tb 		= $(this).attr('title');
		var sel 	= false;	
		var ch 		= $('#'+tb).find('tbody input[type=checkbox]');			  
		
        $('input:checkbox.chk').each(function () {
             selected = (this.checked ? $(this).val() : false);			 
             if(selected != false){
                 ids[i] = selected;
                 i++;
             }
        });				
       var selected_ids = ids.join(); 
  
	   if(selected_ids=='')
	   {
		 alertify.error("Please select atleast one record");
		
		 return false;
		
	   }	   
	   
       if(selected_ids.trim()!=''){
           
            alertify.confirm( "Are you sure you want to delete this record(s)?", function (e) {
            if (e) {				
				ch.each(function(){
					var $this = $(this);
					if($this.is(':checked')) {
						sel = true;	//set to true if there is/are selected row
						$this.parents('tr').fadeOut(function(){
							$this.remove(); //remove row when animation is finished
						});
					}
				});

                $.ajax({
                    type: "POST",

                     data: {
                    'ids' : selected_ids,
                       },
                    url: link,                
                    success: function(data){
                      console.log(data);
                    }
                });    

               alertify.success("Record(s) is successfully deleted.");
               setTimeout(function(){
                   window.location.reload(1);
                }, 3000);
               return true;
            } else {           
            }
            });
         return false; 
       }

		
	});
	
	$('table.delTable tr.odd').css('background',' #f9f9f9');

	
	
    
});		
	
// multiple delete
$('.btn-bulk-delete').click(function(){ 
        var ids 	= [];
        var i 	 	= 0;
        var link 	= $(this).data('link');	

		var tb 		= $(this).attr('title');
		var sel 	= false;	
		var ch 		= $('#'+tb).find('tbody input[type=checkbox]');
        
        if($('.alertify-log').length > 0){
          $('.alertify-log').css('display', 'none');
        }
		
        $('input:checkbox.chk').each(function () {
             selected = (this.checked ? $(this).val() : false);			 
             if(selected != false){
                 ids[i] = selected;
                 i++;
             }
        });				
       var selected_ids = ids.join(); 
  
	   if(selected_ids=='')
	   {
		 alertify.error("Please select atleast one record");	  
		 return false;   
	   }	   
	   
       if(selected_ids.trim()!=''){
           
            alertify.confirm( "Are you sure you want to delete this record(s)?", function (e) {
            if (e) {				
				ch.each(function(){
					var $this = $(this);
					if($this.is(':checked')) {
						sel = true;	//set to true if there is/are selected row
						$this.parents('tr').fadeOut(function(){
							$this.remove(); //remove row when animation is finished
						});
					}
				});

                $.ajax({
                    type: "POST",

                     data: {
                    'ids' : selected_ids,
                       },
                    url: link,                
                    success: function(data){
                      console.log(data);
                    }
                });    

               alertify.success("Record(s) is successfully deleted.");
               setTimeout(function(){
                   window.location.reload(1);
                }, 3000);
               return true;
            } else {           
            }
            });
         return false; 
       }
});

//fancybox popup for showing the image gallery

// end

// delete single record
// Delete record on button click
$(".single_record_delete").click(function(){ 
	 
    var id = $(this).attr('data-attr');	
    var href = $(this).attr('href');
	if ($("#alert-notification").val()) {
		var notification="<span id='alertify-close'>x</span>"+$("#alert-notification").val();
	}else{
		var notification="<span id='alertify-close'>x</span>Are you sure you want to delete this record?";
		//var notification="Are you sure you want to delete this record?";
	}
	
    alertify.confirm( notification, function (e) {
        if (e) {            
            $.ajax({
                type: "POST",
                
                 data: {
                'id' : id,
                   },
                url: href,                
                success: function(data){
                 console.log(data);
                }
            });    
           $('table#datatable tr#'+id+'').remove();
		   alertify.set('notifier','position', 'top-left');
		   
		   alertify.set({ delay: 2000 });
           alertify.success("Record is successfully deleted.");
		      if ($("#setting").val()==1) {
				
				 $("#settings_"+id).remove();
				 $("#project-plan_"+id).remove();
				 $("#location_advantage_"+id).remove();
				 
				
			  }else{
						setTimeout(function(){
					//	window.location.reload(1);
					 }, 3000);
			
			  }
			
        } else {           
        }
        });
     return false;        
});

$("body").on('click','#alertify-close',function(){
	
	$("#alertify-cancel").click();
	
});
// bulk select fields
$("body").on('click','#bulk_select',function(){
	if($(this).is(':checked')) {
		$("input[type='checkbox']").prop('checked', true);
	}
	else{
		$("input[type='checkbox']").prop('checked', false);
	}
});



    // home banner buton link show or hide
    $('#checkbox_hide_area').each(function(){
        
        var target =  $(this).data('target');
        if($(this).is(":checked")) {
          $(target).show();
        }else{
           $(target).hide();  
        }
    });
     $('#checkbox_hide_area').change(function() {
       
        var target =  $(this).data('target');
        if($(this).is(":checked")) {
          $(this).attr('value',1);  
          $(target).show();
        }else{
            $(this).attr('value',0);  
            $(target).hide();  
        }
            
    });
    
	// show contact list description in pop up
    $("body").on("click","#contact-comment",function(e){
	   var data=$(this).attr('data-value');
	   $("#comment-content").empty();
	   $("#comment-content").append(data);
	});
    
	//add more function
	

$(function () {

	$('.remove-status-image').on('click', function(e){
		e.preventDefault();
		var notification="<span id='alertify-close'>x</span>Are you sure you want to delete this image?";
		var href = $(this).data('href');
		var it = $(this);
		if(it.closest('form').find('.remove-status-image').length>1){
			alertify.confirm( notification, function (ee) {
		        if (ee) {      
		            $.ajax({
		                type: "POST",
		                url: href,                
		                success: function(data){
		                }
		            });    
		        	it.parent().remove();
				   alertify.set('notifier','position', 'top-left');		   
				   alertify.set({ delay: 2000 });
		           alertify.success("Image is successfully deleted.");	
		        } 
	        });
		}else{
		   alertify.set('notifier','position', 'top-left');		   
		   alertify.set({ delay: 2000 });
           alertify.error("Atleast one item required.");	
		}
	});

	$('.add-more-status').on('click',function(){
		
		var content = '<div class="status_image remove-div">'+
                          '<a class="remove-status-button badge"  title="Remove this row" >X</a>'+
                          '<input type="file" name="status_image[]"  class="validate[optional, custom[validateMIME[image/jpeg|image/png|image/gif|image/jpg|image/jpg]],custom[validateSIZE[716800]]] dynamic">'+
                          '<p class="help-block text-red">*File size must be less than 700kb. Upload jpg, .jpeg, .png, .gif files</p>'+
        				'</div>';
		$(this).closest('form').find('.status_image').last().after(content);
	});

	$('.add-more-pic').on('click',function(){
		
		var content = '<div class="Add_pictures_container remove-div">'+  
		                	'<a type="button" class="remove-status-button badge" id="remove" title="Remove this row" >X</a>'+
		                  	'<input type="file" name="Add_pictures[]" class="validate[optional, custom[validateMIME[image/jpeg|image/png|image/gif|image/jpg|image/jpg]],custom[validateSIZE[716800]]] dynamic">'+
		                      '<p class="help-block text-red">*File size must be less than 700kb. Upload jpg, .jpeg, .png, .gif files</p>'+
		              '</div>';
		$(this).closest('form').find('.Add_pictures_container').last().after(content);
	});

	$('.add-more-plan').on('click',function(){
		
		var content = '<div class="add_more_plan_container remove-div">'+
		                    '<div class="col-xs-12 col-sm-7 row-seperate">'+
		                    '<a class="remove-status-button badge"  title="Remove this row" >X</a>'+
		                              '<input type="file" data-org-name="Add_plan" name="Add_plan[]"  class="validate[optional, custom[validateMIME[image/jpeg|image/png|image/gif|image/jpg|image/jpg]],custom[validateSIZE[716800]]] dynamic">'+
		                    '<p class="help-block text-red">*File size must be less than 700kb.Upload jpg, .jpeg, .png, .gif files</p></div>'+

		                  '<div class="col-xs-12 col-sm-7 row-seperate">'+
		                   '<label>BHK <span class="required">*</span></label>'+
		                    '<input class="form-control validate[required]" name="bhk[]" id="bhk" type="text" placeholder="BHK" value="">'+ 
		                  '</div>'+

		                  '<div class="col-xs-12 col-sm-7 row-seperate">'+
		                   '<label>SqFt <span class="required">*</span></label>'+
		                    '<input class="form-control validate[required]" name="sqft[]" id="sqft" type="text" placeholder="Square Feet" value="">'+ 
		                  '</div>'+
		              '</div>';
		$(this).closest('form').find('.add_more_plan_container').last().after(content);
	});



	$('body').on('click', '.remove-status-button' ,function(e){
		e.preventDefault();
		$(this).closest('.remove-div').remove();
	});

	 $('.add-more').click(function(){ 
		
		
		var target = $(this).data('target');
		var data = $('<div>').append($(target+':last').clone()).html()
		$(target+':last').after(data);
		
        $(target).find('.removebutton').removeClass('hide');
		var total =$(target).parent().find(".total").val();
		total++;
		$(target).parent().find(".total").val(total);
		$("#decrimnt").val(total);
		
			$(target+':last').find('.dynamic').each(function(){
				var org_name = $(this).attr('data-org-name');
				
				var new_name = org_name+"_"+total;
				
				$(this).attr('name',new_name);
				
                
		    });
            
            $(target+':first').find('.removebutton').addClass('hide');
    });
	 
	 
}); 
 $(document).on('click', 'button.removebutton', function () {
	   //current_total = parseInt($(this).parent().parent().find(".total").val());
	   //current_total -= 1;
	   //$(this).parent().parent().find('.total').val(current_total);
	  
        if($('.alertify-log').length > 0){
          $('.alertify-log').css('display', 'none');
        }
	   //if (current_total>0) {
		 $(this).parent('div').remove();
	   //}else{
		//$(this).parent().parent().find('.total').val(1);
		//alertify.error("One Field Is Required");
	  // }
      
       return false;
   });
 
  $("#order").keypress(function (e) {
        
		if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
		   $("#errmsg").html("<font color='red'>Digits Only</font>").show().fadeOut("slow");
			   return false;
	   }
	   
	  
   });
  
  // check order for banner
$( "#order" ).keyup(function() {
		var order=$("#order").val();
		var controller=$("#controller").val();
	    $.ajax({
				type: "POST",
				url: base_url+"admin/"+controller+"/check_order",
				data: {order:order},
				success: function(data){
					if (data==1) {
						 $("#errmsg").html("<font color='red'>This order is already used</font>").show();
						 $("#view-order").show();
						 $("#order").val('');
						
					}else{
						$("#errmsg").hide();
						
					}
					
					}
				});
    });
	
	  $("#view-order").click(function(){
		 var order= $("#current_order").val();
		     $("#order").val(order);  
		     $("#errmsg").hide();
		});
	// time out for succces msg
 $(document).ready(function(){
      setTimeout(function() {
         $('.alert-success').fadeOut();
      }, 5000);
	  
	   
  });
 
  // password updation

        $("#passsubmit").click(function(){
			if(!$("#form-password").validationEngine('validate')){
            return false;
            }else{
				var newpass = $("#password-value").val();
				var checkVal = $("#password-check").val();
				
				    if ($("#result").text()=="Good" || $("#result").text()=="Strong" ) {
                       
								$.ajax({
									type: "POST",
									url: base_url+"admin/change_password/update_password",
									data: {newpass:newpass},
									success: function(){
										 alertify.success("Password Updated Successfully.");
										 $('span#result').text('');
										 $('#form-password')[0].reset();
										}
									});
						  }else{
							alertify.error("Please Enter Good Password");
						  }
					  
			}
         });
		
// multiple delete
$(".change_status").click(function(){
	 
    var status 	= $(this).attr('data-attr');
	var id 	= $(this).attr('data-id');
	
    var href = $(this).attr('href');	
	var notification="<span id='alertify-close'>x</span>Are you sure you want to change the status?";
		
	
    alertify.confirm( notification, function (e) {
        if (e) {            
            $.ajax({
                type: "POST",
                
                 data: {
                'id' : id,
				'status' : status,
                   },
                url: href,                
                success: function(data){
                 console.log(data);
                }
            });    
        
		   alertify.set('notifier','position', 'top-left');		   
		   alertify.set({ delay: 2000 });
           alertify.success("Status is successfully updated.");
		
		   setTimeout(function(){
					window.location.reload(1);
			}, 3000);		
        } 
        });
     return false;        
});
$(document).ready(function() {
    $("div.bhoechie-tab-menu>div.list-group>a").click(function(e) {
        e.preventDefault();
        $(this).siblings('a.active').removeClass("active");
        $(this).addClass("active");
        var index = $(this).index();
        $("div.bhoechie-tab>div.bhoechie-tab-content").removeClass("active");
        $("div.bhoechie-tab>div.bhoechie-tab-content").eq(index).addClass("active");
    });
});

 $(".dropdown " ).click(function() {
       $(this).toggleClass( "open" );
     });
 
 //editor validation
  /*$(".btn-primary" ).click(function() {
	    var value = tinyMCE.activeEditor.getContent()
		
		if (value=="") {
			 
		    $('.tinymce').before($('<input type="text" class="content_editor_value validate[required]" />'));
        }else{
			$(".content_editor_value").hide();
		}
		
     });*/
 
   
  $(document).ready(function()
{
	/*
		assigning keyup event to password field
		so everytime user type code will execute
	*/

	$('#password-value').keyup(function()
	{
		$('#result').html(checkStrength($('#password-value').val()))
	})	
	
	/*
		checkStrength is function which will do the 
		main password strength checking for us
	*/
	
	function checkStrength(password)
	{
		//initial strength
		var strength = 0
		
		//if the password length is less than 6, return message.
		if (password.length < 6) { 
			$('#result').removeClass()
			$('#result').addClass('short')
			return 'Too short' 
		}
		
		//length is ok, lets continue.
		
		//if length is 8 characters or more, increase strength value
		if (password.length > 7) strength += 1
		
		//if password contains both lower and uppercase characters, increase strength value
		if (password.match(/([a-z].*[A-Z])|([A-Z].*[a-z])/))  strength += 1
		
		//if it has numbers and characters, increase strength value
		if (password.match(/([a-zA-Z])/) && password.match(/([0-9])/))  strength += 1 
		
		//if it has one special character, increase strength value
		if (password.match(/([!,%,&,@,#,$,^,*,?,_,~])/))  strength += 1
		
		//if it has two special characters, increase strength value
		if (password.match(/(.*[!,%,&,@,#,$,^,*,?,_,~].*[!,%,&,@,#,$,^,*,?,_,~])/)) strength += 1
		
		//now we have calculated strength value, we can return messages
		
		//if value is less than 2
		if (strength < 2 )
		{
			$('#result').removeClass()
			$('#result').addClass('weak')
			return 'Weak'			
		}
		else if (strength == 2 )
		{
			$('#result').removeClass()
			$('#result').addClass('good')
			return 'Good'		
		}
		else
		{   $('#result').removeClass()
			$('#result').addClass('strong')
			return 'Strong'
		}
	}
});

$(document).ready(function() {
  $("[data-toggle=tooltip]").tooltip();
}); 

//append final progress value for project section
$('#status-final').click(function(){
    $(".progress-bar").css('width','100%');
	$(".progress-percent").text('100%');
});

//show more amenities
$('.amenity-show').click(function(){
	
      var count=$(this).val();
	  if ($(".amenity-section_"+count).length){
		    
             $(".amenity-section_"+count).show();
        }else{
			  $(".amenity-show").hide();
		}
	
	   count++;
	  $(".amenity-show").val(count);
	 // $('#loading').html("").hide();
});

//show more specification
$('.specification-show').click(function(){
	
      var count=$(this).val();
	  if ($(".specification-section_"+count).length){
		    
             $(".specification-section_"+count).show();
        }else{
			  $(".specification-show").hide();
		}
	
	   count++;
	  $(".specification-show").val(count);
	 // $('#loading').html("").hide();
});


/* Emi Calculator */
