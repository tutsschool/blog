<?php
    $delete = filter_input(INPUT_GET, 'pid');
    if(isset($delete) && $delete != 0)
    {
        $readPost = conectar()->prepare("SELECT * FROM posts WHERE post_id=:id");
        $readPost->bindValue(':id', $delete, PDO::PARAM_INT);
        $readPost->execute();
        
        $getPosts = $readPost->fetchAll(PDO::FETCH_ASSOC);
        $post = null;
        if($readPost->rowCount() >= 1):
            foreach($getPosts as $post);
            $path = '../uploads/posts/';
                if(is_dir("{$path}") && file_exists("{$path}{$post['post_imagem']}"))
                {
                    unlink("{$path}{$post['post_imagem']}");
                }

                $deletePost = conectar()->prepare("DELETE FROM posts WHERE post_id=:id");
                $deletePost->bindValue(':id', $delete, PDO::PARAM_INT);
                try {
                    if($deletePost->execute())
                    {
                        SYSErro("Postagem deletada do sistema !", SYS_ERROR);
                    }
                } catch (PDOException $e) {
                    SYSErro($e->getMessage(), SYS_ERROR);
                }
        else:
            SYSErro("O post que você esta tentando deletar não existe mais !", SYS_ALERT);
        endif;
    }

    $read = conectar()->prepare("SELECT * FROM posts ORDER BY post_id DESC");
    $read->execute();

    $read->setFetchMode(PDO::FETCH_ASSOC);
    $contar = $read->rowCount();

?>
<h2>CATEGORIAS (<?= $contar; ?>)</h2>
<ul>
	<?php
            if($contar >= 1):
                    $dados = $read->fetchAll();
                    foreach($dados as $posts):
	?>
	<li>
		<div class="texto">
                    <p><?= $posts['post_title'] ?></p>
		</div>
		<div class="botoes">
                    <a target="blank" class="ver" href="<?= BASE.'/'.$posts['post_category'].'/'.$posts['post_url']; ?>">ver post</a>
                    <a class="editar" href="<?= BASE.'/admin/index.php?exe=posts/update&pid='.$posts['post_id']; ?>">editar</a>
                    <a class="delete" href="<?= BASE.'/admin/index.php?exe=posts/index&pid='.$posts['post_id']; ?>">excluir</a>
		</div>
	</li>

<?php endforeach; else: SYSErro("não existem postagems cadastradas", SYS_ALERT); endif;?>
</ul>