<?php
	session_start();
	require_once '../sys/config.php';
	if(!isset($_SESSION['userlogin'])){
		include 'login.php';
		exit();
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Admin | Painel de controle</title>
</head>
<body>
	<?php
		$url = filter_input(INPUT_GET, 'exe');
		$dirPages = 'paginas';
		if(isset($url) && $url != '')
		{
			$explode 	= explode('/', $url);
			$explode[1] = ((isset($explode[1]) && $explode[1] != '') ? $explode[1] : 'index');
			$getDir 	= $explode[0];
			$getFile 	= $explode[1];
			if(is_dir("{$dirPages}/{$getDir}") && file_exists("{$dirPages}/{$getDir}/{$getFile}.php"))
			{
				include "{$dirPages}/{$getDir}/{$getFile}.php";
			}
			else{
				include "{$dirPages}/404.php";
			}
		}else{
			header('Location: index.php?exe=home/index');
		}
	?>
</body>
</html>