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
			if(isset($_REQUEST['type'])) {
				if($_REQUEST['type'] == '1' && isset($_POST['ranksNumber']) && $tools->checkString($_POST['ranksNumber'])) {
					//alterar numero de membros
					$ranksN = (int)$_POST['ranksNumber'];
					$worldResource = $g_world[$guild->getWorld_id()]['sqlResource'];
					$DB->query("DELETE FROM guild_ranks WHERE guild_id = '{$guild->getId()}' AND world_id = '{$guild->getWorld_id()}' AND level > '3'");
					$DB->query("DELETE FROM guild_ranks WHERE guild_id = '{$guild->getId()}' AND level > '3'", $worldResource);
					if($ranksN > 3 && $ranksN <= 20) {
						for($i = 4; $i <= $ranksN; $i++) {
							$DB->query("INSERT INTO guild_ranks(guild_id, name, level) 
										VALUES('{$guild->getId()}', 'Member{$i}', '{$i}')", $worldResource);
							$rankId = $DB->last_insert_id($worldResource);
							$DB->query("INSERT INTO guild_ranks(id, guild_id, world_id, name, level) 
										VALUES('{$rankId}', '{$guild->getId()}', '{$guild->getWorld_id()}', 'Member{$i}', '{$i}')");
						}
					}
					$warn = $lang->getWarning('guilds.ranksNumbers');
					$condition = array(
						'title' => $warn['title'],
						'msg' => $warn['msg'],
						'buttons' => $eHTML->simpleButton('back', '?act=guilds.editRanks&name='.urlencode($guild->getName()))
					);
					$content .= $eHTML->conditionTable($condition);
				} elseif($_REQUEST['type'] == '2' && 
						 isset($_POST['rankLevel']) && $tools->checkString($_POST['rankLevel']) && 
						 isset($_POST['newName']) && $tools->checkString($_POST['newName'])) {
					//alterar nome do rank
					if(!$tools->canUseName($_POST['newName'], true)) {
						$warn = $lang->getWarning('guilds.invalidRankName');
						$condition = array(
							'title' => $warn['title'],
							'msg' => $warn['msg'],
							'buttons' => $eHTML->simpleButton('back', '?act=guilds.editRanks&name='.urlencode($guild->getName()))
						);
					} else {
						$DB->query("UPDATE guild_ranks SET name = '".$_POST['newName']."' 
									WHERE guild_id = '{$guild->getId()}' AND world_id = '{$guild->getWorld_id()}' AND 
										  level = '".$_POST['rankLevel']."'");
						$DB->query("UPDATE guild_ranks SET name = '".$_POST['newName']."' 
									WHERE guild_id = '{$guild->getId()}' AND 
										  level = '".$_POST['rankLevel']."'", $g_world[$guild->getWorld_id()]['sqlResource']);
						$warn = $lang->getWarning('guilds.rankNameChanged');
						$condition = array(
							'title' => $warn['title'],
							'msg' => $warn['msg'],
							'buttons' => $eHTML->simpleButton('back', '?act=guilds.editRanks&name='.urlencode($guild->getName()))
						);
					}
					
					$content .= $eHTML->conditionTable($condition);
				}
			} else {
				$guild->loadRanks(true, "ORDER BY level ASC");
				foreach($guild->getRanks() as $rank) {
					$ranks[] = array('valueName' => $rank->getLevel().': '.$rank->getName(), 
									 'valueId' => $rank->getLevel());
				}
				$numberOfRanks = count($ranks);
				for($i = 3; $i <= 20; $i++) {
					if($numberOfRanks == $i) {
						$ranksNumber[] = array('valueName' => $i, 
									 	   	   'valueId' => $i, 'select' => true);
					} else {
						$ranksNumber[] = array('valueName' => $i, 
									 	   	   'valueId' => $i);
					}
				}				
				$content .= '<table cellspacing="1" cellpadding="0" border="0" width="95%" align="center">
						<tr>
							<td class="tableTop">
								'.$trans_subTopicPages['community.guilds.editRanks'][$g_language].'
							</td>
						</tr>';
				$content .= '<tr>
								<td class="tableContLight">
									'.$eHTML->formStart('?act=guilds.editRanks&name='.urlencode($guild->getName()).'&type=1').'
									<table width="100%"><tr><td width="70%">
									'.$trans_texts['guilds.ranksNumber'][$g_language].'
									'.$eHTML->selectBoxInput('ranksNumber', $ranksNumber, true).'
									<small>'.$trans_texts['guilds.ranksNumberLimit'][$g_language].'</small>
									</td><td>
									'.$eHTML->imageButtonInput("next").'
									</td></tr>
									</table>
									'.$eHTML->formEnd().'
								</td>
							 </tr>';
				$content .= '<tr>
								<td class="tableContLight">
									'.$eHTML->formStart('?act=guilds.editRanks&name='.urlencode($guild->getName()).'&type=2').'
									<table width="100%"><tr><td width="70%">
									'.$trans_texts['guilds.setRank'][$g_language][0].'
									'.$eHTML->selectBoxInput('rankLevel', $ranks, true).'<br>
									'.$trans_texts['guilds.setRank'][$g_language][1].'
									'.$eHTML->textBoxInput('newName').'
									</td><td>
									'.$eHTML->imageButtonInput("next").'
									</td></tr>
									</table>
									'.$eHTML->formEnd().'
								</td>
							 </tr>';
				
				$content .= '</table><br><center>';
				
				$content .= $eHTML->simpleButton('back', '?act=guilds.view&name='.urlencode($guild->getName()));
				$content .= '</center>';
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