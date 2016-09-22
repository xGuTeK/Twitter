$(function(){
	$('a.follow').click(function () {
		$(this).toggleClass('followed');
		var htmlString="<?php echo $user->getTmp('name'); ?>";
		if($(this).hasClass('followed')) {
			$(this).text('Followed');
			$('ul li:last-child').html('325<span>Followers</span>');
			alert(htmlString);
		} else {
			$(this).text('Follow');
			$('ul li:last-child').html('324<span>Followers</span>');
			alert(htmlString);
		}
	});
});
