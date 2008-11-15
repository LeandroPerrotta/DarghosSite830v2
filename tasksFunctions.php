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
								skill.skillid = '{$s_v}'
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
?>