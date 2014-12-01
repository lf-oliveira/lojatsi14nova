 <?php
             require_once 'lib/constantes.php';
	         require_once 'lib/database.php';
	         require_once('lib/funcoes.php');
	         require_once('lib/acesso.php');

			$nome = $_POST['nome'];
			$email = $_POST['email'];
			$senha = $_POST['senha'];
			if (!isset($_POST['id']))
			{
			// monta consulta sql para realização a inserção
				$consulta = "
					insert into clientes (nome, email,
						senha) values ('$nome',
						'$email', '$senha')
				";
				$msg_erro = 'Não foi possível inserir.';
			}
			else
			{
				$consulta = "
					update clientes set nome = '$nome',
						email = '$email',
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
                echo "Cadastro com sucesso!!!<br>
                <a href='index.php'><button>Voltar a Loja</a></button>
                ";				
				// finaliza a execução do script
				exit;
			}
			else {
				// exibe mensagem de erro
				echo 'Erro: ' . $msg_erro;
				// finaliza a execução do script
				exit;
			}
	
            ?>