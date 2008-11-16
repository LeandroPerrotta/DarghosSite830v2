<?php 
$content .= '<center><a href="?act=newfiles&type=fastnews">'.$trans_topicPages['fastnews'][$g_language].'</a> -
			 <a href="?act=newfiles">'.$trans_topicPages['news'][$g_language].'</a></center><br />';
if($_GET['type'] == "fastnews") {
	$content .= '<table cellspacing="0" cellpadding="0" border="0" width="95%" align="center">
				<tr>
					<td class="newTittle">
						'.$trans_topicPages['fastnews'][$g_language].'</b>
					</td>
				</tr>';

	$DB->query("SELECT * FROM fastnews ORDER BY date DESC LIMIT 50");
	$i = 0;
	while($fetch = $DB->fetch()) {
		$new = ($g_language == "br" OR $g_language == "pt") ? $fetch->new_br : $fetch->new_us;
		$date = ($g_language == "br" OR $g_language == "pt") ? $tools->datePt($fetch->date, "dd m aaaa") : date("d M Y", $fetch->date);
		$abrev = substr($new, 0, 20).'...';
		$content .= '<div id="fn_ab_'.$i.'" style="display:none;">'.$abrev.'</div>';
		$content .= '<div id="fn_cp_'.$i.'" style="display:none;">'.$new.'</div>';
		$content .= '<tr>
						<td class="'.(($i % 2 == 0) ? "tableContLight" : "tableContDark").'" 
									onClick="newsTicker(\''.$i.'\');">
							<img style="cursor:pointer;" id="fn_img_'.$i.'" src="'.$layoutDir.'/images/general/plus.gif" alt="" onClick="newsTicker(\''.$i.'\');" />
							<b>'.$date.'</b> -
							<div id="fn_sh_'.$i.'" style="float:right;">'.$abrev.'</div>
						</td>
					</tr>';
		$i++;
	}
	$content .= '</table><br /><br />';
	$content .= $eHTML->simpleButton('back', '?act=newfiles').'<br />';
} else {
	if($_GET['id'] != '' && $tools->checkString($_GET['id'])) {
		$DB->query("SELECT date, title, post FROM news WHERE id = '".$_GET['id']."'");
		$fetch = $DB->fetch();
		$content .= '
			<table cellspacing="0" cellpadding="0" border="0" width="95%" align="center">
				<tr>
					<td class="newTittle">
						'.$tools->datePt($fetch->date).' - <b>'.$fetch->title.'</b>
					</td>
				</tr>
				<tr>
					<td class="newContent" colspan=2>
						'.$tools->getFormatNews($fetch->post).'
					</td>
				</tr>
			</table><br>';
		$content .= $eHTML->simpleButton('back', '?act=newfiles').'<br />';
	}
	$content .= '<table cellspacing="0" cellpadding="0" border="0" width="95%" align="center">
				<tr>
					<td class="newTittle" colspan=2>
						'.$trans_subTopicPages['newfiles'][$g_language].'</b>
					</td>
				</tr>';
	
	$DB->query("SELECT id, title, date FROM news ORDER by date DESC LIMIT 20");
	$i = 0;
	while($fetch = $DB->fetch())
	{
		$date = ($g_language == "br" OR $g_language == "pt") ? $tools->datePt($fetch->date, "dd m aaaa") : date("d M Y", $fetch->date);
		$content .= '
			<tr>
				<td class="" width="25%">
					<center>'.$date.'</center>
				</td>
				<td class="newContent">
					<a href="?act=newfiles&id='.$fetch->id.'">'.$fetch->title.'</a>
				</td>
			</tr>	
		';
		$i++;
	}
	$content .= '</table>';
}
?>