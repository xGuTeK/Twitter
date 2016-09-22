$(function(){

	$('.panel_register').hide();
		
	$("#registerB").on('click', function(event) {
		event.preventDefault(); 

		$('.panel_login').fadeOut('slow', function(){
			$('.panel_register').fadeIn('slow');
		});
			
	});	
		
		
	$("#loginB").click(function(event) {
		event.preventDefault(); 

		$('.panel_register').fadeOut('slow', function(){
			$('.panel_login').fadeIn('slow');
		});
			    		
	});



	$( "#loginForm" ).submit(function( e ) {
		e.preventDefault();
		$.ajax({
			url: "index.php?act=login",
			type: "POST",
			data: new FormData(e.target),
			contentType: false,
			cache: false,
			processData:false,
			success: function(data)
			{

				if(data == 'login'){
					window.location = 'index.php?act=login&reload=true';
				} else {
					alert(data);
				}

			}
		});
	});

	$( "#loginForm2" ).submit(function( e ) {
		e.preventDefault();
		$.ajax({
			url: "index.php?act=login",
			type: "POST",
			data: new FormData(e.target),
			contentType: false,
			cache: false,
			processData:false,
			success: function(data)
			{
				if(data == '\nlogin'){
					window.location = 'index.php';
				} else {
					alert(data);
					console.log(data);
				}

			}
		});
	});
});		
		