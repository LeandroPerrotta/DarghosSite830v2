<?
if($login->logged())
{
	if ($_SERVER['REQUEST_METHOD'] == "POST")
	{		
		$account = $engine->loadObject('Account');	
		$account->loadByNumber($_SESSION['account']);
		$account->load();	
	
		$password = md5($_POST['password']);	
			
		if($password != $account->getPassword())
		{
			$warn = $lang->getWarning('geral.falhaConfPass');
			$condition = array
			(
				"title" => $warn['title'],
				"msg" => $warn['msg'],
				"buttons" => $eHTML->simpleButton('back','?act=account.cancelchangeemail')
			);		
		}			
		else
		{
			$account->cancelChangeEmail();
			$warn = $lang->getWarning('changeemail.cancelSucesso');
			$condition = array
			(
				"title" => $warn['title'],
				"msg" => $warn['msg'],
				"buttons" => $eHTML->simpleButton('back','?act=account.main')
			);	
		}
		
		$content .= $eHTML->conditionTable($condition);
	}
	else
	{		
		$cancelChangeEmail = $lang->getDescription('account.cancelchangeemail');
		$cancelChangeEmail = $cancelChangeEmail[0].CHANGE_EMAIL_DAYS.$cancelChangeEmail[1];
		$content .= '
		'.$eHTML->descriptionTable($cancelChangeEmail).'
		'.$eHTML->formStart('?act=account.cancelchangeemail').'
		<table cellspacing="2" cellpadding="0" border="0" width="95%" align="center">
			<tr>
				<td class="tableTop" colspan="2">'.$trans_texts['cancel_change_email'][$g_language].'</td>
			</tr>
			<tr class="tableContLight">
				<td>
					<table class="tableContLight border="0" width="100%" align="center">
						<tr>
							<td width="25%">'.$trans_texts['password'][$g_language].'</td>
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