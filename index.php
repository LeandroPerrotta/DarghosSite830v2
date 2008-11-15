<?
/*
//// DARGHOS WEBSITE v.ALPHA 
//// 2008, TODOS DIREITOS ESTÃO RESERVADOS!!
//// Website desenvolvido por Slash, programador PHP da UltraxSoft, equipe que administra o Website Darghos 
//// Website utilizando:
//// OOP Engine
*/

/*
//// Inicia os SESSIONs do sistema ////
*/

session_start();

/*
//// Inicia as Configurações padrões do sistema ////
*/

	include "lang/translations.php";
	include "definitions.php";
	include "config.php";

/*
//// Inicia a estrutura "mãe" do sistema, classe Engine ////
*/
	include "classes/engine.php";
	$engine = Engine::getInstance();

/*
//// Carrega a estrutura de Banco de Dados do Servidor
//// Testa se há conexão com o Banco de dados 
*/	
	$mySQL = $engine->loadObject('mySQL');
	$g_linkResource['site'] = $mySQL->connect('site');
	$g_linkResource['loginserver'] = $mySQL->connect('loginserver');	
	$g_linkResource['serverI'] = $mySQL->connect('serverI');	
	
	/*echo $g_linkResource['site'];
	echo $g_linkResource['loginserver'];*/
	
	$DB = $engine->loadObject('DB');	

/*
//// Carrega estrutura de ferramentas
*/	
	
	$tools = $engine->loadObject('tools');
	$login = $engine->loadObject('login');

/*
//// Carrega classe de traduções do site
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
	$tasks = $engine->loadObject('tasks');
	Tasks::PerformTasks($g_tasksMap);
	
	
/*
//// Carrega o os modulos de Links
*/

include "modules.php";

/*
//// Aplica o Layout ao sistema ////
*/		
	include "$layoutDir/layout.php";
?>