<?
class Account
{
	private $data = array(
		'id' => '',
		'password' => '', 
		'email' => '', 	
		'premdays' => '', 
		'lastday' => '', 
		'creation' => '', 
		'realName' => '',
		'location' => '', 
		'url' => '', 
		'access' => '', 
		
		'newEmail' => '', 
		'changeEmailDate' => '', 
		
		'newPasswordKey' => '', 
	);		
	
	private $registro = array(
		'primeiroNome' => '',
		'segundoNome' => '', 
		'endereco' => '', 	
		'numero' => '', 
		'complemento' => '', 
		'cidade' => '', 
		'estado' => '',
		'pais' => '', 
		'nascimento' => '', 
		'genero' => '', 
	);		
		
	private $payment_ids = array();	
	
	public function loadByEmail($email)
	{
		$this->data['email'] = $email;
	}
	
	public function loadByNumber($number)
	{
		$this->data['id'] = $number;
	}	
	
	public function exists()
	{
		if($this->data['email'] != "")
			DB::query("SELECT email FROM accounts WHERE email = '".$this->data['email']."'");
		elseif($this->data['id'] != "")
			DB::query("SELECT id FROM accounts WHERE id = ".$this->data['id']."");
		
		if(DB::query_result())
		{
			if(DB::num_rows() == 0)
				return false;
			else
			{
				$this->load();			
				return true;
			}	
		}	
		else
			return false;
	}
	
	public function load($emailChanges = false, $payments = false, $registrarion = false)
	{
		if($this->data['email'] != "")
			DB::query("SELECT * FROM accounts WHERE email = '".$this->data['email']."'");
		elseif($this->data['id'] != "")
			DB::query("SELECT * FROM accounts WHERE id = ".$this->data['id']."");
			
		$fetch = DB::fetch();

		$this->data['id'] = $fetch->id;	
		$this->data['email'] = $fetch->email;	
		$this->data['password'] = $fetch->password;	
		$this->data['premdays'] = $fetch->premdays;	
		$this->data['creation'] = $fetch->creation;	
		$this->data['warnings'] = $fetch->warnings;	
		$this->data['lastday'] = $fetch->lastday;	
		$this->data['realName'] = $fetch->realName;	
		$this->data['location'] = $fetch->location;	
		$this->data['access'] = $fetch->access;	
		$this->data['url'] = $fetch->url;	
		$this->data['questionTries'] = $fetch->questionTries;	
		$this->data['lastQuestionTries'] = $fetch->lastQuestionTries;	
		
		if($emailChanges)
		{
			DB::query("SELECT * FROM change_emails WHERE account_id = ".$this->data['id']."");
			
			if(DB::num_rows() != 0)
			{
				$fetch = DB::fetch();
				$this->data['newEmail'] = $fetch->newEmail;
				$this->data['changeEmailDate'] = $fetch->changeDate;
			}
		}	
		
		if($payments)
		{
			DB::query("SELECT id FROM payments WHERE account_id = ".$this->data['id']."");
			
			while($payment = DB::fetch())
			{
				$this->payment_ids[] = $payment->id;
			}
		}	

		if($registrarion)
		{
			DB::query("SELECT * FROM account_registry WHERE account_id = ".$this->data['id']."");
			
			if(DB::num_rows() != 0)
			{
				while($fetch = DB::fetch())
				{
					$this->registro['primeiroNome'] = $payment->primeiroNome;
					$this->registro['segundoNome'] = $payment->segundoNome;
					$this->registro['endereco'] = $payment->endereco;
					$this->registro['numero'] = $payment->numero;
					$this->registro['complemento'] = $payment->complemento;
					$this->registro['cep'] = $payment->cep;
					$this->registro['cidade'] = $payment->cidade;
					$this->registro['estado'] = $payment->estado;
					$this->registro['pais'] = $payment->pais;
					$this->registro['nascimento'] = $payment->nascimento;
					$this->registro['genero'] = $payment->genero;
				}
			}
		}			
	}
	
	public function newNumber()
	{
		$random = rand(100000,999999);
		$number = $random;
		
		do {
			DB::query("SELECT `id` FROM `accounts` WHERE `id` = $number");
			
			if(DB::num_rows() != 0)
			{
				$number++;
				
				if($number > 999999)
					$number = 100000;
				
				if($number == $random)
				{
					return "Não existe um numero disponivel, contacte a equipe.";
					break;
				}	
				
				$sucess = false;
			}	
			else
				$sucess = true;
		} while(!$sucess);	
		
		$this->data['id'] = $number;
		
		return $number;
	}
	
	public function saveNewNumber()
	{
		//Os dados da nova conta serão inseridos no banco de dados do website, servidores e login servers
		//Website DB (padrão)
		DB::query("INSERT INTO `accounts` (`id`,`password`,`email`,`creation`) VALUES (".$this->data['id'].",'".$this->data['password']."','".$this->data['email']."',".$this->data['creation'].")");
		
		//Game Servers DBs
		foreach($GLOBALS['g_world'] as $p => $v) {
			DB::query("INSERT INTO `accounts` (`id`,`password`) 
					   VALUES (".$this->data['id'].",'".$this->data['password']."')", $GLOBALS['g_world'][$p]['sqlResource']);
		}
		
		//Login Server DB
		DB::query("INSERT INTO `accounts` (`id`,`password`) VALUES (".$this->data['id'].",'".$this->data['password']."')", 'loginserver');
	}

	public function save($loginServer = false, $gameServers = false)
	{		
		//Os dados da conta serão salvos na DB
		//Website DB (padrão)
		DB::query("UPDATE accounts SET password = '".$this->data['password']."', email = '".$this->data['email']."', premdays = ".$this->data['premdays'].", lastday = ".$this->data['lastday'].", location = '".$this->data['location']."', url = '".$this->data['url']."', realName = '".$this->data['realName']."', lastQuestionTries = '".$this->data['lastQuestionTries']."', questionTries = '".$this->data['questionTries']."' WHERE id = ".$this->data['id']."");
		
		if($gameServers)
		{
			//Game Servers DB
			foreach($GLOBALS['g_world'] as $p => $v) {
				DB::query("UPDATE 
							accounts 
						   SET 
						   	password = '".$this->data['password']."', 
						   	premdays = ".$this->data['premdays']." 
						   WHERE 
						   	id = ".$this->data['id']."", $GLOBALS['g_world'][$p]['sqlResource']);
			}
		}	
		
		if($loginServer)
		{
			//Login Server DBs
			DB::query("UPDATE accounts SET password = '".$this->data['password']."', premdays = ".$this->data['premdays']." WHERE id = ".$this->data['id']."", 'loginserver');
		}
	}	

	public function updatePremDays()
	{
		$newDays = (time() - $this->data['lastday']) / 86400;
		
		if($this->data['premdays'] < $newDays)
			$this->data['premdays'] = 0;
		else
			$this->data['premdays'] -= $newDays;
			
		$this->data['lastday'] = time();	
	}
	
	public function newPasswordKey()
	{
		$this->data['newPasswordKey'] = Tools::rand(12);
		
		return $this->data['newPasswordKey'];
	}	
	
	public function savePasswordKey()
	{
		DB::query("INSERT INTO recovery_password (`account_id`, `key`, `date`) values (".$this->data['id'].", '".md5($this->data['newPasswordKey'])."', ".time().")");
	}
	
	public function changeEmail($newEmail)
	{
		DB::query("INSERT INTO change_emails (`newEmail`,`changeDate`,`account_id`) VALUES ('".$newEmail."',".time().",".$this->data['id'].")");
	}	
	
	public function loadPasswordKey()
	{
		DB::query("SELECT `key` FROM recovery_password WHERE account_id = '".$this->data['id']."' ORDER by date DESC");
		
		if(DB::num_rows() != 0)
		{
			$fetch = DB::fetch();
			$this->data['newPasswordKey'] = $fetch->key;
			return true;
		}
		else
		{
			return false;
		}
	}
	
	public function clearPasswordKeys()
	{
		DB::query("DELETE FROM recovery_password WHERE account_id = '".$this->data['id']."'");
	}
	
	public function cancelChangeEmail()
	{
		DB::query("DELETE FROM change_emails WHERE account_id = ".$this->data['id']."");
	}	

	public function setEmail($email)
	{
		$this->data['email'] = $email;
	}

	public function setPassword($password)
	{
		$this->data['password'] = $password;
	}	
	
	public function setCreation($creation)
	{
		$this->data['creation'] = $creation;
	}	

	public function setRealName($realName)
	{
		$this->data['realName'] = $realName;
	}	
	
	public function setLocation($location)
	{
		$this->data['location'] = $location;
	}	
	
	public function setUrl($url)
	{
		$this->data['url'] = $url;
	}	
	
	public function setInfo($data, $value)
	{
		$this->data[$data] = $value;
	}		

	public function getPassword()
	{
		return $this->data['password'];
	}	
	
	public function getNumber()
	{
		return $this->data['id'];
	}		
	
	public function getPremDays()
	{
		return $this->data['premdays'];
	}		
	
	public function getCreation()
	{
		return $this->data['creation'];
	}	
	
	public function getEmail()
	{
		return $this->data['email'];
	}	
	
	public function getWarnings()
	{
		return $this->data['warnings'];
	}		

	public function getAccess()
	{
		return $this->data['access'];
	}	
	
	public function getPayments()
	{
		return $this->payment_ids;
	}		

	public function getInfo($info)
	{
		return $this->data[$info];
	}
	
	public function getRegistrarion($info)
	{
		return $this->registro[$info];
	}
	public function loadChangePasswordKey()
	{
		DB::query("SELECT `key` FROM account_changepasswordkeys WHERE account_id = '".$this->data['id']."' ORDER by date DESC");
		
		if(DB::num_rows() != 0)
		{
			$fetch = DB::fetch();
			
			return $fetch->key;
		}
		else
			return false;
	}
	
	public function addChangePasswordKey($key)
	{
		DB::query("INSERT INTO account_changepasswordkeys (`key`,`date`,`account_id`) values ('".$key."', '".time()."', ".$this->data['id'].")");
	}	
	
	public function ereaseChangePasswordKeys()
	{
		DB::query("DELETE FROM account_changepasswordkeys WHERE account_id = ".$this->data['id']."");
	}

	public function loadQuestions()
	{	
		DB::query("SELECT account_questions.question, account_questions.answer FROM account_questions INNER JOIN accounts ON account_questions.account_id = accounts.id WHERE accounts.id = '".$this->data['id']."'");
	
		if(DB::num_rows() != 0)
		{
			
			$questions = array();
			$i = 0;
			while($fetch = DB::fetch())
			{
				$i++;
				
				$questions[$i]['question'] = $fetch->question;
				$questions[$i]['answer'] = $fetch->answer;	
			}
			
			return $questions;
		}	
		else	
			return false;
	}
	public function ereaseQuestions()
	{
		DB::query("DELETE FROM account_questions WHERE account_id = ".$this->data['id']."");
	}	
	
	public function addQuestion($question, $answer)
	{
		DB::query("INSERT INTO account_questions (`question`,`answer`,`account_id`) values ('".$question."', '".$answer."', ".$this->data['id'].")");
	}
	
	public function schedulerNewEmailIn($email, $date)
	{
		DB::query("INSERT INTO scheduler_changeemails (`account_id`,`email`,`date`) values (".$this->data['id'].", '".$email."', ".$date.")");
	}

}
?>