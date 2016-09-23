<?php
if($_SERVER["REQUEST_METHOD"] == 'POST'){
	if(isset($_POST["email"]) && isset($_POST["pass"])){
		
		$email = $_POST["email"];
		$pass = sha1($_POST["pass"]);
		
		$user->login($email, $pass);
	}
}



