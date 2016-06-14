<div class="content">
        <header id="header">
                <div class="logo">
                        <a href="<?= BASE; ?>">
                                <h1>Blog <b>Pro</b></h1>
                        </a>
                </div><!-- logo -->

                <div class="search">
                        <?php
                                if(isset($_POST['acao']) && $_POST['acao']=='buscar'):
                                        $pesquisa = filter_input(INPUT_POST, 'url');
                                        if($pesquisa != ''):
                                                $pesquisa = urlTitle($pesquisa);
                                                header('Location: '.BASE.'/pesquisa/'.$pesquisa);
                                        endif;
                                endif;
                        ?>
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
                        <li><a href="<?= BASE; ?>">Home</a></li>
                <?php
                        $selecionarCategorias = conectar()->prepare("SELECT * FROM categorias ORDER BY cat_name DESC");
                        $selecionarCategorias->execute();

                        $selecionarCategorias->setFetchMode(PDO::FETCH_ASSOC);

                        if($selecionarCategorias->rowCount() >= 1):
                                foreach($selecionarCategorias->fetchAll() as $cats):
                                        echo '<li><a href="'.BASE.'/categoria/'.$cats['cat_url'].'">'.$cats['cat_name'].'</a></li>';
                                endforeach;
                        endif;
                ?>
                        <li><a href="<?= BASE; ?>/contato">fale conosco</a></li>
                </ul>
        </nav>
<div class="container">