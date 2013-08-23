<?php

include 'phpMysql.php';

function createDatabase()
{		
	$mysqlConnection = new Mysql;
	
	//Create the database
	$mysqlConnection->createDatabase();
	
	createDatabaseTables( $mysqlConnection );
}

//------------------------
// Creates the core tables for the application.
//------------------------
function createDatabaseTables( $mysqlConnection )
{
	createUserTable( $mysqlConnection );
	createFinancialTransactionTable( $mysqlConnection );
	createDirectDebitTable( $mysqlConnection );
	
	//Create table transaction type
	//$sql= "CREATE TABLE pending_transactions(ID INT NOT NULL AUTO_INCREMENT, PRIMARY KEY (ID), name VARCHAR(30) NOT NULL )";
	//$mysqlConnection->mysql_create( $sql, "Finance table creation" );
}

//------------------------
// Creates the user table
//------------------------
function createUserTable( $mysqlConnection )
{
	// Create table User
	$sql="CREATE TABLE user(ID INT NOT NULL AUTO_INCREMENT, PRIMARY KEY (ID), user_name VARCHAR(30), name VARCHAR(50), password VARCHAR(100), finance_total DECIMAL(6,2), email_address VARCHAR(50), full_setup tinyint )";
	$mysqlConnection->mysql_create( $sql, "User table creation" );
}

//------------------------
// Create table financial_transaction
//------------------------
function createFinancialTransactionTable( $mysqlConnection )
{
	//Create table financial_transaction
	$sql= "CREATE TABLE user_transaction(ID INT NOT NULL AUTO_INCREMENT, PRIMARY KEY (ID), user_id INT NOT NULL, amount DECIMAL(5,2) NOT NULL, time DATETIME NOT NULL, category INT NOT NULL )";
	$mysqlConnection->mysql_create( $sql, "Finance table creation" );
}

//------------------------
// Create table direct_debits
//------------------------
function createDirectDebitTable( $mysqlConnection )
{
	//Create table financial_transaction
	$sql= "CREATE TABLE user_direct_debit(ID INT NOT NULL AUTO_INCREMENT, PRIMARY KEY (ID), user_id INT NOT NULL, amount DECIMAL(5,2) NOT NULL, start_date DATETIME NOT NULL, recourrance_type tinyint, end_date DATETIME, category INT NOT NULL )";
	$mysqlConnection->mysql_create( $sql, "Finance table creation" );
}

createDatabase();

?>