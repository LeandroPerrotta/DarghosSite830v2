<?
if($login->logged() and $login->getAccess() >= ACCESS_ADMIN)
{	
	if ($_SERVER['REQUEST_METHOD'] == "POST")
	{	
		if(!$_POST['question_br'] OR !$_POST['question_us'] OR !$_POST['reply_br'] OR !$_POST['reply_us'])
		{
			$warn = $lang->getWarning('geral.camposVazios');
			$condition = array
			(
				"title" => $warn['title'],
				"msg" => $warn['msg'],
				"buttons" => $eHTML->simpleButton('back','?act=admin.postFaq')
			);			
		}
		else
		{
			$DB->query("INSERT INTO faqs(question_br, question_us, reply_br, reply_us) VALUES(
											'".$_POST['question_br']."', '".$_POST['question_us']."',
											'".$_POST['reply_br']."', '".$_POST['reply_us']."')");
			
			$condition = array
			(
				"title" => "FAQ postada com sucesso",
				"msg" => "O seu FAQ foi postada com sucesso!",
				"buttons" => $eHTML->simpleButton('next','?act=admin.faqs')
			);				
		}
		
		$content .= $eHTML->conditionTable($condition);
	}
	else
	{
		include("classes/fckeditor/fckeditor.php") ;
		$oFCKeditor = new FCKeditor('reply_br') ;
		$oFCKeditor->BasePath	= "classes/fckeditor/";
		$oFCKeditor->Value		= 'Em português' ;
		
		$oFCKeditor2 = new FCKeditor('reply_us') ;
		$oFCKeditor2->BasePath	= "classes/fckeditor/";
		$oFCKeditor2->Value		= 'In english' ;

		$content .= '
		'.$eHTML->formStart('?act=admin.postFaq').'
		<table cellspacing="1" cellpadding="0" border="0" width="95%" align="center">
			<tr>
				<td class="tableTop" colspan="2">Escrever Noticia</td>
			</tr>
			<tr>
				<td class="tableContLight" width="25%">Pergunta(em português)</td>
				<td class="tableContLight">'.$eHTML->textBoxInput('question_br').'</td>		
			</tr>	
			<tr>
				<td class="tableContLight" width="25%">Pergunta(em inglês)</td>
				<td class="tableContLight">'.$eHTML->textBoxInput('question_us').'</td>		
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