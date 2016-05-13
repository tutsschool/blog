<?php
	session_start();
	require_once '../sys/config.php';
	if(!isset($_SESSION['userlogin'])){
		include 'login.php';
		exit();
	}

        $user = (isset($_SESSION['userlogin']) ? $_SESSION['userlogin'][0] : NULL);
        $sair  = filter_input(INPUT_GET, 'sair');
        if(isset($sair) && $sair == 'true'):
            unset($user);
            session_destroy();
            header('Location: index.php');
        endif;
        $usuarios = conectar()->prepare("SELECT * FROM usuarios WHERE user_id=:id");
        $usuarios->bindValue(':id', $user['user_id'], PDO::PARAM_INT);
        $usuarios->execute();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Admin | Painel de controle</title>
        <link rel="stylesheet" href="css/reset.css"/>
        <link rel="stylesheet" href="css/style.css"/>
</head>
<body>
    <div class="container">
        <div id="sidebar">
            <a href="<?= BASE ?>/admin/index.php?exe=home/index"><h1>PAINEL</h1></a>
            <div class="widget">
                <p class="userlogado">Olá, <b><?= $user['user_name']; ?></b>, bem vindo ! 
                    <a href="index.php?sair=true" class="sair">[ Logout ]</a></p>
            </div>
            <div class="widget">
                <h2>POSTS</h2>
                <ul>
                    <li><a href="index.php?exe=posts/criar">publicar postagem</a></li>
                    <li><a href="index.php?exe=posts/index">ver posts</a></li>
               </ul>

            </div>
            
            <div class="widget">
                <h2>CATEGORIAS</h2>
                <ul>
                    <li><a href="index.php?exe=categorias/criar">cadastrar categoria</a></li>
                    <li><a href="index.php?exe=categorias/index">ver categorias</a></li>
               </ul>
            </div>
            
            <div class="widget">
                <h2>USUARIOS</h2
                <ul>
                    <li><a href="index.php?exe=users/criar">criar usuario</a></li>
                    <li><a href="index.php?exe=users/index">ver usuarios</a></li>
               </ul>
            </div>
        </div><!-- sidebar -->
        <div id="content">
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
        </div><!-- content -->
    </div><!-- container -->
</body>
</html>