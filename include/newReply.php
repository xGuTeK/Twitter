<?php
if ( isset($_POST["newReplyText"]) && !empty($_POST["newReplyText"]) )
{
    $tweetText = $db->connect()->escape_string($_POST['newReplyText']);
    $tweetID = $db->connect()->escape_string($_POST['tweetID']);
    $comment->newComment($tweetID, $user->getEmail(), $tweetText);

}