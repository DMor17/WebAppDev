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

<!--Database=DEV_WebAppDev_Database;
Data Source=br-cdbr-azure-south-a.cloudapp.net;
User Id=be5a658a3ddc73;
Password=0e4c7b9b-->