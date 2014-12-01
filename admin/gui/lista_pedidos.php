<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<title><?php echo $titulo_pagina; ?></title>
		<meta charset="utf-8">
		<style type="text/css">@import "<?php echo URL_BASE; ?>css/estilos.css";</style>
        <script type="text/javascript" src="functions/goback.js"></script>
	</head>
	<body>
		<div class="container">
			<h1><?php echo $titulo_pagina; ?></h1>
			<table>
				<thead>
					<tr>
						<th>Código</th><th>Registro</th><th>Situação</th><th>Cliente</th><th>Valor Desconto</th><th>Ações</th>
					</tr>
				</thead>
				<tbody>
					<?php
						foreach($registros as $registro)
						{
							echo "
								<tr>
									<td>" . $registro['id'] . "</td>
									<td>{$registro['registrado_em']}</td>
									<td>{$registro['situacao']}</td>
									<td>{$registro['id_cliente']}</td>
                                    <td>{$registro['valor_desconto']}</td>
									<td class='acoes'>
									<a href='javascript:if(confirm(\"Confirma a exclusão?\")){document.location=\"pedidos.php?acao=excluir&id={$registro['id']}\";}'>E</a>
									</td>
								</tr>
							";
						}
					?>
				</tbody>
			</table>
			<div class="form-group"><button type="button" onclick="goBack()">Voltar</button></div>
		</div><!-- container -->
	</body>
</html>