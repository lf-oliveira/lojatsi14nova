<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<title>Cadastro Clientes</title>
		<meta charset="utf-8">
		<style type="text/css">@import "css/estilos.css";</style>
        <script type="text/javascript" src="functions/goback.js"></script>
	</head>
	<body>
		<div class="container">
			<h1>Cadastro Clientes</h1>
			<form method="post" action="cadastro.php">
				<?php
					// se há um id definido (se é uma alteração)
					if (isset($id))
					{
						echo '<input type="hidden" name="id" value="'. $id . '">';
					}
				?>
				<fieldset>
					<legend>Dados do cliente</legend>
					<div class="form-group">
						<label for="nome">Nome:</label>
						<input type="text" name="nome" id="nome" value="<?=isset($nome) ? $nome : ''; ?>">
					</div>
					<div class="form-group">
						<label for="email">e-mail:</label>
						<input type="text" name="email" id="email" value="<?=isset($email) ? $email : ''; ?>">
					</div>
					<div class="form-group">
						<label for="senha">Senha:</label>
						<input type="password" name="senha" id="senha">
					</div>
					<div class="form-group">
						<label for="confirma_senha">Confirmação da senha:</label>
						<input type="password" name="confirma_senha" id="confirma_senha">
					</div>
				</fieldset>
				<div class="form-group">
					<button type="submit">Gravar</button><button type="button" onclick="goBack()">Voltar</button>
				</div>
			</form>
		</div>
	</body>
</html>