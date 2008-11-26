<?
if($login->logged() and $login->getAccess() == ACCESS_ADMIN)
{	
	if ($_SERVER['REQUEST_METHOD'] == "POST")
	{	
		if(!$_GET['id'])
		{
			if($_POST['action'] == "edit")
			{
				$DB->query("SELECT * FROM shop_itemList WHERE id = '".$_POST['item_id']."'");
			
				$fetch = $DB->fetch();

				$container[] = array('valueName' => "Sim", 'valueId' => "1");
				$container[] = array('valueName' => "Não", 'valueId' => "0", 'select' => '1');	
			
				$content .= '
				'.$eHTML->formStart('?act=admin.editItemOnShop&id='.$_POST['item_id'].'').'
				<table cellspacing="1" cellpadding="0" border="0" width="95%" align="center">
					<tr>
						<td class="tableTop" colspan="2">Editar Item Existente.</td>
					</tr>
					<tr>
						<td class="tableContLight" width="25%">Nome do Item</td>
						<td class="tableContLight">'.$eHTML->textBoxInput('name', 'text', $fetch->name).'</td>		
					</tr>	
					<tr>
						<td class="tableContLight" width="25%">Item ID</td>
						<td class="tableContLight">'.$eHTML->textBoxInput('item_id', 'text', $fetch->item_id, 10).'</td>		
					</tr>
					<tr>
						<td class="tableContLight" width="25%">Custo (premdays)</td>
						<td class="tableContLight">'.$eHTML->textBoxInput('price', 'text', $fetch->price, 10).'</td>		
					</tr>
					<tr>
						<td class="tableContLight" width="25%">Quantidade</td>
						<td class="tableContLight">'.$eHTML->textBoxInput('count', 'text', $fetch->count, 10).' (somente para items contaveis)</td>		
					</tr>		
					<tr>
						<td class="tableContLight" width="25%">Descrição</td>
						<td class="tableContLight">'.$eHTML->textArea('description', $fetch->description, 2, 35).'</td>		
					</tr>	
					<tr>
						<td class="tableContLight" width="25%">URL da Imagem</td>
						<td class="tableContLight">'.$eHTML->textBoxInput('url_image', 'text', $fetch->url_image).'</td>		
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
			elseif($_POST['action'] == "delete")
			{
				$DB->query("DELETE FROM shop_itemList WHERE id = '".$_POST['item_id']."'");
				
				$condition = array
				(
					"title" => "Item do Shop Deletado com sucesso!",
					"msg" => "O Item do Shop ID: ".$_POST['item_id']." foi deletado com sucesso!",
					"buttons" => $eHTML->simpleButton('next','?act=admin.itemshop')
				);	

				$content .= $eHTML->conditionTable($condition);				
			}
		}
		else
		{
			if(!$_POST['name'] OR !$_POST['item_id'] OR !$_POST['price'] OR !$_POST['count'] OR !$_POST['description'] OR !$_POST['url_image'])
			{
				$warn = $lang->getWarning('geral.camposVazios');
				$condition = array
				(
					"title" => $warn['title'],
					"msg" => $warn['msg'],
					"buttons" => $eHTML->simpleButton('back','?act=admin.itemshop')
				);			
			}
			else
			{
				$DB->query("UPDATE 
								shop_itemList 
							SET 
								name = '".$_POST['name']."',
								item_id = '".$_POST['item_id']."',
								price = '".$_POST['price']."',
								count = '".$_POST['count']."',
								description = '".$_POST['description']."',
								url_image = '".$_POST['url_image']."',
								isContainer = '".$_POST['isContainer']."'
							WHERE 
								id = '".$_GET['id']."'");
				
				$condition = array
				(
					"title" => "Item do Shop editado com sucesso!",
					"msg" => "O Item do Shop ID: ".$_GET['id']." foi editado com sucesso!",
					"buttons" => $eHTML->simpleButton('next','?act=admin.itemshop')
				);				
			}
			
			$content .= $eHTML->conditionTable($condition);		
		}
	}
}	
?>