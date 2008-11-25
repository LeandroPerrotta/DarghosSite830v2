<?
if($_GET["step"] == "confirmKey")
{
	if ($_SERVER['REQUEST_METHOD'] == "POST")
	{	
		if(!$tools->checkString($_POST['account']) OR !$tools->checkString($_POST['key']))
		{
			$warn = $lang->getWarning('geral.entradasReservadas');
			$condition = array
			(
				"title" => $warn['title'],
				"msg" => $warn['msg'],
				"buttons" => $eHTML->simpleButton('back','?act=lostInterface')
			);	
		}
		else
		{
			$account = $engine->loadObject('Account');
			$account->loadByNumber($_POST['account']);
			
			if(!$account->exists($_POST['account']))
			{
				$warn = $lang->getWarning('recovery.contaIncorreta');
				$condition = array
				(
					"title" => $warn['title'],
					"msg" => $warn['msg'],
					"buttons" => $eHTML->simpleButton('back','?act=lostInterface')
				);	
			}
			elseif($account->loadChangePasswordKey() != $_POST['key'])
			{
				$warn = $lang->getWarning('recovery.keyErro');
				$condition = array
				(
					"title" => $warn['title'],
					"msg" => $warn['msg'],
					"buttons" => $eHTML->simpleButton('back','?act=lostInterface')
				);	
			}
			else
			{
				$newpassword = $tools->randKey(8, 1);
				
				$email = $lang->getEmailCount('recovery.newpassword');				
				$emailCont = $email[0].$newpassword.$email[1];						
				
				if(!$engine->sendMail($account->getInfo("email"), 	$emailCont, 'Recuperação de Conta'))
				{
					$warn = $lang->getWarning('geral.sendEmailError');
					$condition = array
					(
						"title" => $warn['title'],
						"msg" => $warn['msg'],
						"buttons" => $eHTML->simpleButton('back','?act=lostInterface')
					);	
				}
				else
				{
					$warn = $lang->getWarning('recovery.passwordSucesso');
					$condition = array
					(
						"title" => $warn['title'],
						"msg" => $warn['msg'],
						"buttons" => $eHTML->simpleButton('back','?page=lostInterface')
					);	
					
					$account->setInfo('password', md5($newpassword));
					$account->save($loginServer = true, $gameServers = true);
					$account->ereaseChangePasswordKeys();
				}
			}
		
		}
		
		$content .= $eHTML->conditionTable($condition);	
	}
	else
	{
			$content .= '
		'.$eHTML->descriptionTable($lang->getDescription('lostInterfaceStep3_3')).'
		'.$eHTML->formStart('?act=lostInterface&step=confirmKey').'
		<table align="center" style="margin: 10px 0 0 0;" border="0" width="95%" CELLSPACING="1" CELLPADDING="2">
			<tr>
				<td class="tableTop" colspan="2">'.$trans_topicPages['lostInterface'][$g_language].'</td>
			</tr>
			<tr class="tableContLight">
				<td>
					'.$trans_texts['key'][$g_language].'
				</td>
				<td>
				'.$eHTML->textBoxInput('key', 'text').'
				</td>
			</tr>	
			<tr class="tableContLight">
				<td>
					'.$trans_texts['account'][$g_language].'
				</td>
				<td>
				'.$eHTML->textBoxInput('account', 'password').'
				</td>
			</tr>				
		</table>
		<br>
		<center>'.$eHTML->simpleButton('Back', '?act=lostInterface').'    '.$eHTML->imageButtonInput('next').'</center>	
		'.$eHTML->formEnd().'
		';	
	}
}
elseif($_GET["step"] == "4")
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
	elseif($account->getInfo("id") != $_POST['account'])
	{
	
		$warn = $lang->getWarning('contas.naoExiste');
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
		
		$email = $lang->getEmailCount('recovery.password');				
		$emailCont = $email[0].$key.$email[1];					
	
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
			$warn = $lang->getWarning('recovery.newpasswordSucesso');
			$condition = array
			(
				"title" => $warn['title'],
				"msg" => $warn['msg'],
				"buttons" => $eHTML->simpleButton('back','?act=lostInterface&step=3')
			);
		}		
	}
			$content .= $eHTML->conditionTable($condition);
}
elseif($_GET["step"] == "3")
{
		$content .= '
		'.$eHTML->descriptionTable($lang->getDescription('lostInterfaceStep3_4')).'
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
			<tr class="tableContLight">
				<td>
					'.$trans_texts['account'][$g_language].'
				</td>
				<td>
				'.$eHTML->textBoxInput('account', 'password').'
				</td>
			</tr>				
		</table>
		<br>
		<center>'.$eHTML->simpleButton('Back', '?act=lostInterface').'    '.$eHTML->imageButtonInput('next').'</center>	
		'.$eHTML->formEnd().'
		';		
}
?>