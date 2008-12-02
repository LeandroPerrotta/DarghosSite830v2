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
		$DB->query("SELECT DISTINCT 
						world_id 
					FROM 
						characterlist 
					WHERE 
						account_id = '{$account->getNumber()}' AND
						level >= '".GUILD_MIN_LEVEL."'");
		while($worldId = $DB->fetch()->world_id) {
			$worlds[] = array('valueName' => $g_world[$worldId]['name'], 
							  'valueId' => $g_world[$worldId]['name']);
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
		$guildName = $_REQUEST['guild_name'];
		$password = $_REQUEST['password'];
		
		if($account->getPassword() != md5($password)) {
			//Senha errada
		}
		if($player->getInfo('level') < GUILD_MIN_LEVEL) {
			//Player level baixo
		}
		if(!$account->hasThisChar($selectedPlayer->getInfo('name'))) {
			//Player não é da conta
		}
		if(!Guild::canUseName($guildName)) {
			//Não pode usar esse nome da guild
		}
		$guild = new Guild();
		$guild->setCreation(time());
		$guild->setFormation(1);
		$guild->setName($guildName);
		$guild->setMotd(null);
		$guild->setOwner_id($selectedPlayer->getInfo('id'));
		$guild->setWorld_id($selectedWorld['id']);
		$guild->save();
		
		//Guild criada com sucesso!
	}
} else {
	// NO LOGGED
}
?>