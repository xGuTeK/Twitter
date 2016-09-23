<?php

if(isset($_SESSION["email"])){
	?>
	
<!DOCTYPE html>
<html>

<head>

  <meta charset="UTF-8">

  <title></title>

  <link rel="stylesheet" href="./template/css/reset.css">

  <link rel="stylesheet" href="./template/css/style2.css" media="screen" type="text/css" />
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.0/themes/base/jquery-ui.css">
  <script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
  <script src="./template/js/index.js"></script>
  <script src="./template/js/photo_edit.js"></script>
	<script src="./template/js/tweet.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
   <script src="./template/js/jquery.colorbox-min.js"></script> 
   <?php if ($user->isMyProfile($userid) == false){ ?>
   <script>
   $(function(){
       <?php
       if($user->userFollow($user->convertToUserId($_SESSION["email"], 'email'), $user->convertToUserId($userid), "login") == true){
       ?>
           $('a.follow').toggleClass('followed');
           $('a.follow').text('Followed');
           $('ul li:last-child').html('<?php echo $user->getTmp('followers'); ?><span>Followers</span>');

       <?php
      }
       ?>
	$('a.follow').click(function () {
		    $(this).toggleClass('followed');

		if($(this).hasClass('followed')) {
            $.ajax({
                url: "index.php?act=follow&id=<?php echo $user->getTmp('id'); ?>",
                type: "GET",
                success: function()
                {
					$('a.follow').text('Followed');
                    $('ul li:last-child').html('<?php echo $user->getTmp('followers')+1; ?><span>Followers</span>');
                }
            });

		} else {
			$.ajax({
				url: "index.php?act=unfollow&id=<?php echo $user->getTmp('id'); ?>",
				type: "GET",
				success: function()
				{
					$('a.follow').text('Follow <?php echo $user->getTmp("name"); ?>');
					$('ul li:last-child').html('<?php echo $user->getTmp('followers'); ?><span>Followers</span>');
				}
			});
		}
	});
});
   </script>
   <?php }?>
  <!--<script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js"</script>-->

</head>

<body background="./template/bg.jpg">


	<div class ="editProfilePhoto" id="editProfilePhoto" background="black"></div>
	<div class="editProfilePhotoConcent">
		<h2 style="text-align: center">Change profile photo</h2>
		<hr>
		<form id="editProfilePhotoForm" action="" method="post" enctype="multipart/form-data">
			<div id="editProfilePhotoPreview"><img id="editProfilePhotoPreviewImage" src="./template/img/profile/noimage.jpg" /></div>
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

  <!--<h1><img src="" /> <small>test</small></h1>-->
	<div class="nav_top">Twitter</div>
	<div class="container">
	<div class="profile">
		<div class="profile-banner">
			<!--<img class="profile-background" width="975" height="300" src="./template/pgackground.jpg" alt="Profile banner" />-->
			<img class="profile-background" width="975" height="300" src="<?php echo './upload/background/'.$user->getTmp('background'); ?>" alt="Profile banner" />
		</div>
		<div class="profile-picture" style="background-image: url('<?php echo './upload/profile/'.$user->getTmp('photo'); ?>')">
			<?php if ($user->isMyProfile($userid) == true)
				echo '<div class="profile-picture-edit">
						<a href="index.php?act=changeProfilePhoto" id="editPhotoLink" style="text-decoration: none;">Edit</a>
					  </div>';
				?>
		</div>	
		
		<div class="profile-stats">
			<ul>
				<li><?php echo $user->getTmp('tweets'); ?> <span>Tweets</span></li>
				<li><?php echo $user->getTmp('following') ?> <span>Following</span></li>
				<li><?php echo $user->getTmp('followers'); ?><span>Followers</span></li>
			</ul>
			<?php
		
			if ($user->isMyProfile($userid) == true){
				echo '<a href="javascript:void(0);" class="follow">Edit background photo</a>';
			} else {
				echo '<a href="javascript:void(0);" class="follow">Follow '.$user->getTmp('name').'</a>';
			}
			?>
		</div>
		
	</div>
	<h1 class="profile-name"><?php echo ucfirst($user->getTmp('name')).' '.ucfirst($user->getTmp('surname')); ?><small><?php echo ' @'.$user->getTmp('login'); ?></small></h1>
	</div>
	<div class="profile-info">
		
		<table width="100%" style="background-color: white; margin-top: 30px;">
			<tr>
				<td>1</td><td>2</td><td>3</td>
			</tr>
			<a href="index.php?act=logout">[Wyloguj]</a>
			<tr>
				<td>1</td><td>2</td><td>3</td>
			</tr>			
		</table>
	
	</div>
	<div class="tweets">
		<?php if ($user->isMyProfile($userid) == true){ ?>
            <form action="index.php?act=newTweet" method="post" id="newTweetForm">
		        <textarea class="textarea-tweet" name="newTweetText"></textarea><br><span class="textarea-count"></span>
		        <input class="tweets-mesageboxButton" type="submit" value="Tweet">
            </form>
		    <hr>
		<a href="tweetid" style="text-decoration: none;">
		<div class="mytweet">
		
			<div class="profile-small-photo" style="background-image: url('./template/profile p.jpg'); background-size: contain; background-repeat: no-repeat;"></div>
			<div><p style="color:black; left: 5px;"><?php echo ucfirst($user->getTmp('name')).' '.ucfirst($user->getTmp('surname')); ?><small><?php echo ' @'.$user->getLogin(); ?></small>         data</p> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque eleifend erat nec nisl facilisis, quis fermentum nulla malesuada. Aenean at</div>
			
		</div></a>
        <div class="mytweetButtons">
            <img src="./template/img/reply-action_0.png" width="20" height="20">
            <img src="./template/img/retweet-action.png" width="20" height="20">
            <img src="./template/img/heart.png" width="20" height="20">
        </div>

		<hr style="position: relative; bottom: 0px; clear: both;">
		<?php
			$tweet->showTweets($user->getTmp('email'));

		} else {
			$tweet->showTweets($user->getTmp('email'));
		} ?>

	</div>
  <!--<script src='http://codepen.io/assets/libs/fullpage/jquery.js'></script>

  <script src="js/index.js"></script>-->
<div class="footer"><p style="font-width: 40px">by Adrian Tracz</p></div>
</body>

</html>
<?php

}	

