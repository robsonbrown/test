<?php

class UserTransaction implements JsonSerializable
{	
	//Transaction types
	const TT_WITHDRAWAL = 1;
	const TT_ADDITION   = 2;
	
	//-----------------------
	// 
	//------------------------
	public function set_user_transaction( $id_in, $user_id_in, $amount_in, $time_in, $category_in )
	{
		$this->id 			 = $id_in;
		$this->user_id	 	 = $user_id_in;
		$this->amount	 	 = $amount_in;
		$this->time		 	 = $time_in;
		$this->category	 	 = $category_in;
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
	
	public function jsonSerialize() 
	{
        return [
            'id' 		=> $this->id,
            'user_id' 	=> $this->user_id,
            'amount' 	=> $this->amount,
			'time' 		=> $this->time,
			'category' 	=> $this->category
        ];
    }
	
	
	// property declaration
	private $id 			 = 0;
	private $user_id	 	 = 0;
	private $amount	 	 	 = 0;
	private $time		 	 = "";
	private $category	 	 = 0;
}

?>