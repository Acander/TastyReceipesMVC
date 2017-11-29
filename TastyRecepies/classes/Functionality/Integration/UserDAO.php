<?php

	namespace Functionality\Integration;
	
	use Functionality\Util\DbLogInConfig;
	
	class UserDAO {
		private $conn;
		
		public function __construct(){
			$this->conn = DbLogInConfig::establishDatabaseConnection();
		}
		
		/**
		*	Register a user in the datdabase
		*	@param string An unescaped email address from the user input
		*	@param string An unescaped password from the user input
		*	@param string An unescaped re-submited password (supposed to be the same as the above) from the user input
		*/
		public function registrateUser($unescapedEmail, $unescapedPwd, $unescapedpwdRe){
			$email = mysqli_real_escape_string($this->conn, $unescapedEmail);
			$pwd = mysqli_real_escape_string($this->conn, $unescapedPwd);
			$pwdRe = mysqli_real_escape_string($this->conn, $unescapedpwdRe);
			
			self::errorHandlers($email, $pwd, $pwdRe);
		}
		
		private function errorHandlers($email, $pwd, $pwdRe){
			if(self::pwdCondition($pwd, $pwdRe)){
				self::passwordNotTheSame();
			}
			else{
				$resultCheck = self::sqlUserOccurenceCheck($email);
				
				if(self::emailCondition($resultCheck)){
					self::emailAlreadyExists();
				}
				else{
					self::createUser($email, $pwd);
				}
			}
		}
		
		private function pwdCondition($pwd, $pwdRe){
			return (!($pwd == $pwdRe));
		}
		
		private function passwordNotTheSame(){
			header("Location: ../TastyRecepies/UserRegister.php?UserRegister=pwdFailure");
			exit();
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
			header("Location: ../TastyRecepies/UserRegister.php?UserRegister=emailFailure");
			exit();
		}
		
		private function createUser($email, $pwd){
			$sql = "INSERT INTO user (email, pwd) VALUES ('$email', '$pwd');";
			mysqli_query($this->conn, $sql);
			header("Location: ../TastyRecepies/index.php");
			exit();
		}
		
		/**
		*	Validates the user towards the database
		*	@param string unescaped string representing an email
		*	@paramn string unescaped string representing the password
		*/
		public function validateUser($unescapedEmail, $unescapedPwd){
			$email = mysqli_real_escape_string($this->conn, $unescapedEmail);
			$pwd = mysqli_real_escape_string($this->conn, $unescapedPwd);
	
			$result = self::query($email, $pwd);
			$resultCheck = mysqli_num_rows($result);
			self::validation($result, $resultCheck);
		}
		
		private function query($email, $pwd){
			$sql = self::sqlSelectUser($email, $pwd);
			return mysqli_query($this->conn, $sql);
		}
		
		private function sqlSelectUser($email, $pwd){
			return "SELECT * FROM user WHERE email = '$email' AND pwd = '$pwd'";
		}
		
		private function validation($result, $resultCheck){
			if($resultCheck < 1) {
				self::wrongUserInformation();
			}
			else{
				self::correctUserInformation($result);
			}
		}
		
		private function wrongUserInformation(){
			header("Location: ../TastyRecepies/index.php?login=error");
			echo "E-mail or password is incorrect";
			exit();
		}
		
		private function correctUserInformation($sqlResult) {
			$row = mysqli_fetch_assoc($sqlResult);
					
			$_SESSION['e'] = $row["email"];
			$_SESSION['p'] = $row["pwd"];
			header("Location: ../TastyRecepies/resources/views/MainPage.php");
			exit();
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