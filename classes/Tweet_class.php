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

                    $tweetArr["text"] = $row["text"];
                    $tweetArr["date"] = $row["date"];
                }
                $result->free();

                return $tweetArr;
            }
        }

        //return false;
    }

    public function getTweets($user_id){
        
        if (!empty($user_id)) {
            
            $sql = "SELECT * FROM `tweets` WHERE `user_id` = '$user_id'"; //DODAC SORTOWANIE OD NAJNOWSZEGO
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

        if( $this->getTweet($userID) != false){

            foreach($this->getTweet($userID, $tweetID) as $tweet){
                echo '
						<div class="mytweet" id="'.$tweet['tweetID'].'" style="clear:both; ">
							<a href="index.php?profile='.$this->getTmp('login').'" class="tweetprofile"><div class="profile-small-photo" style="background-image: url(./upload/profile/'.$this->getTmp('photo').'); background-size: cover; background-repeat: no-repeat;"></div></a>
							<a class="tweet" href="#"><div>
								<p style="color:black; left: 5px; font-width: bold; width:100%;">'.ucfirst($this->getTmp('name')).' '.ucfirst($this->getTmp('surname')).'<small>@'.$this->getTmp('login').'</small></p><div style="align: right;">'.$tweet["date"].'</div>
								<p>'.$tweet["text"].'</p>
						    </div></a>
						</div>';
            }

        }

    }

    function showTweets($user_id){
        if( $this->getTweets($user_id) != false ){
            if(!empty($this->getTweets($user_id))){
                $this->loadDataFromDb($user_id);

                $lastTweet = end($this->getTweets($user_id));

                foreach($this->getTweets($user_id) as $tweet){
                    echo '
						<div class="mytweet" id="'.$tweet['tweetID'].'" style="clear:both; ">
							<a href="index.php?profile='.$this->getTmp('login').'" class="tweetprofile"><div class="profile-small-photo" style="background-image: url(./upload/profile/'.$this->getTmp('photo').'); background-size: cover; background-repeat: no-repeat;"></div></a>
							<a class="tweet" href="#"><div>
								<p style="color:black; left: 5px; font-width: bold; width:100%;">'.ucfirst($this->getTmp('name')).' '.ucfirst($this->getTmp('surname')).'<small>@'.$this->getTmp('login').'</small></p><div style="align: right;">'.$tweet["date"].'</div>
								<p>'.$tweet["text"].'</p>
						    </div></a>
						</div>';
                    if($tweet['tweetID'] != $lastTweet['tweetID']) {
                        echo '<hr style="position: relative; bottom: 0px; margin-top: 3px; clear:both;">';
                    }
                }
            } else { // brak tweetow
                
                echo "No tweets"; 
            }  
        }
    }
        
        
   

}
