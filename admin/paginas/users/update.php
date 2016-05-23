<h2>ATUALIZAR USUARIO</h2>
<?php
	$usuarioID = filter_input(INPUT_GET, 'update', FILTER_VALIDATE_INT);

	//atualiza usuario
	$forms = filter_input_array(INPUT_POST, FILTER_DEFAULT);
	if(isset($forms['acao']) && $forms['acao'] == 'update'):
		unset($forms['acao']);

        if($forms['user_name'] == ''):
        	SYSErro('Informe o nome do usuario', SYS_ALERT);
        elseif($forms['user_lastname'] == ''):
        	SYSErro('Informe o sobrenome do usuario', SYS_ALERT);
        elseif($forms['user_email'] == ''):
        	SYSErro('Informe o email do usuario', SYS_ALERT);
        else:

        	if($forms['user_password'] != ''):
        		$forms['user_password'] = md5($forms['user_password']);
        	else:
        		$forms['user_password'] = $forms['senhaantiga'];
        	endif;

        	unset($forms['senhaantiga']);

			foreach($forms as $key => $value):
				$campos[] = $key."=?";
				$valores[] = $value;
			endforeach;

	        $valores[] = $usuarioID;
	        $places = implode(',', $campos);
	        $valor = "'".implode("','", $valores)."'";
	        $update = conectar()->prepare("UPDATE usuarios SET {$places} WHERE user_id=?");
	        
	        try {
	            if($update->execute($valores)):
	                SYSErro("O usuario foi atualizado com sucesso !", SYS_SUCCESS);
	            endif;
	        } catch (PDOException $e) {
	             SYSErro($e->getMessage(), SYS_ERROR);
	        }

        endif;
	endif;

	//seleciona usuario para o formulario
	$selecionar = conectar()->prepare("SELECT * FROM usuarios WHERE user_id=:id");
	$selecionar->bindValue(":id", $usuarioID, PDO::PARAM_INT);
	$selecionar->execute();

	$selecionar->setFetchMode(PDO::FETCH_ASSOC);

	if($selecionar->rowCount() >= 1):
		$dados = $selecionar->fetchAll();
		foreach($dados as $user);
?>
<form action="" method="post">
	<label>
		<span>Nome : </span>
		<input type="text" name="user_name" value="<?= $user['user_name'] ?>" />
	</label>

	<label>
		<span>Sobrenome : </span>
		<input type="text" name="user_lastname" value="<?= $user['user_lastname'] ?>" />
	</label>

	<label>
		<span>Email : </span>
		<input type="email" name="user_email" value="<?= $user['user_email'] ?>" />
	</label>

	<label>
		<span>Senha : </span>
		<input type="password" name="user_password"/>
	</label>

	<input type="hidden" name="senhaantiga" value="<?= $user['user_password']; ?>">
	<input type="hidden" name="acao" value="update"/>
	<input type="submit" value="atualizar usuario" class="btn btn-success" />
</form>
<?php 
	endif; ?>