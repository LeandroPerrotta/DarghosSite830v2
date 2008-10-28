<?
$name = $_REQUEST['name'];

if(!empty($name))
{
	$playerLoad = false;
	
	$player = $engine->loadObject('player');	
	if($player->load($name))
	{	
		$playerLoad = true;
		
		$account = $engine->loadObject('Account');
		$account->loadByNumber($player->getInfo('account_id'));

		$account->load();		
		
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
		
		if($player->getInfo('lastlogin') != 0)
			$lastlogin = $tools->datePt($player->getInfo('lastlogin'));
		else
			$lastlogin = $trans_texts['never_loggedIn'][$g_language];
		
		if($account->getInfo('premdays') != 0)
			$premiumType = '<font color="green"><b>'.$trans_texts['premium_account'][$g_language].'</b></font>';
		else
			$premiumType = $trans_texts['free_account'][$g_language];	
		
		$content .= '
			<table cellspacing="1" cellpadding="0" border="0" width="95%" align="center">
				<tr>
					<td class="tableTop" colspan="4">'.$trans_texts['character_details'][$g_language].'</td>
				</tr>	
				<tr>
					<td class="tableContLight" width="25%">'.$trans_texts['name'][$g_language].'</td><td class="tableContLight">'.$player->getInfo('name').'</td>
				</tr>		
				<tr>
					<td class="tableContLight">'.$trans_texts['sex'][$g_language].'</td><td class="tableContLight">'.$trans_texts[$g_sex[$player->getInfo('sex')]['name']][$g_language].'</td>
				</tr>	
				<tr>
					<td class="tableContLight">'.$trans_texts['level'][$g_language].'</td><td class="tableContLight">'.$player->getInfo('level').'</td>
				</tr>					
				<tr>
					<td class="tableContLight">'.$trans_texts['vocation'][$g_language].'</td><td class="tableContLight">'.$trans_texts[$g_vocation[$player->getInfo('vocation')]['name']][$g_language].'</td>
				</tr>				
				<tr>
					<td class="tableContLight">'.$trans_texts['world'][$g_language].'</td><td class="tableContLight">'.$g_world[$player->getInfo('world_id')]['name'].'</td>
				</tr>		
				<tr>
					<td class="tableContLight">'.$trans_texts['residence'][$g_language].'</td><td class="tableContLight">'.$g_city[$player->getInfo('town_id')]['name'].'</td>
				</tr>	
				<tr>
					<td class="tableContLight">'.$trans_texts['lastlogin'][$g_language].'</td><td class="tableContLight">'.$lastlogin.'</td>
				</tr>';
		if($player->getInfo('comment') != null or $player->getInfo('comment') != "")
		{
				$content .= '<tr>
					<td class="tableContLight" width="20%">'.$trans_texts['comment'][$g_language].'</td><td class="tableContLight">'.$player->getInfo('comment').'</td>
				</tr>';
		}
				$content .= '<tr>
					<td class="tableContLight" width="20%">'.$trans_texts['account_type'][$g_language].'</td><td class="tableContLight">'.$premiumType.'</td>
				</tr>					
			</table>
			<br>
			<table cellspacing="1" cellpadding="0" border="0" width="95%" align="center">
				<tr>
					<td class="tableTop" colspan="4">'.$trans_texts['personal_informations'][$g_language].'</td>
				</tr>	
				<tr>
					<td class="tableContLight" width="25%">'.$trans_texts['real_name'][$g_language].'</td><td class="tableContLight">'.$rlname.'</td>
				</tr>		
				<tr>
					<td class="tableContLight">'.$trans_texts['location'][$g_language].'</td><td class="tableContLight">'.$location.'</td>
				</tr>	
				<tr>
					<td class="tableContLight">'.$trans_texts['URL'][$g_language].'</td><td class="tableContLight">'.$url.'</td>
				</tr>											
			</table>			
		';	
	
		if($player->getInfo('hide') == 0)
		{
			$playerList = $player->loadByAccount($player->getInfo('account_id'));
			$playersOnAcc = false;
			if(count($playerList) != 0)
			{
				foreach($playerList as $pid)
				{
					$player->loadById($pid);
					
					if($player->getInfo('hide') == 0)
					{
						$playersOnAcc = true;
						$players .= '
						<tr>
							<td class="tableContLight" width="25%">'.$player->getInfo('name').'</td><td class="tableContLight" width="15%">'.$g_world[$player->getInfo('world_id')]['name'].'</td><td class="tableContLight" width="35%">'.$trans_texts['stat_'.$player->getStatus()][$g_language].'</td><td class="tableContLight" width="35%">'.$eHTML->simpleButton("view", "?act=character.details&name=".$player->getInfo('name')."").'</td>				
						</tr>';
					}	
				}
			}
			
			if($playersOnAcc)
			{
				$content .= '<br><table cellspacing="1" cellpadding="0" border="0" width="95%" align="center">	
					<tr>
						<td class="tableTop" colspan="4">'.$trans_texts['other_characters'][$g_language].'</td>
					</tr>
					<tr>
						<td class="tableContLight" width="25%"><b>'.$trans_texts['name'][$g_language].'</b></td><td class="tableContLight" width="15%"><b>'.$trans_texts['world'][$g_language].'</b></td><td class="tableContLight" width="35%"><b>'.$trans_texts['status'][$g_language].'</b></td><td class="tableContLight" width="35%"></td>			
					</tr>						
					'.$players.'	
				</table>';		
			}
		}	
	
	}
	else
	{
		$warn = $lang->getWarning('char.naoExiste');
		$condition = array
		(
			"title" => $warn['title'],
			"msg" => $warn['msg'],
			"buttons" => $eHTML->simpleButton('back','?act=character.details')
		);		
	}
	
	if(!$playerLoad)
		$content .= $eHTML->conditionTable($condition);
}
else
{
	$content .= '
		'.$eHTML->formStart('?act=character.details').'
		'.$eHTML->descriptionTable($lang->getDescription('character.details')).'
		<table cellspacing="1" cellpadding="0" border="0" width="95%" align="center">
			<tr>
				<td class="tableTop" colspan="4">'.$trans_texts['character_details'][$g_language].'</td>
			</tr>	
			<tr>
				<td class="tableContLight" width="20%">'.$trans_texts['name'][$g_language].'</td><td class="tableContLight">'.$eHTML->textBoxInput('name', 'text').'</td>
			</tr>				
		</table>
		<br>
		<table cellspacing="0" cellpadding="0" border="0" width="95%" align="center">
			<tr>
				<td><center>
					'.$eHTML->imageButtonInput('next').'</center>	
				</td>
			</tr>
		</table>
		<br>
		'.$eHTML->formEnd().'				
	';	
}
?>