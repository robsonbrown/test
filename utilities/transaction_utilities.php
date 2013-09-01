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
//  Converts a number from a positive to a negative
//------------------------
function amount_negate( $amount )
{
	$amount = -$amount;

	return $amount;
}

?>