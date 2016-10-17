<?php

class Comments extends Tweet
{

    const commentMinSize = 1;
    const commentMaxSize = 140;
    private $commentText;
    


    function setCommentText($commentText) {
        if( (strlen($commentText) >= self::commentMinSize) && (strlen($commentText) <= self::commentMaxSize) ){
            $this->commentText = $commentText;
            
            return true;
        }
    }    


    public function newComment($tweet_id, $user_id, $commentText) {

        if ($this->setUser_id($user_id) == true) {
            if ($this->setCommentText($commentText) == true) {

                $sql = "INSERT INTO `comments` (`tweet_id`, `user_id`, `comment_text`, `comment_date`) VALUES ('$tweet_id', '$user_id', '$commentText', '" . date('Y-m-d H:i:s') . "');";
                $result = $this->connect()->query($sql);

            } else {
                echo 'Comment must contain between '.self::commentMinSize.' and '.self::commentMaxSize.' characters.';
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

            include('./include/views/comments.php');

        }

    }
        
        
    
    
    
    
    
    
    
}