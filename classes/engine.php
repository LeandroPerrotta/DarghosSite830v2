<?
class Engine
{
    public static function getInstance()
    {
        static $instance;

        // creates new instance
        if( !isset($instance) )
        {
            $instance = new self();
        }

        return $instance;
    }

 /*   private function __construct()
    {
		include "classes/DB.php";
        spl_autoload_register( array($this, 'loadClass') );
    }	

    public function loadClass()
    {
		include_once("classes/".$this->className.".php");
    }	*/
	
	public function loadObject($object)
	{
		include_once("classes/".$object.".php");
		return new $object();
	}	

	public function sendMail($recipient, $content, $subject)
	{
		require("classes/phpmailer/class.phpmailer.php");

		$users = array(
			array(
				"host" => "smtp-auth.no-ip.com",
				"port" => 587,
				"username" => "darghos.net@noip-smtp",
				"password" => "***REMOVED***"
			),
			array(
				"host" => "smtp.darghos.com",
				"port" => 25,
				"username" => "no-reply@darghos.com",
				"password" => "***REMOVED***"
			),			
		);	
		
		foreach($users as $user)
		{
			$mail = new PHPMailer();
			$mail->IsSMTP();					
			$mail->IsHTML(true);
			$mail->SMTPAuth   = true;
			$mail->Host       = $user['host'];      
			$mail->Port       = $user['port'];              

			$mail->FromName   = "Darghos Server";
			$mail->Username   = $user['username']; 
			$mail->Password   = $user['password'];       

			$mail->From = $account[$accNum];
			$mail->AddAddress($recipient);

			$mail->Subject = $subject;
			$mail->Body    = $content;

			$result = $mail->Send();
			
			if($result)
			{
				return true;
			}
		}
		
		return false;
	}		
}
?>