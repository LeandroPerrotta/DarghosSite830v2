<?php
$_TIME = time();
set_time_limit(60*25); 

$otNew = mysql_pconnect("localhost:3309", "root", "987***REMOVED****");
mysql_select_db("newot_new", $otNew);

$otOld = mysql_pconnect("localhost:3309", "newot", "secret");
mysql_select_db("newot", $otOld);

$webNew = mysql_pconnect("localhost:3309", "wbst", "789***REMOVED***qwe");
mysql_select_db("site_new", $webNew);

$webOld = mysql_pconnect("localhost:3309", "wbst_old", "secret");
mysql_select_db("site", $webOld);

$loginServer = mysql_pconnect("localhost:3309", "login_sv", "789***REMOVED***qwe");
mysql_select_db("ot_login", $loginServer);

// Accounts
// Old: id, password, blocked, premdays, email, real_name, hide, hidemail, location, url, creation, 
//      premFree, lastday, warnings, type, group_id, premTest, hasHouse, key, questionTries, lastQuestionTries
echo "Limpando tabelas... ";

mysql_query("TRUNCATE accounts", $otNew)  or die (mysql_error());
mysql_query("TRUNCATE players", $otNew)  or die (mysql_error());

mysql_query("TRUNCATE accounts", $webNew)  or die (mysql_error());
mysql_query("TRUNCATE account_questions", $webNew)  or die (mysql_error());
mysql_query("TRUNCATE change_emails", $webNew)  or die (mysql_error());
mysql_query("TRUNCATE news", $webNew)  or die (mysql_error());
mysql_query("TRUNCATE fastnews", $webNew)  or die (mysql_error());
mysql_query("TRUNCATE characterlist", $webNew)  or die (mysql_error());

mysql_query("TRUNCATE accounts", $loginServer)  or die (mysql_error());
mysql_query("TRUNCATE characterlist", $loginServer)  or die (mysql_error());

echo "[feito]<br>";
echo "Importando contas... ";

$queryAccs = mysql_query("SELECT * FROM accounts", $otOld)  or die (mysql_error());
while($account = mysql_fetch_object($queryAccs)) {
	#Game Server(NEW DB)
	mysql_query("INSERT INTO accounts VALUES(
						'{$account->id}', '{$account->password}', '{$account->blocked}',
						'{$account->premdays}', '{$account->lastday}', '{$account->warnings}',
						'{$account->type}', '{$account->group_id}', '{$account->hasHouse}',
						'{$account->key}')", $otNew) or die (mysql_error($otNew));
	#Login Server(NEW DB)
	
	mysql_query("INSERT INTO accounts VALUES('{$account->id}', '{$account->password}', 
											 '{$account->premdays}', '{$account->lastday}')", $loginServer) or die (mysql_error($loginServer));
	#Web Site(NEW DB)
	mysql_query("INSERT INTO accounts VALUES(
						'{$account->id}', '{$account->password}', '".mysql_real_escape_string($account->email)."',
						'{$account->premdays}', '{$account->creation}', '{$account->warnings}',
						'{$account->lastday}', '".mysql_real_escape_string($account->real_name)."', '".mysql_real_escape_string($account->location)."', 
						'".mysql_real_escape_string($account->url)."', '0')", $webNew) or die (mysql_error($webNew));
	
	$questQuery = mysql_query("SELECT * FROM account_questions WHERE account_id = '{$account->id}'", $webOld) or die (mysql_error($webOld));
	while($question = mysql_fetch_object($questQuery)) {
		mysql_query("INSERT INTO account_questions VALUES('".mysql_real_escape_string($question->question)."', 
						'".mysql_real_escape_string($question->answer)."', '".mysql_real_escape_string($account->id)."')", $webNew) or die (mysql_error($webNew));
	}
	
	$changeEmailQuery = mysql_query("SELECT * FROM scheduler_changeemails WHERE account_id = '{$account->id}'", $webOld);
	while($changeEmail = mysql_fetch_object($changeEmailQuery)){
		mysql_query("INSERT INTO change_emails(newEmail, changeDate, account_id)
				VALUES('{$changeEmail->email}', '{$changeEmail->date}', '{$changeEmail->account_id}')", $webNew) or die (mysql_error($webNew));
	}
 }
echo "[feito]<br>";
echo "Importando jogadores... ";
// Players
// Old: id, name, account_id, group_id, users, group, sex, vocation, experience, level, maglevel, health, healthmax, 
//      mana, manamax, manaspent, soul, direction, lookbody, lookfeet, lookhead, looklegs, looktype, lookaddons, posx, 
//      posy, posz, cap, lastlogin, lastip, save, conditions, redskulltime, redskull, guildnick, rank_id, town_id, 
//      comment, hide, server, blessings, lastlogout, loss_experience, loss_mana, loss_skills, special_hide, online, 
//      old_name, status, pvpmode, spoof, frags, deaths, flog_url, ip_addr, lastDay_experience, experience_difference, 
//      tutor_time, created, nick_verify, hide_char, duplied_name, ping
$queryPlayers = mysql_query("SELECT * FROM players", $otOld) or die (mysql_error($otOld));
while($player = mysql_fetch_object($queryPlayers)) {
	mysql_query("INSERT INTO players (id, name, account_id, group_id,
					sex, vocation, experience, level, 
					maglevel, health, 
					healthmax, mana, manamax, manaspent, 
					soul, direction, lookbody, lookfeet, 
					lookhead, looklegs, looktype, lookaddons, 
					posx, posy, posz, cap, lastlogin, 
					lastip, save, redskulltime, 
					redskull, guildnick, rank_id, town_id,
					blessings, lastlogout, loss_experience, 
					loss_mana, loss_skills)VALUES(
					'{$player->id}', '{$player->name}', '{$player->account_id}', '{$player->group_id}',
					'{$player->sex}', '{$player->vocation}', '{$player->experience}', '{$player->level}', 
					'{$player->maglevel}', '{$player->health}', 
					'{$player->healthmax}', '{$player->mana}', '{$player->manamax}', '{$player->manaspent}', 
					'{$player->soul}', '{$player->direction}', '{$player->lookbody}', '{$player->lookfeet}', 
					'{$player->lookhead}', '{$player->looklegs}', '{$player->looktype}', '{$player->lookaddons}', 
					'{$player->posx}', '{$player->posy}', '{$player->posz}', '{$player->cap}', '{$player->lastlogin}', 
					'{$player->lastip}', '{$player->save}', '{$player->redskulltime}', 
					'{$player->redskull}', '".mysql_real_escape_string($player->guildnick)."', '{$player->rank_id}', '{$player->town_id}',
					'{$player->blessings}', '{$player->lastlogout}', '10', 
					'10', '10')", $otNew) or die (mysql_error($otNew));
	#Login Server		
	mysql_query("INSERT INTO characterlist VALUES('{$player->id}', '{$player->name}', '0', 
					'{$player->account_id}')", $loginServer) or die (mysql_error($loginServer));
	#Web Site		
	mysql_query("INSERT INTO characterlist VALUES(
					'{$player->id}', '{$player->name}', '{$player->account_id}', '0', '{$player->level}', 
					'{$player->experience}', '{$player->sex}', '{$player->vocation}', '{$player->maglevel}', 
					'{$player->lastlogout}', '{$player->redskulltime}', '".mysql_real_escape_string($player->guildnick)."', '{$player->rank_id}', 
					'{$player->town_id}', '{$player->comment}', '{$player->hide}', '{$player->online}', 
					'{$player->old_name}', '{$player->tutor_time}', '{$player->created}', '{$player->ping}', 
					'{$_TIME}')", $webNew) or die (mysql_error($webNew));
}

echo "[feito]<br>";
echo "Importando noticias... ";

// News
$queryNews = mysql_query("SELECT * FROM news", $otOld) or die (mysql_error($otOld));
while($new = mysql_fetch_object($queryNews)) {
	$author = (is_numeric($new->autor)) ? $new->autor : "35415649";
	mysql_query("INSERT INTO news VALUES(
					'{$new->id}', '{$author}', '".mysql_real_escape_string($new->post_title)."', 
					'".mysql_real_escape_string($new->post)."', '{$new->post_data}')", $webNew) or die (mysql_error($webNew));
}

// New Ticker(Fast News)
$queryNewTicker = mysql_query("SELECT * FROM news_tickers", $otOld) or die (mysql_error($otOld));
while($newTicker = mysql_fetch_object($queryNewTicker)) {
	mysql_query("INSERT INTO fastnews VALUES(
					'{$newTicker->id}', '".mysql_real_escape_string($newTicker->text)."', '".mysql_real_escape_string($newTicker->text)."',
					'{$newTicker->date}', '{$newTicker->author}')", $webNew) or die (mysql_error($webNew));
}
echo "[feito]<br>";
echo "Importação do banco concluida com exito.";
?>