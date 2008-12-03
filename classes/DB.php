<?
class DB
{	
	private $query_temp, $query_error;
	
	public static $instance;
	
	public function query($sql, $link = 'site')
	{			
		$this->query_temp = mysql_query($sql, $GLOBALS['g_linkResource'][$link]);
		
		if(!$this->query_temp)
		{
			echo "".mysql_errno($GLOBALS['g_linkResource'][$link]).mysql_error($GLOBALS['g_linkResource'][$link])." ".$link." ".$sql."";
			die();
		}
	}	
	
	public static function getInstance() 
	{
		if(self::$instance == null) 
		{
			self::$instance = new DB();
		}
		
		return self::$instance;
	}	
	
	public function query_result()
	{
		return (!$this->query_error) ? true : false;
	}

	public function fetch()
	{
		return ($this->query_temp) ? @mysql_fetch_object($this->query_temp) : false;
	}	
	
	public function fetchArray()
	{
		return ($this->query_temp) ? @mysql_fetch_array($this->query_temp) : false;
	}
	
	public function num_rows()
	{
		return ($this->query_temp) ? @mysql_num_rows($this->query_temp) : false;
	}		
	
	public function last_insert_id($tabela, $link = 'site')
	{
		$query = mysql_query("SELECT LAST_INSERT_ID() as id FROM {$tabela}", $GLOBALS['g_linkResource'][$link]);
		$fetch = mysql_fetch_object($query);
		if($fetch->id != null) {
			return $fetch->id;
		} else {
			return false;
		}
	}
}
?>