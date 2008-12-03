<?php
class Guild {
	protected $id;
	protected $world_id;
	protected $name;
	protected $owner_id;
	protected $creation;
	protected $motd;
	protected $formation;
	protected $image;
		
	protected $ranks = array();
	protected $invites = array();
	
	protected $db;
	
	public function __construct($world_id = null, $id = null) {
		$this->db =& $GLOBALS['DB'];
		if($world_id != null && $id != null) {
			$this->load($world_id, $id);
		}
	}
	
	public function load($world_id, $id) {
		$this->db->query("SELECT 
							id, world_id, name, owner_id, creation, motd, formation, image
						  FROM
						  	guilds
						  WHERE
						  	id = '{$id}' AND
						  	world_id = '{$world_id}'");
		if($this->db->num_rows() < 1) {
			return false;
		}
		$guild = $this->db->fetch();
		
		$this->id        = $guild->id;
		$this->world_id  = $guild->world_id;
		$this->name      = $guild->name;
		$this->owner_id  = $guild->owner_id;
		$this->creation  = $guild->creation;
		$this->motd      = $guild->motd;
		$this->formation = $guild->formation;
		$this->image     = $guild->image;
		
		return true;
	}
	
	public function save($gameServerSave = true) {
		if(self::GuildExists($this->id, $this->world_id)) {
			//Update
			$this->db->query("UPDATE
								guilds
							  SET
							  	name 	  = '{$this->name}',
							  	owner_id  = '{$this->owner_id}',
							  	creation  = '{$this->creation}',
							  	motd 	  = '{$this->motd}',
							  	formation = '{$this->formation}',
							  	image     = '{$this->image}'
							  WHERE
							  	id 		 = '{$this->id}' AND
							  	world_id = '{$this->world_id}'");
			if($gameServerSave) {
				$this->db->query("UPDATE
									guilds
							  	  SET
							  		name 	 = '{$this->name}',
							  		owner_id = '{$this->owner_id}',
							  		creation = '{$this->creation}',
							  		motd 	 = '{$this->motd}'
							  	  WHERE
							  		id 		 = '{$this->id}'", 
							  	 $GLOBALS['g_world'][$this->world_id]['sqlResource']);
			}
		} else {
			//Insert
			$this->db->query("INSERT INTO guilds(name, ownerid, creationdata, motd) 
							VALUES('{$this->name}', '{$this->owner_id}', '{$this->creation}', 
							'{$this->motd}')", $GLOBALS['g_world'][$this->world_id]['sqlResource']);
			$this->id = $this->db->last_insert_id($GLOBALS['g_world'][$this->world_id]['sqlResource']);
			$this->db->query("INSERT INTO guilds(id, world_id, name, owner_id, 
												creation, motd, formation, image) 
							VALUES('{$this->id}', '{$this->world_id}', '{$this->name}', 
								   '{$this->owner_id}', '{$this->creation}', '{$this->motd}', 
								   '{$this->formation}', '{$this->image}')");
		}
	}
	
	public static function GuildExists($id, $world_id) {
		global $DB;
		$DB->query("SELECT id FROM guilds WHERE id = '{$id}' AND world_id = '{$world_id}'");
		return ($DB->num_rows() > 0) ? true : false;
	}
	
	public static function GetGuildByName($name) {
		global $DB;
		$name = mysql_escape_string($name);
		$DB->query("SELECT id, world_id FROM guilds WHERE name = '{$name}'");
		if($DB->num_rows() > 0) {
			$fetch = $DB->fetch();
			return new Guild($fetch->world_id, $fetch->id);
		} else {
			return null;
		}
	}
	
	public function loadRanks($loadObject = false, $complementWhere = null) {
		$this->db->query("SELECT id FROM guild_ranks 
						  WHERE world_id = '{$this->world_id}' AND guild_id = '{$this->id}' {$complementWhere}");
		while($rankId = $this->db->fetch()->id) {
			$this->ranks[$rankId] = ($loadObject) ? new GuildRank($rankId, $this->id, $this->world_id) :
												$rankId;
		}
		return true;
	}
	
	public function loadInvites($loadObject = false, $complementWhere = null) {
		$this->db->query("SELECT player_id FROM guild_invites
						  WHERE guild_id = '{$this->id}' AND world_id = '{$this->world_id}' {$complementWhere}");
		while($playerId = $this->db->fetch()->player_id) {
			$this->invites[] = ($loadObject) ? new GuildInvite($playerId, $this->id, $this->world_id) :
												$playerId;
		}
		return true;
	}
	
	/**
	 * @return integer
	 */
	public function getCreation() {
		return $this->creation;
	}
	
	/**
	 * @param integer $creation
	 */
	public function setCreation($creation) {
		$this->creation = $creation;
	}
	
	/**
	 * @return integer
	 */
	public function getId() {
		return $this->id;
	}
	
	/**
	 * @param integer $id
	 */
	public function setId($id) {
		$this->id = $id;
	}
	
	/**
	 * @return Array
	 */
	public function getInvites() {
		return $this->invites;
	}
	
	/**
	 * @return string
	 */
	public function getMotd() {
		return $this->motd;
	}
	
	/**
	 * @param string $motd
	 */
	public function setMotd($motd) {
		$this->motd = $motd;
	}
	
	/**
	 * @return string
	 */
	public function getName() {
		return $this->name;
	}
	
	/**
	 * @param string $name
	 */
	public function setName($name) {
		$this->name = $name;
	}
	
	/**
	 * @return integer
	 */
	public function getOwner_id() {
		return $this->owner_id;
	}
	
	/**
	 * @param integer $owner_id
	 */
	public function setOwner_id($owner_id) {
		$this->owner_id = $owner_id;
	}
	
	/**
	 * @return Array
	 */
	public function getRanks() {
		return $this->ranks;
	}
	
	public function getRank($id) {
		return $this->ranks[$id];
	}
	
	/**
	 * @return integer
	 */
	public function getWorld_id() {
		return $this->world_id;
	}
	
	/**
	 * @param integer $world_id
	 */
	public function setWorld_id($world_id) {
		$this->world_id = $world_id;
	}
	
	/**
	 * @return integer
	 */
	public function getFormation() {
		return $this->formation;
	}
	
	/**
	 * @param integer $formation
	 */
	public function setFormation($formation) {
		$this->formation = $formation;
	}
	
	/**
	 * @return integer
	 */
	public function getImage() {
		return $this->image;
	}
	
	/**
	 * @param Array $image
	 * @return boolean
	 */
	public function setImage($imageFile) {
		$image = 0;
		if($imageFile != null) {
			$pathinfo = pathinfo($imageFile);
			$ext      = '.'.$pathinfo['extension'];
			if($ext != '.jpg') {
				return false;
			}
			$fileName = md5($this->name).$ext;
			
			if(!is_dir(GUILD_IMAGES_DIR)) {
				mkdir(GUILD_IMAGES_DIR);
			}
			$width  = 0;
			$height = 0;
			list($width, $height) = getimagesize($imageFile['tmp_name']);
			
			if($width > GUILD_IMAGE_MAX_WIDTH or $height > GUILD_IMAGE_MAX_HEIGHT) {
				return false;
			}
			
			$finalPath = GUILD_IMAGES_DIR.$fileName;
			
			if(file_exists($finalPath)) {
				unlink($finalPath);
			}
			move_uploaded_file($imageFile['tmp_name'], $finalPath);
			$image = 1;
		}
		$this->image = $image;
		return true;
	}

	public static function canUseName($name) {
		global $DB;
		$DB->query("SELECT id FROM guilds WHERE name = '{$name}'");
		return ($DB->num_rows() > 0) ? false : true;
	}
}
?>