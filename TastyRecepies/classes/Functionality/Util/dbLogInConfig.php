<?php

	namespace Functionality\Util;

	class DbLogInConfig{
			
		private $dbServerName = "localhost";
		private $dbUsername = "root";
		private $dbPassword = "";
		private $dbName = "tastydatabase";
			
		/**
		*	Establishes a connection with the database
		*	@return connection object returns an object representing a connection to the database
		*/
		public static function establishDatabaseConnection{
			self::initializeErrorReporting();
			return mysqli_connect($dbServerName, $dbUsername, $dbPassword, $dbName);
		}
			
		private static function initializeErrorReporting(){
			mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
		}
	}

?>