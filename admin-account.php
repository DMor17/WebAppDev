<?php include_once("config/config.php");
?>
<?php
	error_reporting(E_ERROR);
?>

<?php
if ($_SESSION["loggedIn"]){
			$con = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
			$sthandler = $con->prepare("SELECT privilege, verified FROM users WHERE username = :username ");
			
			$sthandler->execute(array(':username'=>$_SESSION['username']));
			$row = $sthandler->fetch();

				$_SESSION['verified'] = $row['verified'];
				$_SESSION['privilege'] = $row['privilege'];
				
			if ($_SESSION["privilege"] == 0 ){ //if account type reader
				header( 'Location: reader-index.php' );
			}	else if ($_SESSION["privilege"] == 1 ){
				header( 'Location: author-index.php' ); //if account type author
			}   else if ($_SESSION["privilege"] == 2 ){
				 //if account type admin stay here
			} else {
				header( 'Location: index.php' );
			}
		}
?>

	
<!DOCTYPE html>
<html>
<head>
	<title>Adventure Blog | Admin</title>
	<link href="stylesheets/stylesheet-index.css" rel="stylesheet" type="text/css">
	<link rel="shortcut icon" href="images/icon.ico" > 
	<meta name="viewport" content="height=device-height, width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no, target-densitydpi=device-dpi" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<script src="js/scroll.js" type="text/javascript"></script>
</head>
    <body>
	<!-- Header with logo and login -->
		<div class="header">
			
				<img src="images/xplor.png"  class="xplor" alt=""/>
				<div class="login">
					<!--Form called 'post'-->
					<form method="post" action="">
						<?php if ($_SESSION["verified"] == 0){ ?>						
							Please await verification</a>
						<?php ; } else { ?> 				
							Welcome <a href="admin-account.php"><?php echo $_SESSION['firstname'];?></a>
						<?php ; } ?>
						<!--Logout Button-->
						<input type="button" name="logout"  value="Logout" onclick="location.href='logout.php'" class="button-round"/>
					</form>
					
				</div>
		</div>
		
		<div class="container">
		
			<div align ="center"><b>Edit Users</b></div>
				<div class="border4">
				
					<form method="post" action="">
						<div class="text-padder2">
							<label>Enter Username to Promote to Admin</label><br>
							<input type="text" id="promoteUsername" maxlength="30" required name="promoteUsername"/>
						</div>	
						<div class="button-padder2">
							<input type="submit" name="promote" value="Promote" />
						</div>
					</form>
						
					<form method="post" action="">
						<div class="text-padder3"><br/>
							<label>Enter Username to Ban/Unban</label><br>
							<input type="text" id="banUsername" maxlength="30" required name="banUsername"/>
						</div>	<br/>
						<div class="button-padder2">
							<input type="submit" name="ban" value="Ban/Unban" />
						</div>
					</form>			
			</div> <!--border bans users etc-->
		
			
		<div class="postContainer">
		
			<div align ="center"><b>Make Post</b></div>
				<div class="border5">
			
					<form method="post" action="">
						<div class="text-padder2">
								<label>Enter Post Title</label><br>
									<input type="text" id="title" maxlength="30" required name="title"/>
						</div>
						<div class="text-padder3">
								<label>Enter Blog Post</label><br>
								<textarea rows="4" cols="50" input type="text" id="blogPost" required name="blogPost"> </textarea>
							<div class="button-padder3">
								<input type="submit" name="submitPost" value="Post Blog" />
							</div>
						</div>
								
							
					</form>	
				</div>
			</div>
			
			<div class="editContainer">
		
				<div align ="center"><b>Edit Post</b></div>
					<div class="border4">

						<form method="post" action="">
						<div class="text-padder2">
							<label>Enter Post Title to Edit</label><br>
							<!--JQUERY-->
							<div class="ui-widget">
								<input type="text" id="titleToEdit" maxlength="30" required name="titleToEdit"/>
							</div>
						</div>	
						<div class="button-padder2">
							<input type="submit" name="edit" value="Edit Post" />
						</div>
					</form>
						<form method="post" action="">
						<div class="text-padder3"><br/>
							<label>Enter Post title to Remove</label><br>
							<input type="text" id="deleteTitle" maxlength="30" required name="deleteTitle"/>
							
						</div>	<br/>
						<div class="button-padder2">
						<a href="admin-account.php" onclick="return confirm('Are you sure?')"><input type="submit" name="delete" value="Remove Post" /></a>
							
						</div>
					</form>
					
					</div>
			</div>
			<br>
			<br>			
		<div align ="center"><b>Registered Users</b></div>
		<table>
			  <tr>
				<td><b>UserID</b></td>
				<td><b>Username</b></td> 
				<td><b>Email</b></td>
				<td><b>Privilege</b></td>
				<td><b>Deactivated</b></td>
				<td><b>Banned</b></td>
			  </tr>
			
			<?php
			include_once("config/config.php");
					
				$con = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD );
				$sthandler = $con->prepare("SELECT * FROM users");
				$sthandler->execute();

				while ($row = $sthandler->fetch(PDO::FETCH_ASSOC)){
				
							$userID = $row['userID'];
							$username = $row['username'];
							$email= $row['email'];
							$privilege = $row['privilege'];
							$deactivated = $row['deactivated'];
							$banned = $row['banned'];
							
			?>
			  <tr>
				<td><?php echo $userID;?></td>
				<td><?php echo $username;?></td> 
				<td><?php echo $email;?></td>
				<td><?php echo $privilege;?></td>
				<td><?php echo $deactivated;?></td>
				<td><?php echo $banned;?></td>
			  </tr>
			
			
<?php
				}
?>			</table>

			<br>
			<br>			
			<div align ="center"><b>Blog Post Titles</b>
			<table>
				  <tr>
					<td><b>Blog Post ID</b></td>
					<td><b>Title</b></td> 

				  </tr>
				
				<?php
				include_once("config/config.php");
						
					$con = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD );
					$sthandler = $con->prepare("SELECT * FROM posts");
					$sthandler->execute();

					while ($row = $sthandler->fetch(PDO::FETCH_ASSOC)){
					
								$postID = $row['postID'];
								$postTitle = $row['title'];
								
				?>
				  <tr>
					<td><?php echo $postID;?></td>
					<td><?php echo $postTitle;?></td> 
				  </tr>
	<?php
					}
	?>			</table>
				</div>
				
							<br>
			<br>			
			<div align ="center"><b>Reported Comments</b>
			<table>
				  <tr>
				    <td><b>Post ID</b></td>
					<td><b>Comment ID</b></td>
					<td><b>Commenter Username</b></td> 
					<td><b>Reported Comment</b></td> 
				  </tr>
				
				<?php
				include_once("config/config.php");
						
					$con = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD );
					$sthandler = $con->prepare("SELECT * FROM comments WHERE report = 1");
					$sthandler->execute();

					while ($row = $sthandler->fetch(PDO::FETCH_ASSOC)){
					
								$commentID = $row['commentID'];
								$commenterUsername = $row['commenterUsername'];
								$comment = $row['_comment'];	
								$post= $row['postID'];	
				?>
				  <tr>
				    <td><?php echo $postID;?></td>
					<td><?php echo $commentID;?></td>
					<td><?php echo $commenterUsername;?></td> 
					<td><?php echo $comment;?></td> 
				  </tr>
	<?php
					}
	?>			</table>
				</div>

		</div>
			
    </body>
</html>

<?php 

	if( !(isset( $_POST['edit'] ) ) ) {
		} else {//if  edit post button was clicked
		
		$titleToEdit=$_POST['titleToEdit'];
		$_SESSION['titleToEdit'] = $_POST['titleToEdit'];
		
		$con = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
			$sthandler = $con->prepare("SELECT title, blogPost FROM posts WHERE title = :titleToEdit");
			$sthandler->execute(array(':titleToEdit'=>$titleToEdit));
			$row = $sthandler->fetch();
			
				$_SESSION['postTitle'] = $row['title'];
				$_SESSION['postBlog'] = $row['blogPost'];
			
			if( $row ) {
				header( 'Location: admin-EditPost.php');
			} else {
				echo 'Post title Does NOT Exist';//header( 'Location: admin-EditPost.php');
			}
		
		
				
		}
	
	if( !(isset( $_POST['delete'] ) ) ) {
		} else {//if  delete button was clicked
		
		$deleteTitle = $_POST['deleteTitle'];
		
		$con = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
			$sthandler = $con->prepare("DELETE FROM posts WHERE title = :deleteTitle");
			$sthandler->execute(array(':deleteTitle'=>$deleteTitle));
			$valid = $sthandler->fetch();
			
			if($valid) {
				header( 'Location: blogRemoved.php');
			} else {
				echo 'Post Removed';//header( 'Location: admin-EditPost.php');
			}
			
		
				
		}
		
	if( !(isset( $_POST['submitPost'] ) ) ) {
	} else {//if  post blog user button was clicked
		$usr = new Users;
		$usr->storeFormValues($_POST);

			echo $usr->createPost($_POST);
			
		}

	if( !(isset( $_POST['promote'] ) ) ) {
	} else {//if  promote user button was clicked
		$usr = new Users;
		$usr->storeFormValues($_POST);
		
	//Check if the promoteUsername exists
		$promoteUsername = ( $_POST['promoteUsername']);
		$con = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
		$sthandler = $con->prepare("SELECT username FROM users WHERE username = :promoteUsername");
		$sthandler->execute(array(':promoteUsername'=>$promoteUsername));
		if ( $sthandler->rowCount() > 0 ) {
			echo $usr->promote($_POST);
		}else{
			 header( 'Location: usernameError.php' ); //user doesnt exist
		}
	}

	if( !(isset( $_POST['ban'] ) ) ) {
	} else {//if  ban user name button was clicked
		$usr = new Users;
		$usr->storeFormValues($_POST);
		
	//Check if the promoteUsername exists
		$banUsername = ( $_POST['banUsername']);
		$con = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
		$sthandler = $con->prepare("SELECT username FROM users WHERE username = :banUsername");
		$sthandler->execute(array(':banUsername'=>$banUsername));
		if ( $sthandler->rowCount() > 0 ) {
			echo $usr->ban($_POST);
		}else{
			 header( 'Location: usernameError.php' ); //user doesnt exist
		}
	}

?>


