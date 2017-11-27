<?php
	namespace Functionality\Integration;
	
	use Functionality\Util\DbLogInConfig;
	
	/**
	*	Handles all the SQL calls to the <code>Comment</code> database.
	*/
	class CommentDOA{
		
		public function _construct(){
			DbLogInConfig::establishDatabaseConnection();
		}
		
		/**
		*	Used to delete a comment from the database.
		*	@param string The comments id 
		*	@param string The page were a comment should be deleted
		*/
		public function delComment($c_id, $food){
			$sql = sqlCommentDelete($c_id, $food);
			global $conn;
			mysqli_query($conn, $sql);
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
			$sql = sqlAddComment($uid, $message, $date, $food);
			global $conn;
			mysqli_query($conn, $sql);
		}
		
		private function sqlAddComment($uid, $message, $date, $food){
			return "INSERT INTO comments (user_id, message, date, dish) VALUES ('$uid', '$message', '$date', '$food')";
		}
		
		/**
		*	Used to return all data from the comment database
		*	@param string The page were the comments were submitted
		*	@return mysqli_result All data from the comment database
		*/
		
		public function getAllComments(){
			$sql = sqlSelectAllComments();
			global $conn;
			return mysqli_query($conn, $sql);
		}
		
		private function sqlSelectAllComments(){
			return "SELECT * FROM comments";
		}
	}