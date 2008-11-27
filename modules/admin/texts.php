<?
if($login->logged() and $login->getAccess() >= ACCESS_ADMIN)
{	
	$DB->query("SELECT id FROM texts");
	$rows = $DB->num_rows();
	
	//Textos
	$content .= '<table cellspacing="1" cellpadding="0" border="0" width="95%" align="center">
		<tr>
			<td class="tableTop" colspan="2">Textos</td>
		</tr>
		<tr>
			<td class="tableContLight" width="75%">Total de Textos</td><td class="tableContLight">'.$rows .'</td>	
		</tr>					
	</table>
	<br>
	<table cellspacing="0" cellpadding="0" border="0" width="95%" align="center">
		<tr>
			<td>'.$eHTML->simpleButton("next", "?act=admin.postText").'</a></td>
		</tr>
	</table>	
	';
	
	$DB->query("SELECT id, description FROM texts ORDER BY id DESC");
	
	while($fetch = $DB->fetch())
	{
		$news[] = array('valueName' => $fetch->description, 'valueId' => $fetch->id);
	}
	
	$action[] = array('valueName' => "Editar", 'valueId' => "edit");
	$action[] = array('valueName' => "Deletar", 'valueId' => "delete");

	$content .= '
	<br>'.$eHTML->formStart('?act=admin.editText').'
	<table cellspacing="1" cellpadding="0" border="0" width="95%" align="center">
		<tr>
			<td class="tableTop" colspan="2">Modificar Texto</td>
		</tr>
		<tr>
			<td class="tableContLight" width="25%">Texto</td><td class="tableContLight">'.$eHTML->selectBoxInput('text_id', $news, true).'</td>		
		</tr>			
		<tr>
			<td class="tableContLight" width="25%">Ação</td><td class="tableContLight">'.$eHTML->selectBoxInput('action', $action, true).'</td>		
		</tr>			
	</table>
	<br>
	<center>'.$eHTML->imageButtonInput('next').'</center>	
	'.$eHTML->formEnd().'	
	';	
}
?>