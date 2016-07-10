<?php
    include 'sys/config.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?= get_title(); ?></title>
     <meta name="description" content="<?= get_title(); ?>"/>
	<link rel="stylesheet" href="<?= BASE; ?>/css/template.css"/>
</head>
<body>
        <?php
                include 'pages/inc/header.inc.php';

                $url = filter_input(INPUT_GET, 'url');

                $explode = explode('/', $url);
                $extensoesEndereco = ['artigo', 'categoria', 'sobre' , 'contato', 'pesquisa'];

                if(isset($explode[0]) && $explode[0] == ''):
                       include 'pages/index.php';
                elseif($explode[0] != '' && in_array($explode[0], $extensoesEndereco)):
                        include 'pages/'.$explode[0].".php";
                else:
                       include 'pages/404.php';
                endif;

                include 'pages/inc/footer.inc.php';
        ?>
        <script src="js/jquery.js"></script>
        <script src="js/functions.js"></script>
</body>
</html>
