<?php
	$deleteID = filter_input(INPUT_GET, 'deletar', FILTER_VALIDATE_INT);

	if(isset($deleteID) && $deleteID != ''):

		$deletar = conectar()->prepare("DELETE FROM usuarios WHERE user_id=:id");
		$deletar->bindValue(':id', $deleteID, PDO::PARAM_INT);
		try {
			if($deletar->execute()):
				SYSErro('O usuario foi deletado do sistema !', SYS_ERROR);
			endif;
		} catch (PDOException $e) {
			SYSErro($e->getMessage(), SYS_ERROR);
		}

	endif;

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
                    <a class="editar" href="<?= BASE.'/admin/index.php?exe=users/update&update='.$usuarios['user_id']; ?>">editar</a>
                    <a class="delete" href="<?= BASE.'/admin/index.php?exe=users/index&deletar='.$usuarios['user_id']; ?>">excluir</a>
		</div>
	</li>

<?php endforeach; else: SYSErro("não existem postagems cadastradas", SYS_ALERT); endif;?>
</ul>