<?php
include_once($_SERVER['DOCUMENT_ROOT'].'/classes/user.php');
include_once($_SERVER['DOCUMENT_ROOT'].'/classes/user_transaction.php');
include_once($_SERVER['DOCUMENT_ROOT'].'/phpConsole.php');

if(!isset($_SESSION)) 
{ 
	session_start();
}

if(isset( $_POST['head'] )) 
{
	$header = $_POST['head'];
	
	PhpConsole::start(true, true, dirname(__FILE__));

	if( $header == 'login' )
	{	
		debug('login called');
	
		// username and password sent from form 
		$username=$_POST['username']; 
		$password=$_POST['password']; 
		
		$user = new User();
		
		if( $user->login_user( $username, $password ) )
		{
			debug('login passed');
			
			// Register $myusername, $mypassword and redirect to file "login_success.php"
			$_SESSION["user"] = $user;
			
			echo "passed";
		}
		else 
		{
			debug('login failed');
			echo "false";
		}
	}
	else if( $header == 'signUp' )
	{
		debug('signUp called');
	
		$username=$_POST['username']; 
		$name=$_POST['name']; 
		$password=$_POST['password']; 
		$finance=$_POST['finance']; 
		$email=$_POST['email']; 
		
		$user = new User();
		$user->set_user( -1, $username, $name, md5($password), $finance, $email );
		$user->create_new_user();
	}
	else if( $header == 'logout' )
	{
		debug("logout called");
		// Check to see if the logout button has been pressed.
		session_destroy();
		check_session_state();
	}
	else 
	{
		debug('Shouldnt have arrived to session handler maybe?');
	}
}

//------------------------
// Check current login / out session state
//------------------------
function check_session_state()
{
	$user = $_SESSION['user'];

	if(isset($_SESSION['user']))
	{
		$usert = new UserTransaction();
	
		$temp = $user->get_user_transaction_by_id(1);
		
		if($temp != null)
		{
			$temp2 = $usert->cast($temp);;
		}
	}
	else
	{
		debug( 'reloading' );
		header("location:/index.php");
	}
}

?>