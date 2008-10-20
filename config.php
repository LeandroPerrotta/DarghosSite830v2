<?php
//Configurações do OTServ
$cfg['dirdata'] = 'C:/Darghos/Old8.11/data/';
$cfg['house_file'] = 'world/test-house.xml';

$maxsize = (512*10000); //Maxsize for guild images.
$guildimgdir = "images/"; //guild img dir
$screendir = "screenshots/"; //guild img dir
$imagedir = "images/"; //images

//Cidades
$city['quendor'] = array('id' => '1', 'x' => '2020', 'y' => '1903', 'z' => '7');

//Buttons
////////////////////////////////////////////////
$vote_button = ''.$imagedir.'vote.gif';
$back_button = ''.$imagedir.'back.gif';
$changeSex_button = ''.$imagedir.'changesex.gif';
////////////////////////////////////////////////

//Conectores SQL
////////////////////////////////////////////////
$userdb = array(
    'host' => 'localhost',
    'user' => 'root',
    'port' => '3306',
    'database' => 'newot',
	'password' => ''
);

if(!@mysql_connect($userdb['host'], $userdb['user'], $userdb['password']))
{
	$errorDefault['title'] = "Banco de dados em manutenção.";
	$errorDefault['details'] = "Tente novamente mais tarde...";
	include("manutention.php");
	die();
}

if(!@mysql_select_db($userdb['database']))
{
	$errorDefault['title'] = "Banco de dados em manutenção.";
	$errorDefault['details'] = "Tente novamente mais tarde...";
	include("manutention.php");
	die();
}

/////////////////////////////////////////////////

/*  DEFINITIONS  */

// GROUPS
define('GROUP_PLAYER', 1);
define('GROUP_TUTOR', 2);
define('GROUP_SENATOR', 3);
define('GROUP_GAMEMASTER', 4);
define('GROUP_COMMUNITYMANAGER', 5);
define('GROUP_GOD', 6);

define('SHOW_TESTSERVER', 1);
define('SHOW_TICKETS', 1);

define('ENCRYPT_TYPE', 'md5');
define('RECOMENDED_CHANGEPASS_PERIOD', '30');
define('USE_QUESTION_TRIES', '3');
define('SUSPEND_QUESTION_TIME', 60 * 60 * 24);

define('GLOBAL_URL', 'http://ot.darghos.com');
define('STATUS_UPDATE', 60);
define('SCHEDULER_EMAILCHANGER', 5);
/* END DEFINITIONS */

include "classes/engine.php";
include "classes/admin.php";
include "toolbox.php";

$engine = Engine::getInstance();

$DB = $engine->loadClass("database");

include "serverInfo.php";

if($_SESSION['lang'] == "")
{
	include('lang/pt-br/global.php');
}	
else
{
	if($_SESSION['lang'] == 'pt_br')
		include('lang/pt-br/global.php');
	else
		include('lang/en-us/global.php');
}
?>
