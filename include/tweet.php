<?php
if ( isset($_POST["newTweetText"]) && !empty($_POST["newTweetText"]) )
{
    $tweetText = $db->connect()->escape_string($_POST['newTweetText']);

    $tweet->newTweet($user->getEmail(), $tweetText);
}

