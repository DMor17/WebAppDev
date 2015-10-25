<?php 
	include_once("config/config.php");
	
		if ($_SESSION["loggedIn"]){
			//stay here at reader-index
		} else {
			header( 'Location: index.php' ); //if not logged in go here
		}
		if ($_SESSION["privilege"] == 1 ){ //if account type author
			header( 'Location: author-index.php' );
		}	else if ($_SESSION["privilege"] == 2 ){
			header( 'Location: admin-index.php' ); //if account type admin
		}
		
?>
<!DOCTYPE html>
<html>
<head>
	<title>Adventure Blog | Reader Home</title>
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
					Welcome <a href="reader-account.php"><?php echo $_SESSION['firstname'];?></a>
						<!--Logout Button-->
						<input type="button" name="logout"  value="Logout" onclick="location.href='logout.php'" class="button-round"/>
					</form>
					
				</div>
		</div>
			
		<div class="header-image">
			<h1>Discussion Board.</h1>
			<h2>A community to share your adventures with no matter your current location.</h2>
			<h3>Use the search bar below to search by tag.</h3>
			
			<form method="post" action="">
			
				<div class="center-round">
					<input type="text" maxlength="30" value="Search..." onclick="this.value='';" autofocus name="searchText" class="search-round" required/>
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
	

	?>