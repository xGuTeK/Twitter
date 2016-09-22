<?php
session_start();

require_once '../classes/MysqlConn_class.php';
require_once '../classes/User_class.php';

$db = new DB();
$user = new User();

$user->login('gutek@gmail.com', 'da39a3ee5e6b4b0d3255bfef95601890afd80709');


if(isset($_SESSION["email"]) && !empty($_SESSION["email"]) ){ //&& $user->isMyProfile($_SESSION["email"]) == true
	if(isset($_FILES["editProfilePhotoFile"]["type"])){

		$validextensions = array("jpeg", "jpg");
		$temporary = explode(".", $_FILES["editProfilePhotoFile"]["name"]);
		$file_extension = end($temporary);
		$file_max_size = 307200; // 300kb

		$file["name"] = md5($user->getLogin()).'.'.$file_extension; //nie dziala 
		$file["tmp_name"] = $_FILES["editProfilePhotoFile"]["type"];
		$file["type"] = $_FILES["editProfilePhotoFile"]["type"];
		$file["size"] = $_FILES["editProfilePhotoFile"]["size"];
		$file["error"] = $_FILES["editProfilePhotoFile"]["error"];
		$_FILES["editProfilePhotoFile"]["name"] = 'test.jpg';	
		
		$uploadDir = $_SERVER["DOCUMENT_ROOT"]."/Twitter/upload/";
		$uploadProfileDir = $_SERVER["DOCUMENT_ROOT"]."/Twitter/upload/profile/";
		
		if ((($file["type"] == "image/jpg") || ($file["type"] == "image/jpeg")) && ($file["size"] <= $file_max_size) && in_array($file_extension, $validextensions)) {

			if ($file["error"] > 0){
				echo "Return Code: " . $file["error"] . "<br/><br/>";
			} else {
				
				if(!is_dir($uploadDir)) // upload dir
					mkdir($uploadDir);	
				
				if(!is_dir($uploadProfileDir)) // upload/profile dir
					mkdir($uploadProfileDir);
				
				if (file_exists($uploadProfileDir . $file["name"])) {
					echo $_FILES["editProfilePhotoFile"]["name"] . " <span id='invalid'><b>already exists.</b></span> ";
				} else {
					$sourcePath = $_FILES['editProfilePhotoFile']['tmp_name']; // Storing source path of the file in a variable
					$targetPath = $uploadProfileDir . $_FILES["editProfilePhotoFile"]["name"]; // Target path where file is to be stored
						move_uploaded_file($sourcePath,$targetPath) ; // Moving Uploaded file
						echo "<span id='success'>Image Uploaded Successfully...!!</span><br/>";
						echo "<br/><b>File Name:</b> " . $_FILES["editProfilePhotoFile"]["name"] . "<br>";
						echo "<b>Type:</b> " . $_FILES["editProfilePhotoFile"]["type"] . "<br>";
						echo "<b>Size:</b> " . ($_FILES["editProfilePhotoFile"]["size"] / 1024) . " kB<br>";
						echo "<b>Temp file:</b> " . $_FILES["editProfilePhotoFile"]["tmp_name"] . "<br>";
				}
			}
		} else {
			echo "<span id='invalid'>***Invalid file Size or Type***<span>";
		}
	}
}
