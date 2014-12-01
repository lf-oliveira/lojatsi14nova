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