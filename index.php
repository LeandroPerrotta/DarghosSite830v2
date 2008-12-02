<?
/*
//// DARGHOS WEBSITE v.ALPHA 
//// 2008, TODOS DIREITOS EST�O RESERVADOS!!
//// Website desenvolvido por Slash, programador PHP da UltraxSoft, equipe que administra o Website Darghos 
//// Website utilizando:
//// OOP Engine
*/

/*
//// Inicia os SESSIONs do sistema ////
*/

session_start();

/*
//// Manuten��o
*/

	$manutention = true; //true, false
	
	if($manutention)
	{
		$manuText['title'] = "Website em Manuten��o.";
		$manuText['details'] = "O nosso website est� em menuten��o para modifica��es tecnicas. Entretanto o servidor continua normalmente online. Previs�o para website voltar ao ar: 15:30 (Brasilia).";
	
		include "manutention.php";
		die();	
	}	

/*
//// Inicia as Configura��es padr�es do sistema ////
*/

	include "lang/translations.php";
	include "definitions.php";
	include "config.php";

/*
//// Inicia a estrutura "m�e" do sistema, classe Engine ////
*/
	include "classes/engine.php";
	$engine = Engine::getInstance();

/*
//// Carrega a estrutura de Banco de Dados do Servidor
//// Testa se h� conex�o com o Banco de dados 
*/	
	$mySQL = $engine->loadObject('mySQL');
	$g_linkResource['site'] = $mySQL->connect('site');
	$g_linkResource['loginserver'] = $mySQL->connect('loginserver');	
	$g_linkResource['serverI'] = $mySQL->connect('serverI');	
	
	/*echo $g_linkResource['site'];
	echo $g_linkResource['loginserver'];*/
	
	$DB = $engine->loadObject('DB');	

	
/*
//// Carregar/implementar worlds
*/
	$DB->query("SELECT * FROM worlds");
	
	while($_world_ = $DB->fetchArray()) {
		$g_world[$_world['id']] = $_world_;
	}	
	
/*
//// Carrega estrutura de ferramentas
*/	
	
	$tools = $engine->loadObject('tools');
	$login = $engine->loadObject('login');

/*
//// Carrega classe de tradu��es do site
*/	
	
	$lang = $engine->loadObject('trans');
	$lang->setLanguage();
	
/*
//// Carrega a estrutura de Elementos HTML
*/
	$eHTML = $engine->loadObject('elementHTML');
	$layoutDir = "newlay";
	$eHTML->layoutDir = $layoutDir;
	
	
/*
//// Carrega e executa as tasks, se for a hora...
 */	
	if($_GET['active'] == 'tasksonly957153654852') {
		set_time_limit(60*25); 
		$tasks = $engine->loadObject('tasks');
		if($_GET['task_exec'] != '') {
			Tasks::PerformTask($_GET['task_exec'], $g_tasksMap);
		}
		//Tasks::PerformTasks($g_tasksMap);
	}
	
	
/*
//// Carrega o os modulos de Links
*/
	if($_GET['active'] != 'tasksonly957153654852') {
		include "modules.php";
	}

/*
//// Aplica o Layout ao sistema ////
*/		
	if($_GET['active'] != 'tasksonly957153654852') {
		include "$layoutDir/layout.php";
	} else {
		echo "Task executada.";
	}
?>