<?
if($login->logged() and $login->getAccess() == ACCESS_ADMIN)
{	
	if ($_SERVER['REQUEST_METHOD'] == "POST")
	{	
		if(!$_POST['new_br'] OR !$_POST['new_us'])
		{
			$warn = $lang->getWarning('geral.camposVazios');
			$condition = array
			(
				"title" => $warn['title'],
				"msg" => $warn['msg'],
				"buttons" => $eHTML->simpleButton('back','?act=admin.postFastnew')
			);			
		}
		else
		{
			$DB->query("INSERT INTO fastnews(new_br, new_us, account_poster, date) VALUES(
											'".$_POST['new_br']."', '".$_POST['new_us']."',
											'".$_SESSION['account_id']."', '".time()."')");
			
			$condition = array
			(
				"title" => "Not�cia r�pida postada com sucesso",
				"msg" => "A sua not�cia r�pida foi postada com sucesso!",
				"buttons" => $eHTML->simpleButton('next','?act=admin.fastnews')
			);				
		}
		
		$content .= $eHTML->conditionTable($condition);
	}
	else
	{
		$content .= '
		'.$eHTML->formStart('?act=admin.postFastnew').'
		<table cellspacing="1" cellpadding="0" border="0" width="95%" align="center">
			<tr>
				<td class="tableTop" colspan="2">Escrever Not�cia R�pida</td>
			</tr>
			<tr>
				<td class="tableContLight" width="25%">Not�cia(em portugu�s)</td>
				<td class="tableContLight">'.$eHTML->textArea('new_br', '').'</td>		
			</tr>	
			<tr>
				<td class="tableContLight" width="25%">Not�cia(em ingl�s)</td>
				<td class="tableContLight">'.$eHTML->textArea('new_us', '').'</td>		
			</tr>
		</table>
		<br>
		<center>'.$eHTML->imageButtonInput('next').'</center>	
		'.$eHTML->formEnd().'	
		';
	}	
}	
?>