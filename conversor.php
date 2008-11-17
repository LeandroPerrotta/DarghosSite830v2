<?php
$otNew = mysql_pconnect("localhost", "root", "secret");
mysql_select_db("gameserver", $otNovo);

$otOld = mysql_pconnect("localhost", "root1", "secret");
mysql_select_db("newot", $otOld);

$webNew = mysql_pconnect("localhost", "root2", "secret");
mysql_select_db("web", $webNew);

$webOld = mysql_pconnect("localhost", "root3", "secret");
mysql_select_db("site", $webOld);

$loginServer = mysql_pconnect("localhost", "root4", "secret");
mysql_select_db("ot_login", $loginServer);

// Accounts
// Old: id, password, blocked, premdays, email, real_name, hide, hidemail, location, url, creation, 
//      premFree, lastday, warnings, type, group_id, premTest, hasHouse, key, questionTries, lastQuestionTries
$queryAccs = mysql_query("SELECT * FROM accounts", $otOld);
while($account = mysql_fetch_object($queryAccs)) {
	#Game Server(NEW DB)
	mysql_query("INSERT INTO accounts VALUES(
						'{$account->id}', '{$account->password}', '{$account->blocked}',
						'{$account->premdays}', '{$account->lastday}', '{$account->warnings}',
						'{$account->type}', '{$account->group_id}', '{$account->hasHouse}',
						'{$account->key}')", $otNew);
	#Login Server(NEW DB)
	mysql_query("INSERT INTO accounts VALUES('{$account->id}', '{$account->password}', 
											 '{$account->premdays}', '{$account->lastday}')", $loginServer);
	#Web Site(NEW DB)
	mysql_query("INSERT INTO accounts VALUES(
						'{$account->id}', '{$account->password}', '{$account->email}',
						'{$account->premdays}', '{$account->creation}', '{$account->warnings}',
						'{$account->lastday}', '{$account->premdays}', '{$account->real_name}',
						'{$account->location}', '{$account->url}', '0')", $webNew);
	#TODO - The rest, mwahaha!
}
?>