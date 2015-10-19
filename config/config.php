<?php
    //set off all error report
	error_reporting(E_ALL);
	//define constants database username and pass
    define( "DB_DSN", "mysql:host=us-cdbr-azure-central-a.cloudapp.net;dbname=DB_WebAppDev" );
    define( "DB_USERNAME", "b9e8fe48954215" );
    define( "DB_PASSWORD", "934095f4" );
	define( "CLS_PATH", "class" );
	
	//classes path
	include_once( CLS_PATH . "/user.php" );
	

?>

