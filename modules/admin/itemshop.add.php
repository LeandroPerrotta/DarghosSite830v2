<?
if($login->logged() and $login->getAccess() >= ACCESS_ADMIN)
{	
	if ($_SERVER['REQUEST_METHOD'] == "POST")
	{	
		if(!$_POST['name'] OR !$_POST['item_id'] OR !$_POST['price'] OR !$_POST['count'] OR !$_POST['description'] OR !$_POST['url_image'])
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
			$DB->query("INSERT INTO shop_itemList(name, item_id, price, count, description, url_image, isContainer) VALUES(
											'".$_POST['name']."', '".$_POST['item_id']."',
											'".$_POST['price']."', '".$_POST['count']."',
											'".$_POST['description']."', '".$_POST['url_image']."', '".$_POST['isContainer']."')");
			
			$condition = array
			(
				"title" => "Item Adicionado com Exito",
				"msg" => "O item ".$_POST['name']." foi adicionado a lista de Items do nosso Shop com sucesso!",
				"buttons" => $eHTML->simpleButton('next','?act=admin.itemshop')
			);				
		}
		
		$content .= $eHTML->conditionTable($condition);
	}
	else
	{
		$container[] = array('valueName' => "Sim", 'valueId' => "1");
		$container[] = array('valueName' => "Não", 'valueId' => "0", 'select' => '1');	
	
		$content .= '
		'.$eHTML->formStart('?act=admin.addItemToShop').'
		<table cellspacing="1" cellpadding="0" border="0" width="95%" align="center">
			<tr>
				<td class="tableTop" colspan="2">Adicionar novo Item ao Shop.</td>
			</tr>
			<tr>
				<td class="tableContLight" width="25%">Nome do Item</td>
				<td class="tableContLight">'.$eHTML->textBoxInput('name', 'text').'</td>		
			</tr>	
			<tr>
				<td class="tableContLight" width="25%">Item ID</td>
				<td class="tableContLight">'.$eHTML->textBoxInput('item_id', 'text', null, 10).'</td>		
			</tr>
			<tr>
				<td class="tableContLight" width="25%">Custo (premdays)</td>
				<td class="tableContLight">'.$eHTML->textBoxInput('price', 'text', null, 10).'</td>		
			</tr>
			<tr>
				<td class="tableContLight" width="25%">Quantidade</td>
				<td class="tableContLight">'.$eHTML->textBoxInput('count', 'text', "1", 10).' (somente para items contaveis)</td>		
			</tr>		
			<tr>
				<td class="tableContLight" width="25%">Descrição</td>
				<td class="tableContLight">'.$eHTML->textArea('description', '', 2, 35).'</td>		
			</tr>	
			<tr>
				<td class="tableContLight" width="25%">URL da Imagem</td>
				<td class="tableContLight">'.$eHTML->textBoxInput('url_image', 'text').'</td>		
			</tr>			
			<tr>
				<td class="tableContLight" width="25%">Container Completo?</td>
				<td class="tableContLight">'.$eHTML->selectBoxInput('isContainer', $container, true).'</td>		
			</tr>				
		</table>
		<br>
		<center>'.$eHTML->imageButtonInput('next').'</center>	
		'.$eHTML->formEnd().'	
		';
	}	
}	
?>