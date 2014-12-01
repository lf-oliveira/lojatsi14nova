<?php
	// importa o código dos scripts
    require_once 'lib/constantes.php';
	require_once 'lib/database.php';	
    require_once 'lib/acesso.php';   
    
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
    $login = $_POST['login'];
    $entrar = $_POST['entrar'];
    $senha = $_POST['senha'];
   
        if (isset($entrar)) {
                     
            $verifica = mysql_query("SELECT * FROM usuarios WHERE login = '$login' AND senha = '$senha'") or die("erro ao selecionar");
                if (mysql_num_rows($verifica)<=0){
                    echo"Login e/ou senha incorretos";
                    die();              
        }}
        
        header('Location: index.php');
			break;
		case 'sair':
			session_destroy();

			header('Location: ../index.php');

			break;
		default:
			// encerra (mata) o script exibindo mensagem de erro
			die('Erro: Ação inexistente!');
	}