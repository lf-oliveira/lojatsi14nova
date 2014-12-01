<?php
    require_once 'lib/constantes.php';
	require_once 'lib/database.php';
	require_once 'crud/crud_pedidos.php';
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
			select_pedidos();
			break;
		case 'excluir':
			del_pedidos();
			break;
		default:
			// encerra (mata) o script exibindo mensagem de erro
			die('Erro: Ação inexistente!');
	} // fim do switch...case

?>
