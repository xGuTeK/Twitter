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
            echo $sql;
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

        if( $this->getTweet($userID, $tweetID) != false){
            $this->loadDataFromDb($userID);
            foreach($this->getTweet($userID, $tweetID) as $tweet){
                /*
                echo '
						<div class="mytweet" id="'.$tweetID.'" style="clear:both; ">
							<a href="index.php?profile='.$this->getTmp('login').'" class="tweetprofile"><div class="profile-small-photo" style="background-image: url(./upload/profile/'.$this->getTmp('photo').'); background-size: cover; background-repeat: no-repeat;"></div></a>
							<a class="tweet" href="#"><div>
								<p style="color:black; left: 5px; font-width: bold; width:100%;">'.ucfirst($this->getTmp('name')).' '.ucfirst($this->getTmp('surname')).'<small>@'.$this->getTmp('login').'</small></p><div style="align: right;">'.$tweet["date"].'</div>
								<p>'.$tweet["text"].'</p>
						    </div></a>
						</div>';*/

                echo '<div class="zoomTweetHeader">
                            <a href="index.php?profile='.$this->getTmp('login').'" class="tweetprofile"><div class="profile-small-photo" style="background-image: url(./upload/profile/'.$this->getTmp('photo').');" background-size: cover; background-repeat: no-repeat;"></div></a>
                            <p class="zoomTweetName">'.ucfirst($this->getTmp('name')).' '.ucfirst($this->getTmp('surname')).'</p>
                                <span class="zoomTweetLogin">@'.$this->getLogin().'</span>';
                if ($this->isMyProfile($userID) == false){
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
		<img style="width: 27px; height: 27px" src="https://pbs.twimg.com/profile_images/729229049302749184/dR3WjBSO_normal.jpg" alt="medo nanna">
		<img style="width: 27px; height: 27px" src="https://pbs.twimg.com/profile_images/777207786354700288/HX7k-DiI_normal.jpg" alt="Mohammed Barzan.">
		<img style="width: 27px; height: 27px" src="https://pbs.twimg.com/profile_images/715736743933120512/r7_tNJBi_normal.jpg" alt="rosy1319">
		<img style="width: 27px; height: 27px" src="https://abs.twimg.com/sticky/default_profile_images/default_profile_6_normal.png" alt="Jan Schorling">
		<img style="width: 27px; height: 27px" src="https://pbs.twimg.com/profile_images/707187549396193284/rp7XrQt4_normal.jpg" alt="Ruby K.">
		<img style="width: 27px; height: 27px" src="https://pbs.twimg.com/profile_images/3223758993/579d07905d21f75c926f0c049a35915e_normal.jpeg" alt="Corelma Chamorro">
		<img style="width: 27px; height: 27px" src="https://pbs.twimg.com/profile_images/777544943380422656/b1fVbRH2_normal.jpg" alt="Ola">
		<img style="width: 27px; height: 27px" src="https://pbs.twimg.com/profile_images/774198825493889024/TmEx7FEU_normal.jpg" alt="Hamzea I. Awadat">
		<img style="width: 27px; height: 27px" src="https://pbs.twimg.com/profile_images/754585327541559296/R8q5grDD_normal.jpg" alt="José Diego Manzanera">
	</div>
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
							<a class="tweetLink" id="zoomTweetLink" href="javascript:void(0);" data-userID="'.$user_id.'" data-tweetID="'.$tweet['tweetID'].'"><div>
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
