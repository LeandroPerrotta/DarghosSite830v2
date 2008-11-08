<?
if($_GET['step'] == 2)
{
	include("modules/premium/prices.php");
}
elseif($_GET['step'] == 3)
{
	include("modules/premium/buy.php");
}
else
{
	$content .= '
		'.$eHTML->descriptionTable($lang->getDescription('benefictsStep1')).'
		<table border="0" width="95%" CELLSPACING="1" CELLPADDING="2">
			<tr>
				<td>'.$trans_texts['getBeneficts'][$g_language].'</td>
			</tr>
			<tr>
				<td align="center"><BR />'.$eHTML->simpleButton('Next', '?act=contribute&step=2').'</td>
			</tr>
		</table>';
}
?>