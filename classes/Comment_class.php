<?php

class Comments extends DB 
{
    
    private $tweet_id;
    private $user_id;
    private $commentText;
    
    const commentMinSize = 1;
    const commentMaxSize = 60;   
    
    
    function setUser_id($user_id) {
        if(!empty($user_id)){
        
            $userID = $this->connect()->escape_string($user_id);
        
            $sql = "SELECT `user_id` FROM `users` WHERE `user_id`='$userID'";
            $result = $this->connect()->query($sql);
        
            if($result->num_rows > 0){
                $this->user_id = $user_id;
                
                return true;
            } else {
            
                return false;          // no tweet with this id
            }   

        } else {
            
            return false; // tweet id is empty
        }        
    }    
    
    function setTweet_id($tweet_id) {
        if(!empty($tweet_id)){
        
            $tweetID = $this->connect()->escape_string($tweet_id);
        
            $sql = "SELECT `tweet_id` FROM `tweets` WHERE `tweet_id`='$tweetID'";
            $result = $this->connect()->query($sql);
        
            if($result->num_rows > 0){
                $this->tweet_id = $tweet_id;
                
                return true;
            } else {
            
                return false;          // no tweet with this id
            }   

        } else {
            
            return false; // tweet id is empty
        }
    }

    function setCommentText($commentText) {
        if( (strlen($commentText) >= $this->commentMinSize) && (strlen($commentText) <= $this->commentMaxSize) ){
            $this->commentText = $commentText;
            
            return true;
        }
    }    
    
    function getUser_id() {
        if(!empty($this->user_id)){
            
            return $this->user_id;
        }
    }    
    function getTweetID(){
        if(!empty($this->tweet_id)){
            
            return $this->tweet_id;
        }
    }
    
    
    
    public function newComment($tweet_id, $user_id, $commentText) {

        if ($this->setUser_id($user_id) == true) {
            if ($this->setCommentText($commentText) == true) {

                $sql = "INSERT INTO `comments` (`tweet_id`, `user_id`, `text`) VALUES ('$this->getTweetID()', $this->getUser_id()', '$this->getText()');";
                $result = $this->connect()->query($sql);
                
            } else {
                echo 'Comment must contain between '.$this->commentMinSize.' and '.$this->commentMaxSize.' characters.';
            }
        } else {
            echo "DB ERROR";
        }
    }    
    
    public function getComments($tweet_id){
        
        
        
        
    }
        
        
    
    
    
    
    
    
    
}