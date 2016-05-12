<?php
	define("DB_HOST", "localhost");
	define("DB_USER", "root");
	define("DB_PASS", "");
	define("DB_NAME", "blog");

	define("SYS_ERROR", 'error');
	define("SYS_ALERT", 'alert');
	define("SYS_SUCCESS", 'success');

	function SYSErro($erro, $tipo)
	{
		echo "<p class=\"msg {$tipo}\">{$erro}</p>";
	}

	function conectar()
	{
		$pdo = null;
		if(is_null($pdo))
		{
			$dns = 'mysql:host'.DB_HOST.';dbname='.DB_NAME;
			try {
				$pdo = new PDO($dns, DB_USER, DB_PASS);
				$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			} catch (PDOException $e) {
				SYSErro($e->getMessage().' :: '.$e->getLine(), SYS_ERROR);
			}
		}
		return $pdo;
	}

	