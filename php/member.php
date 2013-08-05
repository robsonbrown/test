<?php
	include '/classes/user.php';
	include '/session/session_handler.php';
	include '/utilities/user_transaction_utilities.php';
	
	if(!isset($_SESSION)) 
	{ 
		session_start();
	} 
	else if(isset($_POST['addFinance']))
	{
		$amount=$_POST['amount']; 
		$time=$_POST['time']; 
		$category=$_POST['category']; 
	
		insert_user_transaction( $amount, $time, $category );
	}
	
	check_session_state();
?>

<link rel="stylesheet" type="text/css" href="css/ui-lightness/jquery-ui-1.10.3.custom.css">
<link rel="stylesheet" type="text/css" href="css/member.css">
<script type="text/javascript" src="js/jquery-1.9.1.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.10.3.custom.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.10.3.custom.min.js"></script>
<script type="text/javascript" src="js/member.js"></script>
<script type="text/javascript" src="js/jquery.tools.min.js"></script>