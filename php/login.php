<?php
	if(!isset($_SESSION)) 
	{ 
		session_start();
	} 
	
	//Check to see if there's already a user session, if there is, take them to the members area
	if(isset($_SESSION['user']))
	{
		header("location:/test/member.php");
	}
?>


<link rel="stylesheet" type="text/css" href="css/ui-lightness/jquery-ui-1.10.3.custom.css">
<link rel="stylesheet" type="text/css" href="css/member.css">
<script type="text/javascript" src="js/jquery-1.9.1.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.10.3.custom.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.10.3.custom.min.js"></script>
<script type="text/javascript" src="js/index.js"></script>
<script type="text/javascript" src="js/jquery.tools.min.js"></script>