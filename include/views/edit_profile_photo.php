<script>
	$(document).ready(function (e) {
		$("#editProfilePhotoForm").on('submit',(function(e) {
			e.preventDefault();
			$("#editProfilePhotoMessage").empty();
			$('#editProfilePhotoLoading').show();

			$.ajax({
				url: "index.php?act=photoupload",
				type: "POST",
				data: new FormData(this),
				contentType: false,
				cache: false,
				processData:false,
				success: function(data)
				{
					$('#editProfilePhotoLoading').hide();
					$("#editProfilePhotoMessage").html(data);
					$("#editProfilePhotoMessage").empty(); // To remove the previous error message

					var file = $('#editProfilePhotoFile').val();
					alert(file);
					var imagefile = 'image/jpeg';
					match= ["image/jpeg","image/jpg"];
					if(!((imagefile==match[0]) || (imagefile==match[1])))
					{
						$('#editProfilePhotoPreviewImage').attr('src','<?php echo './upload/profile/'.$user->getTmp('photo'); ?>');
						$("#editProfilePhotoMessage").html("<p id='error'>Please Select A valid Image File</p>"+"<h4>Note</h4>"+"<span id='error_message'>Only jpeg, jpg and Images type allowed</span>");

						return false;
					} else {
						var reader = new FileReader();
						reader.onload = imageIsLoaded;
						reader.readAsDataURL(file);
					}
				}
			});
		}));
		// Function to preview image after validation

			$("#editProfilePhotoFile").change(function() {

				$("#editProfilePhotoMessage").empty(); // To remove the previous error message

				var file = this.files[0];
				console.log(file);
				var imagefile = file.type;
				match= ["image/jpeg","image/jpg"];
				if(!((imagefile==match[0]) || (imagefile==match[1])))
				{
					$('#editProfilePhotoPreviewImage').attr('src','<?php echo './upload/profile/'.$user->getTmp('photo'); ?>');
					$("#editProfilePhotoMessage").html("<p id='error'>Please Select A valid Image File</p>"+"<h4>Note</h4>"+"<span id='error_message'>Only jpeg, jpg and Images type allowed</span>");

					return false;
				} else {
					var reader = new FileReader();
					reader.onload = imageIsLoaded;
					reader.readAsDataURL(this.files[0]);
				}
			});
		function imageIsLoaded(e) {
			$("#editProfilePhotoFile").css("color","green");
			$('#editProfilePhotoPreview').css("display", "block");
			$('#editProfilePhotoPreviewImage').attr('src', e.target.result);
			$('#editProfilePhotoPreviewImage').attr('width', '250px');
			$('#editProfilePhotoPreviewImage').attr('height', '230px');
		};


	});
</script>

<div class="editProfilePhotoConcent2">

		<form id="editProfilePhotoForm" action="" method="post" enctype="multipart/form-data">
				<h2 style="text-align: center; background: rgba(59, 89, 152, 0.75);">Change profile photo</h2>
		<hr>
			<div id="editProfilePhotoPreview"><div id="editProfilePhotoPreviewImage" class="profile-picture" style="background-image: url('<?php echo './upload/profile/'.$user->getTmp('photo'); ?>')"></div></div>
			<hr id="line">
			<div id="editProfilePhotoSelectImage">
				<label>Select Your Image
				<input type="file" name="editProfilePhotoFile" id="file" required /></label>
				<input type="submit" value="Upload" class="editProfilePhotoSubmit" />
			</div>
		</form>
	</div>
	<h4 id='editProfilePhotoLoading' >loading..</h4>
	<div id="editProfilePhotoMessage"></div>