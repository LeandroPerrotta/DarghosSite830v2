<?
if($login->logged() and $login->getAccess() >= ACCESS_ADMIN)
{	
	$DB->query("SELECT id FROM shop_itemList");
	$rows = $DB->num_rows();
	
	//RELATORIOS GERAIS DE NOTICIAS
	$content .= '<table cellspacing="1" cellpadding="0" border="0" width="95%" align="center">
		<tr>
			<td class="tableTop" colspan="2">Relatorio de Items no Shop</td>
		</tr>
		<tr>
			<td class="tableContLight" width="75%">Total de Items</td><td class="tableContLight">'.$rows .'</td>	
		</tr>					
	</table>
	<br>
	<table cellspacing="0" cellpadding="0" border="0" width="95%" align="center">
		<tr>
			<td>'.$eHTML->simpleButton("next", "?act=admin.addItemToShop").'</a></td>
		</tr>
	</table>	
	';
	
	$DB->query("SELECT `id`, `name` FROM shop_itemList ORDER BY id DESC");
	
	while($fetch = $DB->fetch())
	{
		$items[] = array('valueName' => $fetch->name, 'valueId' => $fetch->id);
	}
	
	$action[] = array('valueName' => "Editar", 'valueId' => "edit");
	$action[] = array('valueName' => "Deletar", 'valueId' => "delete");

	$content .= '
	<br>'.$eHTML->formStart('?act=admin.editItemOnShop').'
	<table cellspacing="1" cellpadding="0" border="0" width="95%" align="center">
		<tr>
			<td class="tableTop" colspan="2">Editar um Item do Shop</td>
		</tr>
		<tr>
			<td class="tableContLight" width="25%">Item</td><td class="tableContLight">'.$eHTML->selectBoxInput('item_id', $items, true).'</td>		
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