<?php

echo '<div class="TweetListContent">';
foreach($this->getTweets($user_id) as $tweet){
//    echo '
//						<div class="mytweet" id="'.$tweet['tweetID'].'" style="clear:both; ">
//							<a href="index.php?profile='.$this->getTmp('login').'" class="tweetprofile"><div class="profile-small-photo" style="background-image: url(./upload/profile/'.$this->getTmp('photo').'); background-size: cover; background-repeat: no-repeat;"></div></a>
//							<a class="tweetLink" id="zoomTweetLink" href="javascript:void(0);" data-userID="'.$user_id.'" data-tweetID="'.$tweet['tweetID'].'"><div>
//								<p style="color:black; left: 5px; font-width: bold; width:100%;">'.ucfirst($this->getTmp('name')).' '.ucfirst($this->getTmp('surname')).'<small>@'.$this->getTmp('login').'</small></p><div style="align: right;">'.$tweet["date"].'</div>
//								<p>'.$tweet["text"].'</p>
//						    </div></a>
//						</div>';

    echo '<div class="TweetContent" id="'.$tweet['tweetID'].'" data-userID="'.$user_id.'" data-tweetID="'.$tweet['tweetID'].'">
            <div class="TweetProfilePhoto">
                <a href="index.php?profile='.$this->getTmp('login').'" class="tweetprofile">
                    <div class="profile-small-photo" style="background-image: url(./upload/profile/'.$this->getTmp('photo').'); background-size: cover; background-repeat: no-repeat;"></div>
                </a>     
            </div>
            <div class="TweetProfileInfo">
                <span class="TweetName">'.ucfirst($this->getTmp('name')).' '.ucfirst($this->getTmp('surname')).'</span>
                <span class="TweetLogin">@'.$this->getTmp('login').'</span>
                <span class="TweetTime"> · '.$this->getTimeDifference($tweet["date"]).'</span>
            </div>
            <div class="TweetText">
                <p class="" style="clear: both;">'.$tweet["text"].'</p>
            </div>
            <div class="TweetButtons">
                <span class="glyphicon glyphicon-retweet TweetButtonReply></span>
                <span class="glyphicon glyphicon-retweet TweetButtonReTweet"></span>
                <span class="glyphicon glyphicon-heart TweetButtonLike"></span>
                <span class="glyphicon glyphicon-option-horizontal"></span>
            </div>    
         </div>   
    
    
    ';
//    if($tweet['tweetID'] != $lastTweet['tweetID']) {
//        echo '<hr style="position: relative; bottom: 0px; margin-top: 3px; clear:both;">';
//    }
}
echo '</div>';