<?php

include_once($_SERVER['DOCUMENT_ROOT'].'/mysql/phpMysql.php');
include_once( 'user_transaction.php' );
include_once( 'user_direct_debit.php' );

class User
{	
	//-----------------------
	// 
	//------------------------
    public function set_user( $id_in, $user_name_in, $name_in, $password_in, $finance_total_in, $email_address_in, $full_setup_in ) {
        
		$this->id 					= $id_in;
		$this->user_name 			= $user_name_in;
		$this->name		 			= $name_in;
		$this->password 			= $password_in;
		$this->finance_total 		= $finance_total_in;
		$this->email_address  		= $email_address_in;
		$this->full_setup			= $full_setup_in;
    }
	
	//-----------------------
	// 
	//------------------------
	public function login_user( $user_name_in, $password_in )
	{
		$mysqlConnection = new Mysql;
		
		//sql injection checks
		$user_name_in 	= stripslashes($user_name_in);
		$password_in 	= stripslashes($password_in);
		//$user_name_in 	= mysql_real_escape_string($user_name_in);
		//$password_in 	= mysql_real_escape_string($password_in);
		
		//Add the core user information
		$query = "select * from user where user_name = '" . $user_name_in . "' and password = '" . md5($password_in) . "'";
		
		if( !$mysqlConnection->mysql_select( $query, "user select", 1, $result ) )
		{
			return false;
		}
		
		$row = mysqli_fetch_array($result);
		$this->set_user( $row['ID'], $row['user_name'], $row['name'], $row['password'], $row['finance_total'], $row['email_address'], $row['full_setup'] );
		
		
		//Now add in the user transactions.  TODO: This may need to be split out
		$query = "select * from user_transaction where user_id = " . $this->id;
		
		if( !$mysqlConnection->mysql_select( $query, "user_transaction select", 0, $result ) )
		{
			return false;
		}
		
		while( $row = mysqli_fetch_array($result) )
		{
			$this->add_user_transaction( $row['ID'], $row['amount'], $row['time'], $row['category'] );
		}
		
		
		//Now add the direct debits
		$query = "select * from user_direct_debit where user_id = " . $this->id;
		
		if( !$mysqlConnection->mysql_select( $query, "user_direct_debit select", 0, $result ) )
		{
			return false;
		}
		
		while( $row = mysqli_fetch_array($result) )
		{
			$this->add_direct_debit( $row['ID'], $row['amount'], $row['start_date'], $row['recourrance_type'], $row['end_date'], $row['category'] );
		}
		
		return true;
	}
	
	//-----------------------
	// 
	//------------------------
	public function add_direct_debit( $id_in, $amount_in, $start_date_in, $reocurrance_type_in, $end_date_in, $category_in )
	{		
		$transaction = new UserDirectDebit;
		
		$transaction->set_user_direct_debit( $id_in, $this->get_id(), $amount_in, $start_date_in, $reocurrance_type_in, $end_date_in, $category_in );
		
		array_push($this->user_direct_debits, $transaction);
	}

	//-----------------------
	// 
	//------------------------
	public function create_new_user()
	{		
		//Insert the new user into the database.
		$mysqlConnection = new Mysql;
		
		$query = "INSERT INTO user (user_name, name, password, finance_total, email_address, full_setup) ";
		
		$values = array( $this->user_name, $this->name, $this->password, $this->finance_total, $this->email_address, 0 );
		
		$queryDescription = "Insert User";
		
		if( $mysqlConnection->mysql_insert( $query, $values, $queryDescription ) )
		{
			//Launch the initial user session so the user can jump straight into the app.
			session_start();
			$this->login_user( $this->first_name, $this->password );
			$_SESSION["user"] = $this;
			
			header("location:/member.php");
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
		//debug( $id_in . " id ended " . $amount_in . " amount ended " . $time_in . " time ended " . $category_in . " category ended" );
		$transaction = new UserTransaction;
		$transaction->set_user_transaction( $id_in, $this->get_id(), $amount_in, $time_in, $category_in );
		
		array_push($this->user_transactions, $transaction);
	}
	
	//-----------------------
	// 
	//------------------------
	public function get_user_transactions()
	{
		return $this->user_transactions;
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
	
	//-----------------------
	//  
	//------------------------
	public function get_finance_total()
	{
		return $this->finance_total;
	}
	
	//-----------------------
	//  
	//------------------------
	public function get_full_setup()
	{
		return $this->full_setup;
	}
	
	//-----------------------
	//  
	//------------------------
	public function complete_full_setup( $new_finance_total )
	{
		if( !$this->full_setup )
		{
			//Insert the new user into the database.
			$mysqlConnection = new Mysql;
			
			$column_headers = array( "finance_total", "full_setup" );
			$values = array( $new_finance_total, true );
			
			$queryDescription = "User full setup";
			
			if( $mysqlConnection->mysql_update( "user", $column_headers, $values, "ID", $this->get_id(), $queryDescription ) )
			{				
				//Updated the local finance total
				$this->finance_total = $new_finance_total;
				$this->full_setup = true;
				
				return true;
			}
			
			return false;
		}
	}
	
	//-----------------------
	// This will update a users finance total adding / removing a new financial amount.
	//------------------------
	public function update_finance_total( $amount )
	{
		$new_total = $this->finance_total + $amount;
	
		//Insert the new user into the database.
		$mysqlConnection = new Mysql;
		
		$column_headers = array( "finance_total" );
		
		$values = array( $new_total );
		
		$queryDescription = "Update User finance total";
		
		if( $mysqlConnection->mysql_update( "user", $column_headers, $values, "ID", $this->get_id(), $queryDescription ) )
		{		
			//Updated the local finance total
			$this->finance_total = $new_total;
			
			return true;
		}
		
		return false;
	}
	
	
	// property declaration
    protected $id 			 			= 0;
	protected $user_name	 			= '';
	protected $name	 					= '';
	protected $password 	 			= '';
	protected $finance_total 			= 0;
	protected $email_address 			= '';
	protected $full_setup				= 0;
	
	protected $user_transactions 		= array();
	protected $user_direct_debits 		= array();
}

?>