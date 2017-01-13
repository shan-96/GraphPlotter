<?php

//include('class.password.php');

class User2 extends Password2{

    private $db;
	
	function __construct($db){
		parent::__construct();
	
		$this->_db = $db;
	}

	public function is_logged_in(){
		if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
			return true;
		}
	}

	private function get_user_hash($username){	

		try {

			$stmt = $this->_db->prepare('SELECT password FROM users WHERE username = :username');
			$stmt->execute(array('username' => $username));
			
			$row = $stmt->fetch();
			return $row['password'];

		} catch(PDOException $e) {
		    echo '<p class="error">'.$e->getMessage().'</p>';
		}
	}

	
	public function login($username,$password){	

		$hashed = $this->get_user_hash($username);
		
		if($this->password_verify($password,$hashed) == 1){
		    
			$stmt = $this->_db->prepare('SELECT memberID FROM users WHERE username = :username');
			$stmt->execute(array('username' => $username));
			
			$row = $stmt->fetch();
			
			$_SESSION['id']=$row['memberID'];
		    $_SESSION['loggedin'] = true;
			$_SESSION['username'] = $username;
		    return true;
		}		
	}
	
		
	public function logout(){
		session_destroy();
	}
	
}


?>