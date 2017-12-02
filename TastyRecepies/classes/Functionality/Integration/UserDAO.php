<?php

	namespace Functionality\Integration;
	
	use Functionality\Integration\DbLogInConfig;
	
	class UserDAO {
		private $conn;
		private $databaseManager;
		
		public function __construct(){
			$this->dataBaseManager = new DbLogInConfig();
		}
		
		private function establishConnection(){
			$this->conn = $this->dataBaseManager->establishDatabaseConnection();
		}
		
		/**
		*	Register a user in the datdabase
		*	@param string An unescaped email address from the user input
		*	@param string An unescaped password from the user input
		*	@param string An unescaped re-submited password (supposed to be the same as the above) from the user input
		*/
		public function registrateUser($unescapedEmail, $unescapedPwd, $unescapedpwdRe){
			self::establishConnection();
			$email = mysqli_real_escape_string($this->conn, $unescapedEmail);
			$pwd = mysqli_real_escape_string($this->conn, $unescapedPwd);
			$pwdRe = mysqli_real_escape_string($this->conn, $unescapedpwdRe);
			
			return self::errorHandlers($email, $pwd, $pwdRe);
		}
		
		private function errorHandlers($email, $pwd, $pwdRe){
			if(self::pwdCondition($pwd, $pwdRe)){
				return self::passwordNotTheSame();
			}
			else{
				$resultCheck = self::sqlUserOccurenceCheck($email);
				
				$hashPwd = self::hashPassword($pwd);
				
				if(self::emailCondition($resultCheck)){
					return self::emailAlreadyExists();
				}
				else{
					return self::createUser($email, $hashPwd);
				}
			}
		}
		
		private function pwdCondition($pwd, $pwdRe){
			return (!($pwd == $pwdRe));
		}
		
		private function hashPassword($pwd){
			return password_hash($pwd, PASSWORD_DEFAULT);
		}
		
		private function passwordNotTheSame(){
			return 1;
		}
		
		private function sqlUserOccurenceCheck($email){
			$sql = self::sqlCheckIfUserAlreadyExist($email);
			$result = mysqli_query($this->conn, $sql);
			return mysqli_num_rows($result);
		}
		
		private function sqlCheckIfUserAlreadyExist($email){
			return "SELECT * FROM user WHERE email = '$email'";
		}
		
		private function emailCondition($resultCheck){
			return ($resultCheck > 0);
		}
		
		private function emailAlreadyExists(){
			return 2;
		}
		
		private function createUser($email, $pwd){
			$sql = "INSERT INTO user (email, pwd) VALUES ('$email', '$pwd');";
			mysqli_query($this->conn, $sql);
			return 0;
		}
		
		/**
		*	Validates the user towards the database
		*	@param string unescaped string representing an email
		*	@paramn string unescaped string representing the password
		*/
		public function validateUser($unescapedEmail, $unescapedPwd){
			self::establishConnection();
			$email = mysqli_real_escape_string($this->conn, $unescapedEmail);
			$pwd = mysqli_real_escape_string($this->conn, $unescapedPwd);
	
			$result = self::query($email);
			$resultCheck = mysqli_num_rows($result);
			return self::validation($result, $resultCheck, $pwd);
		}
		
		private function query($email){
			$sql = self::sqlSelectUser($email);
			return mysqli_query($this->conn, $sql);
		}
		
		private function sqlSelectUser($email){
			return "SELECT * FROM user WHERE email = '$email'";
		}
		
		private function validation($result, $resultCheck, $pwd){
			if($resultCheck < 1) {
				return self::wrongUserInformation();
			}
			else{
				$row = mysqli_fetch_assoc($result);
				$hashedPwdCheck = password_verify($pwd, $row['pwd']);
					
				if($hashedPwdCheck == false){
					return self::wrongUserInformation();
				}
				else if($hashedPwdCheck == true){
					return self::correctUserInformation($result);
				}
			}
		}
		
		private function wrongUserInformation(){
			return 1;
		}
		
		//private function validatePwd($pwd){
		//	}
		
		private function correctUserInformation($sqlResult) {
			$row = mysqli_fetch_assoc($sqlResult);
					
			$_SESSION['e'] = $row["email"];
			$_SESSION['p'] = $row["pwd"];
			
			return 0;
		}
		
		/**
		*	Ends the users session
		*/
		
		public function sessionEnd(){
			session_start();
			session_unset();
			session_destroy();
		}
	}