<?
$content .= '<table cellspacing="0" cellpadding="0" border="0" width="95%" align="center">
			<tr>
				<td class="newTittle">
					'.$trans_topicPages['fastnews'][$g_language].'</b>
				</td>
			</tr>';

$DB->query("SELECT * FROM fastnews ORDER BY date DESC LIMIT 5");
$i = 0;
while($fetch = $DB->fetch()) {
	$new = ($g_language == "br" OR $g_language == "pt") ? $fetch->new_br : $fetch->new_us;
	$date = ($g_language == "br" OR $g_language == "pt") ? $tools->datePt($fetch->date, "dd m aaaa") : date("d M Y", $fetch->date);
	$abrev = substr($new, 0, 45).'...';
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
$content .= '</table><br>';

$DB->query("SELECT * FROM news ORDER by date DESC LIMIT 3");
while($fetch = $DB->fetch())
{
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
	</table><br>	
	';
}
?>