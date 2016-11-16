<?php
if (isset($_GET['act']) && isset($_GET['id'])) {
    $tweetID = $_GET['id'];

    if ($tweetID > 0) {
        //like
        if ($_GET['act'] == 'like') {
            $tweet->likeTweet($tweetID, $user->getUserID(), "like");
        }
        //unlike
        if ($_GET['act'] == 'unlike') {
            $tweet->likeTweet($tweetID, $user->getUserID(), "unlike");
        }
    }
}