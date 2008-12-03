<?php
include_once('classes/guild.php');
include_once('classes/guildinvite.php');
include_once('classes/guildrank.php');
if(isset($_REQUEST['name']) && $tools->checkString($_REQUEST['name'])) {
	$guild = Guild::GetGuildByName($_REQUEST['name']);
	if($guild != null) {
		$_logged = $login->logged();
		$_guildLevel = 0;
		if($_logged) {
			$account = $engine->loadObject('Account');
			$account->loadByNumber($_SESSION['account']);
			$DB->query("SELECT 	
							name 
						FROM 
							characterlist 
						WHERE 
							id = '{$guild->getOwner_id()}' AND 
							world_id = '{$guild->getWorld_id()}'");
			$playerName = $DB->fetch();
			if($account->hasThisChar($playerName)) {
				$_guildLevel = 1;
			} else {
				$DB->query("SELECT 
								rank.level
							FROM 
								characterlist as player, 
								guild_ranks as rank 
							WHERE 
								rank.guild_id = '{$guild->getId()}' AND
								rank.world_id = '{$guild->getWorld_id()}' AND
								player.rank_id = rank.id AND
								player.account_id = '{$account->getNumber()}'
								player.world_id = rank.world_id
							ORDER BY
								rank.level
							ASC
							LIMIT 1");
				if($DB->num_rows() > 0) {
					$_guildLevel = $DB->fetch()->level;
				}
			}
		}
		$image = ($guild->getImage() == 1) ? GUILD_IMAGES_DIR.md5($guild->getName()).'.jpg' : GUILD_DEFAULT_NOIMG;
		$content .= '<table>	
						<tr>
							<td>
								<center><img src="'.$image.'" alt="" /></center>
							</td>
							<td>
								<center><h1>'.$guild->getName().'</h1></center>
							</td>
							<td>
								<center><img src="'.$image.'" alt="" /></center>
							</td>
						</tr>
					 </table><br>';
		$date = ($g_language == "br") ? $tools->datePt($guild->getCreation(), "dd m aaaa") : date("d M Y", $guild->getCreation());
		
		$content .= $trans_texts['guilds.funded'][$g_language][0];
		$content .= $g_world[$guild->getWorld_id()]['name'];
		$content .= $trans_texts['guilds.funded'][$g_language][1];
		$content .= $date;
		$content .= '<br>';
		$content .= $trans_texts['guilds.inFormation'][$guild->getFormation()][$g_language];
		$content .= '<br>';
		if($_guildLevel == 1) {
			$content .= $eHTML->simpleButton('disbandGuild', '?act=guilds.disband&name='.urlencode($guild->getName()));
		}
		
		$guild->loadRanks(true, "ORDER BY level DESC");
		$content .= '<table cellspacing="1" cellpadding="0" border="0" width="95%" align="center">
						<tr>
							<td class="tableTop" colspan="3">
								'.$trans_texts['guilds.members'][$g_language].'
							</td>
						</tr>';
		$content .= '<tr>
						<td class="tableContDark">
							<b>'.$trans_texts['guilds.rank'][$g_language].'</b>
						</td>
						<td class="tableContDark">
							<b>'.$trans_texts['guilds.nameAndTitle'][$g_language].'</b>
						</td>
						<td class="tableContDark">
							<b>'.$trans_texts['guilds.joining'][$g_language].'</b>
						</td>
					 </tr>';
		$handler = 0;
		foreach($guild->getRanks() as $rank) {
			$rank->loadPlayers('ORDER BY name ASC');
			foreach($rank->getPlayers() as $player) {
				$tdStyle = ($handler == 0) ? 'tableContLight' : 'tableContDark';
				$title = ($player['guildnick'] != '') ? '('.$player['guildnick'].')' : '';
				$date = ($g_language == "br") ? $tools->datePt($player['joining_date'], "dd m aaaa") : 
												date("d M Y", $player['joining_date']);
				if(in_array($rank->getId(), $ranks)) {
					$rankName = '&nbsp;';
				} else {
					$rankName = $rank->getName();
					$ranks[] = $rank->getId();
				}
				$content .= '<tr>
								<td class="'.$tdStyle.'">
									'.$rankName.'
								</td>
								<td class="'.$tdStyle.'">
									'.$player['name'].' '.$title.'
								</td>
								<td class="'.$tdStyle.'">
									'.$date.'
								</td>
							</tr>';
				$handler = ($handler == 0) ? 1 : 0;
			}
		}
		$content .= '</table><br>';
		
		if($_guildLevel == 1) {
			$content .= $eHTML->simpleButton('editRanks', '?act=guilds.editRanks&name='.urlencode($guild->getName()));
		}
		if($_guildLevel == 1 or $_guildLevel == 2) {
			$content .= $eHTML->simpleButton('editMembers', '?act=guilds.editMembers&name='.urlencode($guild->getName()));
		}
		$content .= '<br>';
		
		$guild->loadInvites(true);
		if(count($guild->getInvites()) > 0) {
			$content .= '<table cellspacing="1" cellpadding="0" border="0" width="95%" align="center">
							<tr>
								<td class="tableTop" colspan="2">
									'.$trans_texts['guilds.invites'][$g_language].'
								</td>
							</tr>';
			$content .= '<tr>
							<td class="tableContDark">
								<b>'.$trans_texts['name'][$g_language].'</b>
							</td>
							<td class="tableContDark">
								<b>'.$trans_texts['guilds.invitationDate'][$g_language].'</b>
							</td>
					 	</tr>';
			foreach($guild->getInvites() as $invite) {
				$date = ($g_language == "br") ? $tools->datePt($invite->getDate(), "dd m aaaa") : 
												date("d M Y", $invite->getDate());
				$content .= '<tr>
								<td class="'.$tdStyle.'">
									'.$invite->getPlayerName().'
								</td>
								<td class="'.$tdStyle.'">
									'.$date.'
								</td>
							</tr>';
			}
			$content .= '</table>';
		}
		if($_guildLevel == 1 or $_guildLevel == 2) {
			$content .= $eHTML->simpleButton('inviteMember', '?act=guilds.inviteMember&name='.urlencode($guild->getName()));
		}
		
	} else {
		//Guild not founded :D
	}
}
?>