<?php
	//url base do site
	define("BASE", "http://localhost/blog");

	//configura o banco de dados
	define("DB_HOST", "localhost");
	define("DB_USER", "root");
	define("DB_PASS", "");
	define("DB_NAME", "blog");

	//tipo de mensagem de erro
	define("SYS_ERROR", 'error');
	define("SYS_ALERT", 'alert');
	define("SYS_SUCCESS", 'success');

     define("SITENAME", "Blog Pro");
     define("SITEDESC", "Criado totalmente usando php !");

	//funcao que apresenta mensagems de erro na tela
	function SYSErro($erro, $tipo)
	{
		echo "<div class=\"msg\"><p class=\"msg {$tipo}\">{$erro}</p></div>";
	}

	//cria url amigavel
	function urlTitle($title)
	{
		return str_replace(' ', '-', trim($title));
	}

	//funcao usada para se conectar ao banco de dados
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

	//funcao responsavel por pegar a imagem correta dos posts
	function getImagem($Imagem)
	{
		$retorno = null;
		if($Imagem != '' && is_file("uploads/".$Imagem)):
			$retorno = BASE."/uploads/{$Imagem}";
		else:
			$retorno = BASE."/uploads/default.jpg";
		endif;
		return $retorno;
	}

	include 'funcoes.php';
