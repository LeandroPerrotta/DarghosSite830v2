<?
/* TODO Criar tabela SQL com seguinte confs:
 * int id
 * text question_br
 * text question_us
 * text reply_br
 * text reply_us
 */
if($login->logged() and $login->getAccess() >= ACCESS_ADMIN)
{	
	$DB->query("SELECT id FROM faqs");
	$rows = $DB->num_rows();
	
	//Textos
	$content .= '<table cellspacing="1" cellpadding="0" border="0" width="95%" align="center">
		<tr>
			<td class="tableTop" colspan="2">Frequently Asked Questions</td>
		</tr>
		<tr>
			<td class="tableContLight" width="75%">Total de FAQs</td><td class="tableContLight">'.$rows .'</td>	
		</tr>					
	</table>
	<br>
	<table cellspacing="0" cellpadding="0" border="0" width="95%" align="center">
		<tr>
			<td>'.$eHTML->simpleButton("next", "?act=admin.postFaq").'</a></td>
		</tr>
	</table>	
	';
	
	$DB->query("SELECT id, question_br FROM faqs ORDER BY id DESC");
	
	while($fetch = $DB->fetch())
	{
		// Pequeno módulo feito para mostrar 25% do começo da pergunta
		// 3 pontos(...) e 25% do final da pergunta, para não extravasar o select box...
		$questMax = strlen($fetch->question_br);
		$initMLen = ceil(@($questMax * 25) / 100);
		$finalMLen = ceil(@($questMax * 75) / 100);
		$quest = substr($fetch->question_br, 0, $initMLen).
						" [...] ".
				 substr($fetch->question_br, $finalMLen, $questMax);
		$faqs[] = array('valueName' => $quest, 'valueId' => $fetch->id);
	}
	
	$action[] = array('valueName' => "Editar", 'valueId' => "edit");
	$action[] = array('valueName' => "Deletar", 'valueId' => "delete");

	$content .= '
	<br>'.$eHTML->formStart('?act=admin.editFaq').'
	<table cellspacing="1" cellpadding="0" border="0" width="95%" align="center">
		<tr>
			<td class="tableTop" colspan="2">Modificar FAQ</td>
		</tr>
		<tr>
			<td class="tableContLight" width="25%">FAQ</td><td class="tableContLight">'.$eHTML->selectBoxInput('faq_id', $faqs, true).'</td>		
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