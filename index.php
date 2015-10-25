<?php 
	include_once("config/config.php");
?>
<!DOCTYPE html>
<html>
<head>
	<title>Adventure Blog | Home</title>
	<link href="stylesheets/stylesheet-index.css" rel="stylesheet" type="text/css">
	<link rel="shortcut icon" href="images/icon.ico" > 
	<meta name="viewport" content="height=device-height, width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no, target-densitydpi=device-dpi" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<script src="js/scroll.js" type="text/javascript"></script>
</head>
    <body>
		<div class="header">
			
				<img src="images/xplor.png"  class="xplor" alt=""/>
			
				<div class="login">
					<!--Form called 'post'-->
					<form method="post" action="">
						<!--Username--> 
						<input type="text" maxlength="30"  value="Username"  onclick="this.value='';" autofocus name="username" class="text-round" required />
						<!--Password-->
						<input type="password" maxlength="30" value="Password" onclick="this.value='';" name="password" class="text-round" required/>
						<!--Login button-->			
						<input type="submit" name="login" value="Sign In" class="button-round"/>
						<!--Register Button-->
						<input type="button" name="register"  value="Sign Up" onclick="location.href='register.php'" class="button-register-round"/>
					</form>
					
				</div>
		</div>
			
		<div class="header-image">
			<h1>Discussion Board.</h1>
			<h2>A community to share your adventures with no matter your current location.</h2>
			<h3>Use the search bar below to search by tag.</h3>
			
			<form method="post" action="">
			
				<div class="center-round">
					<input type="text" maxlength="30" value="Search..." onclick="this.value='';" autofocus name="searchText" class="search-round" required />
					<input type="image" src="images/search.png" id="search-image" name="search" width="20" height="20" />
				</div>
			</form>
			
		</div>
	
	<div class="container"> <div id="toContainer"></div>
		<div class="content">
			The blog will be here
		 </div>
				


    </body>
</html>
	<?php
	if( !(isset( $_POST['login'] ) ) ) {
		//not logged in
	} else {
		
		$usr = new Users;
		$usr->storeFormValues( $_POST );
		if( $usr->userLogin() ) { // if the user exists then

			
			$_SESSION["loggedIn"] = true;
			$_SESSION['username'] = $_POST['username'];
			$_SESSION['password'] = $_POST['password'];
			
			$rememberme=$_POST['rememberme'];
			$username = $_POST['username'];
			
			$con = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
			$sthandler = $con->prepare("SELECT userID, email, firstname, surname, privilege, verified FROM users WHERE username = :username");
			
			$sthandler->execute(array(':username'=>$username));
			$row = $sthandler->fetch();
			
				$_SESSION['userID'] = $row['userID'];
				$_SESSION['email'] = $row['email'];
				$_SESSION['firstname'] = $row['firstname'];
				$_SESSION['surname'] = $row['surname'];
				$_SESSION['privilege'] = $row['privilege'];
				$_SESSION['verified'] = $row['verified'];
				$_SESSION['privilege'] = $row['privilege'];
				
				
				$privilege = $_SESSION['privilege'];
				$verified = $_SESSION['verified'];
				
				//Code below not yet tested
				if (isset($_POST['rememberme'])) {
					// checkbox has been checked
					setcookie("username", $username, time()+7600);
				} // then exexute user type validation
				
				
					if($verified == 0 ) {//If account isnt verified, tell the user they have to wait
						echo '<h1>Account not yet activated.</h1><br> Please contact the site admin <a href=logout.php> Click Here </a> to return to the login page';
					} else if($privilege == 0){//user is reader
						header('Location: reader-index.php');
					} else if ($privilege == 1){//user is reader
						header('Location: author-index.php');
					} else if ($privilege == 2){//user is admin
						header('Location: admin-index.php');
					}
					
		} else {
			// incorrect username or password or dont have an account
			echo 'incorrect username or password. you may not have an account';
		}
	}

	?>