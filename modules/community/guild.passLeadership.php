<?php
include_once('classes/guild.php');
include_once('classes/guildinvite.php');
include_once('classes/guildrank.php');
if(isset($_REQUEST['name']) && $tools->checkString($_REQUEST['name']) && $login->logged()) {
	$guild = Guild::GetGuildByName($_REQUEST['name']);	
	if($guild != null) {
		$DB->query("SELECT 
						name 
					FROM 
						characterlist 
					WHERE 
						id = '{$guild->getOwner_id()}' AND 
						world_id = '{$guild->getWorld_id()}' AND
						account_id = '".$_SESSION['account']."'");
		if($DB->num_rows() > 0) {
			if(isset($_REQUEST['password']) && $tools->checkString($_REQUEST['password']) && 
			   isset($_REQUEST['newLider']) && $tools->checkString($_REQUEST['newLider'])) {
				$account = $engine->loadObject('Account');
				$account->loadByNumber($_SESSION['account']); $account->load();
				$player = $engine->loadObject('Player');
				$player->load($_REQUEST['newLider']);
				$DB->query("SELECT 
								rank.guild_id,
								account.premdays
							FROM
								characterlist as player,
								guild_ranks as rank,
								accounts as account
							WHERE
								player.world_id = rank.world_id AND
								account.id      = player.account_id AND
								player.rank_id  = rank.id AND
								player.name     = '".mysql_escape_string($player->getInfo('name'))."' AND
								rank.world_id   = '{$guild->getWorld_id()}'");
				$fetch = $DB->fetch();
				echo $account->getPassword();
				if($account->getPassword() != md5($_REQUEST['password'])) {
					//Senha errada
					$warn = $lang->getWarning('guilds.wrongPassword');
					$condition = array(
						'title' => $warn['title'],
						'msg' => $warn['msg'],
						'buttons' => $eHTML->simpleButton('back', '?act=guilds.passLeadership&name='.urlencode($guild->getName()))
					);
				} elseif($fetch->guild_id != $guild->getId()) {
					//Player não é da guild
					$warn = $lang->getWarning('guilds.playerNotThisGuild');
					$condition = array(
						'title' => $warn['title'],
						'msg' => $warn['msg'],
						'buttons' => $eHTML->simpleButton('back', '?act=guilds.passLeadership&name='.urlencode($guild->getName()))
					);
				} elseif($player->getInfo('level') < GUILD_MIN_LEVEL) {
					//Player low level
					$warn = $lang->getWarning('guilds.lowerLevel');
					$condition = array(
						'title' => $warn['title'],
						'msg' => $warn['msg'][0].GUILD_MIN_LEVEL.$warn['msg'][1],
						'buttons' => $eHTML->simpleButton('back', '?act=guilds.passLeadership&name='.urlencode($guild->getName()))
					);
			   	} elseif($fetch->premdays < 1) {
					//Player low level
					$warn = $lang->getWarning('guilds.notPremium');
					$condition = array(
						'title' => $warn['title'],
						'msg' => $warn['msg'],
						'buttons' => $eHTML->simpleButton('back', '?act=guilds.passLeadership&name='.urlencode($guild->getName()))
					);
			   	} else {
					$mysql = DB::getInstance();
					//ID - Rank Membro
					$mysql->query("SELECT id FROM guild_ranks 
								   WHERE guild_id = '{$guild->getId()}' AND world_id = '{$guild->getWorld_id()}' AND level = '3'");
					$memberRank = $mysql->fetch()->id;
					
					//ID - Rank Lider
					$mysql->query("SELECT id FROM guild_ranks 
								   WHERE guild_id = '{$guild->getId()}' AND world_id = '{$guild->getWorld_id()}' AND level = '1'");
					$leaderRank = $mysql->fetch()->id;
					
					//Colocar líder de membro
					$mysql->query("UPDATE 
										characterlist 
								   SET 
										rank_id = '{$memberRank}'
								   WHERE 
										id = '{$guild->getOwner_id()}' AND
										world_id = '{$guild->getWorld_id()}'");
					$mysql->query("UPDATE
										players
								   SET
								   		rank_id = '{$memberRank}'
								   WHERE
								   		id = '{$guild->getOwner_id()}'", $g_world[$guild->getWorld_id()]['sqlResource']);
								   		
					//Colocar "membro" de líder
					$mysql->query("UPDATE 
										characterlist 
								   SET 
										rank_id = '{$leaderRank}'
								   WHERE 
										id = '".$player->getInfo('id')."' AND
										world_id = '{$guild->getWorld_id()}'");
					$mysql->query("UPDATE
										players
								   SET
								   		rank_id = '{$leaderRank}'
								   WHERE
								   		id = '".$player->getInfo('id')."'", $g_world[$guild->getWorld_id()]['sqlResource']);
								   		
					$guild->setOwner_id($player->getInfo('id'));
					$guild->save();
								   
					$warn = $lang->getWarning('guilds.passLeadershipSuccess');
					$condition = array(
						'title' => $warn['title'],
						'msg' => $warn['msg'],
						'buttons' => $eHTML->simpleButton('back', '?act=guilds.view&name='.urlencode($guild->getName()))
					);
				}
				$content .= $eHTML->conditionTable($condition);
			} else {
				$guild->loadRanks(true, "AND level >= 2 ORDER BY level ASC");
				foreach($guild->getRanks() as $rank) {
					$rank->loadPlayers('ORDER BY name ASC');
					if(count($rank->getPlayers()) < 1) {
						continue;
					}
					foreach($rank->getPlayers() as $player) {
						$members[] = array('valueName' => $player['name'].' ('.$rank->getName().')', 
										   'valueId' => $player['name']);;
					}
				}
				$content .= $eHTML->formStart('?act=guilds.passLeadership&name='.urlencode($guild->getName()));
				$form .= '<br>';
				$form .= '<table width="100%"><tr><td width="25%">';
				$form .= $trans_texts['guilds.newLeader'][$g_language];
				$form .= '</td><td>';
				$form .= $eHTML->selectBoxInput('newLider', $members, true);
				$form .= '</td></tr><tr><td>';
				$form .= $trans_texts['password'][$g_language];
				$form .= '</td><td>';
				$form .= $eHTML->textBoxInput("password", "password", null, 15);
				$form .= '</td></tr></table>';
				$form .= '</center>';
				
				$warn = $lang->getWarning('guilds.passLeadership');
				$condition = array(
					'title' => $warn['title'],
					'msg' => $warn['msg'].'<br>'.$form,
					'buttons' => $eHTML->imageButtonInput("next").' '.
							 	 $eHTML->simpleButton('back', '?act=guilds.view&name='.urlencode($guild->getName()))
				);
				$content .= $eHTML->conditionTable($condition);
				$content .= $eHTML->formEnd();
			}
		} else {
			$warn = $lang->getWarning('guilds.charNaoPosse');
			$condition = array(
				'title' => $warn['title'],
				'msg' => $warn['msg'],
				'buttons' => $eHTML->simpleButton('back', '?act=guilds.view&name='.urlencode($guild->getName()))
			);
			$content .= $eHTML->conditionTable($condition);
		}
	}
}
?>