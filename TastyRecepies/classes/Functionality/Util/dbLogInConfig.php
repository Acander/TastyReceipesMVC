<?php

	namespace Functionality\Util;

	class DbLogInConfig{
			
		const dbServerName = "localhost";
		const dbUsername = "root";
		const dbPassword = "";
		const dbName = "tastydatabase";
			
		/**
		*	Establishes a connection with the database
		*	@return connection object returns an object representing a connection to the database
		*/
		public static function establishDatabaseConnection(){
			self::initializeErrorReporting();
			return mysqli_connect(self::dbServerName, self::dbUsername, self::dbPassword, self::dbName);
		}
			
		private static function initializeErrorReporting(){
			mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
		}
	}

?>