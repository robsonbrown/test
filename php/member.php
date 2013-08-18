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
	
	//-------------------
	// Loads the current funds box for the user
	//--------------------
	if(isset( $_GET['funds'] ))
	{
		$user = $_SESSION['user'];
		
		$json = json_encode(array( 'finance_total' => $user->get_finance_total(), 'full_setup' => $user->get_full_setup() ) );
		
		echo $json;
	}
	
	//-------------------
	// Post back functions
	//--------------------
	if(isset( $_POST['head'] )) 
	{
		$header = $_POST['head'];
	
		//-------------------
		// Post function for the set initial funds total option
		//-------------------
		if( $header == 'setInitialFinance' )
		{
			$total=$_POST['total']; 
			
			$user = $_SESSION['user'];
		
			if( $user->complete_full_setup( $total ) )
			{
				//debug( 'passed!');
				echo true;
			}
			else
			{
				echo false;
			}
			
		}
	
		//-------------------
		// Post function for the add transaction option
		//-------------------
		else if( $header == 'addFinance' || $header == 'removeFinance' )
		{				
			//debug( $header . ' called.');
		
			$amount=$_POST['amount']; 
			$time=$_POST['time']; 
			$category=$_POST['category']; 
			
			if( $header == 'addFinance' )
			{
				$type = UserTransaction::TT_ADDITION;
			}
			else
			{
				$type = UserTransaction::TT_WITHDRAWAL;
			}
			
			//debug( 'amount is : ' . $amount . ' time is : ' . $time . ' category is : ' . $category );
		
			if( insert_user_transaction( $amount, $time, $category, $type ) )
			{
				//debug( 'passed!');
				echo true;
			}
			else
			{
				echo false;
			}
		}
	}

	//check_session_state();
?>

