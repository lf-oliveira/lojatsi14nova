<?php
	// importa o código dos scripts
	require_once '../lib/constantes.php';
	require_once '../lib/database.php';
	require_once 'lib/acesso.php';
    require_once 'functions/func_login.php';   
    
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

			require_once('gui/form_login.php');

			break;
		case 'autenticar':
			 logar();
			break;
		case 'sair':
			session_destroy();

			header( "refresh:url=/loja" );

			break;
		default:
			// encerra (mata) o script exibindo mensagem de erro
			die('Erro: Ação inexistente!');
	}