<?php
class GuildInvite {
	protected $player_id;
	protected $guild_id;
	protected $world_id;
	
	protected $db;
	
	public function __construct($player_id = null, $guild_id = null, $world_id = null) {
		$this->db =& $GLOBALS['DB'];
		if($player_id != null && $guild_id != null && $world_id != null) {
			$this->load($player_id, $guild_id, $world_id);
		}
	}
	
	public function load($player_id, $guild_id, $world_id) {
		$this->db->query("SELECT 
							player_id, guild_id, world_id 
						  FROM 
						  	guild_invites 
						  WHERE
						  	player_id = '{$player_id}' AND 
						  	guild_id  = '{$guild_id}' AND 
						  	world_id  = '{$world_id}'");
		if($this->db->num_rows() < 1) {
			return false;
		}
		$guildInvite     = $this->db->fetch();		
		$this->player_id = $guildInvite->player_id;
		$this->guild_id  = $guildInvite->guild_id;
		$this->world_id  = $guildInvite->world_id;
		
		return true;
	}
	
	public function save() {
		$this->db->query("INSERT INTO guild_invites VALUES(
							'{$this->player_id}', '{$this->guild_id}', '{$this->world_id}')");
	}
	
	public function delete() {
		$this->db->query("DELETE FROM guild_invites WHERE
						  	player_id = '{$this->player_id}' AND 
						  	guild_id  = '{$this->guild_id}' AND 
						  	world_id  = '{$this->world_id}'");
	}
	
	public static function GuildInviteExists($player_id, $guild_id, $world_id) {
		global $DB;
		$DB->query("SELECT 
						player_id, guild_id, world_id 
					FROM 
						guild_invites 
					WHERE
						player_id = '{$player_id}' AND 
						guild_id  = '{$guild_id}' AND 
						world_id  = '{$world_id}'");
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
	public function getPlayer_id() {
		return $this->player_id;
	}
	
	/**
	 * @param integer $player_id
	 */
	public function setPlayer_id($player_id) {
		$this->player_id = $player_id;
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

}
?>