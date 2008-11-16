<?php 
$DB->query("SELECT * FROM faqs ORDER BY id ASC");

while($fetch = $DB->fetch()) {
	$quest = ($g_language == "br" OR $g_language == "pt") ? $fetch->question_br : $fetch->question_us;
	$reply = ($g_language == "br" OR $g_language == "pt") ? $fetch->reply_br : $fetch->reply_us;
	$content .= '
		<table cellspacing="0" cellpadding="0" border="0" width="95%" align="center">
			<tr>
				<td class="newTittle">
					'.$quest.'
				</td>
			</tr>
			<tr>
				<td class="newContent">
					'.$reply.'
				</td>
			</tr>
		</table><br>';
}

?>