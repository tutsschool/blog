<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Login | Painel de controle</title>
	<link rel="stylesheet" href="css/reset.css">
	<link rel="stylesheet" href="css/login.css">
</head>
<body>
	<div class="content-login">
		<div class="box-login">
			<header class="header-title">
				<h2>Login</h2>
			</header>
			<?php
				$forms = filter_input_array(INPUT_POST, FILTER_DEFAULT);
				if(isset($forms['acao']) && $forms['acao'] == '')
				{
					unset($forms['acoa']);
					var_dump($forms)
				}
			?>
			<div class="msg">
				<p class="success">Login efetuado com sucesso aguarde !</p>
			</div>
			<form action="" method="post">

				<label>
					<span>Email :</span>
					<input type="text" name="email"/>
				</label>

				<label>
					<span>SENHA :</span>
					<input type="password" name="senha"/>
				</label>

				<input type="hidden" name="acao" value="logarse"/>
				<input type="submit" class="btn btn-alert" value="entrar"/>
			</form>
		</div>
		<div class="clearfix"></div>
	</div>
</body>
</html>