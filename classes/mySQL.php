<?
class mySQL
{		
	private $userdb = array
	(
		'site' => array
		(
			'host' => 'localhost',
			'user' => 'root',
			'database' => 'newot_new',
			'password' => '',
			'prefix' => 'ws_',
		),
		'serverI' => array
		(
			'host' => 'localhost',
			'user' => 'root',
			'database' => 'newot_new',
			'password' => '',	
			'prefix' => 'gs_'		
		),
		'serverII' => array
		(
			'host' => '75.126.221.242:3309',
			'user' => 'extern',
			'database' => 'newot',
			'password' => '***REMOVED****'		
		),		
		'loginserver' => array
		(
			'host' => 'localhost',
			'user' => 'root',
			'database' => 'ot_login',
			'password' => ''		
		)		
	);
	
	public function connect($connection)
	{
		$server = $this->userdb[$connection];
		$link = mysql_pconnect($server['host'], $server['user'],$server['password']);

		if ($link)
		{
			if (mysql_select_db($server['database'], $link))
			{
				return $link;
			}	
			else
				die('Unable to select database. MySQL reported.');
		}
		else
			die('Unable to connect to MySQL server. MySQL reported.');	
	}	
}
?>