<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Blog do zero com php</title>
	<link rel="stylesheet" href="css/template.css"/>
</head>
<body>
<div class="content">
        <header id="header">
                <div class="logo">
                        <a href="">
                                <h1>Blog <b>Pro</b></h1>
                        </a>
                </div><!-- logo -->

                <div class="search">
                        <form action="" method="post">
                                <input type="text" name="url">
                                <input type="hidden" name="acao" value="buscar">
                                <input type="submit" value="procurar"/>
                        </form>
                </div><!-- search -->
                <div class="clearfix"></div>
        </header>
        <nav id="navmenu">
                <ul>
                        <li><a href="">home</a></li>
                        <li><a href="">games</a></li>
                        <li><a href="">sistemas</a></li>
                        <li><a href="">dicas</a></li>
                        <li><a href="">linux</a></li>
                        <li><a href="">sobre</a></li>
                        <li><a href="">fale conosco</a></li>
                </ul>
        </nav>
        <div class="container">
                <section id="posts">
                        <?php for($i = 0; $i < 10; $i++): ?>
                        <article class="lia">
                                <header>
                                        <a href="#"><h2>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illo aspernatur error dolore cum voluptate similique </h2></a>
                                </header>

                                <div class="img">
                                        <a href="">
                                                <img src="http://rdtpop.com/wp-content/uploads/2015/06/kunfu.jpg" title="" alt="">
                                        </a>
                                </div>
                                <a href="#" class="read-more">LEIA MAIS</a>
                        </article>
                        <?php endfor;?>
                </section><!-- posts -->
                <div id="sidebar">
                        <div class="widget">
                                <header>
                                        <h3>Sidebar 1</h3>
                                </header>
                                conteudo
                        </div>

                        <div class="widget">
                                <header>
                                        <h3>Sidebar 2</h3>
                                </header>
                                conteudo
                        </div>
                </div><!-- sidebar -->
                <div class="clearfix"></div>
        </div><!-- containner -->
        <div class="clearfix"></div>
        <footer id="footer">
                <span class="to-left"><a href="">Blog Pro</a> &copy; . Todos os direitos reservados.</span>
                <span class="to-right">Desenvolvido por - <a href="">Tutsschool</a></span>
        </footer>
</div><!-- content -->
<script src="js/jquery.js"></script>
<script src="js/functions.js"></script>
</body>
</html>