<div id="sidebar">
        <div class="widget">
                <header>
                        <h3>As mais lidas</h3>
                </header>
                <ul class="mais_lidas">
                    <?php
                         $read_posts = conectar()->prepare("SELECT * FROM posts ORDER BY post_views DESC");
                         $read_posts->execute();

                         $read_posts->setFetchMode(PDO::FETCH_ASSOC);

                         foreach($read_posts->fetchAll() as $posts):
                              echo '<li><a href="'.BASE.'/.'.$posts['post_category'].'/'.$posts['post_url'].'" title="'.$posts['post_title'].'">
                              '.$posts['post_title'].'</a></li>';
                         endforeach;
                    ?>
                </ul>
        </div>
</div><!-- sidebar -->
