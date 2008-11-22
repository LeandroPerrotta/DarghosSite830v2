<?
class mySQL
{		
	private $userdb = array
	(
		'site' => array
		(
			'host' => 'localhost',
			'user' => 'root',
			'database' => 'web',
			'password' => 'secret',
		),
		'serverI' => array
		(
			'host' => 'localhost',
			'user' => 'root1',
			'database' => 'gameserver',
			'password' => 'secret',	
		),
		'serverII' => array
		(
			'host' => 'localhost',
			'user' => 'root2',
			'database' => 'newot',
			'password' => '99491074'		
		),		
		'loginserver' => array
		(
			'host' => 'localhost',
			'user' => 'root3',
			'database' => 'ot_login',
			'password' => 'secret'		
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