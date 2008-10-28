<?
$content .= '
'.$eHTML->descriptionTable($lang->getDescription('account.lost')).'
<table cellspacing="2" cellpadding="0" border="0" width="95%" align="center">
	<tr>
		<td class="tableTop" colspan="2">'.$trans_texts['account_recovery'][$g_language].'</td>
	</tr>
	<tr class="tableContLight">
		<td>
			<a href="?act=recovery.password">'.$trans_texts['recovery_my_password'][$g_language].'</a>
		</td>
	</tr>	
	<tr class="tableContLight">
		<td>
			<a href="?act=recovery.account">'.$trans_texts['recovery_my_account'][$g_language].'</a>
		</td>
	</tr>	
	<tr class="tableContLight">
		<td>
			<a href="?act=recovery.both">'.$trans_texts['recovery_my_account_and_password'][$g_language].'</a>
		</td>
	</tr>		
</table>	
';
?>