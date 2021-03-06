<?php
    // importa o código dos scripts
	require_once 'lib/constantes.php';
	require_once 'lib/database.php';
	require_once 'crud/crud_clientes.php';
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
			// monta a consulta para recuperar a listagem de usuários ordenada pelo nome
			select_clientes();
			break;
		case 'incluir':
			// define o título da página
			$titulo_pagina = 'Novo cliente';
			// carrega arquivo com o formulário para incluir novo usuário
			require_once 'gui/form_clientes.php';
			// interrompe o switch...case
			break;
		case 'alterar':
			// captura o id passado na URL
			alterar_clientes();
			break;
		case 'gravar':
			//capturar dados do formulário
			insert_clientes();
			break;
		case 'excluir':
			// captura o id passado na URL
			del_clientes();
			break;
		default:
			// encerra (mata) o script exibindo mensagem de erro
			die('Erro: Ação inexistente!');
	} // fim do switch...case
