<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<title>Finalizar</title>
		<meta charset="utf-8">
		<script type="text/javascript" src="functions/goback.js"></script>
       <style type="text/css">
			@import "css/estilos.css";
		</style>
	</head>
	<body>
		<div class="container">
			<h1>Finalizar</h1>
			<form method="post" action="finalizar.php">
				<fieldset>
					<legend>Dados do cliente</legend>
					<div class="form-group">
						<label for="nome">Endereço:</label>
						<input type="text">
					</div>
					<div class="form-group">
						<label for="email">E-mail:</label>
						<input type="text" name="email" id="email">
					</div>
                    <div class="form-group">
						<label for="senha">Senha:</label>
						<input type="password" name="senha" id="senha">
					</div>
				</fieldset>
				<div class="form-group">
					<button type="submit">Comprar</button>
				</div>
			</form>
		</div>
	</body>
</html>