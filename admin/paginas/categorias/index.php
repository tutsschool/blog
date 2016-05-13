<?php
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
			<a class="ver" href="">ver categoria</a>
			<a class="editar" href="">editar</a>
			<a class="delete" href="">excluir</a>
		</div>
	</li>

<?php endforeach; endif;?>
</ul>