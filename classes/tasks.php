<?php
class Tasks {
	protected $id;
	protected $name;
	protected $eachTime;
	protected $lastExecution;
	
	protected $db;
	
	public function __construct() {
		$this->db = DB::getInstance();
	}
	
	public function loadTask($key) {
		$keyPointer = (is_numeric($key)) ? "id" : "name";
		
		$this->db->query("SELECT * FROM tasks WHERE {$keyPointer} = '{$key}'");
		if($this->db->num_rows() > 0) {
			$task = $this->db->fetch();
			$this->id = $task->id;
			$this->name = $task->name;
			$this->eachTime = $task->each_time;
			$this->lastExecution = $task->last_execution;
		} else {
			return false;
		}
		
		return true;
	}
	
	public function saveTask() {
		if($this->id != null and self::TaskExists($this->id)) {
			//update..
			$this->db->query("UPDATE tasks SET
								name = '{$this->name}',
								each_time = '{$this->eachTime}',
								last_execution = '{$this->lastExecution}'
							  WHERE
							  	id = '{$this->id}'");
		} else {
			//insert..
			$this->db->query("INSERT INTO tasks(name, 
							each_time, last_execution) 
							VALUES('{$this->name}', 
							'{$this->eachTime}', '{$this->lastExecution}')");
			$this->id = $this->db->last_insert_id();
		}
		return true;
	}
	
	public static function TaskExists($key) {
		$db = DB::getInstance();
		$keyPointer = (is_numeric($key)) ? "id" : "name";
		$db->query("SELECT * FROM tasks WHERE {$keyPointer} = '{$key}'");
		return ($db->num_rows() > 0) ? true : false;
	}
	
	public static function PerformTasks($tasksMap) {
		include_once("tasksFunctions.php");
		foreach($tasksMap as $p => $v) {
			if(Tasks::TaskExists($tasksMap[$p]['name'])) {
				$task = new Tasks();
				$task->loadTask($tasksMap[$p]['name']);
				if($task->getLastExecution() <= time() - $task->getEachTime()) {
					if(function_exists("task_".$task->getName())) {
						call_user_func("task_".$task->getName());
						if($tasksMap[$p]['eachTime'] != $task->getEachTime()) {
							$task->setEachTime($tasksMap[$p]['eachTime']);
						}
						$task->setLastExecution(time());
						$task->saveTask();
						continue;
					} else {
						continue;
					}
				} else {
					continue;
				}
			} else {
				//Primeira vez de execução de uma task
				$task = new Tasks();
				$task->setName($tasksMap[$p]['name']);
				$task->setEachTime($tasksMap[$p]['eachTime']);
				if(function_exists("task_".$task->getName())) {
					call_user_func("task_".$task->getName());
				} else {
					continue;
				}
				$task->setLastExecution(time());
				$task->saveTask();
				continue;
			}
		}
		return true;
	}
	
	public static function PerformTask($taskName, $tasksMap) {
		include_once("tasksFunctions.php");
		$taskArr = array();
		foreach($tasksMap as $p => $v) {
			if(md5($tasksMap[$p]['name']) == $taskName) {
				$taskArr = $tasksMap[$p];
				break;
			} else {
				continue;
			}
		}
		if(count($taskArr) < 1) {
			return false;
		}
		// Executar task
		if(Tasks::TaskExists($taskArr['name'])) {
			$task = new Tasks();
			$task->loadTask($taskArr['name']);
			if(function_exists("task_".$task->getName())) {
				call_user_func("task_".$task->getName());
			}
			$task->setLastExecution(time());
			$task->saveTask();
		} else {
			$task = new Tasks();
			$task->setName($taskArr['name']);
			$task->setEachTime($taskArr['eachTime']);
			if(function_exists("task_".$task->getName())) {
				call_user_func("task_".$task->getName());
			}
			$task->setLastExecution(time());
			$task->saveTask();
		}
		return true;
	}
	
	/**
	 * @return integer
	 */
	public function getEachTime() {
		return $this->eachTime;
	}
	
	/**
	 * @return integer
	 */
	public function getId() {
		return $this->id;
	}
	
	/**
	 * @return integer
	 */
	public function getLastExecution() {
		return $this->lastExecution;
	}
	
	/**
	 * @return string
	 */
	public function getName() {
		return $this->name;
	}
	
	/**
	 * @param integer $eachTime
	 */
	public function setEachTime($eachTime) {
		$this->eachTime = $eachTime;
	}
	
	/**
	 * @param integer $id
	 */
	public function setId($id) {
		$this->id = $id;
	}
	
	/**
	 * @param integer $lastExecution
	 */
	public function setLastExecution($lastExecution) {
		$this->lastExecution = $lastExecution;
	}
	
	/**
	 * @param string $name
	 */
	public function setName($name) {
		$this->name = $name;
	}

}
?>