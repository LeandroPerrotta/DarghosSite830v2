<?
if($login->logged())
{
	$idEnc = $_GET['id'];
	
	$payments = $engine->loadObject('Payments');
	
	if($payments->loadByIdEnc($idEnc) and $payments->getInfo('account_id') == $_SESSION['account'])
	{
		if($payments->needActive())
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
						"buttons" => $eHTML->simpleButton('back','?act=payment.accept&id='.md5($payments->getInfo('auth')).'')
					);		
				}			
				else
				{
					$account->updatePremDays();
					$premDays = $payments->getInfo('period');
					
					if($account->getInfo('premdays') != 0)
					{
						$premDays += $account->getInfo('premdays');
					}
					
					$account->setInfo('premdays', $premDays);
					$account->setInfo('lastday', time());
					
					$account->save($loginServer = true, $gameServer = true);
					
					$payments->setStatus(PGT_STAT_ACTIVED);
					$payments->setAcceptedIn(time());
					$payments->save();
					
					$warn = $lang->getWarning('payments.accepted');
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
				if($payments->getInfo('auth') != 0)
				{
					$content .= '
						'.$eHTML->formStart('?act=payment.accept&id='.md5($payments->getInfo('auth')).'').'';
				}
				else
				{
				$content .= '
						'.$eHTML->formStart('?act=payment.accept&id='.md5($payments->getInfo('id')).'').'';					
				}
				
				$content .= '	
					'.$eHTML->descriptionTable($lang->getDescription('payments.accept')).'
					<table cellspacing="1" cellpadding="0" border="0" width="95%" align="center">
						<tr>
							<td class="tableTop" colspan="4">'.$trans_texts['accept_contribution'][$g_language].'</td>
						</tr>	
						<tr>
							<td class="tableContLight" width="20%">'.$trans_texts['password'][$g_language].'</td><td class="tableContLight">'.$eHTML->textBoxInput('password', 'password').'</td>
						</tr>				
					</table>
					<br>
					<table cellspacing="0" cellpadding="0" border="0" width="95%" align="center">
						<tr>
							<td><center>
								'.$eHTML->simpleButton('back','?act=account.main').'
								'.$eHTML->imageButtonInput('accept').'</center>	
							</td>
						</tr>
					</table>
					<br>
					'.$eHTML->formEnd().'				
				';
			}
		}
	}
}	
?>