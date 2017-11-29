<?php

	namespace Functionality\Util;
	/**
	*	Responsible for initializing different common entities in requests
	*/
	
	class StartUp{
		const CONST_PREFIX = 'FUNCTIONALITY_';
		const WEBAPPROOT = 'C:/wamp64/www/TastyRecepies/';
		
		public static function initRequest(){
			session_start();
			self::createClassLoader();
		}
		
		private static function createClassLoader(){
			spl_autoload_register(function ($className) {require_once self::WEBAPPROOT.'classes/' . \str_replace('\\', '/', $className) . '.php';});
		}
	}