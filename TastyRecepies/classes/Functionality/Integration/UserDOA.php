<?php

	namespace Functionality\Integration;
	
	use Functionality\Util\DbLogInConfig;
	
	class UserDOA {
		
		public function _construct(){
			DbLogInConfig::establishDatabaseConnection();
		}
		
		/**
		*	Register a user in the datdabase
		*	@param string An unescaped email address from the user input
		*	@param string An unescaped password from the user input
		*	@param string An unescaped re-submited password (supposed to be the same as the above) from the user input
		*/
		public function registrateUser($unescapedEmail, $unescapedPwd, $unescapedpwdRe){
			$email = mysqli_real_escape_string($conn, $unescapedEmail);
			$pwd = mysqli_real_escape_string($conn, $unescapedPwd);
			$pwdRe = mysqli_real_escape_string($conn, $unescapedpwdRe);
			
			errorHandlers($email, $pwd, $pwdRe);
		}
		
		private function errorHandlers($email, $pwd, $pwdRe){
			if(pwdCondition($pwd, $pwdRe)){
				passwordNotTheSame();
			}
			else{
				$resultCheck = sqlUserOccurenceCheck($email);
				
				if(emailCondition($resultCheck)){
					emailAlreadyExists();
				}
				else{
					createUser($email, $pwd)
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
			$sql = "SELECT * FROM user WHERE email = '$email'";
			$result = mysqli_query($conn, $sql);
			return mysqli_num_rows($result);
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
			mysqli_query($conn, $sql);
			header("Location: ../TastyRecepies/index.php");
			exit();
		}
		
		/**
		*	Validates the user towards the database
		*	@param string unescaped string representing an email
		*	@paramn string unescaped string representing the password
		*/
		public function validateUser($unescapedEmail, $unescapedPwd){
			global $conn;
			
			$email = mysqli_real_escape_string($conn, $unescapedEmail);
			$pwd = mysqli_real_escape_string($conn, $unescapedPwd);
	
			$result = query();
			$resultCheck = mysqli_num_rows($result);
			validation($resultCheck);
		}
		
		private function query(){
			$sql = sqlSelectUser();
			return mysqli_query($conn, $sql);
		}
		
		private function sqlSelectUser(){
			return "SELECT * FROM user WHERE email = '$email' AND pwd = '$pwd'";
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
			header("Location: ../TastyRecepies/MainPage.php");
			exit();
		}
		
		private function validation($resultCheck){
			if($resultCheck < 1) {
				wrongUserInformation();
			}
			else{
				correctUserInformation($result);
			}
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