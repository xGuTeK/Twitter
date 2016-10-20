<?php
session_start();
require_once 'classes\MysqlConn_class.php';
require_once 'classes\User_class.php';
require_once 'classes\Tweet_class.php';
require_once 'classes\Comment_class.php';

$db = new DB();
$user = new User();

if($user->isLogged() == false){

	if(isset($_GET["act"])){
		switch($_GET["act"]){
			case "login":
				include_once 'include\login.php';
				break;
			case "register":
				include_once 'include\register.php';
				break;
            default:
                include 'include\index_notlogged.php';
		}
	} else {
        include 'include\index_notlogged.php';
    }
} else {

    $user->loadDataFromDb($_SESSION["email"], "login");
    $tweet = new Tweet();
    $comment = new Comments();

    if(isset($_GET["profile"])){
        $userid = $_GET["profile"];
        $user->loadDataFromDb($user->convertLoginToEmail($userid));

    } else {
        $userid = $user->getLogin();
    }

	if(isset($_GET["act"])){
		switch($_GET["act"]){
            case 'registerNextStepUpdate':
                include_once 'include\register_nextStepUpdate.php';
                break;
            case 'checkLogin':
            case "registerStepTwo":
                include_once 'include\register_steptwo.php';
                break;
            case "editphoto":
				include_once 'include\views\edit_profile_photo.php';
				break;
            case "photoupload":
                include_once 'include\edit_profile_photo.php';
                break;
            case 'tweet':
                include_once 'include\tweet.php';
                break;
            case 'showTweet':
                include_once 'include\tweet.php';
                break;
            case 'unfollow':
            case 'follow':
                include_once 'include\follow.php';
                break;
            case 'newReply':
                include_once 'include\newReply.php';
                break;
            case 'search':
                include_once 'include\search.php';
                break;
            case 'logout':
                $user->logout();
                header("Location: index.php");
                break;
		}
	} else {
        include 'include\index_logged.php';
    }
	
}
$db->disconnect();
