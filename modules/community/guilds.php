<?php 
foreach($g_world as $world) {
	$worlds[] = array('valueName' => $world['name'], 'valueId' => $world['name']);
}
$content .= '
		'.$eHTML->formStart('?act=guilds').'
		'.$eHTML->descriptionTable($lang->getDescription('community.guilds')).'
		<table cellspacing="1" cellpadding="0" border="0" width="95%" align="center">
			<tr>
				<td class="tableTop" colspan="4">'.$trans_texts['select_world'][$g_language].'</td>
			</tr>	
			<tr>
				<td class="tableContLight" width="20%">'.$trans_texts['world'][$g_language].'</td><td class="tableContLight">'.$eHTML->selectBoxInput('world', $worlds).'</td>
			</tr>				
		</table>
		<br><center>'.$eHTML->imageButtonInput('next').'</center>
		<br>
		'.$eHTML->formEnd().'				
	';
if(isset($_REQUEST['world']) && $tools->checkString($_REQUEST['world'])) {
	$world = $tools->getServerByName($_REQUEST['world']);
}
?>