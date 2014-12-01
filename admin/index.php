<?php
	require_once 'lib/constantes.php';
	require_once 'lib/funcoes.php';
	require_once 'lib/acesso.php';
    require_once 'lib/database.php';
    require_once 'functions/func_sessao.php';
    
    sessao();	
?>
<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<title>Loja virtual - Área Administrativa - Início</title>
		<meta charset="utf-8">
		<style type="text/css">
			@import "<?php echo URL_BASE; ?>css/estilos.css";
		</style>
	</head>
	<body>
		<div class="container">
			<h1>Menu principal</h1>
			<nav>
				<li><a href="#">Início</a></li>
				<li><a href="pedidos.php">Pedidos</a></li>
				<li><a href="produtos.php">Produtos</a></li>
				<li><a href="departamentos.php">Departamentos</a></li>
				<li><a href="clientes.php">Clientes</a></li>
				<li><a href="usuarios.php">Usuários</a></li>
				<li><a href="login.php?acao=sair">Sair</a></li>
			</nav>
		</div>
	</body>
</html>