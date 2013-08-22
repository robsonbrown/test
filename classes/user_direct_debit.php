<?php

class UserDirectDebit implements JsonSerializable
{	
	//-----------------------
	// 
	//------------------------
	public function set_user_direct_debit( $id_in, $user_id_in, $amount_in, $start_date_in, $reocurrance_type_in, $end_date_in, $category_in )
	{
		$this->id 			 		= $id_in;
		$this->user_id	 	 		= $user_id_in;
		$this->amount	 	 		= $amount_in;
		$this->start_date	 		= $start_date_in;
		$this->reocurrance_type	 	= $reocurrance_type_in;
		$this->end_date				= $end_date_in;
		$this->category				= $category_in;
	}
	
	//-----------------------
	// 
	//------------------------
	public function cast(UserTransaction $object) 
	{
       return $object;
    }
	
	//-----------------------
	// 
	//------------------------
	public function get_amount()
	{
		return $this->amount;
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
	public function jsonSerialize() 
	{
        return [
            'id' 					=> $this->id,
            'user_id' 				=> $this->user_id,
            'start_date' 			=> $this->amount,
			'start_date'			=> $this->start_date,
			'end_date' 				=> $this->end_date,
			'recourrance_type'		=> $this->category
        ];
    }
	
	// property declaration
	private $id 			 	 = 0;
	private $user_id	 	 	 = 0;
	private $amount	 	 		 = 0;
	private $start_date 	 	 = "";
	private $end_date 	 		 = "";
	private $reocurrance_type	 = 0;
	private $category 	 	 	 = 0;
}

?>