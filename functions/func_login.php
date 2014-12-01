<?php
function logar(){
            $email = $_POST['email'];
			$senha = $_POST['senha'];

			$consulta = "
				select * from clientes where email = '$email'
			";

			consultar($consulta);

			$clientes = proximo_registro();

			if ($clientes) {
				if($senha == $clientes['senha']) {
					$_SESSION['id_clientes'] = $clientes['id'];
					$_SESSION['email_clientes'] = $clientes['email'];

					redireciona($_SESSION['request_uri']);
				}
				else {
					die('A senha informanda não confere.');
				}
			}
			else {
				die('O login informado não foi encontrado.');
			}
}
?>