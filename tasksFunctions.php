<?php
function task_highscores() {
	// ações...
	$db = DB::getInstance();
	
	foreach($GLOBALS['g_world'] as $p => $v) {
		$worldId = $GLOBALS['g_world'][$p]['id'];
		$resource = $GLOBALS['g_world'][$p]['sqlResource'];
		foreach($GLOBALS['g_skill'] as $s_p => $s_v) {
			$db->query("DELETE FROM high_{$s_v} WHERE world_id = '{$worldId}'");
			$strTmp = "";
			if($s_v == "experience") { #Level
				$db->query("SELECT 
								name, level, experience 
							FROM 
								players
							WHERE
								group_id < '4'
							ORDER BY
								experience 
							DESC 
							LIMIT 300", $resource);
				$nRows = $db->num_rows() - 1;
				$i = 0;
				while($player = $db->fetch()) {
					$strTmp .= "('{$player->name}', '{$player->level}', '{$player->experience}', '{$worldId}')";
					if($i < $nRows) {
						$strTmp .= ", ";
					} else {
						$strTmp .= ";";
					}
					$i++;
				}
				$db->query("INSERT INTO high_{$s_v} VALUES {$strTmp}");
			} elseif($s_v == "magic") { #Magic Level
				$db->query("SELECT 
								name, maglevel 
							FROM 
								players
							WHERE
								group_id < '4'
							ORDER BY
								maglevel
							DESC 
							LIMIT 300", $resource);
				$nRows = $db->num_rows() - 1;
				$i = 0;
				while($player = $db->fetch()) {
					$strTmp .= "('{$player->name}', '{$player->maglevel}', '{$worldId}')";
					if($i < $nRows) {
						$strTmp .= ", ";
					} else {
						$strTmp .= ";";
					}
					$i++;
				}
				$db->query("INSERT INTO high_{$s_v} VALUES {$strTmp}");
			} else { #Skills
				$db->query("SELECT 
								player.name, 
								skill.value
							FROM 
								players as player,
								player_skills as skill
							WHERE
								player.id = skill.player_id AND
								skill.skillid = '{$s_p}' AND
								player.group_id < '4'
							ORDER BY
								skill.value
							DESC 
							LIMIT 300", $resource);
				$nRows = $db->num_rows() - 1;
				$i = 0;
				while($player = $db->fetch()) {
					$strTmp .= "('{$player->name}', '{$player->value}', '{$worldId}')";
					if($i < $nRows) {
						$strTmp .= ", ";
					} else {
						$strTmp .= ";";
					}
					$i++;
				}
				$db->query("INSERT INTO high_{$s_v} VALUES {$strTmp}");
			}
		}
	}
}
// Worlds:
// int id, string name, string ip, int port, int status, int players, int uptime, 
// int record, int monsters, int recordIn, string version, int max, string location, 
// int onSince, string sqlResource
function task_worldsstatus() {
	$db = DB::getInstance();
	$db->query("SELECT * FROM worlds");
	$queryes = array();
	while($world = $db->fetch()) {
		$fp = @fsockopen($world->ip, (int)$world->port, $errno, $errstr, 2);
		if($fp) {		
		
			stream_set_timeout($fp, 2);
			
		    fwrite($fp, chr(6).chr(0).chr(255).chr(255).'info');
			
			$data = stream_get_contents($fp);	

			if( empty($data) )
				$status = 0;
				
		    fclose($fp); 	
			
			$xml = simplexml_load_string($data);
			$_record = $xml->players['peak'];
			if($_record > $world->record) {
				$record = $_record;
				$recordIn = time();
			} else {
				$record = $world->record;
				$recordIn = $world->recordIn;
			}
			$queryes[] = "UPDATE 
							worlds 
						  SET
						  	status = '1',
						  	players = '".$xml->players['online']."',
						  	uptime = '".$xml->serverinfo['uptime']."',
						  	monsters = '".$xml->monsters['total']."',
						  	max = '".$xml->players['max']."',
							record = '{$record}',
							recordIn = '{$recordIn}'
						  WHERE
						  	id = '{$world->id}'";
		} else {
			$queryes[] = "UPDATE 
							worlds 
						  SET
						  	status = '0',
						  	players = '0',
						  	uptime = '0',
						  	monsters = '0'
						  WHERE
						  	id = '{$world->id}'";
		}
	}
	
	foreach($queryes as $p => $v) {
		$db->query($queryes[$p]);
	}
}

function task_premiumdays() {
	$db = DB::getInstance();
	$db->query("SELECT id, premdays, lastday FROM accounts WHERE premdays > 0");
	$toUpdate = array();
	while($account = $db->fetch()) {
		$lostDaysTime = time() - $account->lastday;
		$lostInDays = @floor($lostDaysTime / (60 * 60 * 24));
		if($lostInDays > $account->premdays) {
			// Cabo premium days
			$toUpdate[] = array('account' => $account->id, 'premdays' => 0, 'lastday' => time());
		} else {
			// Ainda tem
			$toUpdate[] = array('account' => $account->id, 
								'premdays' => $account->premdays - $lostInDays, 
								'lastday' => time());
		}
	}
	
	foreach($toUpdate as $p => $v) {
		#Site
		$db->query("UPDATE 
						accounts 
					SET 
						premdays = '".$toUpdate[$p]['premdays']."',
						lastday = '".$toUpdate[$p]['lastday']."'
					WHERE
						id = '".$toUpdate[$p]['account']."'");
		
		#Login
		$db->query("UPDATE 
						accounts 
					SET 
						premdays = '".$toUpdate[$p]['premdays']."'
					WHERE
						id = '".$toUpdate[$p]['account']."'", "loginserver");
		
		#Game servers
		foreach($GLOBALS['g_world'] as $p => $v) {
			$db->query("UPDATE 
							accounts 
						SET 
							premdays = '".$toUpdate[$p]['premdays']."'
						WHERE
							id = '".$toUpdate[$p]['account']."'", $GLOBALS['g_world'][$p]['sqlResource']);
		}
	}
}
//id 	name 	account_id 	world_id 	level 	experience 	sex 	vocation 	
//maglevel 	lastlogin 	redskulltime 	guildnick 	rank_id 	town_id 	comment 	
//hide 	online 	old_name 	tutor_since 	creation 	ping 	lastUpdate
function task_playersinfos() {
	$db = DB::getInstance();
	$db->query("UPDATE characterlist SET online = '0'");
	$queryes = array();
	foreach($GLOBALS['g_world'] as $p => $v) {
		$worldId = $GLOBALS['g_world'][$p]['id'];
		$db->query("SELECT name, account_id, level, 
						   experience, sex, vocation, 
						   maglevel, lastlogin, redskulltime, 
						   guildnick, rank_id, town_id,
						   online, id
					FROM players WHERE online = '1'", $GLOBALS['g_world'][$p]['sqlResource']);
		while($player = $db->fetch()) {
			$queryes[] = "UPDATE
							characterlist
						  SET
						  	name = '{$player->name}',
						  	account_id = '{$player->account_id}',
						  	level = '{$player->level}',
						  	experience = '{$player->experience}',
						  	sex = '{$player->sex}',
						  	vocation = '{$player->vocation}',
						  	maglevel = '{$player->maglevel}',
						  	lastlogin = '{$player->lastlogin}',
						  	redskulltime = '{$player->redskulltime}',
						  	guildnick = '".mysql_real_escape_string($player->guildnick)."',
						  	rank_id = '{$player->rank_id}',
						  	town_id = '{$player->town_id}',
						  	online = '1',
						  	lastUpdate = '".time()."'
						  WHERE
						  	id = '{$player->id}' AND
						  	world_id = '{$worldId}'";
		}
	}
	
	foreach($queryes as $p => $v) {
		$db->query($queryes[$p]);
	}
}

function task_changeemails() {
	$db = DB::getInstance();
	$db->query("SELECT * FROM change_emails");
	$queryes = array();
	while($changeMail = $db->fetch()) {
		if($changeMail->changeDate + CHANGE_EMAIL_TIMER <= time()) {
			//Trocar
			$queryes[] = "UPDATE accounts SET email = '{$changeMail->newMail}' WHERE id = '{$changeMail->account_id}'";
			$queryes[] = "DELETE FROM change_emails WHERE account_id = '{$changeMail->account_id}'";
		} else {
			//Pular
			continue;
		}
	}
	
	foreach($queryes as $p => $v) {
		$db->query($queryes[$p]);
	}
}
?>