<?php 
function searchServer($name) {
	global $g_world;
	foreach($g_world as $p => $v) {
		if(strtolower($g_world[$p]['name']) == strtolower($name)) {
			return $g_world[$p];
			break;
		} else {
			continue;
		}
	}
}
$world = searchServer($_GET['name']);

$content .= '<table cellspacing="1" cellpadding="0" border="0" width="95%" align="center">
				<tr>
					<td class="tableTop" colspan="4">
						'.$trans_subTopicPages['server.info'][$g_language].' - '.$world['name'].'
					</td>
				</tr>	
				<tr>
					<td class="tableContLight" width="25%">Status:</td>
					<td class="tableContLight">
						'.(((int)$world['status'] == 1) ? "Online" : "Offline").'
					</td>
				</tr>
				<tr>
					<td class="tableContDark" width="25%">'.$trans_texts['players'][$g_language].':</td>
					<td class="tableContDark">
						'.$world['players'].'
					</td>
				</tr>
				<tr>
					<td class="tableContLight" width="25%">'.$trans_texts['max'][$g_language].':</td>
					<td class="tableContLight">
						'.$world['max'].'
					</td>
				</tr>
				<tr>
					<td class="tableContDark" width="25%">'.$trans_texts['record'][$g_language].':</td>
					<td class="tableContDark">
						'.$world['record'].'
					</td>
				</tr>
				<tr>
					<td class="tableContLight" width="25%">'.$trans_texts['recordIn'][$g_language].':</td>
					<td class="tableContLight">
						'.date("d/m/Y H:i", $world['recordIn']).'
					</td>
				</tr>
				<tr>
					<td class="tableContDark" width="25%">'.$trans_texts['monsters'][$g_language].':</td>
					<td class="tableContDark">
						'.$world['monsters'].'
					</td>
				</tr>
			 </table>';
?>