<?
class Player
{
	private $data = array(
		'id' => '', 
		'pid_gs' => '', 
		'name' => '',
		'account_id' => '',
		'group_id' => '',	
		'sex' => '',
		'vocation' => '',		
		'level' => '',
		'experience' => '',
		'maglevel' => '',
		'health' => '',
		'healthmax' => '',
		'mana' => '',
		'manamax' => '',
		'manaspent' => '',
		'soul' => '',
		'direction' => '',
		'lookbody' => '',
		'lookfeet' => '',
		'lookhead' => '',
		'looklegs' => '',
		'looktype' => '',
		'lookaddons' => '',
		'posx' => '',
		'posy' => '',
		'posz' => '',
		'cap' => '',
		'lastlogin' => '',
		'lastip' => '',
		'save' => '',
		'conditions' => '',
		'redskulltime' => '',
		'redskull' => '',
		'guildnick' => '',
		'rank_id' => '',
		'town_id' => '',
		'blessings' => '',
		'lastlogout' => '',
		'loss_experience' => '',
		'loss_mana' => '',
		'loss_skill' => '',
		'online' => '',
		'ping' => '',
		
		'hide' => '',
		'comment' => '',
		
		'lastUpdate' => '',
		'creation' => '',
		'world_id' => '',
	);			
	
	public function saveNew()
	{
		global $DB;
		//Os dados do novo personagem serão inseridos no banco de dados do website, servidores e login servers
		//Insere o personagem na DB do website
		$DB->query("INSERT INTO `characterList` (`name`,`account_id`,`world_id`,`level`,`experience`,`sex`,`vocation`,`town_id`,`creation`) VALUES ('".$this->data['name']."',".$this->data['account_id'].",".$this->data['world_id'].",".$this->data['level'].",".$this->data['experience'].",".$this->data['sex'].",".$this->data['vocation'].",".$this->data['town_id'].",".$this->data['creation'].")");		
		
		//Verifica para qual mundo será criado o novo personagem
		$serverDB = Tools::getWorldResourceById($this->data['world_id']);
	
		//Insere o personagem na DB do mundo escolhido
		$DB->query("INSERT INTO players (
			`name`,`account_id`,`sex`
			,`vocation`,`experience`,`level`,
			`health`,`healthmax`,`mana`,
			`manamax`,`direction`,`lookbody`,
			`lookfeet`,`lookhead`,`looklegs`,
			`looktype`,`cap`,`town_id`,
			`created`) 
			VALUES(
			'".$this->data['name']."','".$this->data['account_id']."','".$this->data['sex']."',
			'".$this->data['vocation']."','".$this->data['experience']."','".$this->data['level']."',
			'".$this->data['health']."','".$this->data['healthmax']."','".$this->data['mana']."',
			'".$this->data['manamax']."','".$this->data['direction']."','".$this->data['lookbody']."',
			'".$this->data['lookfeet']."','".$this->data['lookhead']."','".$this->data['looklegs']."',
			'".$this->data['looktype']."','".$this->data['cap']."','".$this->data['town_id']."', '".time()."')", $serverDB);
		
		//Insere o personagem na DB do login server
		$DB->query("INSERT INTO `characterList` (`name`,`account_id`,`wid`) VALUES ('".$this->data['name']."',".$this->data['account_id'].",".$this->data['world_id'].")", 'loginserver');
	}	
	
	public function save()
	{		
		global $DB;
		$query = "UPDATE `characterList` SET ";
		
		if(!$this->data['sex'])
			$query .= "sex = ".$this->data['sex'].", ";
			
		$query .= "comment = '".$this->data['comment']."', ";	

		$query .= "hide = ".$this->data['hide']."";

		$query .= " WHERE id = ".$this->data['id']."";		
	
		$DB->query($query);
	}

	public function exists()
	{
		global $DB;
		$DB->query("SELECT `id` FROM `characterList` WHERE `name` = '".$this->data['name']."'");
		if($DB->num_rows() != 0)
			return true;
		else
			return false;
	}
	
	public function loadByAccount($account)
	{
		global $DB;
		$DB->query("SELECT `id` FROM `characterList` WHERE `account_id` = $account");
		$players = array();
		while($player = $DB->fetch())
		{
			$players[] = $player->id;
		}
		return $players;
	}		
	
	public function load($name)
	{
		global $DB;
		$this->data['name'] = $name;
	
		$DB->query("SELECT * FROM `characterList` WHERE `name` = '".$this->data['name']."'");
		
		if($DB->num_rows() != 0)
		{
			$player = $DB->fetch();	
			if(time() < $player->lastUpdate + 60 * 5)
			{	
				$this->data['id'] = $player->id;
				$this->data['name'] = $player->name;
				$this->data['account_id'] = $player->account_id;
				$this->data['world_id'] = $player->world_id;
				$this->data['level'] = $player->level;
				$this->data['experience'] = $player->experience;
				$this->data['sex'] = $player->sex;
				$this->data['vocation'] = $player->vocation;
				$this->data['town_id'] = $player->town_id;
				$this->data['creation'] = $player->creation;
				$this->data['lastlogin'] = $player->lastlogin;
				$this->data['hide'] = $player->hide;
				$this->data['comment'] = $player->comment;
			}
			else
			{
				$this->data['world_id'] = $player->world_id;
				$this->updateMirror();
			}	
			
			return true;
		}
		else
			return false;
	}
	
	private function updateMirror()
	{
		global $DB;
		$world_DBresoure = Tools::getWorldResourceById($this->data['world_id']);
		
		$DB->query("SELECT id, level, experience, maglevel, lastlogin, redskulltime, guildnick, rank_id, town_id, online, ping FROM `players` WHERE `name` = '".$this->data['name']."'", $world_DBresoure);
		$player = $DB->fetch();			
		
		$this->data['id'] = $player->id;
		$this->data['level'] = $player->level;
		$this->data['experience'] = $player->experience;
		$this->data['maglevel'] = $player->maglevel;
		$this->data['lastlogin'] = $player->lastlogin;
		$this->data['redskulltime'] = $player->redskulltime;
		$this->data['guildnick'] = $player->guildnick;
		$this->data['rank_id'] = $player->rank_id;
		$this->data['town_id'] = $player->town_id;
		$this->data['online'] = $player->online;
		$this->data['ping'] = $player->ping;
		$this->data['lastUpdate'] = time();
		
		$this->saveMirror();
	}		
	
	private function saveMirror()
	{
		global $DB;
		$DB->query("UPDATE `characterList` SET level = ".$this->data['level'].", experience = ".$this->data['experience'].", maglevel = ".$this->data['maglevel'].", lastlogin = ".$this->data['lastlogin'].", redskulltime = ".$this->data['redskulltime'].", guildnick = '".$this->data['guildnick']."', rank_id = ".$this->data['rank_id'].", town_id = ".$this->data['town_id'].", online = ".$this->data['online'].", ping = ".$this->data['ping'].", lastUpdate = ".$this->data['lastUpdate']." WHERE `name` = '".$this->data['name']."'");	
		$this->load($this->data['name']);
	}
	
	public function loadById($id, $enc = false)
	{	
		global $DB;
		if($enc)
		{
			$DB->query("SELECT id, name FROM `characterList` WHERE MD5(id) = '".$id."'");	
		}	
		else
		{
			$DB->query("SELECT id, name FROM `characterList` WHERE `id` = ".$id."");
		}		
			
		if($DB->num_rows() != 0)	
		{
			$player = $DB->fetch();
			
			$this->data['id'] = $player->id;			
			$this->load($player->name);
			return true;			
		}
		else
			return false;
	}		
	
	public function setName($name)
	{
		$this->data['name'] = $name;
	}			
	
	public function setAccount($account_id)
	{
		$this->data['account_id'] = $account_id;
	}		
	
	public function setWorld($world_id)
	{
		$this->data['world_id'] = $world_id;
	}

	public function setLevel($level)
	{
		$this->data['level'] = $level;
	}	

	public function setExperience($experience)
	{
		$this->data['experience'] = $experience;
	}		

	public function setSex($sex)
	{
		$this->data['sex'] = $sex;
	}		

	public function setVocation($vocation)
	{
		$this->data['vocation'] = $vocation;
	}	

	public function setTownId($town_id)
	{
		$this->data['town_id'] = $town_id;
	}	
	
	public function setCreation()
	{
		$this->data['creation'] = time();
	}	

	public function setHealth($health)
	{
		$this->data['health'] = $health;
		$this->data['healthmax'] = $health;
	}	

	public function setMana($mana)
	{
		$this->data['mana'] = $mana;
		$this->data['manamax'] = $mana;
	}		
	
	public function setDirection($direction)
	{	
		$this->data['direction'] = $direction;
	}
	
	public function setHidden($hiddenMode)
	{	
		if($hiddenMode)
			$this->data['hide'] = 1;
		else
			$this->data['hide'] = 0;		
	}	
	
	public function setComment($comment)
	{	
		$this->data['comment'] = $comment;	
	}	

	public function setLook($lookname)
	{
		switch($this->data['sex'])
		{
			case SEX_FEMALE:
				$looktype = 136;
			break;	
			
			case SEX_MALE:
				$looktype = 128;
			break;				
		}
	
		switch($lookname) 
		{
			case 'DEFAULT': 
				$look = array(
					'lookbody' => 116,
					'lookfeet' => 116,
					'lookhead' => 116,
					'looklegs' => 116,
					'looktype' => $looktype,
				); 
			break;	
		}
	
		$this->data['lookbody'] = $look['lookbody'];
		$this->data['lookfeet'] = $look['lookfeet'];
		$this->data['lookhead'] = $look['lookhead'];
		$this->data['looklegs'] = $look['looklegs'];
		$this->data['looktype'] = $look['looktype'];
	}	
	
	public function setCap($cap)
	{
		$this->data['cap'] = $cap;
	}		
	
	public function setPosByTown($town_id)
	{
		switch($town_id)
		{
			case CITY_QUENDOR:
				$this->data['posx'] = '';
				$this->data['posy'] = '';
				$this->data['posz'] = '';
			break;	
			
			case CITY_ARACURA:
				$this->data['posx'] = '';
				$this->data['posy'] = '';
				$this->data['posz'] = '';
			break;	

			case CITY_ROOKGAARD:
				$this->data['posx'] = '';
				$this->data['posy'] = '';
				$this->data['posz'] = '';
			break;

			case CITY_THORN:
				$this->data['posx'] = '';
				$this->data['posy'] = '';
				$this->data['posz'] = '';
			break;

			case CITY_SALAZART:
				$this->data['posx'] = '';
				$this->data['posy'] = '';
				$this->data['posz'] = '';
			break;			
		}
	}			
	
	public function getInfo($info)
	{
		return $this->data[$info];
	}	
	
	public function getIdOnServer()
	{
		global $DB;
		$serverDB = Tools::getWorldResourceById($this->data['world_id']);
	
		$DB->query("SELECT id FROM players WHERE name = '".$this->data['name']."'", $serverDB);
		$fetch = $DB->fetch();
		
		$this->data['pid_gs'] = $fetch->id;
		return $fetch->id;
	}

	public function getStatus()
	{
		global $trans_texts;
		global $g_language;
	
		$flags = array();
		
		if($this->data['hide'] == 1)
			$flags[] = "hidden";
		
		if($this->data['online'] == 1)	
			$flags[] = "online";	
			
		if($this->isDeleted())
			$flags[] = "deleted";
	
		if(count($flags) == 0)
		{
			$string .= $trans_texts['stat_none'][$g_language];
		}	
		else
		{
			foreach($flags as $flag)
			{
				$i++;
				
				$string .= $trans_texts['stat_'.$flag][$g_language];
				
				if(count($flags) != $i)
					$string .= ", ";
			}			
		}
				
		return $string;
	}	
	
	//INVENTARIO
	public function addItem($slot, $slot_pid, $itemid, $count) 
	{
		global $DB;
		$serverDB = Tools::getWorldResourceById($this->data['world_id']);
	
		$DB->query("INSERT INTO `player_items` VALUES ('".$this->data['pid_gs']."', '".$slot_pid."', '".$slot."', '".$itemid."', '".$count."', '', '', '0')", $serverDB);
	}	
	
	// MORTES
	//struct: player_id, world_id, time, level, killed_by, is_player
	public function loadDeaths() {
		global $DB;
		$DB->query("SELECT time FROM deathlist WHERE player_id = '".$this->data['id']."' AND 
											     world_id = '".$this->data['world_id']."' ORDER BY time DESC LIMIT 1");
		$DiasAtras = (int)(time() - (60 * 60 * 24 * 30));
		if($DB->num_rows() > 0) {
			// Ja atualizo ao menos 1 vez
			$deathTime = $DB->fetch()->time;
			if($deathTime + 60 * 5 <= time()) {
				$this->updateDeathsMirror($deathTime);
			}
			$DB->query("SELECT * FROM deathlist WHERE player_id = '".$this->data['id']."' AND 
											     world_id = '".$this->data['world_id']."' AND 
											     time > '".$DiasAtras."' ORDER BY time DESC");
			$deaths = array();
			while($death = $DB->fetchArray()) {
				$deaths[] = $death;
			}
			return $deaths;
		} else {
			// Primeira vez...
			if($this->updateDeathsMirror()) {
				$DB->query("SELECT * FROM deathlist WHERE player_id = '".$this->data['id']."' AND 
											     world_id = '".$this->data['world_id']."' AND 
											     time > '".$DiasAtras."' ORDER BY time DESC");
				$deaths = array();
				while($death = $DB->fetchArray()) {
					$deaths[] = $death;
				}
				return $deaths;
			} else {
				return array();
			}
		}		
	}
	
	private function updateDeathsMirror($lastDeathTime = 0) {
		global $DB;
		$serverDB = Tools::getWorldResourceById($this->data['world_id']);
		$DB->query("SELECT * FROM player_deaths WHERE player_id = '".$this->data['id']."'
													 AND time > '{$lastDeathTime}'", $serverDB);
		if($DB->num_rows() > 0) {
			$queryes = array();
			while($death = $DB->fetch()) {
				$queryes[] = "INSERT INTO deathlist VALUES(
								'".$this->data['id']."', '".$this->data['world_id']."', 
								'{$death->time}', '{$death->level}', 
								'".mysql_escape_string($death->killed_by)."', '{$death->is_player}')";
			}
			foreach($queryes as $p => $v) {
				$DB->query($queryes[$p]);
			}
			return true;
		} else {
			return false;
		}
	}
	
	public static function playerExists($name) {
		global $DB;
		$DB->query("SELECT id FROM characterlist WHERE name = '".mysql_escape_string($name)."'");
		return ($DB->num_rows() > 0) ? true : false;
	}
	
	public function isDeleted() {
		global $DB;
		$DB->query("SELECT 
						player.name 
					FROM 
						characterlist as player, 
						chardeletions as del 
					WHERE 
						del.player_id = player.id AND
						del.world_id = player.world_id AND
						player.name = '".mysql_escape_string($this->data['name'])."'");
		return ($DB->num_rows() > 0) ? true : false;
	}
	
	public function scheduleDeletion() {
		global $DB;
		$DB->query("INSERT INTO chardeletions(player_id, world_id, date) VALUES('".$this->data['id']."', '".$this->data['world_id']."', '".time()."')");
	}
	
	public function cancelDeletion() {
		global $DB;
		$DB->query("DELETE FROM chardeletions WHERE player_id = '".$this->data['id']."' AND world_id = '".$this->data['world_id']."'");
	}
}
?>