<?
if($login->logged())
{
	$idEnc = $_GET['id'];
	
	$payments = $engine->loadObject('Payments');
	
	if($payments->loadByIdEnc($idEnc) and (($payments->getInfo('account_id') == $_SESSION['account']) OR ($login->logged() and $login->getAccess() == ACCESS_SADMIN)))
	{
		if($payments->needActive())
		{
			$acceptedIn = "Aceitação pendente...";
		}
		else
		{
			$acceptedIn = $tools->datePt($payments->getInfo('acceptedIn'), "dd, mes, aa");
		}
	
		$content .= '
			'.$eHTML->descriptionTable($lang->getDescription('payments.detail')).'
			<table cellspacing="1" cellpadding="0" border="0" width="95%" align="center">
				<tr>
					<td class="tableTop" colspan="4">'.$trans_texts['contribution_details'][$g_language].'</td>
				</tr>	
				<tr>
					<td class="tableContLight" width="20%"><b>'.$trans_texts['period'][$g_language].'</b></td><td class="tableContLight">'.$payments->getInfo('period').' '.$trans_texts['days'][$g_language].'</td><td class="tableContLight" width="20%"><b>'.$trans_texts['price'][$g_language].'</b></td><td class="tableContLight">'.$g_pgtCoin[$payments->getInfo('coin')].' '.$payments->getInfo('cost').'</td>
				</tr>
				<tr>
					<td class="tableContLight" width="20%"><b>'.$trans_texts['method'][$g_language].'</b></td><td class="tableContLight">'.$g_pgtMethod[$payments->getInfo('method')].'</td><td class="tableContLight" width="20%"><b>'.$trans_texts['form'][$g_language].'</b></td><td class="tableContLight">'.$g_pgtType[$payments->getInfo('type')].'</td>
				</tr>			
				<tr>
					<td class="tableContLight" width="20%"><b>'.$trans_texts['released_in'][$g_language].'</b></td><td class="tableContLight" width="30%">'.$tools->datePt($payments->getInfo('activation'), "dd, mes, aa").'</td><td class="tableContLight" width="20%"><b>'.$trans_texts['actived_in'][$g_language].'</b></td><td class="tableContLight">'.$acceptedIn.'</td>
				</tr>	
				<tr>
					<td class="tableContLight" colspan="4" width="20%"><center>'.$trans_texts['auth_number'][$g_language].': <b>'.$payments->getInfo('auth').'</b></center></td>
				</tr>					
			</table>
			<br>
			<table cellspacing="0" cellpadding="0" border="0" width="95%" align="center">
				<tr>
					<td><center>
						'.$eHTML->simpleButton('back','?act=account.main').'';
		if($payments->needActive())
		{	
			if($payments->getInfo('auth') != 0)
				$content .= ' '.$eHTML->simpleButton('accept','?act=payment.accept&id='.md5($payments->getInfo('auth')).'').'';
			else
				$content .= ' '.$eHTML->simpleButton('accept','?act=payment.accept&id='.md5($payments->getInfo('id')).'').'';
		}
		
					$content .= '</td>
				</tr>
			</table>
			<br>			
		';
	}
}	
?>