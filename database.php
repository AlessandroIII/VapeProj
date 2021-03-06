<?php 
class Database{

	public static $connection = null;
	public static $rs = null;

	public static function connect(){
		self::$connection = new mysqli("localhost", "root", "", "vapeproj");
		if(self::$connection->connect_error){
			die('Errore di connessione (' . self::$connection->connect_errno . ') '. self::$connection->connect_error);
		}		
	}

	public static function insertRecord($table, $fields, $values, $debug_mode = FALSE){
		if($debug_mode){
			echo "<div style=\"margin-left:20%\"><pre>";			
			echo "<br>INSERT INTO " . $table . "(" . $fields . ")VALUES(" . $values . ");<br>";
			echo "</pre></div>";
		}
		
		self::$connection->query("INSERT INTO $table($fields)VALUES($values);");
	}

	public static function search($fields, $tables, $conditions, $debug_mode = FALSE){
		if($debug_mode){
			echo "<div style=\"margin-left:20%\"><pre>";			
			echo "<br>SELECT $fields FROM $tables WHERE $conditions;<br>";
			echo "</pre></div>";
		}
		$rs = self::$connection->query("SELECT $fields FROM $tables WHERE $conditions");

		if($rs->num_rows) {
			return $rs->fetch_all(MYSQLI_ASSOC);
		} else {
			return 0;
		}
	}

	public static function deleteData($table){
		self::$connection->query("TRUNCATE TABLE $table");
	}

	public static function customQuery($query, $debug_mode = FALSE){
		if($debug_mode){
			echo "<div style=\"margin-left:20%\"><pre>";			
			echo "<br>$query<br>";
			echo "</pre></div>";
		}
		$rs = self::$connection->query($query);
		if($rs->num_rows) {
			return $rs->fetch_all(MYSQLI_ASSOC);
		} else {
			return 0;
		}
	}

	public static function delete($table, $condition, $debug_mode = FALSE){
		if($debug_mode){
			echo "<div style=\"margin-left:20%\"><pre>";	
			echo "<br>$query;<br>";
			echo "</pre></div>";
		}
		$esito = self::$connection->query("DELETE FROM $table WHERE $condition");
	}
	
	public static function update($table, $fields, $condition, $debug_mode = FALSE){
		if($debug_mode){
			echo "<div style=\"margin-left:20%\"><pre>";			
			echo "<br>UPDATE " . $table . " SET " . $fields . " WHERE " . $condition . ";<br>";
			echo "</pre></div>";
		}
		$esito = self::$connection->query("UPDATE " . $table . " SET " . $fields . " WHERE " . $condition . ";");
		if($esito == NULL){
			echo "Errore update su query <br> $table, <br> $fields, <br> $condition";
			exit;
		}
	}
}
?>