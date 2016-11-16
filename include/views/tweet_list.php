<?php

echo '<div class="TweetListContent">';
foreach($this->getTweets($user_id) as $tweet){
    echo '<div class="TweetContent" id="TweetContent" data-userID="'.$user_id.'" data-tweetID="'.$tweet['tweetID'].'">
            <div class="TweetProfilePhoto">
                <a href="index.php?profile='.$this->getTmp('login').'" class="tweetprofile" onmouseover="tooltip.pop(this, \'#profile-tooltip'.$tweet['tweetID'].'\', {position:0, cssClass:\'no-padding\'})">
                    <div class="profile-small-photo" style="background-image: url(./upload/profile/'.$this->getTmp('photo').'); background-size: cover; background-repeat: no-repeat;"></div>
                </a>     
            </div>
            <div class="TweetProfileInfo">
                <span class="TweetName" onmouseover="tooltip.pop(this, \'#profile-tooltip'.$tweet['tweetID'].'\', {position:0, cssClass:\'no-padding\'})">'.ucfirst($this->getTmp('name')).' '.ucfirst($this->getTmp('surname')).'</span>
                <span class="TweetLogin" onmouseover="tooltip.pop(this, \'#profile-tooltip'.$tweet['tweetID'].'\', {position:0, cssClass:\'no-padding\'})">@'.$this->getTmp('login').'</span>
                <div style="display:none;">
                    <div id="profile-tooltip'.$tweet['tweetID'].'" style="width: 300px; min-height: 270px;">
                        <div style=" position: relative; cursor: pointer;">
                        <img class="" width="300" height="100" src="./upload/background/'.$this->getTmp('background').'" alt="Profile banner" />
                        <a href="index.php?profile='.$this->getTmp('login').'" class="tweetprofile">
                            <img class="profile-picture-tooltip" src="./upload/profile/'.$this->getTmp('photo').'" alt="Profile banner" />
                        </a>
                         <p class="name-tooltip">'.ucfirst($this->getTmp('name')).' '.ucfirst($this->getTmp('surname')).'</p>
                         <p class="login-tooltip">@'.$this->getTmp('login').'</p>
                         <img class="follow-button-tooltip" src="./template/img/icons/follow_user_icon.png">
                         <p class="desc-tooltip">'.$this->getTmp('desc').'</p>
                         <div class="stats-tooltip">
                            <div class="stats-tweet-tooltip">
                                <span>Tweety</span>
                                <p>'.$this->getTmp('tweets').'</p>
                            </div>
                            <div class="stats-tweet-tooltip">
                                <span>Obserwowani</span>
                                <p>'.$this->getTmp('following').'</p>
                            </div>
                            <div class="stats-tweet-tooltip">
                                <span>Obserwujący</span>
                                <p>'.$this->getTmp('followers').'</p>
                            </div>
                         </div>
                        </div>
                       
                    </div>
                </div>
                <span class="TweetTime" data-toggle="tooltip-data" data-placement="top" title="'.$tweet["date"].'"> · '.$this->getTimeDifference($tweet["date"]).'</span>
            </div>
            <div class="TweetText">
                <p class="" style="clear: both;">'.$tweet["text"].'</p>
            </div>
            <div class="TweetButtons" style="float:left; ">
                <span class="glyphicon TweetButtonReply" style="float:left"></span>
                <span class="glyphicon glyphicon-retweet" style="float:left;"></span>';
                if($this->checkIfLikedTweet($tweet['tweetID'], $this->convertToUserId($_SESSION["email"], 'email')) == true){
                    echo '<span class="glyphicon glyphicon-heart tweet-liked" style="float:left;" data-tweetID="'.$tweet['tweetID'].'"><span class="tweet-LikeCount" id="LikeCount'.$tweet['tweetID'].'">'.$this->likesTweetCount($tweet['tweetID']).'</span></span>';
                } else {
                    echo '<span class="glyphicon glyphicon-heart tweet-like" style="float:left;" data-tweetID="'.$tweet['tweetID'].'"><span class="tweet-LikeCount" id="LikeCount'.$tweet['tweetID'].'">'.$this->likesTweetCount($tweet['tweetID']).'</span></span>';
                }

             echo '<div class="dropdown">
                 <span class="glyphicon glyphicon-option-horizontal dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" data-tweetID="'.$tweet['tweetID'].'" style="float:left"></span>   
			        <ul class="dropdown-menu" id="SettingsTweetButton'.$tweet['tweetID'].'" role="menu" aria-labelledby="menu1" style="display: none; margin-top: 20px;">
				        <li role="presentation"><a role="menuitem" tabindex="-1" href="#funkcja do kopiowania"><i class="glyphicon glyphicon-copy"></i>Kopiuj link do tweeta</a></li>
				        <li role="presentation" class="divider"></li>
				        <li role="presentation"><a role="menuitem" tabindex="-1" href="#"><i class="glyphicon glyphicon-share-alt"></i>Udostepnij przez prywatną wiadomość</a></li>
				        <li role="presentation" class="divider"></li>';
                        if($this->covertEmailToLogin($_SESSION["email"]) != $this->getTmp('login')){
                            echo '<li role="presentation"><a role="menuitem" tabindex="-1" href="#"><i class="glyphicon glyphicon-ban-circle"></i>Zablokuj @'.$this->getTmp('login').'</li>';
                        } else {
                            echo '<li role="presentation"><a role="menuitem" tabindex="-1" href="" id="tweetDelete" data-tweetID="'.$tweet['tweetID'].'"><i class="glyphicon glyphicon-remove"></i>Usuń Tweeta</a></li>';
                        }
	echo'    
			        </ul>
		
                </div>

            </div>
      </div>     
        
    ';
}
echo '
<div class="TweetMarginBottom"></div>
</div>';