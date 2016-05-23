<?php
	define("BASE", "http://localhost/blog");
	define("DB_HOST", "localhost");
	define("DB_USER", "root");
	define("DB_PASS", "");
	define("DB_NAME", "blog");

	define("SYS_ERROR", 'error');
	define("SYS_ALERT", 'alert');
	define("SYS_SUCCESS", 'success');

	function SYSErro($erro, $tipo)
	{
		echo "<div class=\"msg\"><p class=\"msg {$tipo}\">{$erro}</p></div>";
	}

	function urlTitle($title)
	{
		return str_replace(' ', '-', trim($title));
	}

	function conectar()
	{
		$pdo = null;
		if(is_null($pdo))
		{
                    $dns = 'mysql:host='.DB_HOST.';dbname='.DB_NAME;
                    try {
                            $pdo = new PDO($dns, DB_USER, DB_PASS);
                            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    } catch (PDOException $e) {
                            SYSErro($e->getMessage().' :: '.$e->getLine(), SYS_ERROR);
                    }
		}
		return $pdo;
	}
        
    function printCode($code, $tipoDebug = false)
    {   
        echo '<pre style="display:block; padding:10px; font-size:1.5em; border:1px solid #ddd; color:#444; margin:10px; border-radius:10px;">';
        (!$tipoDebug ? print_r($code) : var_dump($code));
        echo '</pre>';
    }
    //conectar();

	