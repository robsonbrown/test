<?php
include_once($_SERVER['DOCUMENT_ROOT'].'/classes/user.php');
include_once($_SERVER['DOCUMENT_ROOT'].'/classes/user_transaction.php');
include_once($_SERVER['DOCUMENT_ROOT'].'/mysql/phpMysql.php');
include_once($_SERVER['DOCUMENT_ROOT'].'/phpConsole.php');

if(!isset($_SESSION)) 
{ 
	session_start();
} 

PhpConsole::start(true, true, dirname(__FILE__));

//------------------------
//  Adds a transaction for the user.
//------------------------
function insert_user_transaction( $amount, $time, $category, $type )
{
	$user = $_SESSION['user'];
	
	//Let's add this shiz to the database..
	$mysqlConnection = new Mysql;
		
	$query = "INSERT INTO user_transaction (user_id, amount, time, category) ";
	
	//If the type is to withdraw the cash, make it a negative
	if($type == UserTransaction::TT_WITHDRAWAL )
	{
		if( $amount > 0 )
		{
			debug( $amount );
			$amount = amount_negate($amount);
			debug( $amount );
		}
	}
	
	$values = array( $user->get_id(), $amount, $time, $category );
	
	$queryDescription = "Insert user_transaction";
	
	if( $mysqlConnection->mysql_insert( $query, $values, $queryDescription ) )
	{	
		//Now we need to select out that transaction to get the new id.
		$added_id = $mysqlConnection->select_most_recent_id( $user->get_id(), "user_transaction");

		//Finally, let's add it to the current session.
		$user->add_user_transaction( $added_id, $amount, $time, $category, $type );
		
		$_SESSION['user'] = $user;
		
		//Now we're going to update the current finance value
		$user->update_finance_total( $amount );
		
		return true;
	}
	
	return false;	
}


//------------------------
//  Converts a number from a positive to a negative
//------------------------
function amount_negate( $amount )
{
	$amount = -$amount;

	return $amount;
}

?>