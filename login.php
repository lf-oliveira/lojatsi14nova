<?php
	// importa o código dos scripts
	require_once 'lib/constantes.php';
	require_once 'lib/database.php';
	require_once 'lib/funcoes.php';
    require_once 'lib/acesso.php';
    
    session_start();
	// se uma ação foi informada na URL
	if (isset($_GET['acao']))
	{
		// captura a ação informada do array superglobal $_GET[]
		$acao = $_GET['acao'];
	}

	// se não foi informada ação
	if(!isset($acao))
	{
		// assume ação padrão (identificar)
		$acao = 'identificar';
	}

	switch($acao) {
		case 'identificar':

			require_once('form_login.php');

			break;
		case 'autenticar':
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
			break;
		case 'sair':
			session_destroy();
        
			header('Location: index.php');

			break;
		default:
			// encerra (mata) o script exibindo mensagem de erro
			die('Erro: Ação inexistente!');
	}