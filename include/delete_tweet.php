<?php

if ( isset($_GET['act']) && $_GET['act'] == 'deleteTweet' && isset($_GET['id']) && ($_GET['id'] > 0) ){

    $tweetID = $_GET['id'];

    var_dump( $tweet->deleteTweet($tweetID, $user->getEmail()) );

}