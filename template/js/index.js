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
	/*
	$('*').click(function(e) {
		
    	if((e.target.className != 'editProfilePhotoConcent') || (e.target.id != '#file') || (e.target.id != '.editPhotoLink') || (e.target.id != null) || (e.target.className != 'editProfilePhoto')) {
    		$('.editProfilePhotoConcent').hide();
			$('.editProfilePhoto').hide();
		} else {
			console.log('foo');
		}

    });

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
	  //$('.editProfilePhoto').show();
	  //$( ".editProfilePhotoConcent" ).show();
	  editProfilePhoto();
	  
    });
	function editProfilePhoto() {
		$.ajax({
			url: "index.php?act=editphoto",
			type: "GET",
			success: function (data) {
				$('<div class="editProfilePhotoDialog"></div>').appendTo('body')
					.html(data)
					.dialog({
						width: 410,
						height: 450,
						modal: true,
						show: {effect: 'fold', duration: 550},
						hide: {effect: 'fade', duration: 1000},
						resizable: false,
						draggable: false,
						dialogClass: 'ui-dialog-zoomTweet',
						open: function (event, ui) {
							$(".ui-widget-overlay").css({
								opacity: 0.75,
								filter: "Alpha(Opacity=0)",
								backgroundColor: "black"
							});
							$(this).css("padding", "0px");
							$(this).css('option', 'position', 'center');
							$(this).siblings('.ui-dialog-titlebar').remove();
							$('body').css('overflow','hidden');
							$('.ui-widget-overlay').click(function () {
								$('.ui-dialog-zoomTweet').remove();
								$('.editProfilePhotoConcent').remove();
								$('#editProfilePhotoForm').remove();
							});
							window.scrollTo(0, 0);
						},
						close: function (event, ui){
							$('body').css('overflow','scroll');
						},
						position: {my: "center top", at: "center top+75"}
					});
			}

		});
	}


});		
		