<?php
	namespace Functionality\Controller;
	
	use Functionality\Util\StartUp;
	use Functionality\Integration\CommentDAO;
	use Functionality\Integration\UserDAO;
	
	/**
	* This is the controller object. All calls to the bottom layers from the view goes through here.
	*/

	class Controller {
		const CONTR_KEY = StartUp::CONST_PREFIX.'controller';
		private $commentDAO;
		private $userDAO;
		
		public function __construct(){
			$this->commentDAO = new CommentDAO();
			$this->userDAO = new UserDAO();
		}
		
		public static function getController(){
			if(!isset($_SESSION[self::CONTR_KEY])){
				return new Controller();
			}
			return unserialize($_SESSION[self::CONTR_KEY]);
			
		}
		
		/**
		*	Deletes one of the users comments
		*	@param string The comments id 
		*	@param string The page were a comment should be deleted
		*/
		public function deleteComment($c_id, $food){
			$this->commentDAO->delComment($c_id, $food);
		}
		
		/**
		*	Adds a users new comment
		*	@param string The users id (email)
		*	@param string The comment itself
		*	@param date The time of submitting
		*	@param string Which page the comment was added
		*/
		public function addANewComment($uid, $message, $date, $food){
			$this->commentDAO->addComment($uid, $message, $date, $food);
		}
		
		/**
		*	Gets all comments from the database
		*	@returns mysqli_result 
		*/
		public function getComments(){
			return $this->commentDAO->getAllComments();
		}
		
		/**
		*	Register a user
		*	@param string An unescaped email address from the user input
		*	@param string An unescaped password from the user input
		*	@param string An unescaped re-submited password (supposed to be the same as the above) from the user input
		*	@return integer An error code wich signals if the operation was successful or not
		*/
		public function userRegistration($unescapedEmail, $unescapedPwd, $unescapedpwdRe){
			return $this->userDAO->registrateUser($unescapedEmail, $unescapedPwd, $unescapedpwdRe);
		}
		
		/**
		*	Validates the login and makes sure that this is a registrered user
		*	@param string An unescaped emali address (user identification)
		*	@param string An unescaped password
		*/
		public function conValUser($unescapedEmail, $unescapedPwd){
			return $this->userDAO->validateUser($unescapedEmail, $unescapedPwd);
		}
		
		/**
		*	Logs out the user
		*/
		public function userLogOut(){
			$this->userDAO->sessionEnd();
		}
		
		/**
		*Destroys the controller
		*/
		public function __destruct() {
			$_SESSION[self::CONTR_KEY] = serialize($this);
		}
		
	}