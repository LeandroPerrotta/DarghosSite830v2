<?
if($login->logged() and $login->getAccess() >= ACCESS_ADMIN)
{	
	if ($_SERVER['REQUEST_METHOD'] == "POST")
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
			$DB->query("INSERT INTO texts(description, pt, us) VALUES('".$_POST['textDesc']."',
												 '".$tools->htmlCrypt($_POST['textPost_pt'])."',
												 '".$tools->htmlCrypt($_POST['textPost_us'])."')");
			
			$condition = array
			(
				"title" => "Texto postado com sucesso",
				"msg" => "O seu texto foi postado com sucesso!",
				"buttons" => $eHTML->simpleButton('next','index.php')
			);				
		}
		
		$content .= $eHTML->conditionTable($condition);
	}
	else
	{
		include("classes/fckeditor/fckeditor.php") ;
		$oFCKeditor = new FCKeditor('textPost_pt') ;
		$oFCKeditor->BasePath	= "classes/fckeditor/";
		$oFCKeditor->Value		= 'Em português' ;
		
		$oFCKeditor2 = new FCKeditor('textPost_us') ;
		$oFCKeditor2->BasePath	= "classes/fckeditor/";
		$oFCKeditor2->Value		= 'In english' ;

		$content .= '
		'.$eHTML->formStart('?act=admin.postText').'
		<table cellspacing="1" cellpadding="0" border="0" width="95%" align="center">
			<tr>
				<td class="tableTop" colspan="2">Escrever Noticia</td>
			</tr>
			<tr>
				<td class="tableContLight" width="25%">Titulo</td><td class="tableContLight">'.$eHTML->textBoxInput('textDesc').'</td>		
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
}	
?>