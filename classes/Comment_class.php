<?php

class Comments extends Tweet
{

    const commentMinSize = 1;
    const commentMaxSize = 140;
    private $commentText;
    


    function setCommentText($commentText) {
        if( (strlen($commentText) >= $this->commentMinSize) && (strlen($commentText) <= $this->commentMaxSize) ){
            $this->commentText = $commentText;
            
            return true;
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
        $tweet_id = $this->connect()->escape_string($tweet_id);

        if($tweet_id > 0){

            $sql = "SELECT * FROM `comments` WHERE `tweet_id` = '$tweet_id';";

            $result = $this->connect()->query($sql);

            if($result->num_rows > 0){
                include('./include/views/comments.php');

            } else {

                echo '<p>There are no comments.</p>';
                
            }

        }

    }
        
        
    
    
    
    
    
    
    
}