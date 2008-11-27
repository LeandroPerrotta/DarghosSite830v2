<?
if($login->logged() and $login->getAccess() >= ACCESS_ADMIN)
{	
	if ($_SERVER['REQUEST_METHOD'] == "POST")
	{	
		if(!$_GET['id'])
		{
			if($_POST['action'] == "edit")
			{
				$DB->query("SELECT * FROM news WHERE id = '".$_POST['new_id']."'");
			
				$fetch = $DB->fetch();
			
				include("classes/fckeditor/fckeditor.php") ;
				$oFCKeditor = new FCKeditor('newPost') ;
				$oFCKeditor->BasePath	= "classes/fckeditor/";
				$oFCKeditor->Value		= $fetch->post;

				$content .= '
				'.$eHTML->formStart('?act=admin.editNew&id='.$_POST['new_id'].'').'
				<table cellspacing="1" cellpadding="0" border="0" width="95%" align="center">
					<tr>
						<td class="tableTop" colspan="2">Escrever Noticia</td>
					</tr>
					<tr>
						<td class="tableContLight" width="25%">Titulo</td><td class="tableContLight">'.$eHTML->textBoxInput('newTitle', 'text', $fetch->title).'</td>		
					</tr>			
					<tr>
						<td class="tableContLight" colspan="2">'.$oFCKeditor->CreateHtml().'</td>		
					</tr>	
				</table>
				<br>
				<center>'.$eHTML->imageButtonInput('next').'</center>	
				'.$eHTML->formEnd().'	
				';		
			}
			elseif($_POST['action'] == "delete")
			{
				$DB->query("DELETE FROM news WHERE id = '".$_POST['new_id']."'");
				
				$condition = array
				(
					"title" => "Noticia deletada com sucesso!",
					"msg" => "A noticia ID: ".$_POST['new_id']." foi deletada com sucesso!",
					"buttons" => $eHTML->simpleButton('next','index.php')
				);	

				$content .= $eHTML->conditionTable($condition);				
			}
		}
		else
		{
			if(!$_POST['newTitle'] OR !$_POST['newPost'])
			{
				$warn = $lang->getWarning('geral.camposVazios');
				$condition = array
				(
					"title" => $warn['title'],
					"msg" => $warn['msg'],
					"buttons" => $eHTML->simpleButton('back','?act=admin.postNew')
				);			
			}
			else
			{
				$DB->query("UPDATE news SET title = '".$_POST['newTitle']."', post = '".$_POST['newPost']."' WHERE id = '".$_GET['id']."'");
				
				$condition = array
				(
					"title" => "Noticia editada com sucesso!",
					"msg" => "A noticia ID: ".$_GET['id']." foi editada com sucesso! Acesse o index para a visualizar.",
					"buttons" => $eHTML->simpleButton('next','index.php')
				);				
			}
			
			$content .= $eHTML->conditionTable($condition);		
		}
	}
}	
?>