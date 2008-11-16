<?
if($login->logged() and $login->getAccess() == ACCESS_ADMIN)
{	
	if ($_SERVER['REQUEST_METHOD'] == "POST")
	{	
		if(!$_GET['id'])
		{
			if($_POST['action'] == "edit")
			{
				$DB->query("SELECT * FROM faqs WHERE id = '".$_POST['faq_id']."'");
			
				$fetch = $DB->fetch();
			
				include("classes/fckeditor/fckeditor.php") ;				
				$oFCKeditor = new FCKeditor('reply_br') ;
				$oFCKeditor->BasePath	= "classes/fckeditor/";
				$oFCKeditor->Value		= $fetch->reply_br ;
		
				$oFCKeditor2 = new FCKeditor('reply_us') ;
				$oFCKeditor2->BasePath	= "classes/fckeditor/";
				$oFCKeditor2->Value		= $fetch->reply_us ;

				$content .= '
				'.$eHTML->formStart('?act=admin.editFaq&id='.$_POST['faq_id'].'').'
				<table cellspacing="1" cellpadding="0" border="0" width="95%" align="center">
					<tr>
						<td class="tableTop" colspan="2">Escrever FAQ</td>
					</tr>
					<tr>
						<td class="tableContLight" width="25%">Pergunta(em português)</td>
						<td class="tableContLight">'.$eHTML->textBoxInput('question_br', 'text', $fetch->question_br).'</td>		
					</tr>	
					<tr>
						<td class="tableContLight" width="25%">Pergunta(em inglês)</td>
						<td class="tableContLight">'.$eHTML->textBoxInput('question_us', 'text', $fetch->question_us).'</td>		
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
				$DB->query("DELETE FROM faqs WHERE id = '".$_POST['faq_id']."'");
				
				$condition = array
				(
					"title" => "FAQ deletado com sucesso!",
					"msg" => "O FAQ ID: ".$_POST['faq_id']." foi deletado com sucesso!",
					"buttons" => $eHTML->simpleButton('next','?act=admin.faqs')
				);	

				$content .= $eHTML->conditionTable($condition);				
			}
		}
		else
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
				$DB->query("UPDATE 
								faqs 
							SET 
								question_br = '".$_POST['question_br']."',
								question_us = '".$_POST['question_us']."',
								reply_br = '".$_POST['reply_br']."',
								reply_us = '".$_POST['reply_us']."'
							WHERE 
								id = '".$_GET['id']."'");
				
				$condition = array
				(
					"title" => "FAQ editado com sucesso!",
					"msg" => "O FAQ ID: ".$_GET['id']." foi editado com sucesso!",
					"buttons" => $eHTML->simpleButton('next','?act=admin.faqs')
				);				
			}
			
			$content .= $eHTML->conditionTable($condition);		
		}
	}
}	
?>