<?php
	function select_usuarios(){

			$consulta = "
			select * from usuarios order by nome
			";
			// executa a consulta sql
			consultar($consulta);
			// declara um vetor de registros para passar para a view (gui)
			$registros = array();
			// percorre o resultset retornado pela consulta extraindo um a um os registros retornados
			while ($registro = proximo_registro())
			{
				// acrescenta o registro ao vetor
				array_push($registros, $registro);
			}
			// define o título da página
			$titulo_pagina = 'Lista de usuários';
			// carrega o arquivo com a listagem de usuários (gui)
			require_once 'gui/lista_usuarios.php';
	}

	function alterar_usuarios(){
			// captura o id passado na URL
			$id = $_GET['id'];
			// monta consulta SQL para recuperar os dados do usuário a ser alterado
			$consulta = "select * from usuarios where id = $id";
			// executa a consulta
			consultar($consulta);
			// captura o registro retornado pela consulta
			$registro = proximo_registro();

			// extrai as informações em variáveis avulsas
			$nome = $registro['nome'];
			$email = $registro['email'];
			$login = $registro['login'];

			// define o título da página
			$titulo_pagina = 'Alterar usuário';
			// carrega o formulário para alterar o usuário
			require_once('gui/form_usuarios.php');
	}

	function insert_usuarios(){
					//capturar dados do formulário
			$nome = $_POST['nome'];
			$email = $_POST['email'];
			$login = $_POST['login'];
			$senha = $_POST['senha'];
			if (!isset($_POST['id']))
			{
			// monta consulta sql para realização a inserção
				$consulta = "
					insert into usuarios (nome, email,
						login, senha) values ('$nome',
						'$email', '$login', '$senha')
				";
				$msg_erro = 'Não foi possível inserir.';
			}
			else
			{
				$consulta = "
					update usuarios set nome = '$nome',
						email = '$email', login = '$login',
						senha = '$senha'
					where id = {$_POST['id']}
				";
				$msg_erro = 'Não foi possível alterar.';
			}
			// executa a consulta
			consultar($consulta);
			// verifica se a operação foi bem sucedida
			if(linhas_afetadas() > 0)
			{
				// redireciona para a listagem de usuários
				header('location:usuarios.php?acao=listar');
				// finaliza a execução do script
				exit;
			}
			else {
				// exibe mensagem de erro
				echo 'Erro: ' . $msg_erro;
				// finaliza a execução do script
				exit;
			}
	}

	function del_usuarios(){
		// captura o id passado na URL
			$id = $_GET['id'];
			// monta consulta SQL para excluir usuário
			$consulta = "delete from usuarios where id = $id";
			// executa a consulta
			consultar($consulta);
			// verifica se a exclusão foi bem sucedida
			if(linhas_afetadas() > 0)
			{
				// redireciona para a listagem de usuários
				header('location:usuarios.php?acao=listar');
				// encerra a execução do script
				exit;
			}
			else {
				// exibe mensagem de erro
				echo "Erro: Não foi possível excluir.";
				exit;
			}
	}

?>