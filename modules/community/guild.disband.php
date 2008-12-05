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
			if(isset($_REQUEST['password']) && $tools->checkString($_REQUEST['password'])) {
				$account = $engine->loadObject('Account');
				$account->loadByNumber($_SESSION['account']);
				if($account->getPassword() != md5($_REQUEST['password'])) {
					//Senha errada
					$warn = $lang->getWarning('guilds.wrongPassword');
					$condition = array(
						'title' => $warn['title'],
						'msg' => $warn['msg'],
						'buttons' => $eHTML->simpleButton('back', '?act=guilds.view&name='.urlencode($guild->getName()))
					);
				} else {
					$mysql = DB::getInstance();
					$guild->loadRanks(true);
					foreach($guild->getRanks() as $rank) {
						$rank->loadPlayers();
						if(count($rank->getPlayers()) > 0) {
							foreach($rank->getPlayers() as $player) {
								$mysql->query("UPDATE characterlist 
											SET 
												rank_id = '0', guildnick = '', joining_date = '0' 
											WHERE 
												id = '".$player['id']."' AND
												world_id = '{$guild->getWorld_id()}'");
							
								$mysql->query("UPDATE players SET rank_id = '0', guildnick = '' WHERE id = '".$player['id']."'", 
										  	  $g_world[$guild->getWorld_id()]['sqlResource']);
							}
						}
						$mysql->query("DELETE FROM guild_ranks 
									   WHERE id       = '{$rank->getId()}' AND 
									   		 guild_id = '{$guild->getId()}' AND 
									   		 world_id = '{$rank->getWorld_id()}'");
						$mysql->query("DELETE FROM guild_ranks WHERE id = '{$rank->getId()}' AND guild_id = '{$guild->getId()}'", 
									  $g_world[$guild->getWorld_id()]['sqlResource']);
					}
					$mysql->query("DELETE FROM guilds WHERE id = '{$guild->getId()}' AND world_id = '{$guild->getWorld_id()}'");
					$mysql->query("DELETE FROM guilds WHERE id = '{$guild->getId()}'", 
								   $g_world[$guild->getWorld_id()]['sqlResource']);
								   
					$warn = $lang->getWarning('guilds.disbanded');
					$condition = array(
						'title' => $warn['title'],
						'msg' => $warn['msg'],
						'buttons' => $eHTML->simpleButton('back', '?act=guilds')
					);
				}
				$content .= $eHTML->conditionTable($condition);
			} else {
				$content .= $eHTML->formStart('?act=guilds.disband&name='.urlencode($guild->getName()));
				$form .= '<center>';
				$form .= $eHTML->textBoxInput("password", "password", null, 15);
				$form .= '</center>';
				
				$warn = $lang->getWarning('guilds.disbandConf');
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