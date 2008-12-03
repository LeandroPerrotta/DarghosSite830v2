<?php
include_once('classes/guild.php');
include_once('classes/guildinvite.php');
include_once('classes/guildrank.php');
if($login->logged()) {
	#Step 1 - Selecionando o mundo disponível
	$isPremium = false;
	$account = $engine->loadObject('Account');
	$account->loadByNumber($_SESSION['account']);
	$account->load();
	if($account->getPremDays() > 0) {
		$DB->query("SELECT
						world_id 
					FROM 
						characterlist 
					WHERE 
						account_id = '{$account->getNumber()}' AND
						level >= '".GUILD_MIN_LEVEL."'");
		while($worldId = $DB->fetch()->world_id) {
			$worlds[$worldId] = array('valueName' => $g_world[$worldId]['name'], 
							  		  'valueId'   => $g_world[$worldId]['name']);
		}
		$content .= '
				'.$eHTML->formStart('?act=guilds.found').'
				<table cellspacing="1" cellpadding="0" border="0" width="95%" align="center">
					<tr>
						<td class="tableTop" colspan="4">'.$trans_texts['select_world'][$g_language].'</td>
					</tr>	
					<tr>
						<td class="tableContLight" width="20%">
							'.$trans_texts['world'][$g_language].'
						</td>
						<td class="tableContLight">
							'.$eHTML->selectBoxInput('world', $worlds).'
						</td>
					</tr>				
				</table>
				<br><center>'.$eHTML->imageButtonInput('next').'</center>
				<br>
				'.$eHTML->formEnd();
		$isPremium = true;
	} else {
		$isPremium = false;
	}
	#Step 2 - Botando informações
	if($isPremium && isset($_REQUEST['world']) && $tools->checkString($_REQUEST['world'])) {
		$selectedWorld = $tools->getServerByName($_REQUEST['world']);
		$DB->query("SELECT 
						name 
					FROM 
						characterlist 
					WHERE 
						account_id = '{$account->getNumber()}' AND
						level >= '".GUILD_MIN_LEVEL."' AND
						world_id = '".$selectedWorld['id']."'");
						
		while($player = $DB->fetch()) {
			$chars[] = array('valueName' => $player->name,
							 'valueId' => $player->name);
		}
		$content .= '
				'.$eHTML->formStart('?act=guilds.found').'
				<table cellspacing="1" cellpadding="0" border="0" width="95%" align="center">
					<tr>
						<td class="tableTop" colspan="4">'.$trans_texts['guilds.found'][$g_language].'</td>
					</tr>	
					<tr>
						<td class="tableContLight" width="20%">
							'.$trans_texts['guilds.name'][$g_language].'
						</td>
						<td class="tableContLight">
							'.$eHTML->textBoxInput('guild_name').'
						</td>
					</tr>
					<tr>
						<td class="tableContLight" width="20%">
							'.$trans_texts['world'][$g_language].'
						</td>
						<td class="tableContLight">
							'.$eHTML->hiddenInput('world', $selectedWorld['name']).$selectedWorld['name'].'
						</td>
					</tr>
					<tr>
						<td class="tableContLight" width="20%">
							'.$trans_texts['guilds.leader'][$g_language].'
						</td>
						<td class="tableContLight">
							'.$eHTML->selectBoxInput('guild_owner', $chars).'
						</td>
					</tr>	
					<tr>
						<td class="tableContLight" width="20%">
							'.$trans_texts['password'][$g_language].'
						</td>
						<td class="tableContLight">
							'.$eHTML->textBoxInput('password', 'password').'
						</td>
					</tr>			
				</table>
				<br><center>'.$eHTML->imageButtonInput('next').'</center>
				<br>
				'.$eHTML->formEnd();
	}
	
	if($isPremium  && 
	   isset($_REQUEST['world']) && 
	   $tools->checkString($_REQUEST['world']) &&
	   isset($_REQUEST['guild_name']) && 
	   $tools->checkString($_REQUEST['guild_name']) &&
	   isset($_REQUEST['guild_owner']) && 
	   $tools->checkString($_REQUEST['guild_owner']) &&
	   isset($_REQUEST['password']) && 
	   $tools->checkString($_REQUEST['password'])) {
	   	
		$selectedWorld = $tools->getServerByName($_REQUEST['world']);
		$selectedPlayer = $engine->loadObject('Player');
		$selectedPlayer->load($_REQUEST['guild_owner']);
		$guildName = ucfirst(strtolower($_REQUEST['guild_name']));
		$password = $_REQUEST['password'];
		
		$_Error = false;
		
		if($account->getPassword() != md5($password)) {
			//Senha errada
			$_Error = true;
			$warn = $lang->getWarning('guilds.wrongPassword');
			$condition = array(
				'title' => $warn['title'],
				'msg' => $warn['msg'],
				'buttons' => $eHTML->simpleButton('back', '?act=guilds.found')
			);
		}
		if($player->getInfo('level') < GUILD_MIN_LEVEL) {
			//Player level baixo
			$_Error = true;
			$warn = $lang->getWarning('guilds.lowerLevel');
			$condition = array(
				'title' => $warn['title'],
				'msg' => $warn['msg'][0].GUILD_MIN_LEVEL.$warn['msg'][1],
				'buttons' => $eHTML->simpleButton('back', '?act=guilds.found')
			);
		}
		if(!$account->hasThisChar($selectedPlayer->getInfo('name'))) {
			//Player não é da conta
			$_Error = true;
			$warn = $lang->getWarning('guilds.charNaoPosse');
			$condition = array(
				'title' => $warn['title'],
				'msg' => $warn['msg'],
				'buttons' => $eHTML->simpleButton('back', '?act=guilds.found')
			);
		}
		if(!Guild::canUseName($guildName)) {
			//Não pode usar esse nome da guild
			$_Error = true;
			$warn = $lang->getWarning('guilds.cantUseName');
			$condition = array(
				'title' => $warn['title'],
				'msg' => $warn['msg'],
				'buttons' => $eHTML->simpleButton('back', '?act=guilds.found')
			);
		}
		if(!$_Error) {
			$guild = new Guild();
			$guild->setCreation(time());
			$guild->setFormation(1);
			$guild->setName($guildName);
			$guild->setMotd(null);
			$guild->setOwner_id($selectedPlayer->getInfo('id'));
			$guild->setWorld_id($selectedWorld['id']);
			$guild->save();
			
			$L_guildRank = new GuildRank();
			$L_guildRank->setGuild_id($guild->getId());
			$L_guildRank->setWorld_id($selectedWorld['id']);
			$L_guildRank->setName("Leader");
			$L_guildRank->setLevel(1);
			$L_guildRank->save();
			
			$V_guildRank = new GuildRank();
			$V_guildRank->setGuild_id($guild->getId());
			$V_guildRank->setWorld_id($selectedWorld['id']);
			$V_guildRank->setName("Vice-Leader");
			$V_guildRank->setLevel(2);
			$V_guildRank->save();
			
			$M_guildRank = new GuildRank();
			$M_guildRank->setGuild_id($guild->getId());
			$M_guildRank->setWorld_id($selectedWorld['id']);
			$M_guildRank->setName("Member");
			$M_guildRank->setLevel(3);
			$M_guildRank->save();
			
			$DB->query("UPDATE 
							characterlist 
						SET 
							rank_id = '{$L_guildRank->getId()}',
							joining_date = '".time()."'
						WHERE 
							id = '{$guild->getOwner_id()}' AND 
							world_id = '{$guild->getWorld_id()}'");
			$DB->query("UPDATE
							players
						SET
							rank_id = '{$L_guildRank->getId()}'
						WHERE
							id = '{$guild->getOwner_id()}'", $selectedWorld['sqlResource']);
			
			
			$warn = $lang->getWarning('guilds.success');
			$condition = array(
				'title' => $warn['title'],
				'msg' => $warn['msg'],
				'buttons' => $eHTML->simpleButton('back', '?act=guilds&world='.$selectedWorld['name'])
			);
		}
		$content .= $eHTML->conditionTable($condition);
	}
}
?>