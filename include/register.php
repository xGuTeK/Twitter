<?php

if($_SERVER["REQUEST_METHOD"] == "POST"){

	if(isset($_POST["email"]) && isset($_POST["pass"]) && isset($_POST["repass"])){
		$user->register($_POST["email"], $_POST["pass"], $_POST["repass"]);
	}
	
}
    