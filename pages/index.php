<section id="posts">
        <?php
                $page = (isset($_GET['page']) && $_GET['page'] != '' && $_GET['page'] != 0 ? $_GET['page'] : 1);
                $inicio = ($page - 1);
                $maximo = 1;
                $selecionarPosts = conectar()->prepare("SELECT * FROM posts ORDER BY post_id DESC LIMIT $inicio, $maximo");
                $selecionarPosts->execute();

                $selecionarPosts->setFetchMode(PDO::FETCH_ASSOC);

                if($selecionarPosts->rowCount() >= 1):
                        foreach($selecionarPosts->fetchAll() as $posts):
                                $home = BASE.'/artigo/'.$posts['post_category'].'/'.$posts['post_url'];
                                $url_img = 'posts/'.$posts['post_imagem'];
        ?>
        <article class="lia">
                <header>
                        <a href="<?= $home; ?>">
                                <h2><?= $posts['post_title']; ?></h2>
                        </a>
                </header>

                <div class="img">
                        <a href="<?= $home; ?>">
                                <img src="<?= getImagem($url_img); ?>"
                                title="<?= $posts['post_title']; ?>" alt="<?= $posts['post_title']; ?>">
                        </a>
                </div>
                <a href="<?= $home; ?>" class="read-more">LEIA MAIS</a>
        </article>
                <?php
                                endforeach;
                        else:
                                echo 'Nenhum post foi encontrado';
                        endif;


                $paganator = conectar()->prepare("SELECT * FROM posts ORDER BY post_id DESC");
                $paganator->execute();

                $total = ceil($paganator->rowCount() / $maximo) - $paganator->rowCount();
                $anterior = $page - 1;
                $proximo = $page + 1;

                if($anterior <= 1):
                        echo '<a href="?page='.$proximo.'">proximo</a>';
                endif;

                if($proximo >= $total && $anterior != 0):
                        if($page <= $paganator->rowCount()):
                                echo '<a href="?page='.$anterior.'">anterior</a>';
                        endif;
                endif;

                ?>

        </section><!-- posts -->
        <?php include 'inc/sidebar.inc.php'; ?>
