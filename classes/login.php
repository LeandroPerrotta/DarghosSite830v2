<?
class Login
{	
	protected static $access = -1;

	public function logged()
	{
		$account = Engine::loadObject('Account');
		if(($_SESSION['account'] and $_SESSION['password']) != (null or ""))
		{
			$account->loadByNumber($_SESSION['account']);
		
			if($account->exists() and $account->getPassword() == $_SESSION['password'])
			{
				self::$access = $account->getAccess();
				return true;
			}	
			else
				return false;
		}
		else
			return false;		
	}
	
	public function make($number, $password)
	{
		$account = Engine::loadObject('Account');
		if(($number and $password) != (null or ""))
		{
			$account->loadByNumber($number);
		
			if($account->exists() and $account->getPassword() == md5($password))
			{
				self::$access = $account->getAccess();
				return true;
			}	
			else
				return false;
		}
		else
			return false;		
	}	
	
	public function logout()
	{
		session_unset();
		session_destroy();
	}
	
	public function getAccess()
	{
		return self::$access;
	}
}
?>