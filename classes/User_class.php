<?php

class User extends DB {
    private $userID;
    private $login;
    private $name;
    private $surname;
    private $email;
    private $pwd;
    private $profileImage;
    private $backgroundImage;
    private $TweetsCount;
    private $FollowersCount;
    private $FollowingCount;
    private $tmp;
   
	function phpAlert($msg){
		echo '<script type="text/javascript">alert("'.$msg.'");</script>';
	}
        
    function getEmail() {
        return $this->email;
    }
    
    function checkEmailExist($email){
        $email = $this->conn->escape_string($email);
        
        $sql = "SELECT * FROM `users` WHERE `email`='$email'";
        $result = $this->conn->query($sql);
        
        if($result->num_rows > 0){
            
            return true;
        } else {
            
            return false;
            
        }                    
    }
    function validateEmail($email){
        $sanitized_email = filter_var($email, FILTER_SANITIZE_EMAIL);
        if (filter_var($sanitized_email, FILTER_VALIDATE_EMAIL)) {
            
            return true;
        } else {
            
            return false;
        }
    }
    function setEmail($email) {
        if($this->validateEmail($email) == true){
            if($this->checkEmailExist($email) == true){
                $this->email = $this->connect()->escape_string($email);

                return true;
            } else {
                return false;
            }
        } else {
            
            return false;
        }
    }
    function getPwd() {
        return $this->pwd;
    }        
    function setPwd($pwd, $pwd2) {
        if ($pwd == $pwd2){
            
                $this->pwd = sha1($pwd);

        }
    }
    public function checkProfileInfo($userid){
        $userid = $this->connect()->escape_string($userid);
        
        $sql = "SELECT `name FROM `users` WHERE `id`='$userid';";
        
        $result = $this->connect()->query($sql);
        
        if ($result->num_rows < 0){
           
            $this->registerNextStep($userid);
        }
        
    }
    public function registerNextStep($userid){
        $userid = $this->connect()->escape_string($userid);
        
        
        
        
    }
    public function register($email, $pwd, $pwd2){
        if ($pwd === $pwd2){ 
            if((strlen($pwd) >= 4) && (strlen($pwd) <= 10)){
                if($this->setEmail($email) == true){
                   
                    $email = $this->conn->escape_string($this->email);
                    $pass = sha1($this->conn->escape_string($pwd));

                    $sql  = "INSERT INTO `users` (`email`, `password`) VALUES ('$email','$pass');";
                    $result = $this->conn->query($sql);
                    
                   echo $result ? 'Registration completed' : die("DB ERROR");
                  
                } else {
                    echo 'E-mail already use or wrong e-mail.';
                }
            } else {
                echo 'Password must be 4-10 characters.';
            }
        } else {
            echo "Passwords doesn't match.";
        }
    }
    
    public function login($email, $sha1Pwd){
        $email = $this->connect()->escape_string($email);
        $pass = $this->connect()->escape_string($sha1Pwd);
        

        $sql = "SELECT * FROM `users` WHERE `email`='$email' AND `password`='$pass';";
        $result = $this->connect()->query($sql);
        if($result->num_rows >0){
            $_SESSION['email'] = $email;

            $this->loadDataFromDb($email, "login");

            echo 'login';

        } else {
            echo 'Wrong e-mail or password.';
        }
        
    }
    
    public function autoLogin(){
        
        $this->login($_SESSION['email'], $_SESSION['pwd']);
    }
    
    public function logout(){
        $_SESSION['email'] = null;
        $_SESSION['pwd'] = null;
        
        session_destroy();
    }
    
    public function isLogged(){
        if(isset($_SESSION['email'])){
            return !is_null($_SESSION['email']);
        } else {
            return false;
        }
    }
    function getUserID() {
        return $this->userID;
    }

    function getLogin() {
        return $this->login;
    }

    function getName() {
        return $this->name;
    }

    function getSurname() {
        return $this->surname;
    }

    function setUserID($userID) {
        $this->userID = $userID;
    }

    function setLogin($login) {
        $this->login = $login;
    }

    function setName($name) {
        $this->name = $name;
    }

    function setSurname($surname) {
        $this->surname = $surname;
    }
	function setTmp($tmp){
		$this->tmp = $tmp;
		
	}

	function getTmp($value = ''){
		if($value == ''){
			
			return $this->tmp;
		} else {
			return $this->tmp[$value];
		}
	}
    
    //Profile Images
    
    function setProfileImage($profileImage) {
        $this->profileImage = $profileImage;
    }
    
    function getProfileImage() {
        return $this->profileImage;
    }

    function setBackgroundImage($backgroundImage) {
        $this->backgroundImage = $backgroundImage;
    }
           
    function getBackgroundImage() {
        return $this->backgroundImage;
    }
    
    //Profile Info
    
    function setTweetsCount($TweetsCount) {
        $this->TweetsCount = $TweetsCount;
    }

    function setFollowersCount($FollowersCount) {
        $this->FollowersCount = $FollowersCount;
    }

    function setFollowingCount($FollowingCount) {
        $this->FollowingCount = $FollowingCount;
    }
    

	
    function getTweetsCount() {
        return $this->TweetsCount;
    }

    function getFollowersCount() {
        return $this->FollowersCount;
    }

    function getFollowingCount() {
        return $this->FollowingCount;
    }
	function isMyProfile($login){
		//$email = $this->connect()->escape_string($email);
		if(strlen($login) > 0){
			if($login == $this->getLogin()){

				return true;
			} else {
			
				return false;
			}
		}
	}
	
	public function convertToUserId($value, $type = "login")
	{
		if(!empty($value)){
			$value =  $this->conn->escape_string($value);

            if($type == 'login') {
                $sql = "SELECT `id` FROM `users` WHERE `login`='$value';";
            } else if ($type == 'email') {
                $sql = "SELECT `id` FROM  `users` WHERE `email`='$value';";
            }
			$result = $this->connect()->query($sql);
			
			$row = $result->fetch_array(); 
				
			return $row["id"];
		} 
	}
	public function convertLoginToEmail($login)
	{
		if(!empty($login)){
			$login =  $this->conn->escape_string($login);
		
			$sql = "SELECT `email` FROM `users` WHERE `login`='$login';";
			$result = $this->connect()->query($sql);
			
			$row = $result->fetch_array(); 
				
			return $row["email"];
		} 	
	}

    public function userStats($user_id, $columnName, $option = '+'){
	    $user_id = $this->connect()->escape_string($user_id);
	    if($user_id > 0){

            $sql = "SELECT `$columnName` FROM `users_profile_stats` WHERE `id`='$user_id';";
            $result = $this->connect()->query($sql);
            $row = $result->fetch_array();
	        if($option == '+') {
                $value = $row[$columnName]+1;
            } else if ($option == '-'){
                $value = $row[$columnName]-1;
            }

            $sql = "UPDATE `users_profile_stats` SET `$columnName`='$value' WHERE `id`='$user_id';";
            $result = $this->connect()->query($sql);

        }
    }

	public function userFollow($user_id, $follow_id, $option = '')
    {
        $user_id = $this->connect()->escape_string($user_id);
        $follow_id = $this->connect()->escape_string($follow_id);
        if($user_id > 0 && $follow_id > 0) {

            $sql = "SELECT `user_id` FROM `user_follow` WHERE `user_id`='$user_id' AND `follow_id`='$follow_id';";

            $result = $this->connect()->query($sql);

            if($option == 'follow'){
                if($result->num_rows == 0) {

                    $sql = "INSERT INTO `user_follow` (`user_id`, `follow_id`, `follow_date`) VALUES ('$user_id', '$follow_id', '" . date('Y-m-d H:i:s') . "'); ";
                    $result = $this->connect()->query($sql);

                    $this->userStats($follow_id, 'Followers', "+");
                    $this->userStats($user_id, 'Following', "+");

                    return true;
                }
            } else if($option == 'unfollow'){

                $sql = "DELETE FROM `user_follow` WHERE `user_id`='$user_id' AND `follow_id`='$follow_id';";
                $result = $this->connect()->query($sql);

                $this->userStats($follow_id, 'Followers', "-");
                $this->userStats($user_id, 'Following', "-");

                return true;
            } else {

                return true;
            }
        }
    }
             
    public function loadDataFromDb($email, $option = ''){
        $email = $this->connect()->escape_string($email);
		$this->tmp = [];
		
        //Profile Info
        $sql = "SELECT `id`, `login`, `name`, `surname` FROM `users` WHERE `email`='$email';";

        $result = $this->connect()->query($sql);
        
        $row = $result->fetch_array();

		
        if($option == 'login'){
			$this->setUserID($row["id"]);
			$this->setLogin($row["login"]);
			$this->setName($row["name"]);
			$this->setSurname($row["surname"]);
            $this->setEmail($email);
		}
		$tmp['id'] = $row["id"];
		$tmp['login'] = $row["login"];
		$tmp['name'] = $row["name"];
		$tmp['surname'] = $row["surname"];
		$tmp['email'] = $email;
		
        //Profile Info Stats
        
        $sql = "SELECT `Tweets`, `Following`, `Followers` FROM `users_profile_stats` WHERE `id`='".$tmp["id"]."';";

        $result = $this->connect()->query($sql);
        $row = $result->fetch_array();
		
        
		
        if($option == 'login'){
			$this->setTweetsCount($row["Tweets"]);
			$this->setFollowingCount($row["Following"]);
			$this->setFollowersCount($row["Followers"]);
		}
		$tmp['tweets'] = $row["Tweets"];
		$tmp['following'] = $row["Following"];
		$tmp['followers'] = $row["Followers"];
		
		//Profile Images
		     
        $queryProfileImages = "SELECT `photo`, `background` FROM `users_profile_images` WHERE `id`='$email';";
        $result = $this->conn->query($queryProfileImages);
        $row = $result->fetch_array();
		
		if($option == 'login'){
			$this->setProfileImage($row["photo"]);
			$this->setBackgroundImage($row["background"]);
		}
		$tmp['photo'] = $row['photo'];
		$tmp['background'] = $row['background'];


        $this->setTmp($tmp);
		

    }
}

