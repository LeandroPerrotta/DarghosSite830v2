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
		//Os dados do novo personagem serão inseridos no banco de dados do website, servidores e login servers
		//Insere o personagem na DB do website
		DB::query("INSERT INTO `characterList` (`name`,`account_id`,`world_id`,`level`,`experience`,`sex`,`vocation`,`town_id`,`creation`) VALUES ('".$this->data['name']."',".$this->data['account_id'].",".$this->data['world_id'].",".$this->data['level'].",".$this->data['experience'].",".$this->data['sex'].",".$this->data['vocation'].",".$this->data['town_id'].",".$this->data['creation'].")");		
		
		//Verifica para qual mundo será criado o novo personagem
		$serverDB = Tools::getWorldResourceById($this->data['world_id']);
	
		//Insere o personagem na DB do mundo escolhido
		DB::query("INSERT INTO `players`(`name`,`account_id`,`sex`,`vocation`,`experience`,`level`,`health`,`healthmax`,`mana`,`manamax`,`direction`,`lookbody`,`lookfeet`,`lookhead`,`looklegs`,`looktype`,`cap`,`town_id`) VALUES('".$this->data['name']."',".$this->data['account_id'].",".$this->data['sex'].",".$this->data['vocation'].",".$this->data['experience'].",".$this->data['level'].",".$this->data['health'].",".$this->data['healthmax'].",".$this->data['mana'].",".$this->data['manamax'].",".$this->data['direction'].",".$this->data['lookbody'].",".$this->data['lookfeet'].",".$this->data['lookhead'].",".$this->data['looklegs'].",".$this->data['looktype'].",".$this->data['cap'].",".$this->data['town_id'].")", $serverDB);
		
		//Insere o personagem na DB do login server
		DB::query("INSERT INTO `characterList` (`name`,`account_id`,`wid`) VALUES ('".$this->data['name']."',".$this->data['account_id'].",".$this->data['world_id'].")", 'loginserver');
	}	
	
	public function save()
	{		
		$query = "UPDATE `characterList` SET ";
		
		if($this->data['sex'] != ("" or null))
			$query .= "sex = ".$this->data['sex'].", ";
			
		if($this->data['comment'] != ("" or null))
			$query .= "comment = '".$this->data['comment']."', ";	

		$query .= "hide = ".$this->data['hide']."";

		$query .= " WHERE id = ".$this->data['id']."";		
	
		DB::query($query);
	}

	public function exists()
	{
		DB::query("SELECT `id` FROM `characterList` WHERE `name` = '".$this->data['name']."'");
		if(DB::num_rows() != 0)
			return true;
		else
			return false;
	}
	
	public function loadByAccount($account)
	{
		DB::query("SELECT `id` FROM `characterList` WHERE `account_id` = $account");
		$players = array();
		while($player = DB::fetch())
		{
			$players[] = $player->id;
		}
		return $players;
	}		
	
	public function load($name)
	{
		$this->data['name'] = $name;
	
		DB::query("SELECT * FROM `characterList` WHERE `name` = '".$this->data['name']."'");
		
		if(DB::num_rows() != 0)
		{
			$player = DB::fetch();	
			if(time() < $player->lastUpdate + 60 * 5)
			{	
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
		$world_DBresoure = Tools::getWorldResourceById($this->data['world_id']);
		
		DB::query("SELECT level, experience, maglevel, lastlogin, redskulltime, guildnick, rank_id, town_id, online, ping FROM `players` WHERE `name` = '".$this->data['name']."'", $world_DBresoure);
		$player = DB::fetch();			
		
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
		DB::query("UPDATE `characterList` SET level = ".$this->data['level'].", experience = ".$this->data['experience'].", maglevel = ".$this->data['maglevel'].", lastlogin = ".$this->data['lastlogin'].", redskulltime = ".$this->data['redskulltime'].", guildnick = '".$this->data['guildnick']."', rank_id = ".$this->data['rank_id'].", town_id = ".$this->data['town_id'].", online = ".$this->data['online'].", ping = ".$this->data['ping'].", lastUpdate = ".$this->data['lastUpdate']." WHERE `name` = '".$this->data['name']."'");	
		$this->load($this->data['name']);
	}
	
	public function loadById($id, $enc = false)
	{	
		if($enc)
		{
			DB::query("SELECT id, name FROM `characterList` WHERE MD5(id) = '".$id."'");	
		}	
		else
		{
			DB::query("SELECT id, name FROM `characterList` WHERE `id` = ".$id."");
		}		
			
		if(DB::num_rows() != 0)	
		{
			$player = DB::fetch();
			
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
		$serverDB = Tools::getWorldResourceById($this->data['world_id']);
	
		DB::query("SELECT id FROM players WHERE name = '".$this->data['name']."'", $serverDB);
		$fetch = DB::fetch();
		
		$this->data['pid_gs'] = $fetch->id;
		return $fetch->id;
	}

	public function getStatus()
	{
		$tmp = 0;
		
		if($this->data['hide'] == 1)
			$tmp += 1;
		
		if($this->data['online'] == 1)	
			$tmp += 2;
	
		switch($tmp)
		{
			case 0:
				$string = "none";
			break;

			case 1:
				$string = "hidden";
			break;

			case 2:
				$string = "online";
			break;
				
			case 3:
				$string = "hidden_online";
			break;	
		}
				
		return $string;
	}	
	
	//INVENTARIO
	public function addItem($slot, $slot_pid, $itemid, $count) 
	{
		$serverDB = Tools::getWorldResourceById($this->data['world_id']);
	
		DB::query("INSERT INTO `player_items` VALUES ('".$this->data['pid_gs']."', '".$slot_pid."', '".$slot."', '".$itemid."', '".$count."', '', '', '')", $serverDB);
	}	
}
?>