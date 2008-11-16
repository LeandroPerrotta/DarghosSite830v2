<?
/*
//// Lê a variavel SUBTOPIC para carremento dos Modulos ////
*/		
if($_REQUEST['act'] != "")
{	
	switch($_REQUEST['act'])
	{
	
/*
//// Separação para inicialização de modulos de NÓTICIAS ////
*/				
		case "lastnews";
			$topic = $GLOBALS['trans_topicPages']['news'][$GLOBALS['g_language']];
			$subtopic = $GLOBALS['trans_subTopicPages']['lastnews'][$GLOBALS['g_language']];
			include "modules/news/main.php";
		break;
		
		case "newfiles";
			$topic = $GLOBALS['trans_topicPages']['news'][$GLOBALS['g_language']];
			$subtopic = $GLOBALS['trans_subTopicPages']['newfiles'][$GLOBALS['g_language']];
			include "modules/news/newsfile.php";
		break;			

/*
//// Separação para inicialização de modulos GERAIS ////
*/	
		
		case "about";	
			$topic = $GLOBALS['trans_topicPages']['about'][$GLOBALS['g_language']];
			$subtopic = $GLOBALS['trans_subTopicPages']['about'][$GLOBALS['g_language']];
			include "modules/general/about.php";
		break;		

		case "faq";	
			$topic = $GLOBALS['trans_topicPages']['faq'][$GLOBALS['g_language']];
			$subtopic = $GLOBALS['trans_subTopicPages']['faq'][$GLOBALS['g_language']];
			include "modules/general/about.php";
		break;	

		case "downloads";	
			$topic = $GLOBALS['trans_topicPages']['downloads'][$GLOBALS['g_language']];
			$subtopic = $GLOBALS['trans_subTopicPages']['downloads'][$GLOBALS['g_language']];
			include "modules/general/downloads.php";
		break;		

		case "contact";	
			$topic = $GLOBALS['trans_topicPages']['contact'][$GLOBALS['g_language']];
			$subtopic = $GLOBALS['trans_subTopicPages']['contact'][$GLOBALS['g_language']];
			include "modules/general/contact.php";
		break;						

/*
//// Separação para inicialização de modulos de PREMIUM ACCOUNT ////
*/				
		
		case "contribute";	
			$topic = $GLOBALS['trans_topicPages']['contributions'][$GLOBALS['g_language']];
			$subtopic = $GLOBALS['trans_subTopicPages']['contributions'][$GLOBALS['g_language']];
			include "modules/premium/main.php";
		break;			

/*
//// Separação para inicialização de modulos BIBLIOTECA (DARGHOPÉDIA) ////
*/				
		
		case "library";	
			$topic = "Darghopédia";
			$subtopic = "Darghopédia";
			include "modules/library/main.php";
		break;			

/*
//// Separação para inicialização de modulos ACCOUNT ////
*/				
		
		case "account.main";	
			$topic = $GLOBALS['trans_topicPages']['account'][$GLOBALS['g_language']];
			$subtopic = $GLOBALS['trans_subTopicPages']['account.main'][$GLOBALS['g_language']];
			include "modules/account/main.php";
		break;

		case "account.register";	
			$topic = $GLOBALS['trans_topicPages']['account'][$GLOBALS['g_language']];
			$subtopic = $GLOBALS['trans_subTopicPages']['account.register'][$GLOBALS['g_language']];
			include "modules/account/register.php";
		break;	

		case "account.login";	
			$topic = $GLOBALS['trans_topicPages']['account'][$GLOBALS['g_language']];
			$subtopic = $GLOBALS['trans_subTopicPages']['account.login'][$GLOBALS['g_language']];
			include "modules/account/login.php";
		break;		

		case "account.logout";	
			$topic = $GLOBALS['trans_topicPages']['account'][$GLOBALS['g_language']];
			$subtopic = $GLOBALS['trans_subTopicPages']['account.logout'][$GLOBALS['g_language']];
			include "modules/account/logout.php";
		break;
		
		case "account.changepassword";	
			$topic = $GLOBALS['trans_topicPages']['account'][$GLOBALS['g_language']];
			$subtopic = $GLOBALS['trans_subTopicPages']['account.changepassword'][$GLOBALS['g_language']];
			include "modules/account/changepassword.php";
		break;		

		case "account.changeinfos";	
			$topic = $GLOBALS['trans_topicPages']['account'][$GLOBALS['g_language']];
			$subtopic = $GLOBALS['trans_subTopicPages']['account.changeinfos'][$GLOBALS['g_language']];
			include "modules/account/changeinfos.php";
		break;	

		case "account.changeemail";	
			$topic = $GLOBALS['trans_topicPages']['account'][$GLOBALS['g_language']];
			$subtopic = $GLOBALS['trans_subTopicPages']['account.changeemail'][$GLOBALS['g_language']];
			include "modules/account/changeemail.php";
		break;		

		case "account.cancelchangeemail";	
			$topic = $GLOBALS['trans_topicPages']['account'][$GLOBALS['g_language']];
			$subtopic = $GLOBALS['trans_subTopicPages']['account.cancelchangeemail'][$GLOBALS['g_language']];
			include "modules/account/cancelchangeemail.php";
		break;		
		
		case "account.setQuestions";	
			$topic = $GLOBALS['trans_topicPages']['account'][$GLOBALS['g_language']];
			$subtopic = $GLOBALS['trans_subTopicPages']['account.setQuestions'][$GLOBALS['g_language']];
			include "modules/account/setQuestions.php";
		break;				

		case "account.registration";	
			$topic = $GLOBALS['trans_topicPages']['account'][$GLOBALS['g_language']];
			$subtopic = $GLOBALS['trans_subTopicPages']['account.registration'][$GLOBALS['g_language']];
			include "modules/account/registration.php";
		break;				
		
		case "lostInterface";	
			$topic = $GLOBALS['trans_topicPages']['lostInterface'][$GLOBALS['g_language']];
			$subtopic = $GLOBALS['trans_subTopicPages']['account.lost'][$GLOBALS['g_language']];
			include "modules/lostInterface/main.php";
		break;		

		case "recovery.password";	
			$topic = $GLOBALS['trans_topicPages']['account'][$GLOBALS['g_language']];
			$subtopic = $GLOBALS['trans_subTopicPages']['account.lost'][$GLOBALS['g_language']];
			include "modules/account/recovery.password.php";
		break;	

		case "recovery.account";	
			$topic = $GLOBALS['trans_topicPages']['account'][$GLOBALS['g_language']];
			$subtopic = $GLOBALS['trans_subTopicPages']['account.lost'][$GLOBALS['g_language']];
			include "modules/account/recovery.account.php";
		break;			

		case "recovery.both";	
			$topic = $GLOBALS['trans_topicPages']['account'][$GLOBALS['g_language']];
			$subtopic = $GLOBALS['trans_subTopicPages']['account.lost'][$GLOBALS['g_language']];
			include "modules/account/recovery.both.php";
		break;					
		
		case "recovery.newpassword";	
			$topic = $GLOBALS['trans_topicPages']['account'][$GLOBALS['g_language']];
			$subtopic = $GLOBALS['trans_subTopicPages']['account.lost'][$GLOBALS['g_language']];
			include "modules/account/newpassword.php";
		break;				

/*
//// Separação para inicialização de modulos PERSONAGENS ////
*/	

		case "character.create";	
			$topic = $GLOBALS['trans_topicPages']['character'][$GLOBALS['g_language']];
			$subtopic = $GLOBALS['trans_subTopicPages']['character.create'][$GLOBALS['g_language']];
			include "modules/character/create.php";
		break;		

		case "character.preferences";	
			$topic = $GLOBALS['trans_topicPages']['character'][$GLOBALS['g_language']];
			$subtopic = $GLOBALS['trans_subTopicPages']['character.preferences'][$GLOBALS['g_language']];
			include "modules/character/preferences.php";
		break;		

		case "character.details";	
			$topic = $GLOBALS['trans_topicPages']['character'][$GLOBALS['g_language']];
			$subtopic = $GLOBALS['trans_subTopicPages']['character.details'][$GLOBALS['g_language']];
			include "modules/character/details.php";
		break;				

/*
//// Separação para inicialização de modulos HIGHSCORES ////
*/				

		case "highscores";	
			$topic = $GLOBALS['trans_topicPages']['community'][$GLOBALS['g_language']];
			$subtopic = $GLOBALS['trans_subTopicPages']['community.highscores'][$GLOBALS['g_language']];
			include "modules/community/highscores.php";
		break;	

/*
//// Separação para inicialização de modulos ADMINISTRAÇÂO ////
*/	

		case "admin.news";	
			$topic = $GLOBALS['trans_topicPages']['admin'][$GLOBALS['g_language']];
			$subtopic = $GLOBALS['trans_subTopicPages']['admin.news'][$GLOBALS['g_language']];
			include "modules/admin/news.php";
		break;		
		
		case "admin.postNew";	
			$topic = $GLOBALS['trans_topicPages']['admin'][$GLOBALS['g_language']];
			$subtopic = $GLOBALS['trans_subTopicPages']['admin.postNew'][$GLOBALS['g_language']];
			include "modules/admin/new.post.php";
		break;		

		case "admin.editNew";	
			$topic = $GLOBALS['trans_topicPages']['admin'][$GLOBALS['g_language']];
			$subtopic = $GLOBALS['trans_subTopicPages']['admin.editNew'][$GLOBALS['g_language']];
			include "modules/admin/new.edit.php";
		break;	

		case "admin.texts";	
			$topic = $GLOBALS['trans_topicPages']['admin'][$GLOBALS['g_language']];
			$subtopic = $GLOBALS['trans_subTopicPages']['admin.texts'][$GLOBALS['g_language']];
			include "modules/admin/texts.php";
		break;		
		
		case "admin.postText";	
			$topic = $GLOBALS['trans_topicPages']['admin'][$GLOBALS['g_language']];
			$subtopic = $GLOBALS['trans_subTopicPages']['admin.postText'][$GLOBALS['g_language']];
			include "modules/admin/text.post.php";
		break;		

		case "admin.editText";	
			$topic = $GLOBALS['trans_topicPages']['admin'][$GLOBALS['g_language']];
			$subtopic = $GLOBALS['trans_subTopicPages']['admin.editText'][$GLOBALS['g_language']];
			include "modules/admin/text.edit.php";
		break;
		
		case "admin.faqs";	
			$topic = $GLOBALS['trans_topicPages']['admin'][$GLOBALS['g_language']];
			$subtopic = $GLOBALS['trans_subTopicPages']['admin.faqs'][$GLOBALS['g_language']];
			include "modules/admin/faqs.php";
		break;		
		
		case "admin.postFaq";	
			$topic = $GLOBALS['trans_topicPages']['admin'][$GLOBALS['g_language']];
			$subtopic = $GLOBALS['trans_subTopicPages']['admin.postFaq'][$GLOBALS['g_language']];
			include "modules/admin/faq.post.php";
		break;		

		case "admin.editFaq";	
			$topic = $GLOBALS['trans_topicPages']['admin'][$GLOBALS['g_language']];
			$subtopic = $GLOBALS['trans_subTopicPages']['admin.editFaq'][$GLOBALS['g_language']];
			include "modules/admin/faq.edit.php";
		break;
		
		case "admin.fastnews";	
			$topic = $GLOBALS['trans_topicPages']['admin'][$GLOBALS['g_language']];
			$subtopic = $GLOBALS['trans_subTopicPages']['admin.fastnews'][$GLOBALS['g_language']];
			include "modules/admin/fastnews.php";
		break;		
		
		case "admin.postFastnew";	
			$topic = $GLOBALS['trans_topicPages']['admin'][$GLOBALS['g_language']];
			$subtopic = $GLOBALS['trans_subTopicPages']['admin.postFastnew'][$GLOBALS['g_language']];
			include "modules/admin/fastnew.post.php";
		break;		

		case "admin.editFastnew";	
			$topic = $GLOBALS['trans_topicPages']['admin'][$GLOBALS['g_language']];
			$subtopic = $GLOBALS['trans_subTopicPages']['admin.editFastnew'][$GLOBALS['g_language']];
			include "modules/admin/fastnew.edit.php";
		break;

		case "admin.payments";	
			$topic = $GLOBALS['trans_topicPages']['admin'][$GLOBALS['g_language']];
			$subtopic = $GLOBALS['trans_subTopicPages']['admin.payments'][$GLOBALS['g_language']];
			include "modules/admin/payments.php";
		break;			

		case "admin.payments.new";	
			$topic = $GLOBALS['trans_topicPages']['admin'][$GLOBALS['g_language']];
			$subtopic = $GLOBALS['trans_subTopicPages']['admin.paymentsnew'][$GLOBALS['g_language']];
			include "modules/admin/payments.new.php";
		break;	

/*
//// Separação para inicialização de modulos PAGAMENTOS ////
*/	

		case "payment.details";	
			$topic = $GLOBALS['trans_topicPages']['contributions'][$GLOBALS['g_language']];
			$subtopic = $GLOBALS['trans_subTopicPages']['payment.details'][$GLOBALS['g_language']];
			include "modules/payments/detail.php";
		break;		

		case "payment.accept";	
			$topic = $GLOBALS['trans_topicPages']['contributions'][$GLOBALS['g_language']];
			$subtopic = $GLOBALS['trans_subTopicPages']['payment.accept'][$GLOBALS['g_language']];
			include "modules/payments/accept.php";
		break;	

/*
//// Separação para inicialização de modulos SETS ////
*/				
		
		case "set";	
			$topic = "Set";
			$subtopic = "Set";
			include "set.php";
		break;				
	}
}
else
{
/*
//// Inicia o Modulo padrão (default) para Últimas Nóticias ////
*/		

	$topic = $GLOBALS['trans_topicPages']['home'][$GLOBALS['g_language']];
	$subtopic = $GLOBALS['trans_subTopicPages']['lastnews'][$GLOBALS['g_language']];
	include "modules/news/main.php";		
}
?>