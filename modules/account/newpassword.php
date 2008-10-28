<?
if($_SERVER['REQUEST_METHOD'] != "POST")
{
	$content .= '
	'.$eHTML->descriptionTable($lang->getDescription('recovery.newpassword')).'
	'.$eHTML->formStart('?act=recovery.newpassword').'
	<table cellspacing="2" cellpadding="0" border="0" width="95%" align="center">
		<tr>
			<td class="tableTop" colspan="2">'.$trans_texts['informations_to_recovery'][$g_language].'</td>
		</tr>
		<tr class="tableContLight">
				<td width="30%">'.$trans_texts['my_character'][$g_language].'</td>
				<td>'.$eHTML->textBoxInput('character', 'text').'</td>
		</tr>				
		<tr class="tableContLight">
				<td width="30%">'.$trans_texts['account'][$g_language].':</td>
				<td>'.$eHTML->textBoxInput('account', 'password').'</td>
		</tr>			
		<tr class="tableContLight">
				<td width="30%">'.$trans_texts['password_recovery_key'][$g_language].':</td>
				<td>'.$eHTML->textBoxInput('password_key', 'text').'</td>
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
	if(!$tools->checkString($_POST['character']) or !$tools->checkString($_POST['password_key']) or !$tools->checkString($_POST['account']) or !is_numeric($_POST['account']))
	{
		$warn = $lang->getWarning('geral.entradasReservadas');
		$condition = array
		(
			"title" => $warn['title'],
			"msg" => $warn['msg'],
			"buttons" => $eHTML->simpleButton('back','?act=recovery.newpassword')
		);		
	}			
	else
	{
		$account = $engine->loadObject('Account');	
		$account->loadByNumber($_POST['account']);
		$account->load();	
		
		$player = $engine->loadObject('player');	
		
		if(!$player->load($_POST['character']))
		{
			$warn = $lang->getWarning('char.naoExiste');
			$condition = array
			(
				"title" => $warn['title'],
				"msg" => $warn['msg'],
				"buttons" => $eHTML->simpleButton('back','?act=recovery.newpassword')
			);			
		}
		elseif($player->getInfo('account_id') != $_POST['account'])
		{
			$warn = $lang->getWarning('recovery.contaIncorreta');
			$condition = array
			(
				"title" => $warn['title'],
				"msg" => $warn['msg'],
				"buttons" => $eHTML->simpleButton('back','?act=recovery.newpassword')
			);			
		}
		elseif(!$account->loadPasswordKey())
		{
			$warn = $lang->getWarning('recovery.AccDontHaveKey');
			$condition = array
			(
				"title" => $warn['title'],
				"msg" => $warn['msg'],
				"buttons" => $eHTML->simpleButton('back','?act=recovery.newpassword')
			);		
		}
		elseif($account->getInfo('newPasswordKey') != md5($_POST['password_key']))
		{	
			$warn = $lang->getWarning('recovery.keyErro');
			$condition = array
			(
				"title" => $warn['title'],
				"msg" => $warn['msg'],
				"buttons" => $eHTML->simpleButton('back','?act=recovery.newpassword')
			);			
		}
		else
		{
			$newPass = $tools->rand(12);
			$account->setPassword(md5($newPass));
			
			$account->save($loginServer = true, $gameServer = true);
			
			$email = $lang->getEmailCount('recovery.newpassword');				
			$emailCont = $email[0].$newPass.$email[1];			
			
			if($engine->sendMail($account->getInfo('email'), $emailCont, "Recuperação de Conta"))
			{		
				$account->clearPasswordKeys();
				
				$warn = $lang->getWarning('recovery.newpasswordSucesso');
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
					"buttons" => $eHTML->simpleButton('back','?act=account.lost')
				);				
			}			
		}
	}	
	
	$content .= $eHTML->conditionTable($condition);
}
?>	