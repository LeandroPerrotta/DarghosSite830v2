<?
class Players
{
	private $data = array();
	
	public function __construct()
	{	
		$this->DB = Database::getInstance();
	}	
	
	function loadByName($name)
	{
		$this->DB->query("SELECT id, account_id FROM players WHERE name = '".$name."'");
		
		if($this->DB->num_rows() != 0)
		{
			$fetch = $this->DB->fetch();
			
			$this->data['account_id'] = $fetch->account_id;
			
			return true;
		}
		else
			return false;
	}
	
	function getData($data)
	{
		return $this->data[$data];
	}
}
?>