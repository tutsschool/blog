<h2>CADASTRAR CATEGORIA</h2>
<?php
	$forms = filter_input_array(INPUT_POST, FILTER_DEFAULT);
	if(isset($forms['acao']) && $forms['acao']=='enviar')
	{
		unset($forms['acao']);
		$forms['cat_url'] = urlTitle($forms['cat_name']);
		$forms['cat_views'] = 1;

		if($forms['cat_name'] == ''):
			SYSErro('Informe o nome da categoria !', SYS_ALERT);
		elseif($forms['cat_desc'] == ''):
			SYSErro('Informe a descrição da categoria !', SYS_ALERT);
		else:
			$campos = implode(',', array_keys($forms));
			$values = "'".implode("','", array_values($forms))."'";
			$create = conectar()->prepare("INSERT INTO categorias ({$campos}) VALUES ({$values})");
			try {
				
				if($create->execute()):
					SYSErro('Categoria criada com sucesso !', SYS_SUCCESS);
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
	<label>
		<span>Nome da categoria : </span>
		<input type="text" name="cat_name"/>
	</label>

	<label>
		<span>Descrição : </span>
		<textarea name="cat_desc"></textarea>
	</label>

	<input type="hidden" name="acao" value="enviar"/>
	<input type="submit" value="criar categoria" class="btn btn-alert"/>
</form>