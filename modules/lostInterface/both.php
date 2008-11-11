<?
if($_GET["step"] == "4")
{
	$player = $engine->loadObject('player');
	$player->load($_SESSION['lostInterface']['character']);
	
	$account = $engine->loadObject('Account');
	$account->loadByNumber($player->getInfo('account_id'));
	
	$account->load();
	
	if($account->getInfo("email") != $_POST['email'])
	{
		$warn = $lang->getWarning('recovery.emailIncorreto');
		$condition = array
		(
			"title" => $warn['title'],
			"msg" => $warn['msg'],
			"buttons" => $eHTML->simpleButton('back','?act=lostInterface&step=3')
		);	
	}
	else
	{
		$acc_number = $account->getInfo("id");
		$key = $tools->randKey(8, 2, "upper+number");
		
		$email = $lang->getEmailCount('recovery.both');				
		$emailCont = $email[0].$acc_number.$email[1].$key.$email[2];			
		
		if(!$engine->sendMail($account->getInfo("email"), $emailCont, 'Recuperação de Conta'))
		{
			$warn = $lang->getWarning('geral.sendEmailError');
			$condition = array
			(
				"title" => $warn['title'],
				"msg" => $warn['msg'],
				"buttons" => $eHTML->simpleButton('back','?act=lostInterface&step=3')
			);	
		}
		else
		{
			$account->addChangePasswordKey($key);
			$warn = $lang->getWarning('recovery.bothSucesso');
			$condition = array
			(
				"title" => $warn['title'],
				"msg" => $warn['msg'],
				"buttons" => $eHTML->simpleButton('back','?page=lostInterface&step=3')
			);	
		}
	}
	$content .= $eHTML->conditionTable($condition);	
}
elseif($_GET["step"] == "3")
{
		$content .= '
		'.$eHTML->descriptionTable($lang->getDescription('lostInterfaceStep3_2')).'
		'.$eHTML->formStart('?act=lostInterface&step=4').'
		<table style="margin: 10px 0 0 0;" border="0" width="95%" CELLSPACING="1" CELLPADDING="2">
			<tr>
				<td class="tableTop" colspan="2">'.$trans_topicPages['lostInterface'][$g_language].'</td>
			</tr>
			<tr class="tableContLight">
				<td>
					'.$trans_texts['email_address'][$g_language].'
				</td>
				<td>
				'.$eHTML->textBoxInput('email', 'text').'
				</td>
			</tr>					
		</table>
		<br>
		<center>'.$eHTML->simpleButton('Back', '?act=lostInterface').'    '.$eHTML->imageButtonInput('next').'</center>	
		'.$eHTML->formEnd().'
		';	
}
?>