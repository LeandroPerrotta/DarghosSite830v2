<?
if($login->logged() and $login->getAccess() == ACCESS_ADMIN)
{	
	$DB->query("SELECT id FROM news");
	$rows = $DB->num_rows();
	
	//RELATORIOS GERAIS DE NOTICIAS
	$content .= '<table cellspacing="1" cellpadding="0" border="0" width="95%" align="center">
		<tr>
			<td class="tableTop" colspan="2">Relatorio de Noticias</td>
		</tr>
		<tr>
			<td class="tableContLight" width="75%">Total de Noticias</td><td class="tableContLight">'.$rows .'</td>	
		</tr>					
	</table>
	<br>
	<table cellspacing="0" cellpadding="0" border="0" width="95%" align="center">
		<tr>
			<td>'.$eHTML->simpleButton("admin.postNew", "?act=admin.postNew").'</a></td>
		</tr>
	</table>	
	';
	
	$DB->query("SELECT `id`, `title` FROM news ORDER BY date DESC");
	
	while($fetch = $DB->fetch())
	{
		$news[] = array('valueName' => $fetch->title, 'valueId' => $fetch->id);
	}
	
	$action[] = array('valueName' => "Editar", 'valueId' => "edit");
	$action[] = array('valueName' => "Deletar", 'valueId' => "delete");

	$content .= '
	<br>'.$eHTML->formStart('?act=admin.editNew').'
	<table cellspacing="1" cellpadding="0" border="0" width="95%" align="center">
		<tr>
			<td class="tableTop" colspan="2">Modificar Noticia</td>
		</tr>
		<tr>
			<td class="tableContLight" width="25%">Noticia</td><td class="tableContLight">'.$eHTML->selectBoxInput('new_id', $news, true).'</td>		
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