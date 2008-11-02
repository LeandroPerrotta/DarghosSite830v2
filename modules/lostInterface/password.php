<?
if($_GET["step"] == "confirmKey")
{
	if ($_SERVER['REQUEST_METHOD'] == "POST")
	{	
		if(!$tools->checkSqlInjection($_POST['account']) OR !$tools->checkSqlInjection($_POST['key']))
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
			
			if(!$account->loadByNumber($_POST['account']))
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
				if(!$engine->sendMail($account->getInfo("email"), 'Recuperação de Conta', $trans_texts['recovery_mail_password1'][$g_language]))
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
					
					$account->setData('password', md5($newpassword));
					$account->update(array('password'));
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
		<table style="margin: 10px 0 0 0;" border="0" width="95%" CELLSPACING="1" CELLPADDING="2">
			<tr>
				<td class="tableTop" colspan="2">'.$trans_texts['lostInterface'][$g_language].'</td>
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
		
			if(!$engine->sendMail($account->getInfo("email"), 'Recuperação de Conta', $trans_texts['recovery_mail_password1'][$g_language]))
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