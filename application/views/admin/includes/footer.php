
<footer class="main-footer">
  <div class="pull-right hidden-xs"> </div>
  <strong>Copyright &copy; <?php echo date('Y');?>&nbsp;&nbsp; D WALKER JEWELRY</strong>&nbsp;&nbsp; All rights reserved. </footer>
<!-- jQuery 2.1.4 --> 
<script src="<?php echo base_url();?>assets/admin/js/jQuery/jQuery-2.1.4.min.js" type="text/javascript"></script> 
<script src="<?php echo base_url();?>assets/admin/js/bootstrap-datepicker.min.js" type="text/javascript"></script> 
<script src="<?php echo base_url();?>assets/admin/js/bootstrap-datetimepicker.js" type="text/javascript"></script> 
<!-- Bootstrap 3.3.2 JS --> 

<!-- <script src=".<?php echo base_url();?>assets/admin/js/bootstrap.min.js" type="text/javascript"></script>--> 
<!-- DATA TABES SCRIPT --> 
<script src="<?php echo base_url();?>assets/admin/js/datatables/jquery.dataTables.min.js" type="text/javascript"></script> 
<script src="<?php echo base_url();?>assets/admin/js/datatables/dataTables.bootstrap.min.js" type="text/javascript"></script> 
<!-- SlimScroll --> 
<script src="<?php echo base_url();?>assets/admin/js/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script> 
<!-- FastClick --> 
<script src="<?php echo base_url();?>assets/admin/js/fastclick/fastclick.min.js" type="text/javascript"></script> 
<!-- AdminLTE for demo purposes --> 
<script src="<?php echo base_url();?>assets/admin/js/alertify/alertify.min.js" type="text/javascript"></script> 
<script src="<?php echo base_url();?>assets/admin/js/bootstrap/bootstrap.js" type="text/javascript"></script> 
<script src="<?php echo base_url();?>assets/admin/js/bootstrap/bootstrap.min.js" type="text/javascript"></script> 
<script src="<?php echo base_url();?>assets/admin/js/app.min.js" type="text/javascript"></script> 
<script src="<?php echo base_url();?>assets/admin/js/fancybox/jquery.fancybox.js" type="text/javascript"></script> 
<script src="<?php echo base_url(); ?>assets/admin/js/jquery.validationEngine-en.js"></script> 
<script src="<?php echo base_url();?>assets/admin/js/jquery.validationEngine.js" type="text/javascript"></script> 
<script src="<?php echo base_url();?>assets/admin/js/custom.js" type="text/javascript"></script> 
<script src="<?php echo base_url();?>assets/admin/js/tinymce/js/tinymce/tinymce.min.js" type="text/javascript"></script> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-colorpicker/2.3.6/js/bootstrap-colorpicker.js"></script> 

 <script src="<?php echo base_url();?>ckeditor5/build/ckeditor.js"></script>
<!-- page script --> 
<script type="text/javascript">
 //import Base64UploadAdapter from '@ckeditor/ckeditor5-upload/src/adapters/base64uploadadapter';

class MyUploadAdapter {
    constructor( loader ) {
        // The file loader instance to use during the upload.
        this.loader = loader;
    }

    // Starts the upload process.
    upload() {
        return this.loader.file
            .then( file => new Promise( ( resolve, reject ) => {
                this._initRequest();
                this._initListeners( resolve, reject, file );
                this._sendRequest( file );
            } ) );
    }

    // Aborts the upload process.
    abort() {
        if ( this.xhr ) {
            this.xhr.abort();
        }
    }

    // Initializes the XMLHttpRequest object using the URL passed to the constructor.
    _initRequest() {
        const xhr = this.xhr = new XMLHttpRequest();

        // Note that your request may look different. It is up to you and your editor
        // integration to choose the right communication channel. This example uses
        // a POST request with JSON as a data structure but your configuration
        // could be different.
        xhr.open( 'post', '<?php echo base_url();?>/application/views/admin/includes/add_image.php', true );
        xhr.responseType = 'json';
    }

    // Initializes XMLHttpRequest listeners.
    _initListeners( resolve, reject, file ) {
        const xhr = this.xhr;
        const loader = this.loader;
        const genericErrorText = `Couldn't upload file: ${ file.name }.`;

        xhr.addEventListener( 'error', () => reject( genericErrorText ) );
        xhr.addEventListener( 'abort', () => reject() );
        xhr.addEventListener( 'load', () => {
            const response = xhr.response;

            // This example assumes the XHR server's "response" object will come with
            // an "error" which has its own "message" that can be passed to reject()
            // in the upload promise.
            //
            // Your integration may handle upload errors in a different way so make sure
            // it is done properly. The reject() function must be called when the upload fails.
			
            if ( !response || response.error ) {
                return reject( response && response.error ? response.error.message : genericErrorText );
            }

            // If the upload is successful, resolve the upload promise with an object containing
            // at least the "default" URL, pointing to the image on the server.
            // This URL will be used to display the image in the content. Learn more in the
            // UploadAdapter#upload documentation.
            resolve( {
                default: response.url
            } );
        } );

        // Upload progress when it is supported. The file loader has the #uploadTotal and #uploaded
        // properties which are used e.g. to display the upload progress bar in the editor
        // user interface.
        if ( xhr.upload ) {
            xhr.upload.addEventListener( 'progress', evt => {
                if ( evt.lengthComputable ) {
                    loader.uploadTotal = evt.total;
                    loader.uploaded = evt.loaded;
                }
            } );
        }
    }

    // Prepares the data and sends the request.
    _sendRequest( file ) {
        // Prepare the form data.
		
        const data = new FormData();

        data.append( 'upload', file );

        // Important note: This is the right place to implement security mechanisms
        // like authentication and CSRF protection. For instance, you can use
        // XMLHttpRequest.setRequestHeader() to set the request headers containing
        // the CSRF token generated earlier by your application.

        // Send the request.
	
        this.xhr.send( data );
    }
}

// ...

function MyCustomUploadAdapterPlugin( editor ) {
    editor.plugins.get( 'FileRepository' ).createUploadAdapter = ( loader ) => {
        // Configure the URL to the upload script in your back-end here!
        return new MyUploadAdapter( loader );
    };
}

// ...

ClassicEditor
			.create( document.querySelector( '#editor4' ), {
				
				toolbar: {
					items: [
						'exportPdf',
						'heading',
						'|',
						'bold',
						'italic',
						'link',
						'bulletedList',
						'numberedList',
						'|',
						'indent',
						'outdent',
						'|',
						'imageUpload',
						'blockQuote',
						'insertTable',
						
						'specialCharacters',
						'fontColor',
						'fontSize',
						'underline',
						'strikethrough',
						'pageBreak',
						'horizontalLine',
						'fontBackgroundColor',
						'undo',
						'redo',
						'alignment',
						'mediaEmbed',
					]
				},
				language: 'en',
				image: {
					styles: [
                          'alignLeft', 'alignCenter', 'alignRight'
                        ],
					toolbar: [
					    'imageStyle:alignLeft', 'imageStyle:alignCenter', 'imageStyle:alignRight',
						'imageTextAlternative',
						'imageStyle:full',
						'imageStyle:side'
					]
				},
				table: {
					contentToolbar: [
						'tableColumn',
						'tableRow',
						'mergeTableCells'
					]
				},
				licenseKey: '',
				extraPlugins: [ MyCustomUploadAdapterPlugin ],		
			} )
			.then( editor => {
				window.editor = editor;
		
				
				
				
		
				
				
				
			} )
			.catch( error => {
				console.error( 'Oops, something went wrong!' );
				console.error( 'Please, report the following error on https://github.com/ckeditor/ckeditor5/issues with the build id and the error stack trace:' );
				console.warn( 'Build id: r44fntrg0y2-lxdeldtm5eps' );
				console.error( error );
			} );



	
	ClassicEditor
			.create( document.querySelector( '#editor1' ), {
				
				toolbar: {
					items: [
						'exportPdf',
						'heading',
						'|',
						'bold',
						'italic',
						'link',
						'bulletedList',
						'numberedList',
						'|',
						'indent',
						'outdent',
						'|',
						
						'blockQuote',
						'insertTable',
						
						'specialCharacters',
						'fontColor',
						'fontSize',
						'underline',
						'strikethrough',
						'pageBreak',
						'horizontalLine',
						'fontBackgroundColor',
						'undo',
						'redo',
						'alignment',
						'mediaEmbed',
					]
				},
				language: 'en',
				image: {
					styles: [
                          'alignLeft', 'alignCenter', 'alignRight'
                        ],
					toolbar: [
					    'imageStyle:alignLeft', 'imageStyle:alignCenter', 'imageStyle:alignRight',
						'imageTextAlternative',
						'imageStyle:full',
						'imageStyle:side'
					]
				},
				table: {
					contentToolbar: [
						'tableColumn',
						'tableRow',
						'mergeTableCells'
					]
				},
				licenseKey: '',
				extraPlugins: [ MyCustomUploadAdapterPlugin ],		
			} )
			.then( editor => {
				window.editor = editor;
		
				
				
				
		
				
				
				
			} )
			.catch( error => {
				console.error( 'Oops, something went wrong!' );
				console.error( 'Please, report the following error on https://github.com/ckeditor/ckeditor5/issues with the build id and the error stack trace:' );
				console.warn( 'Build id: r44fntrg0y2-lxdeldtm5eps' );
				console.error( error );
			} );
 ClassicEditor
			.create( document.querySelector( '.editor' ), {
				
				toolbar: {
					items: [
						'exportPdf',
						'heading',
						'|',
						'bold',
						'italic',
						'link',
						'bulletedList',
						'numberedList',
						'|',
						'indent',
						'outdent',
						'|',
						'imageUpload',
						'blockQuote',
						'insertTable',
						
						'specialCharacters',
						'fontColor',
						'fontSize',
						'underline',
						'strikethrough',
						'pageBreak',
						'horizontalLine',
						'fontBackgroundColor',
						'undo',
						'redo',
						'alignment',
						'mediaEmbed',
					]
				},
				language: 'en',
					image: {
					styles: [
                          'alignLeft', 'alignCenter', 'alignRight'
                        ],
					toolbar: [
					    'imageStyle:alignLeft', 'imageStyle:alignCenter', 'imageStyle:alignRight',
						'imageTextAlternative',
						'imageStyle:full',
						'imageStyle:side'
					]
				},
				table: {
					contentToolbar: [
						'tableColumn',
						'tableRow',
						'mergeTableCells'
					]
				},
				licenseKey: '',
				extraPlugins: [ MyCustomUploadAdapterPlugin ],		
			} )
			.then( editor => {
				window.editor = editor;
		
				
				
				
		
				
				
				
			} )
			.catch( error => {
				console.error( 'Oops, something went wrong!' );
				console.error( 'Please, report the following error on https://github.com/ckeditor/ckeditor5/issues with the build id and the error stack trace:' );
				console.warn( 'Build id: r44fntrg0y2-lxdeldtm5eps' );
				console.error( error );
			} );
     </script>

<script language="javascript" type="text/javascript">
    function isNumeric(evt)
	 {
	 var charCode = (evt.which) ? evt.which : event.keyCode
	 if (charCode > 31 && (charCode < 48 || charCode > 57) && charCode != 46)
		return false;
	
	 return true;
	 }
</script>