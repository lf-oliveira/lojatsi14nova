<?php
function logar(){
            $login = $_POST['login'];
			$senha = $_POST['senha'];

			$consulta = "
				select * from usuarios where login = '$login'
			";

			consultar($consulta);

			$usuario = proximo_registro();

			if ($usuario) {
				if($senha == $usuario['senha']) {
					$_SESSION['id_usuario'] = $usuario['id'];
					$_SESSION['nome_usuario'] = $usuario['nome'];
					$_SESSION['email_usuario'] = $usuario['email'];

					redireciona($_SESSION['request_uri']);
				}
				else {
					$erro = 'A senha informanda não confere.';					
				}
			}
			else {
				die('O login informado não foi encontrado.');
			}
}
?>


