// JavaScript Document
$(document).ready(function(){
	
	/* Data Insert Starts Here */
	$(document).on('submit', '#simpansei', function() {
	  
	   $.post("createkod.php", $(this).serialize())
        .done(function(data){
			$("#dis").fadeOut();
			$("#dis").fadeIn('slow', function(){
				 $("#dis").html('<div class="alert alert-success">'+data+'</div>');
			     $("#simpansei")[0].focus();
		     });	
		 });   
	     return false;
    });
});
$(document).ready(function(){
	
	/* Data Insert Starts Here */
	$(document).on('submit', '#simpansih', function() {
	  
	   $.post("createb.php", $(this).serialize())
        .done(function(data){
			$("#dis").fadeOut();
			$("#dis").fadeIn('slow', function(){
				 $("#dis").html('<div class="alert alert-success">'+data+'</div>');
			     $("#simpansih")[0].focus();
		     });	
		 });   
	     return false;
    });


$(document).ready(function(){
	
	/* Data Insert Starts Here */
	$(document).on('submit', '#saverin', function() {
	  
	   $.post("create.php", $(this).serialize())
        .done(function(data){
			$("#dis").fadeOut();
			$("#dis").fadeIn('slow', function(){
				 $("#dis").html('<div class="alert alert-success">'+data+'</div>');
			     $("#saverin")[0].reset();
		     });	
		 });   
	     return false;
    });
	/* Data Insert Ends Here */
	
	
	/* Data Delete Starts Here */
	$(".delete-link").click(function()
	{
		var id = $(this).attr("id");
		var del_id = id;
		var parent = $(this).parent("td").parent("tr");
		if(confirm('Sure to Delete ID no = ' +del_id))
		{
			$.post('delete.php', {'del_id':del_id}, function(data)
			{
				parent.fadeOut('slow');
			});	
		}
		return false;
	});
	/* Data Delete Ends Here */
	
	/* Get Edit ID  */
	$(".edit-link").click(function()
	{
		var id = $(this).attr("id");
		var edit_id = id;
		if(confirm('Peminjam ID no = ' +edit_id))
		{
			$("body").fadeOut('slow', function()
			 {
				$("body").fadeIn('slow');
				$("body").load('peminjam.php?edit_id='+edit_id);
			});
		}
		return false;
	});
	
	
	/* Get Edit ID  */
	
	/* Update Record  */
	
	$(document).on('submit', '#e-UpdateForm', function() {
	 
	   $.post("updbook.php", $(this).serialize())
        .done(function(data){
			$("#disd").fadeIn('slow', function(){
			     $("#disd").html('<div class="alert alert-info">'+data+'</div>');
			     $("#e-UpdateForm")[0].focus();
				 
		     });	
		});   
	    return false;
    });
	
		
	
	/* Update Record  */

	
	
	$(document).on('submit', '#emp-UpdateForm', function() {
	 
	   $.post("edit_form.php", $(this).serialize())
        .done(function(data){
			$("#disd").fadeIn('slow', function(){
			     $("#disd").html('<div class="alert alert-info">'+data+'</div>');
			     $("#emp-UpdateForm")[0].focus();
				 $("body").fadeIn('slow', function()
			 {
				$("body").fadeIn('slow');
				$("body").load('index.php');
				 });				 
		     });	
		});   
	    return false;
    });
	/* Update Record  */
});
});