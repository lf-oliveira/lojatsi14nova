<?php

	require_once 'lib/constantes.php';
	require_once 'lib/database.php';
	require_once 'lib/funcoes.php';
	require_once 'lib/acesso.php';
	require_once 'functions/func_sessao.php';

	sessao();
	verificar_login();

    $email = $_POST['email'];
    $senha = $_POST['senha'];
    
    $verifica = mysql_query("SELECT * FROM clientes WHERE email = '$email' AND senha = '$senha'")
        or die("erro ao selecionar");
                if (mysql_num_rows($verifica)<=0){
                    echo"email ou senha incorreto!!!";
                    die();              
        }

	$today = date("d/m/y");
    $data = implode(array_reverse(explode('/', $today)), '-');
    $id_cliente = $_SESSION['id_clientes'];
   


	$sql = "insert into pedidos (registrado_em, situacao, id_cliente, valor_desconto) values ('$data', '1', '$id_cliente','0.00')";
	$result = mysql_query($sql);

	$sql = "SELECT * from pedidos where id_cliente = $id_cliente";
	$result = mysql_query($sql);
	while ($line = mysql_fetch_array($result)) {
		$idPedido = $line['id'];
	}
	foreach ($_SESSION['carrinho'] as $id => $qtd) {
								$sql 		= "SELECT * FROM produtos where id = '$id'";
								$result 	= mysql_query($sql);
								$registro 	= mysql_fetch_assoc($result);
								$id 		= $registro['id'];
								$preco 		= $registro['preco'];
								$qtd 		= $qtd;
								$sql = "insert into itens_pedido (id_pedido, id_produto, quantidade, preco) VALUES ('$idPedido', '$id', '$qtd', '$preco')";
								$result = mysql_query($sql);
	}

    if ($result) {
		echo "Compra Finalizada com Sucesso!!!";
	} else if (!$result) {
		echo mysql_error();
	}

    header( "refresh:2;url=/loja" );
?>