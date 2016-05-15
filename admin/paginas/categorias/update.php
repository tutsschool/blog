<h2>CADASTRAR CATEGORIA</h2>
<?php
	$catId = filter_input(INPUT_GET, 'id');
	$forms = filter_input_array(INPUT_POST, FILTER_DEFAULT);
	if(isset($forms['acao']) && $forms['acao']=='atualizar')
	{
		unset($forms['acao']);
		$forms['cat_url'] = urlTitle($forms['cat_name']);
		$forms['cat_views'] = 1;

		if($forms['cat_name'] == ''):
			SYSErro('Informe o nome da categoria !', SYS_ALERT);
		elseif($forms['cat_desc'] == ''):
			SYSErro('Informe a descrição da categoria !', SYS_ALERT);
		else:
			$campos = implode('=?,', array_keys($forms))."=?";
			$values = array_values($forms);
			$values[] = $catId;
			$update = conectar()->prepare("UPDATE categorias SET {$campos} WHERE cat_id=?");
			try {
				
				if($update->execute($values)):
					SYSErro('Categoria atualizada com sucesso !', SYS_SUCCESS);
				else:
					SYSErro('Erro ao criar categoria !', SYS_ERROR);
				endif;
			
			} catch (PDOException $e) {
				SYSErro($e->getMessage(), SYS_ERROR);
			}
		endif;
	}
?>
<form action="" method="post">
	<?php
		$read = conectar()->prepare("SELECT * FROM categorias WHERE cat_id=?");
		$read->execute(array($catId));

		if($read->rowCount() >= 1):
			$dados = $read->fetchAll(PDO::FETCH_ASSOC);
			foreach($dados as $cats);
		endif;

	?>
	<label>
		<span>Nome da categoria : </span>
		<input type="text" name="cat_name" value="<?= $cats['cat_name']; ?>" />
	</label>

	<label>
		<span>Descrição : </span>
		<textarea name="cat_desc"><?= $cats['cat_desc']; ?></textarea>
	</label>

	<input type="hidden" name="acao" value="atualizar"/>
	<input type="submit" value="atualizar categoria" class="btn btn-success"/>
</form>