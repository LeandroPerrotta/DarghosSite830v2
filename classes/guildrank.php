<?php
class GuildRank {
	protected $id;
	protected $guild_id;
	protected $world_id;
	protected $name;
	protected $level;
	
	protected $players;
	
	protected $db;
	
	public function __construct($id = null, $guild_id = null, $world_id = null) {
		$this->db =& $GLOBALS['DB'];
		if($id != null && $guild_id != null && $world_id != null) {
			$this->load($id, $guild_id, $world_id);
		}
	}
	
	public function load($id, $guild_id, $world_id) {
		$this->db->query("SELECT id, guild_id, world_id, name, level
						  FROM guild_ranks
						  WHERE id = '{$id}' AND world_id = '{$world_id}' AND guild_id = '{$guild_id}'");
		if($this->db->num_rows() < 1) {
			return false;
		}
		$guildRank = $this->db->fetch();
		
		$this->id       = $guildRank->id;
		$this->guild_id = $guildRank->guild_id;
		$this->world_id = $guildRank->world_id;
		$this->name     = $guildRank->name;
		$this->level    = $guildRank->level;
		
		return true;
	}
	
	public function save($saveGameServer = true) {
		$gameServerResource = $GLOBALS['g_world'][$this->world_id]['sqlResource'];
		if(self::GuildRankExists($this->id, $this->guild_id, $this->world_id)) {
			$this->db->query("UPDATE
								guild_ranks
							  SET
							  	name  = '{$this->name}',
							  	level = '{$this->level}'
							  WHERE
							  	id       = '{$this->id}' AND 
							  	world_id = '{$this->world_id}' AND 
							  	guild_id = '{$this->guild_id}'");
			if($saveGameServer) {
				$this->db->query("UPDATE
									guild_ranks
							  	  SET
							  		name  = '{$this->name}',
							  		level = '{$this->level}'
							 	  WHERE
							  		id       = '{$this->id}' AND 
							  		guild_id = '{$this->guild_id}'", $gameServerResource);
			}
		} else {
			$this->db->query("INSERT INTO guild_ranks(guild_id, name, level) 
							  VALUES('{$this->guild_id}', '{$this->name}',
							  '{$this->level}')", $gameServerResource);
			$this->id = $this->db->last_insert_id($gameServerResource);
			$this->db->query("INSERT INTO guild_ranks(id, guild_id, world_id, name, level)
							  VALUES('{$this->id}', '{$this->guild_id}', 
							  '{$this->world_id}', '{$this->name}', '{$this->level}')");
		}
	}
	
	public static function GuildRankExists($id, $guild_id, $world_id) {
		global $DB;
		$DB->query("SELECT id, guild_id, world_id, name, level
					FROM guild_ranks
					WHERE id = '{$id}' AND world_id = '{$world_id}' AND guild_id = '{$guild_id}'");
		return ($DB->num_rows() < 1) ? false : true;
	}
	
	/**
	 * @return integer
	 */
	public function getGuild_id() {
		return $this->guild_id;
	}
	
	/**
	 * @param integer $guild_id
	 */
	public function setGuild_id($guild_id) {
		$this->guild_id = $guild_id;
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
	 * @return integer
	 */
	public function getLevel() {
		return $this->level;
	}
	
	/**
	 * @param integer $level
	 */
	public function setLevel($level) {
		$this->level = $level;
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
	public function getWorld_id() {
		return $this->world_id;
	}
	
	/**
	 * @param integer $world_id
	 */
	public function setWorld_id($world_id) {
		$this->world_id = $world_id;
	}
	
	public function loadPlayers($complementWhere = '') {
		$db = DB::getInstance();
		$db->query("SELECT id, name, guildnick, rank_id, joining_date FROM characterlist WHERE rank_id = '{$this->id}' {$complementWhere}");
		while($playerInfos = $db->fetchArray()) {
			$this->players[$playerInfos['id']] = $playerInfos;
		}
	}
	
	public function getPlayers() {
		return $this->players;
	}
	
	public function getPlayer($id) {
		return $this->players[$id];
	}

}
?>