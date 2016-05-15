<h2>CRIAR USUARIO</h2>
<?php
	$forms = filter_input_array(INPUT_POST, FILTER_DEFAULT);
	if(isset($forms['acao']) && $forms['acao'] == 'criar'):
		unset($forms['acao']);

		$usuario = conectar()->prepare("SELECT * FROM usuarios WHERE user_email=:email LIMIT 1");
		$usuario->bindValue(':email', $forms['user_email'], PDO::PARAM_STR);
		$usuario->execute();

		$contarUsuario = $usuario->rowCount();

		if($forms['user_name'] == ''):
			SYSErro('Informe o nome do usuario !', SYS_ALERT);
		elseif($forms['user_lastname'] == ''):
			SYSErro('Informe o sobrenome do usuario !', SYS_ALERT);
		elseif($forms['user_email'] == ''):
			SYSErro('Informe o email do usuario !', SYS_ALERT);
		elseif($contarUsuario >= 1):
			SYSErro('O email ja esta sendo usado no sistema!', SYS_ALERT);
		elseif($forms['user_password'] == ''):
			SYSErro('Informe a senha do usuario !', SYS_ALERT);
		else:
			$forms['user_password'] = md5($forms['user_password']);

			$Keys = implode(',', array_keys($forms));
			$Values = "'".implode("','", array_values($forms))."'";

			$criar = conectar()->prepare("INSERT INTO usuarios ({$Keys}) VALUES ({$Values})");

			try {
				if($criar->execute()):
					SYSErro('O usuario foi cadastrado com sucesso !', SYS_SUCCESS);
				endif;
			} catch (PDOException $e) {
				SYSErro($e->getMessage(), SYS_ERROR);
			}
		endif;
	endif;
?>
<form action="" method="post">
	<label>
		<span>Nome : </span>
		<input type="text" name="user_name"/>
	</label>

	<label>
		<span>Sobrenome : </span>
		<input type="text" name="user_lastname"/>
	</label>

	<label>
		<span>Email : </span>
		<input type="email" name="user_email"/>
	</label>

	<label>
		<span>Senha : </span>
		<input type="password" name="user_password"/>
	</label>

	<input type="hidden" name="acao" value="criar"/>
	<input type="submit" value="cadastrar usuario" class="btn btn-alert" />
</form>