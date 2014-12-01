<?php
    require_once '../lib/constantes.php';
	require_once '../lib/database.php';
	require_once 'crud/crud_pedidos.php';
	require_once '../lib/funcoes.php';
	require_once 'lib/acesso.php';
    require_once 'functions/func_sessao.php';
    
    sessao();
	verificar_login();


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
			select_pedidos();
			break;
		case 'incluir':
			// define o título da página
			$titulo_pagina = 'Novo Pedido';

			// carrega arquivo com o formulário para incluir novo usuário
			require_once 'gui/form_pedidos.php';
			// interrompe o switch...case
			break;
		case 'gravar':
            insert_pedidos();
			break;
		case 'excluir':
			del_pedidos();
			break;
		default:
			// encerra (mata) o script exibindo mensagem de erro
			die('Erro: Ação inexistente!');
	} // fim do switch...case

?>