<?php

if(isset($_SESSION["email"])){

	?>
	
<!DOCTYPE html>
<html>

<head>

  <meta charset="UTF-8">

  <title></title>
	<!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">-->
  <link rel="stylesheet" href="./template/css/reset.css">

  <link rel="stylesheet" href="./template/css/style2.css" media="screen" type="text/css" />
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.0/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.0.0-rc2/css/bootstrap-glyphicons.css">
  <link rel="stylesheet" href="./template/css/bootstrap.css" media="screen" type="text/css" />
  <script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
  <script src="./template/js/index.js"></script>
  <script src="./template/js/photo_edit.js"></script>
	<script src="./template/js/tweet.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
   <script src="./template/js/jquery.colorbox-min.js"></script>

	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
   <?php if ($user->isMyProfile($userid) == false){

	   if(empty($user->getLogin())){
		   echo '<script src="template/js/register_nextstep.js"></script>';
	   }
	   ?>
   <script>
   $(function(){
       <?php
       if($user->userFollow($user->convertToUserId($_SESSION["email"], 'email'), $user->convertToUserId($userid), "login") == true){
       ?>
           $('a.follow').toggleClass('followed');
           $('a.follow').text('Followed');
           $('#FollowersCount').html('<?php echo $user->getTmp('followers'); ?><span>Followers</span>');

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
                    $('#FollowersCount').html('<?php echo $user->getTmp('followers')+1; ?><span>Followers</span>');
                }
            });

		} else {
			$.ajax({
				url: "index.php?act=unfollow&id=<?php echo $user->getTmp('id'); ?>",
				type: "GET",
				success: function()
				{
					$('a.follow').text('Follow <?php echo $user->getTmp("name"); ?>');
					$('#FollowersCount').html('<?php echo $user->getTmp('followers'); ?><span>Followers</span>');
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

<!--
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
	<div id="editProfilePhotoMessage"></div>-->

  <!--<h1><img src="" /> <small>test</small></h1>-->
	<div class="nav_top">Twitter

	<div class="nav_profile_menu">

		<div class="dropdown" style="">
			<button class="profile-small nav_profile_button" type="button" id="menu1" data-toggle="dropdown" style="background-image: url('<?php echo './upload/profile/'.$user->getProfileImage(); ?>'); background-size: cover; background-repeat: no-repeat; height: 30px; width: 30px; position: relative; top: 10%;"></button>
			<ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
				<li role="presentation"><a role="menuitem" tabindex="-1" href="index.php?profile=<?php echo $user->getLogin(); ?>"><i class="glyphicon glyphicon-user" style=""></i>Zobacz profil</a></li>
				<li role="presentation" class="divider"></li>
				<li role="presentation"><a role="menuitem" tabindex="-1" href="#"><i class="glyphicon glyphicon-envelope"></i>Wiadomości</a></li>
				<li role="presentation" class="divider"></li>
				<li role="presentation"><a role="menuitem" tabindex="-1" href="#"><i class="glyphicon glyphicon-cog"></i>Ustawienia</a></li>
				<li role="presentation" class="divider"></li>
				<li role="presentation"><a role="menuitem" tabindex="-1" href="index.php?act=logout"><i class="glyphicon glyphicon-log-out"></i>Logout</a></li>
			</ul>
		</div>
	</div>

	</div>
	<div class="container">
	<div class="profile">
		<div class="profile-banner">
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
			<ul id="profileStatsUL">
				<li id="TweetCount"><?php echo $user->getTmp('tweets'); ?> <span>Tweets</span></li>
				<li id="FollowingCount"><?php echo $user->getTmp('following') ?> <span>Following</span></li>
				<li id="FollowersCount"><?php echo $user->getTmp('followers'); ?><span>Followers</span></li>
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
		<p style="text-align:center; margin-top: 5px;"><?php echo $user->getTmp('desc');?></p>
		<p style="margin-left: 12px; margin-top: 15px;"><span class="glyphicon glyphicon-map-marker" style="color: gray;"></span> <?php echo $user->getTmp('city'); ?></p>
		<p style="margin-left: 12px; margin-top: 5px;"><span class="glyphicon glyphicon-link" style="color: gray;"></span> <?php echo $user->getTmp('page'); ?></p>
		<p style="margin-left: 12px; margin-top: 5px;"><span class="glyphicon glyphicon-calendar" style="color: gray;"></span> <?php echo substr($user->getTmp('createdate'), 0, -9); ?></p>
	</div>
	<div class="tweets">
		<?php if ($user->isMyProfile($userid) == true){ ?>
            <form action="index.php?act=newTweet" method="post" id="newTweetForm">
		        <textarea class="textarea-tweet" name="newTweetText"></textarea><br><span class="textarea-count"></span>
		        <input class="tweets-mesageboxButton" type="submit" value="Tweet">
            </form>

		<?php
			$tweet->showTweets($user->getTmp('email'));

		} else {
			$tweet->showTweets($user->getTmp('email'));
		} ?>

	</div>

<div class="footer"><p style="font-width: 40px">by Adrian Tracz</p></div>
</body>

</html>
<?php

}	

