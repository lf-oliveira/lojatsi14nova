<?php
    require_once 'lib/constantes.php';
	require_once 'lib/database.php';
	require_once 'lib/funcoes.php';
	require_once 'lib/acesso.php';
    	
?>
<!DOCTYPE html>
<html lang="pt-BR">
<meta charset="UTF-8">
	<head>
        <style type="text/css">@import "<?php echo URL_BASE; ?>css/estilos.css";</style>
		<title>Loja</title>
    </head>
<body>        		
          			<a href="form_clientes.php"><button>Cadastre - se</a></button>
                    <a href="carrinho.php"><button>Meu Carrinho</a></button>
                    <a href="admin/login.php"><button>Area Restrita</a></button>
          		

        		<h3>Minha Loja TSI14 </h3>  
      		
      		<legend> Departamentos </legend>
      		
      			<?php
      				$sql = "SELECT * from departamentos";
      				$result = mysql_query($sql);
      				while ($registro = mysql_fetch_assoc($result)) {

      					echo "      						
      						<tr><td><a href='?departamento=" . $registro['id'] . "'onClick='showProdutos();' style='text-decoration:none;'>
      					" . $registro['nome'] . "</a></td></tr>";

      			
      				}
      			?>           
                               

                	<legend> Produtos </legend>                	

                		<?php

                			if (isset($_GET['departamento'])) {
                				$idDep = $_GET['departamento'];
                				$sql = "SELECT * from produtos WHERE id_departamento = $idDep";
                				$result = mysql_query($sql);
                        if (mysql_num_rows($result) == 0) {
                            echo "
                            Nenhum produto encontrado neste departamento.
                            ";
                        }
                				$contador = 0;
                				while ($registro = mysql_fetch_assoc($result)) {
                                                   
                         echo "<h3>" . $registro['nome'] . '</h3><hr/>'; 
                             				echo "<h4>R$ " . $registro['preco'] . '</h4><hr/>';
                             				echo "<a href='?produto=" . $registro['id'] . "'><button type='button'>
                             				 Informações
                             				</button></a><hr/>";
                					echo "<a href='carrinho.php?acao=add&id=" . $registro['id'] . "'><button value='Adicionar ao carrinho'>Adicionar ao carrinho</button></a><br>";
                					$contador = $contador + 1;
                					   if ($contador == 4) {
          								        $contador = 0;
                							    
                					   }  
               				   }

                      }


                			if (isset($_GET['produto'])) {
                				$idProd = $_GET['produto'];
                				$sql = "SELECT * from produtos WHERE id = $idProd";
                				$result = mysql_query($sql);
                				while ($registro = mysql_fetch_assoc($result)) {
                					$detalhe = $registro['detalhes'];
                					echo "            						
  								
  									<h4>Detalhes</h4><hr/>
    									<tr><td>$detalhe</td></tr>
    									<hr/>
    									<button onClick='parent.history.back();'>Voltar lista de produtos</button>
  								";
                				}

                			}



                		?>


                	</div>
                </div>
                </div>
	</div>

</body>
</html>
