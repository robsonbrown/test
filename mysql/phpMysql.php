<?php

	include_once($_SERVER['DOCUMENT_ROOT'].'/phpConsole.php');
	
	PhpConsole::start(true, true, dirname(__FILE__));

	class Mysql
	{
		protected $host		="localhost"; // Host name 
		protected $username	="root"; // Mysql username 
		protected $password	=""; // Mysql password 
		protected $db_name	="financeDB"; // Database name 
		//$tbl_name	="members"; // Table name
	
		//------------------------
		// Mysql core connection function
		//------------------------
		private function mysqlConnect( &$status )
		{
			// Create connection
			$con=mysqli_connect( $this->host, $this->username, $this->password, $this->db_name );
		
			// Check connection
			if ( !$con )
			{
				echo "Failed to connect to MySQL: " . mysqli_connect_error();
				$status = $con->connect_errno;
			}
			else
			{				
				$status = true;
			}
			
			return $con;
			
		}
		
		//-----------------------
		// Mysql query running ability
		//------------------------
		protected function runMysql( $sql, $queryDescription )
		{
			$con = $this->mysqlConnect( $status );
		
			// Execute query
			if ( $result = mysqli_query($con,$sql) )
			{
				//echo "Query " . $queryDescription . " ran successfully." ;
			}
			else
			{
				echo "Error running: " . $queryDescription . " " . mysqli_error($con);
				echo "</br>The query that was run was : " . $sql;
			}
			
			$this->closeConnection($con);
			
			return $result;
		}
		
		//-----------------------
		// Mysql select queries method.
		//------------------------
		public function mysql_select( $sql, $queryDescription, $required_rows, &$result )
		{
			$result = $this->runMysql( $sql, $queryDescription );
			
			$count = $result->num_rows;
			
			if( !$required_rows || ( $count == $required_rows ) )
			{
				return true;
			}
			
			return false;
		}
		
		//-----------------------
		// Mysql create table queries method.
		//------------------------
		public function mysql_create( $sql, $queryDescription )
		{
			$result = $this->runMysql( $sql, $queryDescription );
		}
		
		//-----------------------
		// Mysql insert queries method.
		// $sql - The core query until the 'values' porition
		// $values - The values that need to be passed (In array format)
		//------------------------
		public function mysql_insert( $sql, $values, $queryDescription )
		{
			$query = $sql . "VALUES( ";

			for( $i = 0; $i < count($values); $i++ )
			{
				$query = $query . "'" . $values[$i] . "'";
					
				if( $i != ( count($values) -1) )
				{
					$query = $query . ", ";
				}
				else
				{
					$query = $query . " );";
				}
			}
			
			if( $this->runMysql( $query, $queryDescription ) )
			{
				return true;
			}
			
			return false;
		}
		
		//-----------------------
		// Mysql insert queries method.
		// $table - The table we're going to update
		// $column_names - An array of column names that are going to be updated
		// $values - An array of the values they're going to be updated to
		// $where_id - The id for the where call (for example where user = x)
		// $where_column - The column that needs to be 
		// $queryDescription - Description of the 
		//------------------------
		public function mysql_update( $table, $column_names, $values, $where_column, $where_id, $queryDescription )
		{
			$query = "UPDATE " . $table . " SET ";

			for( $i = 0; $i < count($column_names); $i++ )
			{
				$query = $query . " " . $column_names[$i] . "=" . $values[$i];
					
				if( $i != ( count($values) -1) )
				{
					$query = $query . ", ";
				}
				else
				{
					$query = $query . " where " . $where_column . "=" . $where_id . ";";
				}
			}
			
			//debug( $query );
			
			if( $this->runMysql( $query, $queryDescription ) )
			{
				return true;
			}
			
			return false;
		}
		
		//------------------------
		// 
		//------------------------
		public function mysql_insert_no_values( $sql, $queryDescription )
		{
			if( $this->runMysql( $sql, $queryDescription ) )
			{
				return true;
			}
		
			return false;
		}
		
		//------------------------
		// Mysql close connection
		//------------------------
		private function closeConnection($con)
		{
			mysqli_close($con);
		}
		
		//------------------------
		// Database creation.
		//------------------------
		public function createDatabase()
		{
			// Create database
			$sql="CREATE DATABASE " . $this->db_name;
			
			$con=mysqli_connect( $this->host, $this->username, $this->password, "test" );
					
			if (mysqli_query($con,$sql))
			{
				echo "Database my_db created successfully";
			}
			else
			{
				echo "Error creating database: " . mysqli_error($con);
			}
		}
		
		//------------------------
		// database connection check
		//------------------------
		public function checkDatabaseConnection()
		{
			$status = false;
		
			$con = $this->mysqlConnect( $status );
		
			if( $status )
			{
				return true;
			}
			else 
			{
				return false;
			}
		}
		
		//------------------------
		// 
		//------------------------
		public function select_most_recent_id( $user_id, $table )
		{
			$this->mysql_select( "SELECT id from " . $table . " WHERE user_id = " . $user_id . " ORDER BY ID DESC " . "LIMIT 1", "ID select for user", 1, $result );
			
			$row = mysqli_fetch_array($result);
			
			return $row['id'];			
		}
	}
?>