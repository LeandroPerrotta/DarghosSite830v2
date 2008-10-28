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

		$mail = new PHPMailer();
		$mail->IsSMTP();					
		$mail->IsHTML(true);
		$mail->SMTPAuth   = true;
		$mail->Host       = "smtp.darghos.com";
		$mail->Port       = 25;

		$mail->FromName   = "Darghos Server";
		$mail->Username   = "auto-responder@darghos.com";
		$mail->Password   = "***REMOVED***"; 

		$mail->From = $account[$accNum];;
		$mail->AddAddress($recipient);

		$mail->Subject = $subject;
		$mail->Body    = $content;

		return $mail->Send();
	}		
}
?>