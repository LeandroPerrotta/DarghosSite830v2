<?
/* TODO Criar tabela SQL com seguinte confs:
 * int id
 * text new_br
 * text new_us
 * int date
 * int account_poster
 */
if($login->logged() and $login->getAccess() == ACCESS_ADMIN)
{	
	$DB->query("SELECT id FROM fastnews");
	$rows = $DB->num_rows();
	
	//Textos
	$content .= '<table cellspacing="1" cellpadding="0" border="0" width="95%" align="center">
		<tr>
			<td class="tableTop" colspan="2">Notícias rápidas</td>
		</tr>
		<tr>
			<td class="tableContLight" width="75%">Total de Notícias Rápidas</td>
			<td class="tableContLight">'.$rows .'</td>	
		</tr>					
	</table>
	<br>
	<table cellspacing="0" cellpadding="0" border="0" width="95%" align="center">
		<tr>
			<td>'.$eHTML->simpleButton("next", "?act=admin.postFastnew").'</a></td>
		</tr>
	</table>	
	';
	
	$DB->query("SELECT id, new_br FROM fastnews ORDER BY date DESC");
	
	while($fetch = $DB->fetch())
	{
		// Pequeno módulo feito para mostrar 25% do começo da pergunta
		// 3 pontos(...) e 25% do final da pergunta, para não extravasar o select box...
		/*$len = strlen($fetch->new_br);
		$initMLen = ceil(@($len * 5) / 100);
		$finalMLen = ceil(@($len * 95) / 100);
		$fastnew = substr($fetch->new_br, 0, $initMLen).
						" [...] ".
				 substr($fetch->new_br, $finalMLen, $len);*/
				 
		$fastnew = substr($fetch->new_br, 0, 50).((strlen($fetch->new_br) > 50) ? "[...]": "");
		$fnews[] = array('valueName' => $fastnew, 'valueId' => $fetch->id);
	}
	
	$action[] = array('valueName' => "Editar", 'valueId' => "edit");
	$action[] = array('valueName' => "Deletar", 'valueId' => "delete");

	$content .= '
	<br>'.$eHTML->formStart('?act=admin.editFastnew').'
	<table cellspacing="1" cellpadding="0" border="0" width="95%" align="center">
		<tr>
			<td class="tableTop" colspan="2">Modificar Notícia Rápida</td>
		</tr>
		<tr>
			<td class="tableContLight" width="25%">Notícia Rápida</td><td class="tableContLight">'.$eHTML->selectBoxInput('fastnew_id', $fnews, true).'</td>		
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