<h2>ATUALIZAR USUARIO</h2>
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