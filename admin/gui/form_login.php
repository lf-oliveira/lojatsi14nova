<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<title>Loja virtual - Área Administrativa - Identificação do Usuário</title>
		<meta charset="utf-8">
		<style type="text/css">
			@import "<?php echo URL_BASE; ?>css/estilos.css";
		</style>
	</head>
	<body>
		<div class="container">
			<h1>Identificação do Usuario</h1>
			<form method="post" action="login.php?acao=autenticar">
				<fieldset>
					<legend>Dados do Usuario</legend>
					<div class="form-group">
						<label for="nome">Logon:</label>
						<input type="text" name="login" id="login">
					</div>
					<div class="form-group">
						<label for="senha">Senha:</label>
						<input type="password" name="senha" id="senha">
					</div>
					<div class="form-group">
						<button type="submit" value="entrar" id="entrar" name="entrar">Enviar</button>
					</div>
				</fieldset>
			</form>
		</div>
	</body>
</html>