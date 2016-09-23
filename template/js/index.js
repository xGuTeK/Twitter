$(function(){

	$('.profile-picture-edit').hide();
	
	$(".profile-picture").mouseover(function(){
		$('.profile-picture-edit').show();
		//$('.profile-picture-edit').fadeTo("slow", 1);
			
	});	
	
	$(".profile-picture").mouseout(function() { 
		$('.profile-picture-edit').hide();
		//$('.profile-picture-edit').fadeToggle("slow");
			
	});			
	$('.editProfilePhoto').hide();
	$('.editProfilePhotoConcent').hide();
	
	$('*').click(function(e) {
		
    	if((e.target.className != 'editProfilePhotoConcent') || (e.target.id != '#file') || (e.target.id != '.editPhotoLink') || (e.target.id != null) || (e.target.className != 'editProfilePhoto')) {
    		$('.editProfilePhotoConcent').hide();
			$('.editProfilePhoto').hide();
			console.log(e.target.id);
		} else {
			console.log('foo');
		}

    });
	/*
	$('.container').click(function() {
		$('#editPhotoLink').click(function(){
			return false;
		});
		$('.editProfilePhotoConcent').click(function(){
			return false;
		});	
		

		$('.editProfilePhotoConcent').fadeOut('slow');
	});*/
	
    $( "#editPhotoLink" ).on( "click", function(event) {
	  event.preventDefault(); 
	  $('.editProfilePhoto').show();
	  $( ".editProfilePhotoConcent" ).show();
	  
	  
    });
	/*
	$('#zoomTweet').dialog({
		width: 730,
		modal: true,
		resizable: false,
		draggable: false,
		dialogClass: 'ui-dialog-osx',
		open:
			function (event, ui) {
			$(".ui-widget-overlay").css({
				opacity: 0.75,
				filter: "Alpha(Opacity=0)",
				backgroundColor: "black"
			});

		},
		position: { my: "center top", at: "center top+75"}
	});
	$('#zoomTweet').siblings('.ui-dialog-titlebar').remove();
	$("body").on("click",".ui-widget-overlay",function() {
		$('#zoomTweet').dialog( "close" );
	});*/
});		
		