<?
if($login->logged() and $login->getAccess() >= ACCESS_ADMIN)
{	
	if ($_SERVER['REQUEST_METHOD'] == "POST")
	{	
		if(!$_GET['id'])
		{
			if($_POST['action'] == "edit")
			{
				$DB->query("SELECT * FROM texts WHERE id = '".$_POST['text_id']."'");
			
				$fetch = $DB->fetch();
			
				include("classes/fckeditor/fckeditor.php") ;				
				$oFCKeditor = new FCKeditor('textPost_pt') ;
				$oFCKeditor->BasePath	= "classes/fckeditor/";
				$oFCKeditor->Value		= $tools->htmlUncrypt($fetch->pt) ;
		
				$oFCKeditor2 = new FCKeditor('textPost_us') ;
				$oFCKeditor2->BasePath	= "classes/fckeditor/";
				$oFCKeditor2->Value		= $tools->htmlUncrypt($fetch->us) ;

				$content .= '
				'.$eHTML->formStart('?act=admin.editText&id='.$_POST['text_id'].'').'
				<table cellspacing="1" cellpadding="0" border="0" width="95%" align="center">
					<tr>
						<td class="tableTop" colspan="2">Escrever Texto</td>
					</tr>
					<tr>
						<td class="tableContLight" width="25%">Titulo</td><td class="tableContLight">'.$eHTML->textBoxInput('textDesc', 'text', $fetch->description).'</td>		
					</tr>			
					<tr>
						<td class="tableContLight" colspan="2">'.$oFCKeditor->CreateHtml().'</td>		
					</tr>	
					<tr>
						<td class="tableContLight" colspan="2">'.$oFCKeditor2->CreateHtml().'</td>		
					</tr>
				</table>
				<br>
				<center>'.$eHTML->imageButtonInput('next').'</center>	
				'.$eHTML->formEnd().'	
				';		
			}
			elseif($_POST['action'] == "delete")
			{
				$DB->query("DELETE FROM texts WHERE id = '".$_POST['text_id']."'");
				
				$condition = array
				(
					"title" => "Noticia deletada com sucesso!",
					"msg" => "O texto ID: ".$_POST['text_id']." foi deletado com sucesso!",
					"buttons" => $eHTML->simpleButton('next','?act=admin.texts')
				);	

				$content .= $eHTML->conditionTable($condition);				
			}
		}
		else
		{
			if(!$_POST['textDesc'] OR !$_POST['textPost_pt'] OR !$_POST['textPost_us'])
			{
				$warn = $lang->getWarning('geral.camposVazios');
				$condition = array
				(
					"title" => $warn['title'],
					"msg" => $warn['msg'],
					"buttons" => $eHTML->simpleButton('back','?act=admin.postText')
				);			
			}
			else
			{
				$DB->query("UPDATE texts SET description = '".$_POST['textDesc']."', pt = '".$tools->htmlCrypt($_POST['textPost_pt'])."', us = '".$tools->htmlCrypt($_POST['textPost_us'])."' WHERE id = '".$_GET['id']."'");
				
				$condition = array
				(
					"title" => "Texto editado com sucesso!",
					"msg" => "O texto ID: ".$_GET['id']." foi editado com sucesso!",
					"buttons" => $eHTML->simpleButton('next','?act=admin.texts')
				);				
			}
			
			$content .= $eHTML->conditionTable($condition);		
		}
	}
}	
?>