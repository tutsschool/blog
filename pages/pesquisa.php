<section id="posts">
        <?php
        		 $buscar = str_replace('-', ' ', $explode[1]);
                $selecionarPosts = conectar()->prepare("SELECT * FROM posts WHERE post_title LIKE '%' :buscar '%' ORDER BY post_id DESC");
                $selecionarPosts->bindValue(':buscar', $buscar, PDO::PARAM_STR);
                $selecionarPosts->execute();

                $selecionarPosts->setFetchMode(PDO::FETCH_ASSOC);

                if($selecionarPosts->rowCount() >= 1):
                		echo '<h1>'.$selecionarPosts->rowCount().' resultados</h1>';
                        foreach($selecionarPosts->fetchAll() as $posts):
                                $home = BASE.'/artigo/'.$posts['post_category'].'/'.$posts['post_url'];
               
        ?>  
        <article class="lia">
                <header>
                        <a href="<?= $home; ?>">
                                <h2><?= $posts['post_title']; ?></h2>
                        </a>
                </header>

                <div class="img">
                        <a href="<?= $home; ?>">
                                <img src="<?=  getImagem('posts/'.$posts['post_imagem']); ?>"
                                title="<?= $posts['post_title']; ?>" alt="<?= $posts['post_title']; ?>">
                        </a>
                </div>
                <a href="<?= $home; ?>" class="read-more">LEIA MAIS</a>
        </article>
                <?php 
                                endforeach;
                        endif; ?>

        </section><!-- posts -->
        <?php include 'inc/sidebar.inc.php'; ?>