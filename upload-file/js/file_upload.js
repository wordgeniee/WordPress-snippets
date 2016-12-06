jQuery(document).ready(function(){
   
   
	jQuery('input[type="file"]').on('change',function(event){
        id = jQuery(this).attr('id');
       
		
		element= jQuery(this);
       
        var data = new FormData();        
        
		
        var file_data = jQuery(this).prop("files")[0];
	    data.append("file", file_data);
        data.append("action", 'upload_file');
        
	    path = vars.ajax_path;
        
    	jQuery.ajax({
        	url: path,
        	type: 'POST',
        	data: data,
        	cache: false,
        	dataType: 'json',
        	processData: false,
        	contentType: false, 
        	success: function(data, textStatus, jqXHR)
        	{
                 console.log(data.files.url);
        		
            	if(typeof data.error === 'undefined')
            	{
                    console.log(data); //Process uploaded file details
            	}
            	else
            	{
                
                    alert('File could not be uploaded successfully. Please try again!');
                    console.log('ERRORS: ' + data.error);
            	}
        	},
        	error: function(jqXHR, textStatus, errorThrown)
        	{
        	   
           		console.log('ERRORS: ' + textStatus);
            	
        	}
        });
    });
    


});

