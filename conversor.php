<?php
$_TIME = time();

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
	
	$questQuery = mysql_query("SELECT * FROM account_questions WHERE account_id = '{$account->id}'", $webOld);
	while($question = mysql_fetch_object($questQuery)) {
		mysql_query("INSERT INTO accounts_question VALUES('{$question->question}', 
						'{$question->answer}', '{$account->id}')", $webNew);
	}
	
	$changeEmailQuery = mysql_query("SELECT * FROM scheduler_changeemails WHERE account_id = '{$account->id}'", $webOld);
	$changeEmail = mysql_fetch_object($changeEmailQuery);
	mysql_query("INSERT INTO change_emails(newEmail, changeDate, account_id)
				 VALUES('{$changeEmail->email}', '{$changeEmail->date}', '{$changeEmail->account_id}')");
}

// Players
// Old: id, name, account_id, group_id, users, group, sex, vocation, experience, level, maglevel, health, healthmax, 
//      mana, manamax, manaspent, soul, direction, lookbody, lookfeet, lookhead, looklegs, looktype, lookaddons, posx, 
//      posy, posz, cap, lastlogin, lastip, save, conditions, redskulltime, redskull, guildnick, rank_id, town_id, 
//      comment, hide, server, blessings, lastlogout, loss_experience, loss_mana, loss_skills, special_hide, online, 
//      old_name, status, pvpmode, spoof, frags, deaths, flog_url, ip_addr, lastDay_experience, experience_difference, 
//      tutor_time, created, nick_verify, hide_char, duplied_name, ping
$queryPlayers = mysql_query("SELECT * FROM players", $otOld);
while($player = mysql_fetch_object($queryPlayers)) {
	mysql_query("INSERT INTO players VALUES(
					'{$player->id}', '{$player->name}', '{$player->account_id}', '{$player->group_id}',
					'{$player->sex}', '{$player->vocation}', '{$player->experience}', '{$player->level}', 
					'{$player->maglevel}', '{$player->health}', 
					'{$player->healthmax}', '{$player->mana}', '{$player->manamax}', '{$player->manaspent}', 
					'{$player->soul}', '{$player->direction}', '{$player->lookbody}', '{$player->lookfeet}', 
					'{$player->lookhead}', '{$player->looklegs}', '{$player->looktype}', '{$player->lookaddons}', 
					'{$player->posx}', '{$player->posy}', '{$player->posz}', '{$player->cap}', '{$player->lastlogin}', 
					'{$player->lastip}', '{$player->save}', '{$player->conditions}', '{$player->redskulltime}', 
					'{$player->redskull}', '{$player->guildnick}', '{$player->rank_id}', '{$player->town_id}'
					'{$player->blessings}', '{$player->lastlogout}', '{$player->loss_experience}', 
					'{$player->loss_mana}', '{$player->loss_skills}', '{$player->online}', '{$player->ping}')", $otNew);
	#Login Server		
	mysql_query("INSERT INTO characterlist VALUES('{$player->id}', '{$player->name}', '0', 
					'{$player->account_id}')", $loginServer);
	#Web Site		
	mysql_query("INSERT INTO characterlist VALUES(
					'{$player->id}', '{$player->name}', '{$player->account_id}', '0', '{$player->level}', 
					'{$player->experience}', '{$player->sex}', '{$player->vocation}', '{$player->maglevel}', 
					'{$player->lastlogout}', '{$player->redskulltime}', '{$player->guildnick}', '{$player->rank_id}', 
					'{$player->town_id}', '{$player->comment}', '{$player->hide}', '{$player->online}', 
					'{$player->old_name}', '{$player->tutor_time}', '{$player->created}', '{$player->ping}', 
					'{$_TIME}')", $webNew);
}

// News
$queryNews = mysql_query("SELECT * FROM news", $otOld);
while($new = mysql_fetch_object($queryNews)) {
	$author = (is_numeric($new->autor)) ? $new->autor : "35415649";
	mysql_query("INSERT INTO news VALUES(
					'{$new->id}', '{$author}', '{$new->post_title}', 
					'{$new->post}', '{$new->post_data}')", $webNew);
}

// New Ticker(Fast News)
$queryNewTicker = mysql_query("SELECT * FROM news_tickers", $otOld);
while($newTicker = mysql_fetch_object($queryNewTicker)) {
	mysql_query("INSERT INTO fastnews VALUES(
					'{$newTicker->id}', '{$newTicker->text}', '{$newTicker->text}',
					'{$newTicker->date}', '{$newTicker->author}')", $webNew);
}
?>