<?php
		function select_departamentos(){
			$consulta = "
				select * from departamentos order by nome
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
			$titulo_pagina = 'Lista de departamentos';
			// carrega o arquivo com a listagem de clientes (gui)
			require_once 'gui/lista_departamentos.php';
		}

		function alterar_departamentos(){
			// captura o id passado na URL
			$id = $_GET['id'];
			// monta consulta SQL para recuperar os dados do usuário a ser alterado
			$consulta = "select * from departamentos where id = $id";
			// executa a consulta
			consultar($consulta);
			// captura o registro retornado pela consulta
			$registro = proximo_registro();

			// extrai as informações em variáveis avulsas
			$nome = $registro['nome'];

			// define o título da página
			$titulo_pagina = 'Alterar departamento';
			// carrega o formulário para alterar o usuário
			require_once('gui/form_departamentos.php');
		}

		function insert_departamentos(){
			//capturar dados do formulário
			$nome = $_POST['nome'];

			if (!isset($_POST['id']))
			{
			// monta consulta sql para realização a inserção
				$consulta = "
					insert into departamentos (nome) values ('$nome')
				";
				$msg_erro = 'Não foi possível inserir.';
			}
			else
			{
				$consulta = "
					update departamentos set nome = '$nome'
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
				header('location:departamentos.php?acao=listar');
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

		function del_departamentos(){
			// se não informou id na URL
			if (!isset($_GET['id']))
			{
				// encerra (mata) o script com mensagem de erro
				die('Erro: O departamento do cliente a excluir não foi
					informado.');
			}

			// captura o id passado na URL
			$id = $_GET['id'];
			// monta consulta SQL para excluir usuário
			$consulta = "delete from departamentos where id = $id";
			// executa a consulta
			consultar($consulta);
			// verifica se a exclusão foi bem sucedida
			if(linhas_afetadas() > 0)
			{
				// redireciona para a listagem de usuários
				header('location:departamentos.php?acao=listar');
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