<?php
    // importa o código dos scripts
	require_once 'lib/constantes.php';
	require_once 'lib/database.php';
	require_once 'crud/crud_produtos.php';
	require_once 'lib/funcoes.php';
	require_once 'lib/acesso.php';
    require_once 'functions/func_sessao.php';
    
    sessao();
	


	// se uma ação foi informada na URL
	if (isset($_GET['acao']))
	{
		// captura a ação informada do array superglobal $_GET[]
		$acao = $_GET['acao'];
	}

	// se não foi informada ação
	if(!isset($acao))
	{
		// assume ação padrão (listar)
		$acao = 'listar';
	}

	switch($acao)
	{
		case 'listar':
			select_produtos();
			break;
		case 'incluir':
			// define o título da página
			$titulo_pagina = 'Novo produto';

			$lista_deptos = montaListaDeptos();

			// carrega arquivo com o formulário para incluir novo usuário
			require_once 'gui/form_produtos.php';
			// interrompe o switch...case
			break;
		case 'alterar':
			// captura o id passado na URL
			alterar_produtos();
			break;
		case 'gravar':
			insert_produtos();
			break;
		case 'excluir':
			// captura o id passado na URL
			del_produtos();
			break;
		default:
			// encerra (mata) o script exibindo mensagem de erro
			die('Erro: Ação inexistente!');
	} // fim do switch...case
