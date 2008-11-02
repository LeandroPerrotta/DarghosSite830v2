<?
if($_GET["step"] == "4")
{
	$player = $engine->loadObject('player');
	$player->load($_SESSION['lostInterface']['character']);
	
	$account = $engine->loadObject('Account');
	$account->loadByNumber($player->getInfo('account_id'));
	
	$account->load();
	
	$sendemail = $account->getInfo("id");
	
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
		$key = $tools->randKey(8, 2, "upper+number");
		
		if(!$engine->sendMail($account->getInfo("email"), 'Recuperação de Conta', $trans_texts['recovery_mail_both'][$g_language]))
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