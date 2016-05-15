<?php
	$selecionarUsuarios = conectar()->prepare("SELECT * FROM usuarios ORDER BY user_id DESC");
	$selecionarUsuarios->execute();

	$contar = $selecionarUsuarios->rowCount();
?>
<h2>LISTANDO USUARIOS (<?= $contar; ?>)</h2>
<ul>
	<?php
            if($contar >= 1):
                    $dados = $selecionarUsuarios->fetchAll();
                    foreach($dados as $usuarios):
	?>
	<li>
		<div class="texto">
                    <p><?= $usuarios['user_name'].' '.$usuarios['user_lastname']; ?></p>
		</div>
		<div class="botoes">
                    <a class="editar" href="<?= BASE.'/admin/index.php?exe=users/update&uid='.$usuarios['user_id']; ?>">editar</a>
                    <a class="delete" href="<?= BASE.'/admin/index.php?exe=users/index&uid='.$usuarios['user_id']; ?>">excluir</a>
		</div>
	</li>

<?php endforeach; else: SYSErro("não existem postagems cadastradas", SYS_ALERT); endif;?>
</ul>