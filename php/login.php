<link rel="stylesheet" type="text/css" href="css/ui-lightness/jquery-ui-1.10.3.custom.css">
<link rel="stylesheet" type="text/css" href="css/member.css">
<script type="text/javascript" src="js/jquery-1.9.1.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.10.3.custom.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.10.3.custom.min.js"></script>
<script type="text/javascript" src="js/pages/index.js"></script>
<script type="text/javascript" src="js/functions/list_functions.js"></script>
<script type="text/javascript" src="js/functions/jquery.tools.min.js"></script>


<?php
	include_once($_SERVER['DOCUMENT_ROOT'].'/phpConsole.php');
	include_once($_SERVER['DOCUMENT_ROOT'].'/mysql/phpMysql.php');

	PhpConsole::start(true, true, dirname(__FILE__));
	
	debug('Checking login status');
	
	if(!isset($_SESSION)) 
	{ 
		session_start();
	} 
	
	//We're going to check there's a database to connect to, if there isn't we're going to flag an error and allow the database to be created.
	$mysqlConnection = new Mysql;
	
	if( !$mysqlConnection->checkDatabaseConnection() )
	{
		debug('Database not found');
		header("location:/mysql/createDatabase.php");
	}
	else
	{
		debug('Database found');
	}
	
	//Check to see if there's already a user session, if there is, take them to the members area
	if(isset($_SESSION['user']))
	{
		debug('User session found, logging in');
		header("location:/member.php");
	}
?>