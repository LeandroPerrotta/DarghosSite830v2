<?
if($login->logged() and $login->getAccess() == ACCESS_ADMIN)
{	
	if ($_SERVER['REQUEST_METHOD'] == "POST")
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
			$DB->query("INSERT INTO news (`author_account`,`title`,`post`,`date`) VALUES('".$_SESSION['account']."','".$_POST['newTitle']."','".$_POST['newPost']."','".time()."')");
			
			$condition = array
			(
				"title" => "Noticia Postada com sucesso!",
				"msg" => "A sua notícia foi postada com sucesso! Acesse o index para a visualizar.",
				"buttons" => $eHTML->simpleButton('next','index.php')
			);				
		}
		
		$content .= $eHTML->conditionTable($condition);
	}
	else
	{
		include("classes/fckeditor/fckeditor.php") ;
		$oFCKeditor = new FCKeditor('newPost') ;
		$oFCKeditor->BasePath	= "classes/fckeditor/";
		$oFCKeditor->Value		= '' ;

		$content .= '
		'.$eHTML->formStart('?act=admin.postNew').'
		<table cellspacing="1" cellpadding="0" border="0" width="95%" align="center">
			<tr>
				<td class="tableTop" colspan="2">Escrever Noticia</td>
			</tr>
			<tr>
				<td class="tableContLight" width="25%">Titulo</td><td class="tableContLight">'.$eHTML->textBoxInput('newTitle').'</td>		
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
}	
?>