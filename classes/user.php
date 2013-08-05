<?php

include_once($_SERVER['DOCUMENT_ROOT'].'/test/mysql/phpMysql.php');
include_once( 'user_transaction.php' );

class User
{	
	//-----------------------
	// 
	//------------------------
    public function set_user( $id_in, $user_name_in, $name_in, $password_in, $finance_total_in, $email_address_in ) {
        
		$this->id 				= $id_in;
		$this->user_name 		= $user_name_in;
		$this->name		 		= $name_in;
		$this->password 		= $password_in;
		$this->finance_total 	= $finance_total_in;
		$this->email_address  	= $email_address_in;
    }
	
	//-----------------------
	// 
	//------------------------
	public function login_user( $user_name_in, $password_in )
	{
		//sql injection checks
		$user_name_in 	= stripslashes($user_name_in);
		$password_in 	= stripslashes($password_in);
		$user_name_in 	= mysql_real_escape_string($user_name_in);
		$password_in 	= mysql_real_escape_string($password_in);

		$mysqlConnection = new Mysql;
		
		//Add the core user information
		$query = "select * from user where user_name = '" . $user_name_in . "' and password = '" . md5($password_in) . "'";
		
		//echo "selecting user</br>";
		
		if( !$mysqlConnection->mysql_select( $query, "user select", 1, $result ) )
		{
			return false;
		}
		
		$row = mysqli_fetch_array($result);
		$this->set_user( $row['ID'], $row['user_name'], $row['name'], $row['password'], $row['finance_total'], $row['email_address'] );
		
		
		//Now add in the user transactions.  TODO: This may need to be split out
		$query = "select * from user_transaction where user_id = " . $this->id;
		
		if( !$mysqlConnection->mysql_select( $query, "user_transaction select", 0, $result ) )
		{
			return false;
		}
		
		while( $row = mysqli_fetch_array($result) )
		{
			$this->add_user_transaction( $row['ID'], $row['user_id'], $row['amount'], $row['time'], $row['category'] );
		}
		
		
		//Now add the direct debits
		$query = "select * from user_direct_debit where user_id = " . $this->id;
		
		if( !$mysqlConnection->mysql_select( $query, "user_direct_debit select", 0, $result ) )
		{
			return false;
		}
		
		while( $row = mysqli_fetch_array($result) )
		{
			$this->add_user_transaction( $row['ID'], $row['user_id'], $row['amount'], $row['time'], $row['category'] );
		}
		
		return true;
	}

	//-----------------------
	// 
	//------------------------
	public function create_new_user()
	{		
		//Insert the new user into the database.
		$mysqlConnection = new Mysql;
		
		$query = "INSERT INTO user (user_name, name, password, finance_total, email_address) ";
		
		$values = array( $this->user_name, $this->name, $this->password, $this->finance_total, $this->email_address );
		
		$queryDescription = "Insert User";
		
		if( $mysqlConnection->mysql_insert( $query, $values, $queryDescription ) )
		{
			//Launch the initial user session so the user can jump straight into the app.
			session_start();
			$this->login_user( $this->first_name, $this->password );
			$_SESSION["user"] = $this;
			
			header("location:/test/member.php");
		}
	}
	
	protected function validate_new_user_information()
	{
		return true;
	}
	
	//-----------------------
	// To add a user_transaction to the user array (Not an insert into the database)
	//------------------------
	public function add_user_transaction( $id_in, $amount_in, $time_in, $category_in )
	{
		$transaction = new UserTransaction;
		$transaction->set_user_transaction( $id_in, $this->get_id(), $amount_in, $time_in, $category_in );
		
		array_push($this->user_transactions, $transaction);
	}
	
	//-----------------------
	// 
	//------------------------
	public function get_user_transactions()
	{
		return $user_transactions;
	}
	
	//-----------------------
	// 
	//------------------------
	public function get_user_transaction_by_id( $user_transaction_id )
	{
		for( $i = 0; $i < count($this->user_transactions); $i++ )
		{
			if( $this->user_transactions[$i]->get_id() == $user_transaction_id )
			{
				return $this->user_transactions[$i];
			}
		}
		
		return null;
	}
	
	//-----------------------
	// 
	//------------------------
	public function get_name()
	{
		return $this->name;
	}
	
	//-----------------------
	// 
	//------------------------
	public function get_id()
	{
		return $this->id;
	}
	
	// property declaration
    protected $id 			 			= 0;
	protected $user_name	 			= '';
	protected $name	 					= '';
	protected $password 	 			= '';
	protected $finance_total 			= 0;
	protected $email_address 			= '';
	
	protected $user_transactions 		= array();
	protected $user_direct_debits 		= array();
}

?>