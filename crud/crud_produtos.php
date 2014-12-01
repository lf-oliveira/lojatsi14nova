<?php
	function select_produtos(){
		// monta a consulta para recuperar a listagem de produtos, com o respectivo nome
			// do departamento associado, ordenada pelo nome do produto
			$consulta = "
				select p.id, p.nome as nome_produto,
				p.preco, d.nome as nome_departamento
				from produtos p,
				departamentos d
				where d.id = p.id_departamento
				order by p.nome
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
			$titulo_pagina = 'Lista de produtos';
			// carrega o arquivo com a listagem de usuários (gui)
			require_once 'gui/lista_produtos.php';
	}

	function alterar_produtos(){
			$id = $_GET['id'];
			// monta consulta SQL para recuperar os dados do usuário a ser alterado
			$consulta = "select * from produtos where id = $id";
			// executa a consulta
			consultar($consulta);
			// captura o registro retornado pela consulta
			$registro = proximo_registro();

			// extrai as informações em variáveis avulsas
			$nome = $registro['nome'];
			$id_departamento = $registro['id_departamento'];
			$detalhes = $registro['detalhes'];
			$preco = $registro['preco'];

			$lista_deptos = montaListaDeptos($id_departamento);

			// define o título da página
			$titulo_pagina = 'Alterar produto';
			// carrega o formulário para alterar o usuário
			require_once('gui/form_produtos.php');
	}

	function insert_produtos(){
		//capturar dados do formulário
			$nome = $_POST['nome'];
			$id_departamento = $_POST['id_departamento'];
			$detalhes = $_POST['detalhes'];
			$preco = $_POST['preco'];
			if (!isset($_POST['id']))
			{
			// monta consulta sql para realização a inserção
				$consulta = "
					insert into produtos (nome, id_departamento,
						detalhes, preco) values ('$nome',
						$id_departamento, '$detalhes', $preco)
				";
				$msg_erro = 'Não foi possível inserir.';
			}
			else
			{
				$consulta = "
					update produtos set nome = '$nome',
						id_departamento = $id_departamento, detalhes = '$detalhes',
						preco = $preco
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
				header('location:produtos.php?acao=listar');
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

	function del_produtos(){
		$id = $_GET['id'];
			// monta consulta SQL para excluir usuário
			$consulta = "delete from produtos where id = $id";
			// executa a consulta
			consultar($consulta);
			// verifica se a exclusão foi bem sucedida
			if(linhas_afetadas() > 0)
			{
				// redireciona para a listagem de usuários
				header('location:produtos.php?acao=listar');
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

<?php
function montaListaDeptos()
	{
		// recupera departamentos
		$consulta = "
			select * from departamentos
			order by nome
		";

		consultar($consulta);

		$lista_deptos = '';

		while($registro = proximo_registro())
		{
			$lista_deptos .= '<option value="' .
				$registro['id'] .
				@( $id == $registro['id'] ) .
				'">' . $registro['nome'] . '</option>';
		}

		return $lista_deptos;
	}
?>