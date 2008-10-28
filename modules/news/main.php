<?
$DB->query("SELECT * FROM site_new.news ORDER by date DESC LIMIT 3");
while($fetch = $DB->fetch())
{
	$content .= '
	<table cellspacing="0" cellpadding="0" border="0" width="95%" align="center">
		<tr>
			<td class="newTittle">
				'.$tools->datePt(1213997510).' - <b>'.$fetch->title.'</b>
			</td>
		</tr>
		<tr>
			<td class="newContent" colspan=2>
				'.$fetch->post.'
			</td>
		</tr>
	</table>	
	';
}
?>