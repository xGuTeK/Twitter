<?php

if($user->isLogged() != false){

?>
<!DOCTYPE html>
<html>

<head>

  <meta charset="UTF-8">

  <title><?php echo ucfirst($user->getTmp('name')).' '.ucfirst($user->getTmp('surname')).' (@'.$user->getTmp('login').') | Twitter'; ?></title>
  <link rel="stylesheet" href="./template/css/reset.css">
  <link rel="stylesheet" href="./template/css/style2.css" media="screen" type="text/css" />
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.0/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="./template/css/bootstrap.css" media="screen" type="text/css" />
  <link rel="stylesheet" href="./template/css/tooltip.css" media="screen" type="text/css" />


  <script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

  <script src="./template/js/index.js"></script>
  <script src="./template/js/photo_edit.js"></script>
  <script src="./template/js/tweet.js"></script>
  <script src="./template/js/search.js"></script>
  <script src="./template/js/tooltip.js"></script>

<?php

  if(empty($user->getLogin())){
	echo '<script src="template/js/register_nextstep.js"></script>';
  }

  if ($user->checkIfIsMyProfile() == false){
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

	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body background="./template/bg.jpg">

<!--
	<h4 id='editProfilePhotoLoading' >loading..</h4>
	<div id="editProfilePhotoMessage"></div>-->

	<div class="nav_top">Twitter
		<?php
			include_once 'include\views\nav_top.php';
		?>
	</div>

	<div class="container">

		<div class="profile">
			<div class="profile-banner">
				<img class="profile-background" width="975" height="300" src="<?php echo './upload/background/'.$user->getTmp('background'); ?>" alt="Profile banner" />
			</div>
			<div class="profile-picture" style="background-image: url('<?php echo './upload/profile/'.$user->getTmp('photo'); ?>')">
				<?php if ($user->checkIfIsMyProfile() == true)
					echo '<div class="profile-picture-edit">
							<a href="index.php?act=changeProfilePhoto" id="editPhotoLink" style="text-decoration: none;">Edit</a>
					  	  </div>';
				?>
			</div>
		
			<div class="profile-stats">
				<ul id="profileStatsUL">
					<li id="TweetCount"><?php echo $user->getTmp('tweets'); ?> <span>Tweety</span></li>
					<li id="FollowingCount"><?php echo $user->getTmp('following') ?> <span>Obserwowani</span></li>
					<li id="FollowersCount"><?php echo $user->getTmp('followers'); ?><span>Obserwujący</span></li>
				</ul>
				<?php
					if ($user->checkIfIsMyProfile() == true){
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
		<?php if ($user->checkIfIsMyProfile() == true){ ?>
            <form action="index.php?act=newTweet" method="post" id="newTweetForm">
		        <textarea class="textarea-tweet" name="newTweetText"></textarea><br><span class="textarea-count"></span>
		        <input class="tweets-mesageboxButton" type="submit" value="Tweet">
            </form>

		<?php
			}
			$tweet->showTweets($user->getTmp('email'));

		 ?>

	</div>

	<div class="footer">
		<p style="font-width: 40px">by Adrian Tracz</p>
	</div>

</body>

</html>
<?php
}	

