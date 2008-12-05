<?php
include_once('classes/guild.php');
include_once('classes/guildinvite.php');
include_once('classes/guildrank.php');
if(isset($_REQUEST['name']) && $tools->checkString($_REQUEST['name']) && $login->logged()) {
	$guild = Guild::GetGuildByName($_REQUEST['name']);	
	if($guild != null) {
				$DB->query("SELECT 
						rank.level
					FROM 
						characterlist as player, 
						guild_ranks as rank 
					WHERE 
						rank.guild_id = '{$guild->getId()}' AND
						rank.world_id = '{$guild->getWorld_id()}' AND
						player.rank_id = rank.id AND
						player.account_id = '".$_SESSION['account']."' AND
						player.world_id = rank.world_id
					ORDER BY
						rank.level
					ASC
					LIMIT 1");
		$_guildLevel = $DB->fetch()->level;
		if($_guildLevel < 3) {
			if(true == true) {
				//TODO - actions and condition /\
			} else {
				$guild->loadRanks(true, "AND level >= 2 ORDER BY level ASC");
				foreach($guild->getRanks() as $rank) {
					$ranks[] = array('valueName' => $rank->getLevel().': '.$rank->getName(), 
									 'valueId' => $rank->getLevel());
					$rank->loadPlayers('ORDER BY name ASC');
					if(count($rank->getPlayers()) < 1) {
						continue;
					}
					foreach($rank->getPlayers() as $player) {
						$members[] = array('valueName' => $player['name'].' ('.$rank->getName().')', 
										   'valueId' => $player['name']);;
					}
				}
				// TODO - form
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