<?
if ($_SERVER['REQUEST_METHOD'] == "POST")
{	
	$account = $engine->loadObject('Account');
	
	$account->loadByEmail($_POST['email_address']);
	
	if($_POST['email_address'] == null)
	{
		$warn = $lang->getWarning('geral.camposVazios');
		$condition = array
		(
			"title" => $warn['title'],
			"msg" => $warn['msg'],
			"buttons" => $eHTML->simpleButton('back','?act=account.register')
		);	
	}
	elseif($account->exists())
	{
		$warn = $lang->getWarning('contas.emailExistente');
		$condition = array
		(
			"title" => $warn['title'],
			"msg" => $warn['msg'],
			"buttons" => $eHTML->simpleButton('back','?act=account.register')
		);
	}
	elseif(!$tools->validEmail($_POST['email_address']))
	{
		$warn = $lang->getWarning('geral.emailInvalido');
		$condition = array
		(
			"title" => $warn['title'],
			"msg" => $warn['msg'],		
			"buttons" => $eHTML->simpleButton('back','?act=account.register')
		);
	}	
	else
	{
		
		$password = $tools->rand(12);
		$number = $account->newNumber();
		$account->setEmail($_POST['email_address']);
		$account->setPassword(md5($password));		
		
		$email = $lang->getEmailCount('account.register');				
		$emailCont = $email[0].$number.$email[1].$password.$email[2];
		
		if($engine->sendMail($_POST['email_address'], $emailCont, "Registro"))
		{	
			$account->setCreation(time());	
			$account->saveNewNumber();
				
			$warn = $lang->getWarning('contas.sucesso');
			$condition = array
			(
				"title" => $warn['title'],
				"msg" => $warn['msg'][0].$number.$warn['msg'][1],		
				"buttons" => $eHTML->simpleButton('login','?act=account.login')
			);
		}	
		else
		{
			$warn = $lang->getWarning('geral.emailFalhou');
			$condition = array
			(	
				"title" => $warn['title'],
				"msg" => $warn['msg'],					
				"buttons" => $eHTML->simpleButton('back','?act=account.register')
			);		
		}
	}
	
	$content .= $eHTML->conditionTable($condition);
}
else
{	
	$content .= '
	'.$eHTML->descriptionTable($lang->getDescription('account.registration')).'
	'.$eHTML->formStart('?act=account.registration').'
	<table cellspacing="2" cellpadding="0" border="0" width="95%" align="center">
		<tr>
			<td class="tableTop" colspan="2">'.$trans_texts['account_registrarion'][$g_language].'</td>
		</tr>
		<tr class="tableContLight">
			<td>
				<table class="tableContLight border="0" width="100%" align="center">
					<tr>
						<td width="25%">'.$trans_texts['firstName'][$g_language].':</td>
						<td>'.$eHTML->textBoxInput('firstName', 'text').'</td>
					</tr>	
					<tr>
						<td width="25%">'.$trans_texts['secondName'][$g_language].':</td>
						<td>'.$eHTML->textBoxInput('secondName', 'text').'</td>
					</tr>		
					<tr>
						<td width="25%">'.$trans_texts['street_address'][$g_language].':</td>
						<td>'.$eHTML->textBoxInput('streetAddress', 'text').'</td>
					</tr>	
					<tr>
						<td width="25%">'.$trans_texts['completion'][$g_language].':</td>
						<td>'.$eHTML->textBoxInput('completion', 'text').'</td>
					</tr>		
					<tr>
						<td width="25%">'.$trans_texts['postal'][$g_language].':</td>
						<td>'.$eHTML->textBoxInput('postal', 'text').'</td>
					</tr>						
					<tr>
						<td width="25%">'.$trans_texts['city'][$g_language].':</td>
						<td>'.$eHTML->textBoxInput('city', 'text').'</td>
					</tr>			
					<tr>
						<td width="25%">'.$trans_texts['state'][$g_language].':</td>
						<td>'.$eHTML->textBoxInput('state', 'text').'</td>
					</tr>		
					<tr>
						<td width="25%">'.$trans_texts['country'][$g_language].':</td>
						<td>'.$eHTML->textBoxInput('country', 'text').'</td>
					</tr>	
					<tr>
						<td width="25%">'.$trans_texts['birth_date'][$g_language].':</td>
						<td>'.$eHTML->textBoxInput('birth_date', 'text').'</td>
					</tr>						
				</table>	
			</td>
		</tr>	
	</table>	
	<br>
	<center>'.$eHTML->imageButtonInput('register').'</center>	
	'.$eHTML->formEnd().'		
	';
}	
?>