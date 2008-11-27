<?
if($login->logged())
{
	$account = $engine->loadObject('Account');
	$account->loadByNumber($_SESSION['account']);

	$account->load($emailChanges = true, $payments = true, $registrarion = true);
	
	if($account->getInfo('premdays') != 0)
	{
		$premiumType = '<font color="green"><b>'.$trans_texts['premium_account'][$g_language].'</b></font> ('.$account->getInfo('premdays').' '.$trans_texts['days_left'][$g_language].')';
	}
	else
	{
		$premiumType = $trans_texts['free_account'][$g_language];
	}
	
	if($account->getInfo('realName') == (null or ""))
		$rlname = $trans_texts['not_informed'][$g_language];
	else
		$rlname = $account->getInfo('realName');
		
	if($account->getInfo('location') == (null or ""))
		$location = $trans_texts['not_informed'][$g_language];
	else
		$location = $account->getInfo('location');		

	if($account->getInfo('url') == (null or ""))
		$url = $trans_texts['not_informed'][$g_language];
	else
		$url = $account->getInfo('url');	
		
	$content .= '
	<table cellspacing="0" cellpadding="0" border="0" width="95%" align="center">
		<tr>
			<td>'.$lang->getDescription('account.main').'</td>
		</tr>
	</table>	
	<br>';
	
	if($account->getInfo('newEmail') != (null or ""))
	{
		$content .= '
	<table cellspacing="1" cellpadding="0" border="0" width="95%" align="center">
		<tr>
			<td class="tableTop">'.$trans_texts['email_changer_alert'][$g_language].'</td>
		</tr>
		<tr>
			<td class="tableContLight" width="25%">'.$trans_texts['email_changer_msg'][$g_language][0].''.$account->getInfo('newEmail').''.$trans_texts['email_changer_msg'][$g_language][2].''.$tools->datePt($account->getInfo('changeEmailDate') + CHANGE_EMAIL_TIMER).''.$trans_texts['email_changer_msg'][$g_language][2].'
			</td>	
		</tr>						
	</table>
	<br>
	<table cellspacing="0" cellpadding="0" border="0" width="95%" align="center">
		<tr>
			<td>
				'.$eHTML->simpleButton("cancel", "?act=account.cancelchangeemail").'
			</td>
		</tr>
	</table>
	<br><br>	
	';
	}		
	
	$content .= '<table cellspacing="1" cellpadding="0" border="0" width="95%" align="center">
		<tr>
			<td class="tableTop" colspan="2">'.$trans_texts['account_informations'][$g_language].'</td>
		</tr>
		<tr>
			<td class="tableContLight" width="25%">'.$trans_texts['created_in'][$g_language].'</td><td class="tableContLight">'.$tools->datePt($account->getCreation()).'</td>	
		</tr>			
		<tr>
			<td class="tableContLight" width="25%">'.$trans_texts['email_address'][$g_language].'</td><td class="tableContLight">'.$account->getEmail().'</td>	
		</tr>	
		<tr>
			<td class="tableContLight" width="25%">'.$trans_texts['account_type'][$g_language].'</td><td class="tableContLight">'.$premiumType.'</td>	
		</tr>	
		<tr>
			<td class="tableContLight" width="25%">'.$trans_texts['account_warnings'][$g_language].'</td><td class="tableContLight">'.$account->getWarnings().'</td>	
		</tr>			
	</table>
	<br>
	<table cellspacing="0" cellpadding="0" border="0" width="95%" align="center">
		<tr>
			<td>
				'.$eHTML->simpleButton("changePassword", "?act=account.changepassword").'';
			if($account->getInfo('newEmail') == (null or ""))
				$content .= ' '.$eHTML->simpleButton("changeEmail", "?act=account.changeemail");		
			if(!$account->loadQuestions())	
				$content .= ' '.$eHTML->simpleButton("setQuestions", "?act=account.setQuestions");	
			$content .= '</td>
		</tr>
	</table>';

/*	// PARTE DE REGISTRO DA CONTA // SOMENTE DISPONIVEL NA PROXIMA VERSÃO 
	$content .= '<br><br>		
	<table cellspacing="1" cellpadding="0" border="0" width="95%" align="center">
		<tr>
			<td class="tableTop" colspan="2">'.$trans_texts['account_registrarion'][$g_language].'</td>
		</tr>';
	if($account->getRegistrarion('primeiroNome') != null or $account->getRegistrarion('primeiroNome') != "")
	{			
		$content .= '<tr>
			<td class="tableContLight" width="25%">'.$trans_texts['real_name'][$g_language].'</td><td class="tableContLight">'.$rlname.'</td>	
		</tr>			
		<tr>
			<td class="tableContLight" width="25%">'.$trans_texts['location'][$g_language].'</td><td class="tableContLight">'.$location.'</td>	
		</tr>	
		<tr>
			<td class="tableContLight" width="25%">'.$trans_texts['URL'][$g_language].'</td><td class="tableContLight">'.$url.'</td>	
		</tr>
	</table>
	<br>
	<table cellspacing="0" cellpadding="0" border="0" width="95%" align="center">
		<tr>
			<td>'.$eHTML->simpleButton("changeinfos", "?act=account.changeinfos").'</td>
		</tr>
	</table>';	
	}	
	else
	{
		$content .= '<tr>
			<td class="tableContLight" colspan="2" width="25%">'.$trans_texts['account_unregistered'][$g_language].'</td>	
		</tr>			
	</table>
	<br>
	<table cellspacing="0" cellpadding="0" border="0" width="95%" align="center">
		<tr>
			<td>'.$eHTML->simpleButton("register", "?act=account.registration").'</td>
		</tr>
	</table>';		
	}*/
	
	$content .= '
	<br><br>
	<table cellspacing="1" cellpadding="0" border="0" width="95%" align="center">
		<tr>
			<td class="tableTop" colspan="2">'.$trans_texts['personal_informations'][$g_language].'</td>
		</tr>
		<tr>
			<td class="tableContLight" width="25%">'.$trans_texts['real_name'][$g_language].'</td><td class="tableContLight">'.$rlname.'</td>	
		</tr>			
		<tr>
			<td class="tableContLight" width="25%">'.$trans_texts['location'][$g_language].'</td><td class="tableContLight">'.$location.'</td>	
		</tr>	
		<tr>
			<td class="tableContLight" width="25%">'.$trans_texts['URL'][$g_language].'</td><td class="tableContLight">'.$url.'</td>	
		</tr>			
	</table>
	<br>
	<table cellspacing="0" cellpadding="0" border="0" width="95%" align="center">
		<tr>
			<td>'.$eHTML->simpleButton("changeinfos", "?act=account.changeinfos").'</td>
		</tr>
	</table>
	<br><br>	
	';
	

	
	$content .= '
	<table cellspacing="1" cellpadding="0" border="0" width="95%" align="center">
		<tr>
			<td class="tableTop" colspan="2">'.$trans_texts['contributions'][$g_language].'</td>
		</tr>';
		
		if(count($account->getPayments()) == 0)
		{
			$content .= '
				<tr>
					<td class="tableContLight">'.$trans_texts['no_contributions'][$g_language].'</td>
				</tr>';
		}	
		else
		{		
			$payments = $engine->loadObject('Payments');
			
			foreach($account->getPayments() as $paymentId)
			{	
				$payments->loadById($paymentId);
				$payment_status = $g_pgtStatus[$payments->getInfo('status')];
				$payment_identificator = ($payments->getInfo('auth') != 0) ? "?act=payment.details&id=".md5($payments->getInfo('auth'))."" : "?act=payment.details&id=".md5($paymentId)."";
				
				$content .= '
				<tr>
					<td class="tableContLight">'.$trans_texts['contribution_info'][$g_language][0].''.$payments->getInfo('period').''.$trans_texts['contribution_info'][$g_language][1].''.$tools->datePt($payments->getInfo('activation'), "dd, mes, aa").''.$trans_texts['contribution_info'][$g_language][2].''.$trans_texts[$payment_status][$g_language].'.</td><td class="tableContLight"><center>'.$eHTML->simpleButton("details", $payment_identificator).'</td>
				</tr>';	
			}	
		}	
					
	$content .= '</table><br>
	<table cellspacing="0" cellpadding="0" border="0" width="95%" align="center">
		<tr>
			<td>'.$eHTML->simpleButton("contribute", "?act=contribute").'</td>
		</tr>
	</table>
	<br><br>';		
	

	
	$content .= '<table cellspacing="1" cellpadding="0" border="0" width="95%" align="center">
		<tr>
			<td class="tableTop" colspan="4">'.$trans_texts['my_characters'][$g_language].'</td>
		</tr>	
		<tr>
			<td class="tableContLight" width="25%"><b>'.$trans_texts['name'][$g_language].'</td><td class="tableContLight"><b>'.$trans_texts['world'][$g_language].'</td><td class="tableContLight"><b>'.$trans_texts['status'][$g_language].'</td><td class="tableContLight"></td>		
		</tr>		
	';
	
	$player = $engine->loadObject('Player');
	$playerList = $player->loadByAccount($_SESSION['account']);
	if(count($playerList) != 0)
	{
		foreach($playerList as $pid)
		{
			$player->loadById($pid);
			$content .= '
			<tr>
				<td class="tableContLight" width="25%"><a href="?act=character.details&name='.$player->getInfo('name').'">'.$player->getInfo('name').'</a></td>
				<td class="tableContLight" width="15%">'.$g_world[$player->getInfo('world_id')]['name'].'</td>
				<td class="tableContLight" width="35%">'.$player->getStatus().'</td>
				<td class="tableContLight">'.$eHTML->simpleButton("preferences", "?act=character.preferences&id=".md5($player->getInfo('id'))."").'</td>			
			</tr>';		
		}
	}
	else
	{
			$content .= '
			<tr>
				<td colspan="2" class="tableContLight" width="25%">'.$trans_texts['no_characters_created'][$g_language].'</td>	
			</tr>';		
	}
	$DB->query("SELECT 
					player.name 
				FROM 
					chardeletions as del, 
					characterlist as player 
				WHERE 
					del.player_id = player.id AND 
					player.account_id = '".$_SESSION['account']."'");
	$extraBut = ($DB->num_rows() > 0) ? 
					$eHTML->simpleButton("undeleteCharacter", "?act=account.cancelDeleteChar") :
					'';
	$content .= '
	</table><br>
	<table cellspacing="5" cellpadding="0" border="0" width="95%" align="center">
		<tr>
			<td width="5%">'.$eHTML->simpleButton("newCharacter", "?act=character.create&step=1").'</td>
			<td width="5%">'.$eHTML->simpleButton("deleteCharacter", "?act=account.deleteChar").'</td>
			<td>'.$extraBut.'</td>
		</tr>
	</table>';
}	
?>