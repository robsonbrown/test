<?php
	include_once($_SERVER['DOCUMENT_ROOT'].'/phpConsole.php');
	include_once($_SERVER['DOCUMENT_ROOT'].'/classes/user.php');
	include_once($_SERVER['DOCUMENT_ROOT'].'/utilities/user_transaction_utilities.php');
	include_once($_SERVER['DOCUMENT_ROOT'].'/session/session_handler.php');
	
	PhpConsole::start(true, true, dirname(__FILE__));
	
	if(!isset($_SESSION)) 
	{ 
		session_start();
	} 
	
	if(isset( $_POST['head'] )) 
	{
		$header = $_POST['head'];
	
		if( $header == 'addFinance' )
		{				
			debug('Adding a financial transaction called.');
		
			$amount=$_POST['amount']; 
			$time=$_POST['time']; 
			$category=$_POST['category']; 
			
			//debug( 'amount is : ' . $amount . ' time is : ' . $time . ' category is : ' . $category );
		
			if( insert_user_transaction( $amount, $time, $category ) )
			{
				debug( 'passed!');
				echo 'passed';
			}
			else
			{
				echo 'false';
			}
		}
	}

	//check_session_state();
?>

