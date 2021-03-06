<section id="posts">
        <?php
                $category = (isset($explode[1]) && $explode[1] != '' ? $explode[1] : '');    
                $selecionarPosts = conectar()->prepare("SELECT * FROM posts WHERE post_category=:category");
                $selecionarPosts->bindValue(':category', $category, PDO::PARAM_STR);
                $selecionarPosts->execute();

                $selecionarPosts->setFetchMode(PDO::FETCH_ASSOC);

                if($selecionarPosts->rowCount() >= 1):
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