<?
if($_SERVER['REQUEST_METHOD'] != "POST")
{
	$content .= '
	'.$eHTML->descriptionTable($lang->getDescription('recovery.account')).'
	'.$eHTML->formStart('?act=recovery.account').'
	<table cellspacing="2" cellpadding="0" border="0" width="95%" align="center">
		<tr>
			<td class="tableTop" colspan="2">'.$trans_texts['informations_to_recovery'][$g_language].'</td>
		</tr>
		<tr class="tableContLight">
				<td width="30%">'.$trans_texts['my_character'][$g_language].'</td>
				<td>'.$eHTML->textBoxInput('character', 'text').'</td>
		</tr>				
		<tr class="tableContLight">
				<td width="30%">'.$trans_texts['password'][$g_language].':</td>
				<td>'.$eHTML->textBoxInput('password', 'password').'</td>
		</tr>			
		<tr class="tableContLight">
				<td width="30%">'.$trans_texts['email_address'][$g_language].':</td>
				<td>'.$eHTML->textBoxInput('email_address', 'text').'</td>
		</tr>	
	</table>	
	<br>
	<center>
	'.$eHTML->simpleButton('back','?act=account.lost').'
	'.$eHTML->imageButtonInput('next').'</center>	
	'.$eHTML->formEnd().'		
	';
}	
else
{
	if(!$tools->checkString($_POST['character']) or !$tools->checkString($_POST['email_address']))
	{
		$warn = $lang->getWarning('geral.entradasReservadas');
		$condition = array
		(
			"title" => $warn['title'],
			"msg" => $warn['msg'],
			"buttons" => $eHTML->simpleButton('back','?act=recovery.account')
		);		
	}			
	else
	{		
		$player = $engine->loadObject('player');	
		
		if(!$player->load($_POST['character']))
		{
			$warn = $lang->getWarning('char.naoExiste');
			$condition = array
			(
				"title" => $warn['title'],
				"msg" => $warn['msg'],
				"buttons" => $eHTML->simpleButton('back','?act=recovery.account')
			);			
		}
		else
		{
			$account = $engine->loadObject('Account');	
			$account->loadByNumber($player->getInfo('account_id'));
			$account->load();			
		
			if($account->getInfo('password') != md5($_POST['password']))
			{
				$warn = $lang->getWarning('recovery.senhaIncorreta');
				$condition = array
				(
					"title" => $warn['title'],
					"msg" => $warn['msg'],
					"buttons" => $eHTML->simpleButton('back','?act=recovery.account')
				);			
			}
			elseif($account->getInfo('email') != $_POST['email_address'])
			{
				$warn = $lang->getWarning('recovery.emailIncorreto');
				$condition = array
				(
					"title" => $warn['title'],
					"msg" => $warn['msg'],
					"buttons" => $eHTML->simpleButton('back','?act=recovery.account')
				);		
			}
			else
			{
				$email = $lang->getEmailCount('recovery.account');				
				$emailCont = $email[0].$player->getInfo('account_id').$email[1];			
				
				if($engine->sendMail($account->getInfo('email'), $emailCont, "Recuperação de Conta"))
				{					
					$warn = $lang->getWarning('recovery.accountSucesso');
					$condition = array
					(
						"title" => $warn['title'],
						"msg" => $warn['msg'],
						"buttons" => $eHTML->simpleButton('back','?act=account.lost')
					);		
				}
				else
				{
					$warn = $lang->getWarning('geral.emailFalhou');
					$condition = array
					(	
						"title" => $warn['title'],
						"msg" => $warn['msg'],					
						"buttons" => $eHTML->simpleButton('back','?act=recovery.account')
					);				
				}			
			}
		}	
	}	
	
	$content .= $eHTML->conditionTable($condition);
}
?>	