<?php
	namespace Functionality\Integration;
	use Functionality\Integration\DbLogInConfig;
	
	/**
	*	Handles all the SQL calls to the <code>Comment</code> database.
	*/
	class CommentDAO{
		private $conn;
		private $dataBaseManager;
		
		public function __construct(){
			$this->dataBaseManager = new DbLogInConfig();
		}
		
		private function establishConnection(){
			$this->conn = $this->dataBaseManager->establishDatabaseConnection();
		}
		
		/**
		*	Used to delete a comment from the database.
		*	@param string The comments id 
		*	@param string The page were a comment should be deleted
		*/
		public function delComment($c_id, $food){
			self::establishConnection();
			$sql = self::sqlCommentDelete($c_id, $food);
			mysqli_query($this->conn, $sql);
		}
		
		private function sqlCommentDelete($c_id, $food){
			return "DELETE FROM comments WHERE c_id = '$c_id'";
		}
		
		/**
		*Used to add a new comment to the database
		*@param string The users id (email)
		*@param string The comment
		*@param date The time of submission
		*@param string The page were submitted
		*/
		public function addComment($uid, $message, $date, $food){
			self::establishConnection();
			$sql = self::sqlAddComment($uid, $message, $date, $food);
			mysqli_query($this->conn, $sql);
		}
		
		private function sqlAddComment($uid, $message, $date, $food){
			return "INSERT INTO comments (user_id, message, date, dish) VALUES ('$uid', '$message', '$date', '$food')";
		}
		
		/**
		*	Used to return all data from the comment database
		*	@return mysqli_result All data from the comment database
		*/
		
		public function getAllComments(){
			self::establishConnection();
			$sql = self::sqlSelectAllComments();
			return mysqli_query($this->conn, $sql);
		}
		
		private function sqlSelectAllComments(){
			return "SELECT * FROM comments";
		}
	}