<?php
	include_once($_SERVER['DOCUMENT_ROOT'].'/phpConsole.php');
	include_once($_SERVER['DOCUMENT_ROOT'].'/classes/user.php');
	include_once($_SERVER['DOCUMENT_ROOT'].'/utilities/transaction_utilities.php');
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
		
		check_session_state();
		
		$json = json_encode(array( 'finance_total' => $user->get_finance_total(), 'full_setup' => $user->get_full_setup() ) );
		
		echo $json;
	}
	
	//-------------------
	// Loads the list Panel with transactions data
	//--------------------
	if(isset( $_GET['transactionsListPanel'] ))
	{
		$user = $_SESSION['user'];
		check_session_state();
		
		$json = json_encode( $user->get_user_transactions() );
		
		echo $json;
	}
	
	
	//-------------------
	// Loads the list Panel with direct debit data
	//--------------------
	if(isset( $_GET['directDebitListPanel'] ))
	{
		$user = $_SESSION['user'];
		check_session_state();
		
		$json = json_encode( $user->get_user_direct_debits() );
		
		echo $json;
	}
	
	
		//-------------------
	// Loads the list Panel with direct debit data
	//--------------------
	if(isset( $_GET['targetListPanel'] ))
	{
		$user = $_SESSION['user'];
		check_session_state();
		
		$json = json_encode( $user->get_user_targets() );
		
		echo $json;
	}
	
	
	//-------------------
	// Post back functions
	//--------------------
	if(isset( $_POST['head'] )) 
	{
		$header = $_POST['head'];
		
		debug( $header . ' called.');
		
		
		switch( $header )
		{
			//-------------------
			// Post function for the set initial funds total option
			//-------------------
			case 'setInitialFinance':
			{
				$total=$_POST['total']; 
			
				$user = $_SESSION['user'];
			
				if( !$user->complete_full_setup( $total ) )
				{
					echo false;
				}
			}
			break;
			//-------------------
			// Post function for the add transaction option
			//-------------------
			case 'addFinance':
			case 'removeFinance':
			{
				$values=$_POST['array'];
			
				$amount = $values[0];
				$time = $values[1];
				$category = $values[2]; 
				
				if( $header == 'addFinance' )
				{
					$type = UserTransaction::TT_ADDITION;
				}
				else
				{
					$type = UserTransaction::TT_WITHDRAWAL;
				}
				
				$user = $_SESSION['user'];
				
				if( !$user->insert_user_transaction( $amount, $time, $category, $type ) )
				{
					echo false;
				}
			}
			break;
			//-------------------
			// Post function for the add target option
			//-------------------
			case 'addTarget':
			{
				$values=$_POST['array'];
				
				$amount = $values[0];
				$target_date = $values[1];
				$category = $values[2]; 
				$name = $values[3]; 
				
				$user = $_SESSION['user'];
				
				if( $user->insert_target_transaction( $amount, $target_date, $category, $name ) )
				{
					echo false;
				}
			}
			break;
			//-------------------
			// Post function for the add target option
			//-------------------
			case 'addDirectDebit':
			{
				$values=$_POST['array'];
				
				$amount = $values[0];
				$start_date = $values[1];
				$end_date = $values[2]; 
				$recourrance_type = $values[3]; 
				$category = $values[4]; 
				
				$user = $_SESSION['user'];
			
				if( $user->insert_direct_debit_transaction( $amount, $start_date, $end_date, $recourrance_type, $category ) )
				{
					echo false;
				}
			}
			break;
			default:
			echo false;
			break;
		}
		
		echo true;
	}

	check_session_state();
?>

