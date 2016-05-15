<?php

    $deletar = filter_input(INPUT_GET, 'cid');
    if(isset($deletar) && $deletar != 0):
        $catDelete = conectar()->prepare("DELETE FROM categorias WHERE cat_id=?");
        try{
            if($catDelete->execute(array($deletar))):
                SYSErro("Categoria deletada do sistema !", SYS_ERROR);
            endif;
        } catch (PDOException $e) {
            SYSErro($e->getMessage(), SYS_ERROR);
        }
    endif;

    $read = conectar()->prepare("SELECT * FROM categorias ORDER BY cat_id DESC");
    $read->execute();
    
    $read->setFetchMode(PDO::FETCH_ASSOC);
    $contar = $read->rowCount();

?>
<h2>CATEGORIAS (<?= $contar; ?>)</h2>
<ul>
	<?php
		if($contar >= 1):
			$dados = $read->fetchAll();
			foreach($dados as $cats):
	?>
	<li>
		<div class="texto">
			<p><?= $cats['cat_name'] ?></p>
		</div>
		<div class="botoes">
                    <a target="blank" class="ver" href="<?= BASE.'/categoria/'.$cats['cat_url']; ?>">ver categoria</a>
                    <a class="editar" href="<?= BASE.'/admin/index.php?exe=categorias/update&cid='.$cats['cat_id']; ?>">editar</a>
                    <a class="delete" href="<?= BASE.'/admin/index.php?exe=categorias/index&cid='.$cats['cat_id']; ?>">excluir</a>
		</div>
	</li>

<?php endforeach; endif;?>
</ul>