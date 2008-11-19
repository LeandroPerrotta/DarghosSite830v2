<?php 
//$content .= '<center><a href="?act=newfiles">'.$trans_topicPages['news'][$g_language].'</a> -
//			 <a href="?act=newfiles&type=fastnews">'.$trans_topicPages['fastnews'][$g_language].'</a></center><br />';
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
		$content .= '<tr onClick="newsTicker(\''.$i.'\')">
						<td class="'.(($i % 2 == 0) ? "tableContLight" : "tableContDark").'">
							<img onClick="newsTicker(\''.$i.'\')" id="fn_img_'.$i.'" style="cursor:pointer;" src="'.$layoutDir.'/images/general/plus.gif" alt="" border="0" />
							<b>'.$date.'</b> -
							<span id="fn_sh_'.$i.'">'.$abrev.'</span>
						</td>
					</tr>';
		$i++;
	}
	$content .= '</table>';
	$content .= '<br><br><center>'.$eHTML->simpleButton('back', '?act=newfiles').'</center><br />';
} elseif($_GET['type'] == "news") {
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
			<tr class="'.(($i % 2 == 0) ? "tableContLight" : "tableContDark").'">
				<td class="" width="25%">
					<center>'.$date.'</center>
				</td>
				<td class="newContent">
					<a href="?act=newfiles&type=new&id='.$fetch->id.'">'.$fetch->title.'</a>
				</td>
			</tr>	
		';
		$i++;
	}
	$content .= '</table>';
	$content .= '<br><br><center>'.$eHTML->simpleButton('back', '?act=newfiles').'</center><br />';
} elseif($_GET['type'] == "new" && $_GET['id'] != '' && $tools->checkString($_GET['id'])){
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
		</table>';
	$content .= '<br><br><center>'.$eHTML->simpleButton('back', 'javascript:history.back(-1);').'</center><br />';
} else {
	$content .= $eHTML->formStart('', 'GET').
				$eHTML->hiddenInput('act', $_GET['act']).
				'<table cellspacing="0" cellpadding="0" border="0" width="95%" align="center">
				<tr>
					<td class="newTittle" colspan=2>
						'.$trans_subTopicPages['newfiles'][$g_language].'</b>
					</td>
				</tr>';
	$days = array();
	for($i = 1; $i <= 30; $i++) {
		$days[] = array('valueName' => $i, 'valueId' => $i);
	}
	$months = array();
	for($i = 1; $i <= 12; $i++) {
		$months[] = array('valueName' => $i, 'valueId' => $i);
	}
	$years = array();
	for($i = 2005; $i <= (int)date("Y"); $i++) {
		$years[] = array('valueName' => $i, 'valueId' => $i);
	}
			
	$types = array(
			array('valueName' => $trans_texts['news'][$g_language], 'valueId' => 'news'),
			array('valueName' => $trans_texts['fastnews'][$g_language], 'valueId' => 'fastnews'));
			
	$content .= '
		<tr class="tableContDark">
			<td class="" width="25%">
				<center>'.$trans_texts['newsType'][$g_language].'</center>
			</td>
			<td class="newContent">
				'.$eHTML->selectBoxInput('type', $types, true).'
			</td>
		</tr>	
	';
	$content .= '
		<tr class="tableContLight">
			<td class="" width="25%">
				<center>'.$trans_texts['since'][$g_language].'</center>
			</td>
			<td class="newContent">
				'.$eHTML->selectBoxInput('sinceDay', $days, true).'/'.
				$eHTML->selectBoxInput('sinceMonth', $months, true).'/'.
				$eHTML->selectBoxInput('sinceYear', $years, true).' ('.$trans_texts['dateFormat'][$g_language].')
			</td>
		</tr>	
	';
	$content .= '</table><br><center>'.$eHTML->imageButtonInput('next').'</center>'.$eHTML->formEnd();
}
?>