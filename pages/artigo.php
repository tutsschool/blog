<?php
	$category = (isset($explode[1]) && $explode[1] != '' ? $explode[1] : '');
	$url = (isset($explode[2]) && $explode[2] != '' ? $explode[2] : '');
	$selecionarArtigo = conectar()->prepare("SELECT * FROM posts WHERE post_category=:category AND post_url=:url LIMIT 1");
	$selecionarArtigo->bindValue(':category', $category, PDO::PARAM_STR);
	$selecionarArtigo->bindValue(':url', $url, PDO::PARAM_STR);
	$selecionarArtigo->execute();


?>
<section id="posts">
				<?php
					if($selecionarArtigo->rowCount() <= 0):
						header('Location: '.BASE.'/404');
					else:
						foreach($selecionarArtigo->fetchAll() as $artigo);
						$home = BASE.'/artigo/'.$artigo['post_category'].'/'.$artigo['post_url'];
					endif;
				?>
				<article class="lia">
					<header>
						<h2><?= $artigo['post_title']; ?></h2>
					</header>
					<div class="tags">
						<span>Em : <b><?= date('d/m/Y', strtotime($artigo['post_data'])) ?></b> |</span>
						<span>( <?= $artigo['post_views']; ?> ) <b>visitas</b> |</span>
						<span>categoria : <a href="<?= BASE.'/categoria/'.$artigo['post_category']; ?>"><?= str_replace('-', ' ', $artigo['post_category']); ?></a></span>
					</div>
					<div class="img">
							<img src="<?=  getImagem('posts/'.$artigo['post_imagem']); ?>" title="" alt="">
					</div>
					<div class="conteudo">
						<p><?= $artigo['post_content']; ?></p>
					</div>
				</article>
</section><!-- posts -->
      <?php include 'inc/sidebar.inc.php'; ?>

<?php
	$postId = $artigo['post_id'];
	$u = (int) $artigo['post_views'] + 1;
	$update = conectar()->prepare("UPDATE posts SET post_views=:views WHERE post_id=:id");
	$update->bindValue(':views', $u, PDO::PARAM_INT);
	$update->bindValue(':id', $postId, PDO::PARAM_INT);
	$update->execute();
?>