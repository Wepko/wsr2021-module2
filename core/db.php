<?php

	function dbInstance() {
		static $db;
		
		if($db === null){
			$db = new PDO('mysql:host=' . 'localhost' . ';dbname=' . 'module2', 'root', 'root', [
				PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
			]);
			
			$db->exec('SET NAMES UTF8');
		}
		
		return $db;
	}

	function dbQuery($sql, $params = []) {
		$db = dbInstance();
		$query = $db->prepare($sql);
		$query->execute($params);
		dbCheckError($query);
		return $query;
	}

	function dbCheckError($query) {
		$errInfo = $query->errorInfo();

		if($errInfo[0] !== PDO::ERR_NONE){
			echo $errInfo[2];
			exit();
		}

		return true;
	}
  