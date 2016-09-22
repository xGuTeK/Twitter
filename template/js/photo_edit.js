$(document).ready(function (e) {
	$("#editProfilePhotoForm").on('submit',(function(e) {
		e.preventDefault();
		$("#editProfilePhotoMessage").empty();
		$('#editProfilePhotoLoading').show();
		
		$.ajax({
			url: "../Twitter/include/edit_profile_photo.php", 
			type: "POST",             
			data: new FormData(this), 
			contentType: false,      
			cache: false,             
			processData:false,        
			success: function(data)   
			{
				$('#editProfilePhotoLoading').hide();
				$("#editProfilePhotoMessage").html(data);
			}
		});
	}));

	// Function to preview image after validation
	$(function() {
		$("#editProfilePhotoFile").change(function() {
			$("#editProfilePhotoMessage").empty(); // To remove the previous error message
			var file = this.files[0];
			console.log(file);
			var imagefile = file.type;
			match= ["image/jpeg","image/jpg"];
			if(!((imagefile==match[0]) || (imagefile==match[1])))
			{
				$('#editProfilePhotoPreviewImage').attr('src','noimage.png');
				$("#editProfilePhotoMessage").html("<p id='error'>Please Select A valid Image File</p>"+"<h4>Note</h4>"+"<span id='error_message'>Only jpeg, jpg and Images type allowed</span>");
			
				return false;
			} else {
				var reader = new FileReader();
				reader.onload = imageIsLoaded;
				reader.readAsDataURL(this.files[0]);
			}
		});
	});
	function imageIsLoaded(e) {
		$("#editProfilePhotoFile").css("color","green");
		$('#editProfilePhotoPreview').css("display", "block");
		$('#editProfilePhotoPreviewImage').attr('src', e.target.result);
		$('#editProfilePhotoPreviewImage').attr('width', '250px');
		$('#editProfilePhotoPreviewImage').attr('height', '230px');
	};


});