<?php
include_once($_SERVER['DOCUMENT_ROOT'].'/classes/user.php');
include_once($_SERVER['DOCUMENT_ROOT'].'/classes/user_transaction.php');
include_once($_SERVER['DOCUMENT_ROOT'].'/mysql/phpMysql.php');

if(!isset($_SESSION)) 
{ 
	session_start();
} 

//------------------------
//  Adds a transaction for the user.
//------------------------
function insert_user_transaction( $amount, $time, $category )
{
	$user = $_SESSION['user'];
	
	//Let's add this shiz to the database..
	$mysqlConnection = new Mysql;
		
	$query = "INSERT INTO user_transaction (user_id, amount, time, category) ";
	
	$values = array( $user->get_id(), $amount, $time, $category );
	
	$queryDescription = "Insert user_transaction";
	
	if( $mysqlConnection->mysql_insert( $query, $values, $queryDescription ) )
	{
		//Now we need to select out that transaction to get the new id.
		$added_id = $mysqlConnection->select_most_recent_id( $user->get_id(), "user_transaction");

		//Finally, let's add it to the current session.
		$user->add_user_transaction( $added_id, $amount, $time, $category );
		
		$_SESSION['user'] = $user;
		
		return true;
	}
	
	return false;	
}

?>