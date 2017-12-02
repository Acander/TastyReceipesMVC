<?php

	namespace Functionality\Integration;

	class DbLogInConfig{
			
		const dbServerName = "localhost";
		const dbUsername = "OneDirection";
		const dbPassword = "justinbieber";
		const dbName = "tastydatabase";
			
		/**
		*	Establishes a connection with the database
		*	@return connection object returns an object representing a connection to the database
		*/
		public function establishDatabaseConnection(){
			self::initializeErrorReporting();
			return mysqli_connect(self::dbServerName, self::dbUsername, self::dbPassword, self::dbName);
		}
			
		private function initializeErrorReporting(){
			mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
		}
	}

?>