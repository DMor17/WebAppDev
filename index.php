<!DOCTYPE html>
<html>
<head>
	<title>Adventure Blog Demo Test</title>
	<meta name="viewport" content="height=device-height, width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no, target-densitydpi=device-dpi" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>

<?php
			include_once("config/config.php");
		
								
				$con = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD );
				$sthandler = $con->prepare("SELECT * FROM users ORDER BY blogTime DESC");
				$sthandler->execute();

				while ($row = $sthandler->fetch(PDO::FETCH_ASSOC)){
				
							$postID = $row['postID'];
							$title = $row['title'];
							$post = $row['blogPost'];
							$blogTime = $row['blogTime'];
							
							?>
							
							<h1><?php echo $title;?></h1>
							<br>
							<br>
							<?php echo $blogTime;?>
							<br>
							<?php echo $post;?><br>
</body>
</html>
