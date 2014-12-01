<?php

    require_once 'lib/constantes.php';
	require_once 'lib/database.php';
	require_once 'lib/funcoes.php';
	require_once 'lib/acesso.php';
    $totalCompra = 0;

?>
<!DOCTYPE html>
<html lang="pt-BR">
	<head>
		<style type="text/css">@import "<?php echo URL_BASE; ?>css/estilos.css";</style>
		<title>Loja - Meu Carrinho</title>
    </head>
<body>

	<?php

		session_start();
        verificar_login();

		// Se minha seção carrinho não existir, eu inicializo ela como um array
		if (!isset($_SESSION['carrinho'])) {
			$_SESSION['carrinho'] = array();
			$_SESSION['qtd'] = 0;
		}

		
		if (isset($_GET['acao'])) {

			// Adicionar Produto
			if ($_GET['acao'] == 'add') {
				
				$id = intval($_GET['id']);

				// Se não existir este produto
				if (!isset($_SESSION['carrinho'][$id])) {
					$_SESSION['carrinho'][$id] = 1;
					$_SESSION['qtd'] += 1;
					
				// Se já existir adiciona mais 1	
				} else {
					$_SESSION['carrinho'][$id] += 1;
				}
			}

			// Remover Produto
			if ($_GET['acao'] == 'del') {

				$id = intval($_GET['id']);

				if (isset($_SESSION['carrinho'][$id])) {
					unset($_SESSION['carrinho'][$id]);
					$_SESSION['qtd'] -= 1;
				}

			}

			// Alterar Quantidade
			if ($_GET['acao'] == 'up') {
				if (isset($_POST['prod']) && is_array($_POST['prod'])) {
					foreach ($_POST['prod'] as $id => $qtd) {
						
						$id = intval($id);
						$qtd = intval($qtd);

						if (!empty($qtd) || $qtd <> 0 ) {

							$_SESSION['carrinho'][$id] = $qtd;

						} else {
							$_SESSION['qtd'] -= 1;
							unset($_SESSION['carrinho'][$id]);
						}
					}
				}
			}


		}


	?>
        		
          			<button><a href="carrinho.php">Meu Carrinho</a></button>
          			<button><a href="login.php?acao=sair">Sair</a></button>
          			 		

        		<h3>Minha Loja<small> TSI14 </small></h3>
   	        </div>
   	        	<form action='?acao=up' method='post'>
   	              	<table>
			<legend> Meu Carrinho </legend>
				<thead>
					<tr>
						<th>Produto </th>
						<th>Quantidade </th>
						<th>Preço </th>
						<th>Sub-Total </th>
						<th>Remover </th>
					</tr>
				</thead>
				<tbody>

					<?php

						if (count($_SESSION['carrinho']) == 0) {
							echo "<tr><td colspan='2'>Nenhum produto no carrinho</td></tr>";
														
						} else {

							foreach ($_SESSION['carrinho'] as $id => $qtd) {
								
								$sql 		= "SELECT * FROM produtos where id = '$id'";
								$result 	= mysql_query($sql);
								$registro 	= mysql_fetch_assoc($result);

								$nome 		= $registro['nome'];
								$preco 		= $registro['preco'];
								$total 		= $registro['preco'] * $qtd;
								$totalCompra    += $total;						

								echo '
									<tr>
										<td>'.$nome.'</td>
										<td><input type="text" size="3" name="prod['.$id.']" value="'.$qtd.'"</td>
										<td>'.$preco.'</td>
										<td>'.$total.'</td>
										<td><a href="?acao=del&id='.$id.'">Remover</a></td>
									</tr>

								';

								
							}

							echo "<tr>
								<td></td>
								<td></td>
								<td></td>
								<td><strong>Total:  </strong></td>
								<td><strong>R$ ".$totalCompra."</strong></td>
								</tr>";
														}

					?>

				</tbody>

			
			
   	        	</table>

   	        	
			<a href='index.php'><button type="button">Continuar Comprando</button></a>

			<button type='submit' id='atualizarCarrinho'>Atualizar</button>

			<a href='check.php'><button type="button">Finalizar Pedido</button></a>

			</div>
   	       		</form>

   	       		<?php

   	       			if (count($_SESSION['carrinho']) == 0) {
						
					echo "<script>
						$('#mostrarTotal').hide();
						$('#showButtons').hide();
					</script>";
				}

   	       		?>

   	        	

   	</div>

 
</body>
</html>
