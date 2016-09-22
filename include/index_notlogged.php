 <!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8"> 
        <meta name="keywords" content="Twitter">
        <meta name="author" content="Adrian Tracz">  
        
        
        <link rel="stylesheet" href="./template/css/login.css">
		<link rel="stylesheet" href="./template/css/style.css">
		<script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
		<script type="text/javascript" src="./template/js/background.cycle.js"></script>
		<script type="text/javascript" src="http://messijs.github.io/MessiJS/javascripts/messi.js"></script>
		
        <script type="text/javascript">
            $(document).ready(function() {
                $("body").backgroundCycle({
                    imageUrls: [
                        './template/img/bg1.jpg',
                        './template/img/bg3.jpg',
			'./template/img/bg4.jpg',
			'./template/img/bg2.jpg'
                    ],
                    fadeSpeed: 1000,
                    duration: 6000,
                    backgroundSize: SCALING_MODE_COVER
                });
				
            });
        </script> 
		
        <title>Twitter</title>
    </head>

	<body>
		<div class="nav_top"></div>
		<div class="container">

			<div class="panel_index_message">

				<h1>Welcome to Twitter.</h1>

				<p>Connect with your friends � and other fascinating people. Get in-the-moment updates on the things that interest you. And watch events unfold, in real time, from every angle.</p>
			</div>
	
			<div class="panel_login">
				<div class="login-card">
					<h1>Sign in</h1><br>
					<form method="POST" id="loginForm">
						<input type="text" name="email" placeholder="e-mail">
						<input type="password" name="pass" placeholder="Password">
						<input type="submit" name="login" class="login login-submit" value="Login">
					</form>
   
					<div class="login-help">
						<a id="registerB" href="">Create New Account</a> � <a>Forgot Password</a>
					</div>
				</div>			
			</div>
			<div class="panel_register">
				<div class="register-card">
					<h1>Register</h1><br>
					<form action="index.php?act=register" method="POST" name="registerForm">
						<input type="text" name="user" placeholder="Username">
						<input type="email" name="email" placeholder="E-mail">
						<input type="password" name="pass" placeholder="Password">
						<input type="password" name="repass" placeholder="Re-Password">
						<input type="submit" name="Register" class="login login-submit" value="Register">
					</form>
    
					<div class="register-help">
						<a id="loginB">Login</a> � <a>Forgot Password</a>
					</div>
				</div>			
			</div>
		</div>
		<div class="footer"><p style="font-width: 40px">by Adrian Tracz</p></div>
		<script type="text/javascript" src="./template/js/index_form.js"></script> 
	</body>
</html>

