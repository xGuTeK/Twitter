<?php
if ( isset($_POST["newTweetText"]) && !empty($_POST["newTweetText"]) )
{
    $tweetText = $db->connect()->escape_string($_POST['newTweetText']);
    $tweet->newTweet($user->getEmail(), $tweetText);


}

if(isset($_GET['act']) && $_GET['act'] == 'showTweet'){
    if(isset($_GET['userID']) && $_GET['userID']){
        if(isset($_GET['tweetID']) && ($_GET['tweetID'] >0)){
            $userID = $db->connect()->escape_string($_GET['userID']);
            $tweetID = $db->connect()->escape_string($_GET['tweetID']);
            $tweet->showTweet($userID, $tweetID);
            $comment->getComments($tweetID);
        }
    }
}