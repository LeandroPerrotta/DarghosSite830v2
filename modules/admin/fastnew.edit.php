<?
if($login->logged() and $login->getAccess() >= ACCESS_ADMIN)
{	
	if ($_SERVER['REQUEST_METHOD'] == "POST")
	{	
		if(!$_GET['id'])
		{
			if($_POST['action'] == "edit")
			{
				$DB->query("SELECT * FROM fastnews WHERE id = '".$_POST['fastnew_id']."'");
			
				$fetch = $DB->fetch();

				$content .= '
				'.$eHTML->formStart('?act=admin.editFastnew&id='.$_POST['fastnew_id'].'').'
				<table cellspacing="1" cellpadding="0" border="0" width="95%" align="center">
					<tr>
						<td class="tableTop" colspan="2">Escrever Notícia Rápida</td>
					</tr>
					<tr>
						<td class="tableContLight" width="25%">Pergunta(em português)</td>
						<td class="tableContLight">'.$eHTML->textArea('new_br', $fetch->new_br).'</td>		
					</tr>	
					<tr>
						<td class="tableContLight" width="25%">Pergunta(em inglês)</td>
						<td class="tableContLight">'.$eHTML->textArea('new_us', $fetch->new_us).'</td>		
					</tr>
				</table>
				<br>
				<center>'.$eHTML->imageButtonInput('next').'</center>	
				'.$eHTML->formEnd().'	
				';		
			}
			elseif($_POST['action'] == "delete")
			{
				$DB->query("DELETE FROM fastnews WHERE id = '".$_POST['fastnew_id']."'");
				
				$condition = array
				(
					"title" => "Notícia rápida deletada com sucesso!",
					"msg" => "A notícia rápida ID: ".$_POST['fastnew_id']." foi deletada com sucesso!",
					"buttons" => $eHTML->simpleButton('next','?act=admin.fastnews')
				);	

				$content .= $eHTML->conditionTable($condition);				
			}
		}
		else
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
				$DB->query("UPDATE 
								fastnews 
							SET 
								new_br = '".$_POST['new_br']."',
								new_us = '".$_POST['new_us']."'
							WHERE 
								id = '".$_GET['id']."'");
				
				$condition = array
				(
					"title" => "Notícia rápida editada com sucesso!",
					"msg" => "A notícia rápida ID: ".$_GET['id']." foi editada com sucesso!",
					"buttons" => $eHTML->simpleButton('next','?act=admin.fastnews')
				);				
			}
			
			$content .= $eHTML->conditionTable($condition);		
		}
	}
}	
?>