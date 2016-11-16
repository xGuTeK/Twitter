<?php

class Tweet extends User{

    private $id;
    private $user_id;
    private $text;
	private $tweetsArr;

    const tweetMinSize = 10;
    const tweetMaxSize = 140;

    function setText($text) {
        if (( strlen($text) >= self::tweetMinSize ) && ( strlen($text) <= self::tweetMaxSize )) {
            $this->text = $text;

            return true;
        } else {

            return false;
        }
    }

    function setUser_id($user_id) {
        if (!empty($user_id)) {
            $this->user_id = $user_id;

            return true;
        } else {

            return false;
        }
    }

    function getId() {
        if(!empty($this->id)){
            
            return $this->id;
        }
    }

    function getUser_id() {
        if(!empty($this->user_id)){
            
            return $this->user_id;
        }
    }

    function getText() {
        if(!empty($this->text)){
            
            return $this->text;
        }    
    }

    public function getTimeDifference($time) {
        //Let's set the current time
        $currentTime = date('Y-m-d H:i:s');
        $toTime = strtotime($currentTime);

        //And the time the notification was set
        $fromTime = strtotime($time);

        //Now calc the difference between the two
        $timeDiff = floor(abs($toTime - $fromTime) / 60);

        //Now we need find out whether or not the time difference needs to be in
        //minutes, hours, or days
        if ($timeDiff < 1) {
            $timeDiff = "Teraz";
        } elseif (($timeDiff > 1 && $timeDiff <= 4) || ($timeDiff >= 21 && $timeDiff <= 24) || ($timeDiff >= 32 && $timeDiff <= 34) || ($timeDiff >= 42 && $timeDiff <= 44) || ($timeDiff >= 52 && $timeDiff <= 54)){
            $timeDiff = floor(abs($timeDiff)) . " minuty temu";
        } elseif ($timeDiff > 4 && $timeDiff < 60) {
            $timeDiff = floor(abs($timeDiff)) . " minut temu";
        } elseif ($timeDiff >= 60 && $timeDiff < 120) {
            $timeDiff = floor(abs($timeDiff / 60)) . " godzine temu";
        } elseif ($timeDiff < 1440) {
            $timeDiff = floor(abs($timeDiff / 60)) . " godziny temu";
        } elseif ($timeDiff > 1440 && $timeDiff < 2880) {
            $timeDiff = floor(abs($timeDiff / 1440)) . " dzień temu";
        } elseif ($timeDiff > 2880) {
            $timeDiff = floor(abs($timeDiff / 1440)) . " dni temu";
        }

        return $timeDiff;
    }

    public function userTweetCountUpdate($userId, $option)
    {
        $userId = $this->connect()->escape_string($userId);

        if($option == '+') {
            $sql = "UPDATE `users_profile_stats` SET `Tweets`=`Tweets`+1 WHERE `id`='$userId';";
        }
        if($option == '-'){
            $sql = "UPDATE `users_profile_stats` SET `Tweets`=`Tweets`-1 WHERE `id`='$userId';";
        }
        $result = $this->connect()->query($sql);
    }

    public function newTweet($userID,$text) {
        if ($this->setText($text) == true) {
            $sql = "INSERT INTO `tweets` (`user_id`, `text`, `date`) VALUES ('$userID', '".$this->getText()."', '" . date('Y-m-d H:i:s') . "');";
            $result = $this->connect()->query($sql);

            $this->userTweetCountUpdate($this->convertToUserId($userID, "email"), '+');

            echo 'Success';

        } else {
            echo 'Tweet must contain between 10 and 140 characters.';
        }
    }
    public function getTweet($userID, $tweetID)
    {
        $userID = $this->connect()->escape_string($userID);
        $tweetID = $this->connect()->escape_string($tweetID);
        $tweetArr = [];

        if ( $userID && ($tweetID > 0) ) {

            $sql = "SELECT * FROM `tweets` WHERE `id`='$tweetID' AND `user_id` = '$userID';";
            $result = $this->connect()->query($sql);
            if($result->num_rows > 0){
                while ($row = $result->fetch_assoc()) {

                    $tweetArr[1]["text"] = $row["text"];
                    $tweetArr[1]["date"] = $row["date"];
                }
                $result->free();

                return $tweetArr;
            }
        }

        //return false;
    }

    public function getTweets($user_id){
        
        if (!empty($user_id)) {
            
            $sql = "SELECT * FROM `tweets` WHERE `user_id` = '$user_id' ORDER BY `date` DESC";
            $result = $this->connect()->query($sql);
            
            if($result->num_rows > 0){
                $i=1;
                $tweetsArr = [];
                while ($row = $result->fetch_assoc()) {
                    
                    $tweetsArr[$i]["tweetID"] = $row["id"];
                    $tweetsArr[$i]["userID"] = $row["user_id"];
                    $tweetsArr[$i]["text"] = $row["text"];
                    $tweetsArr[$i]["date"] = $row["date"];
                    $i++;
                }
                $result->free();
                
                return $tweetsArr;
            } else {
                return false;
            }
        } else {
            return false; // db error
        }
    }

    function showTweet($userID, $tweetID)
    {
       $userID = $this->connect()->escape_string($userID);
       $tweetID = $this->connect()->escape_string($tweetID);

        if( $this->getTweet($userID, $tweetID) != false){
            $this->loadDataFromDb($userID);
            foreach($this->getTweet($userID, $tweetID) as $tweet){

                echo '<div class="zoomTweetHeader">
                            <a href="index.php?profile='.$this->getTmp('login').'" class="tweetprofile"><div class="profile-small-photo" style="background-image: url(./upload/profile/'.$this->getTmp('photo').'); background-size: cover; background-repeat: no-repeat;"></div></a>
                            <p class="zoomTweetName">'.ucfirst($this->getTmp('name')).' '.ucfirst($this->getTmp('surname')).'</p>
                                <span class="zoomTweetLogin">@'.$this->getTmp('login').'</span>';
                if ($this->isMyProfile($userID, $_SESSION['email']) == false){
	                echo '<span class="tweetZoomFollow"><a href="javascript:void(0);" class="follow" style="height: 23px">Follow '.$this->getTmp('name').'</a></span>';
                }
                echo '<hr style="clear:both;">
                </div>
                <div class="zoomTweetText">'.$this->getTweet($this->getTmp('email'), $tweetID)[1]["text"].'</div>
<div class="zoomTweetStats">
	<div class="shareLikeColumn">
		<span class="shareText">Podane dalej</span><span class="shareText">Polubienia</span>
	</div>
	<div class="sharePhotoColumn">

	</div>
</div>';

            }

        }

    }

    function showTweets($user_id){
        if( $this->getTweets($user_id) != false ){
            if(!empty($this->getTweets($user_id))){
                $this->loadDataFromDb($user_id);

                include_once 'include\views\tweet_list.php';

            } else {
                
                echo "No tweets"; 
            }  
        }
    }
    function likesTweetCount($tweetID){
        $tweetID = $this->connect()->escape_string($tweetID);

        if($tweetID > 0){
            $sql = "SELECT `tweet_id` FROM `tweets_likes` WHERE `tweet_id`='$tweetID';";

            $result = $this->connect()->query($sql);

            if($result->num_rows >= 0){

              return $result->num_rows;
            }
        }

    }
    function checkIfLikedTweet($tweetID, $userID){
        $tweetID = $this->connect()->escape_string($tweetID);
        $userID = $this->connect()->escape_string($userID);

        if(($userID > 0) && ($tweetID >0)){
            $sql = "SELECT `user_id` FROM `tweets_likes` WHERE `tweet_id`='$tweetID' AND `user_id`='$userID';";
            $result = $this->connect()->query($sql);

            if($result->num_rows > 0){

                return true;
            }

            return false;
        }
    }
    function likeTweet($tweetID, $userID, $option = 'like'){
        $tweetID = $this->connect()->escape_string($tweetID);
        $userID = $this->connect()->escape_string($userID);

        if(($userID > 0) && ($tweetID >0)){
            if($option == 'like') {
                $sql = "INSERT INTO `tweets_likes` (`tweet_id`, `user_id`) VALUES ('$tweetID', '$userID');";
            }

            if($option == 'unlike'){
                $sql = "DELETE FROM `tweets_likes` WHERE `tweet_id`='$tweetID' AND `user_id`='$userID';";
            }

            $query = $this->connect()->query($sql);

            if($query) {
                return true;
            }
        }

        return false;
    }
    function checkIfUserIsTweetAuthor($tweetID, $userID){
        $tweetID = $this->connect()->escape_string($tweetID);
        $userID = $this->connect()->escape_string($userID);

        if ( ($tweetID > 0) ) {
            $sql = "SELECT `id` FROM `tweets` WHERE `id`='$tweetID' AND `user_id`='$userID';";

            $result = $this->connect()->query($sql);

            if($result->num_rows > 0){

                return true;
            }
        }

        return false;
    }

    function deleteTweet($tweetID, $userID){
        $tweetID = $this->connect()->escape_string($tweetID);
        $userID = $this->connect()->escape_string($userID);

        if($this->checkIfUserIsTweetAuthor($tweetID, $userID) == true){
            $sql = "DELETE FROM `tweets` WHERE `id`='$tweetID' AND `user_id`='$userID';";

           $result = $this->connect()->query($sql);

            return true;
        }

        return false;
    }

}
