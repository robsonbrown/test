<?php

class UserTarget implements JsonSerializable
{	
	//-----------------------
	// 
	//------------------------
	public function set_user_target( $id_in, $user_id_in, $amount_in, $target_date_in, $category_in, $name_in )
	{
		$this->id 			 		= $id_in;
		$this->user_id	 	 		= $user_id_in;
		$this->amount	 	 		= $amount_in;
		$this->target_date	 		= $target_date_in;
		$this->category				= $category_in;
		$this->name	 				= $name_in;
	}
	
	//-----------------------
	// 
	//------------------------
	public function cast(UserTarget $object) 
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
			'amount'				=> $this->amount,
            'target_date' 			=> $this->target_date,
			'category'				=> $this->category,
			'name'					=> $this->name
        ];
    }
	
	// property declaration
	private $id 			 	 = 0;
	private $user_id	 	 	 = 0;
	private $amount	 	 		 = 0;
	private $target_date 	 	 = "";
	private $name	 	 		 = "";
	private $category 	 	 	 = 0;
}

?>