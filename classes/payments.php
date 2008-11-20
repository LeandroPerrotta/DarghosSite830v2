<?
class Payments
{
	private $quantidade;
	private $data = array(
		'id' => '',
		'account_id' => '',
		'period' => '',
		'activation' => '',
		'cost' => '',
		'coin' => '',
		'status' => '',
		'acceptedIn' => '',
		'type' => '',
		'method' => '',
		'auth' => '',
	);

	public function __construct()
	{
		$this->DB = DB::getInstance();
	}
	
	public function loadMain()
	{
		$this->DB->query("SELECT id FROM payments");
		$this->quantidade = $this->DB->num_rows();
	}
		
	public function loadPaymentsByPeriod($inicial, $final)
	{
		$this->DB->query("SELECT * FROM payments WHERE activation >= ".$inicial." AND activation <= ".$final."");
		$this->quantidade = $this->DB->num_rows();
	}
	
	public function loadById($payment_id)
	{
		$this->DB->query("SELECT * FROM payments WHERE id = ".$payment_id."");
		$fetch = $this->DB->fetch();
	
		$this->data['account_id'] = $fetch->account_id;
		$this->data['period'] = $fetch->period;
		$this->data['activation'] = $fetch->activation;
		$this->data['cost'] = $fetch->cost;
		$this->data['coin'] = $fetch->coin;
		$this->data['status'] = $fetch->status;
		$this->data['acceptedIn'] = $fetch->acceptedIn;
		$this->data['method'] = $fetch->method;
		$this->data['auth'] = $fetch->auth;
	}	
	
	public function loadByIdEnc($IdEnc)
	{
		$this->DB->query("SELECT * FROM payments WHERE MD5(auth) = '".$IdEnc."' OR MD5(id) = '".$IdEnc."' AND auth = 0");
		if($this->DB->num_rows() != 0)
		{
			$fetch = $this->DB->fetch();
			$this->data['id'] = $fetch->id;
			$this->data['account_id'] = $fetch->account_id;
			$this->data['period'] = $fetch->period;
			$this->data['activation'] = $fetch->activation;
			$this->data['cost'] = $fetch->cost;
			$this->data['coin'] = $fetch->coin;
			$this->data['status'] = $fetch->status;
			$this->data['acceptedIn'] = $fetch->acceptedIn;
			$this->data['method'] = $fetch->method;
			$this->data['type'] = $fetch->type;
			$this->data['auth'] = $fetch->auth;
			
			return true;
		}	
		else
			return false;
	}		
	
	public function setAccountId($account)
	{
		$this->data['account_id'] = $account;
	}	
	
	public function setPeriod($period)
	{
		$this->data['period'] = $period;
	}	
	
	public function setActivation($activation)
	{
		$this->data['activation'] = $activation;
	}		
	
	public function setCost()
	{
		switch($this->data['method'])
		{
			case PGT_MET_PAGSEGURO:
				$this->data['coin'] = PGT_COIN_BR;
				$this->data['cost'] = $GLOBALS['g_pgtPeriodCost'][$this->data['coin']][$this->data['period']];
			break;

			case  PGT_MET_PAYPAL:
				$this->data['coin'] = PGT_COIN_US;
				$this->data['cost'] = $GLOBALS['g_pgtPeriodCost'][$this->data['coin']][$this->data['period']];
			break;				
		}
	}			
	
	public function setStatus($status)
	{
		$this->data['status'] = $status;
	}	

	public function setAcceptedIn($acceptedIn)
	{
		$this->data['acceptedIn'] = $acceptedIn;
	}		

	public function setType($type)
	{
		$this->data['type'] = $type;
	}		
	
	public function setMethod($method)
	{
		$this->data['method'] = $method;
	}		
	
	public function setAuth($auth)
	{
		$this->data['auth'] = $auth;
	}		
	
	public function savePayment()
	{
		$this->DB->query("INSERT INTO payments 
			(`period`, `activation`, `cost`, 
			`coin`, `account_id`, `type`, 
			`method`, `auth`) 
			VALUES
			('".$this->data['period']."', '".$this->data['activation']."', '".$this->data['cost']."',
			'".$this->data['coin']."', '".$this->data['account_id']."', '".$this->data['type']."', 
			'".$this->data['method']."', '".$this->data['auth']."')");
	}
	
	public function save()
	{
		$query = "UPDATE payments SET ";
		
		if($this->data['period'] != (null or ""))
			$query .= "`period` = '" .$this->data['period']. "', ";
			
		if($this->data['activation'] != (null or ""))
			$query .= "`activation` = " .$this->data['activation']. ", ";	
			
		if($this->data['cost'] != (null or ""))
			$query .= "`cost` = '" .$this->data['cost']. "', ";		
			
		if($this->data['coin'] != (null or ""))
			$query .= "`coin` = " .$this->data['coin']. ", ";			
			
		if($this->data['account_id'] != (null or ""))
			$query .= "`account_id` = " .$this->data['account_id']. ", ";	
			
		if($this->data['status'] != (null or ""))
			$query .= "`status` = " .$this->data['status']. ", ";		

		if($this->data['acceptedIn'] != (null or ""))
			$query .= "`acceptedIn` = " .$this->data['acceptedIn']. ", ";					
			
		if($this->data['type'] != (null or ""))
			$query .= "`type` = " .$this->data['type']. ", ";	
			
		if($this->data['method'] != (null or ""))
			$query .= "`method` = " .$this->data['method']. ", ";	
			
		if($this->data['auth'] != (null or ""))
			$query .= "`auth` = '" .$this->data['auth']. "' ";		

		$query .= "WHERE `id` = ".$this->data['id']."";	
		
		$this->DB->query($query);
	}
	
	public function getQtdContr()
	{
		return $this->quantidade;
	}

	public function needActive()
	{
		if($this->data['status'] == PGT_STAT_TOACCEPT)
			return true;
		else
			return false;		
	}	
	
	public function getInfo($info)
	{
		return $this->data[$info];
	}	
}
?>