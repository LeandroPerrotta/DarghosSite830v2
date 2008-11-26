<?
if($login->logged())
{
	if ($_SERVER['REQUEST_METHOD'] == "POST")
	{		
		$account = $engine->loadObject('Account');	
		$account->loadByNumber($_SESSION['account']);
		$account->load();	
	
		$newemail = $_POST['newEmail'];
		$password = md5($_POST['password']);
		
		$checkemail = $engine->loadObject('Account');	
		$checkemail->loadByEmail($newemail);		
		
		if(!$tools->checkString($newemail))
		{
			$warn = $lang->getWarning('geral.entradasReservadas');
			$condition = array
			(
				"title" => $warn['title'],
				"msg" => $warn['msg'],
				"buttons" => $eHTML->simpleButton('back','?act=account.changeemail')
			);	
		}
		elseif($checkemail->exists())
		{
			$warn = $lang->getWarning('contas.emailExistente');
			$condition = array
			(
				"title" => $warn['title'],
				"msg" => $warn['msg'],
				"buttons" => $eHTML->simpleButton('back','?act=account.changeemail')
			);		
		}			
		elseif($newemail == $account->getEmail())
		{
			$warn = $lang->getWarning('changeemail.identico');
			$condition = array
			(
				"title" => $warn['title'],
				"msg" => $warn['msg'],
				"buttons" => $eHTML->simpleButton('back','?act=account.changeemail')
			);		
		}	
		elseif($password != $account->getPassword())
		{
			$warn = $lang->getWarning('geral.falhaConfPass');
			$condition = array
			(
				"title" => $warn['title'],
				"msg" => $warn['msg'],
				"buttons" => $eHTML->simpleButton('back','?act=account.changeemail')
			);		
		}		
		elseif(!$tools->validEmail($newemail))
		{
			$warn = $lang->getWarning('changeemail.emailInvalido');
			$condition = array
			(
				"title" => $warn['title'],
				"msg" => $warn['msg'],		
				"buttons" => $eHTML->simpleButton('back','?act=account.changeemail')
			);
		}		
		else
		{
			$email = $lang->getEmailCount('account.changeemail');	
			$emailCont = $email[0].$newemail.$email[1].CHANGE_EMAIL_DAYS.$email[2].CHANGE_EMAIL_DAYS.$email[3];
			
			if($engine->sendMail($account->getEmail(), $emailCont, "Mudança de Email"))
			{			
				$account->changeEmail($newemail);
				$warn = $lang->getWarning('changeemail.sucesso');
				$condition = array
				(
					"title" => $warn['title'],
					"msg" => $warn['msg'],
					"buttons" => $eHTML->simpleButton('back','?act=account.main')
				);	
			}	
		}
		
		$content .= $eHTML->conditionTable($condition);
	}
	else
	{		
		$changeEmailText = $lang->getDescription('account.changeemail');
		$changeEmailText = $changeEmailText[0].CHANGE_EMAIL_DAYS.$changeEmailText[1].CHANGE_EMAIL_DAYS.$changeEmailText[2];
		$content .= '
		'.$eHTML->descriptionTable($changeEmailText).'
		'.$eHTML->formStart('?act=account.changeemail').'
		<table cellspacing="2" cellpadding="0" border="0" width="95%" align="center">
			<tr>
				<td class="tableTop" colspan="2">'.$trans_texts['email_changer'][$g_language].'</td>
			</tr>
			<tr class="tableContLight">
				<td>
					<table class="tableContLight border="0" width="100%" align="center">
						<tr>
							<td width="25%">'.$trans_texts['new_email'][$g_language].':</td>
							<td>'.$eHTML->textBoxInput('newEmail', 'text').'</td>
						</tr>	
						<tr>
							<td width="25%">'.$trans_texts['password'][$g_language].':</td>
							<td>'.$eHTML->textBoxInput('password', 'password').'</td>
						</tr>					
					</table>	
				</td>
			</tr>	
		</table>	
		<br>
		<center>
		'.$eHTML->simpleButton('back','?act=account.main').'
		'.$eHTML->imageButtonInput('next').'</center>	
		'.$eHTML->formEnd().'		
		';
	}	
}	
?>