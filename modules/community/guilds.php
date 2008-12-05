<?php 
foreach($g_world as $world) {
	$worlds[] = array('valueName' => $world['name'], 'valueId' => $world['name']);
}
$content .= '
		'.$eHTML->formStart('?act=guilds').'
		'.$eHTML->descriptionTable($lang->getDescription('community.guilds')).'
		<table cellspacing="1" cellpadding="0" border="0" width="95%" align="center">
			<tr>
				<td class="tableTop" colspan="4"><b>'.$trans_texts['select_world'][$g_language].'</b></td>
			</tr>	
			<tr>
				<td class="tableContLight" width="20%">'.$trans_texts['world'][$g_language].'</td>
				<td class="tableContLight">'.$eHTML->selectBoxInput('world', $worlds).'</td>
			</tr>				
		</table>
		<br><center>'.$eHTML->imageButtonInput('next').'</center>
		<br><br>
		'.$eHTML->formEnd().'				
	';
if(isset($_REQUEST['world']) && $tools->checkString($_REQUEST['world'])) {
	$world = $tools->getServerByName($_REQUEST['world']);
	
	$DB->query("SELECT image, name, motd FROM guilds WHERE world_id = '".$world['id']."' AND formation = '0'");
	$content .= '<table cellspacing="1" cellpadding="0" border="0" width="95%" align="center">
			<tr>
				<td class="tableTop" colspan="3">
					<b>'.$trans_texts['guilds.active'][$g_language].$world['name'].'</b>
				</td>
			</tr>';
	if($DB->num_rows() > 0) {
		$content .= '<tr>
						<td class="tableContDark">
							<b>'.$trans_texts['guilds.logo'][$g_language].'</b>
						</td>
						<td class="tableContDark">
							<b>'.$trans_texts['guilds.desc'][$g_language].'</b>
						</td>
						<td class="tableContDark">
							&nbsp;
						</td>
					</tr>';
		$handler = 0;
		while($guild = $DB->fetch()) {
			$tdStyle = ($handler == 0) ? 'tableContLight' : 'tableContDark';
			$image = ($guild->image == 1) ? GUILD_IMAGES_DIR.md5($guild->name).'.jpg' : GUILD_DEFAULT_NOIMG;
			$content .= '<tr>
							<td class="'.$tdStyle.'">
								<center><img src="'.$image.'" width="'.GUILD_IMAGE_IDEAL_WIDTH.'" height="'.GUILD_IMAGE_IDEAL_HEIGHT.'" alt="" /></center>
							</td>
							<td class="'.$tdStyle.'">
								<b>'.$guild->name.'</b><br />'.$guild->motd.'
							</td>
							<td class="'.$tdStyle.'">
								<center>	
								'.$eHTML->formStart('?act=guilds.view').'
								'.$eHTML->hiddenInput('name', $guild->name).'
								'.$eHTML->imageButtonInput('view').'
								'.$eHTML->formEnd().'
								</center>
							</td>
						</tr>';
			$handler = ($handler == 0) ? 1 : 0;
		}
	} else {
		// Sem guilds
		$content .= '<tr>
						<td class="tableContLight">
							<center>'.$trans_texts['guilds.noguild'][$g_language].'</center>
						</td>
					 </tr>';
	}
	$content .= '</table><BR><BR>';
	# GUILDS EM FORMAÇÃO
	$DB->query("SELECT image, name, motd FROM guilds WHERE world_id = '".$world['id']."' AND formation = '1'");
	$content .= '<table cellspacing="1" cellpadding="0" border="0" width="95%" align="center">
			<tr>
				<td class="tableTop" colspan="3">
					<b>'.$trans_texts['guilds.formation'][$g_language].$world['name'].'</b>
				</td>
			</tr>';
	if($DB->num_rows() > 0) {
		$content .= '<tr>
						<td class="tableContDark">
							<b>'.$trans_texts['guilds.logo'][$g_language].'</b>
						</td>
						<td class="tableContDark">
							<b>'.$trans_texts['guilds.desc'][$g_language].'</b>
						</td>
						<td class="tableContDark">
							&nbsp;
						</td>
					</tr>';
		$handler = 0;
		while($guild = $DB->fetch()) {
			$tdStyle = ($handler == 0) ? 'tableContLight' : 'tableContDark';
			$image = ($guild->image == 1) ? GUILD_IMAGES_DIR.md5($guild->name).'.jpg' : GUILD_DEFAULT_NOIMG;
			$content .= '<tr>
							<td class="'.$tdStyle.'">
								<center><img src="'.$image.'" width="'.GUILD_IMAGE_IDEAL_WIDTH.'" height="'.GUILD_IMAGE_IDEAL_HEIGHT.'" alt="" /></center>
							</td>
							<td class="'.$tdStyle.'">
								<b>'.$guild->name.'</b><br />'.$guild->motd.'
							</td>
							<td class="'.$tdStyle.'">
								<center>	
								'.$eHTML->formStart('?act=guilds.view').'
								'.$eHTML->hiddenInput('name', $guild->name).'
								'.$eHTML->imageButtonInput('view').'
								'.$eHTML->formEnd().'
								</center>
							</td>
						</tr>';
			$handler = ($handler == 0) ? 1 : 0;
		}
	} else {
		// Sem guilds
		$content .= '<tr>
						<td class="tableContLight">
							<center>'.$trans_texts['guilds.noguild'][$g_language].'</center>
						</td>
					 </tr>';
	}
	$content .= '</table>';
	
	$content .= '<br><br><div align="right">
						 '.$eHTML->formStart('?act=guilds.found').'
						 '.$eHTML->imageButtonInput('foundGuild').'
						 '.$eHTML->formEnd().'</div>';
}
?>