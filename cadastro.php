<?php
	session_start();
  	if ( !empty( $_SESSION['id'] )  ) {
	  	echo "Seja bem vindo " . $_SESSION['nome'] . "<br>";
	  	echo "<a href='sair.php'>Sair</a>";	
  	} else {
  		$_SESSION['msg'] = "Área restrita";
  		header("Location: login.php");
  	}
  	include_once( "inc/config.php" );
?>

<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<title>Cadastro de Itens</title>
		<script src="js/jquery-3.2.1.min.js" type="text/javascript"></script>
		<script src="js/jquery.maskMoney.min.js" type="text/javascript"></script>
		<script src="js/custom.js" type="text/javascript"></script>
	</head>
	<body>
		
		<form action="" method="POST" enctype="multipart/form-dara">
			<label for="">Data</label>
			<input type="text" onKeyUp="formataData(this);" name="data" placeholder="Data"><br><br>
			<label for="">Descrição</label>
			<input type="text" name="descricao" placeholder="Descrição"><br><br>
			<label for="">Valor (R$): </label>
			<input type="text" name="valor" id="valor" placeholder="Valor"><br><br>
			<label for="">KM</label>
			<input type="number" name="km" placeholder="Kilometragem"><br><br>
			<label for="">Natureza de Item</label>
			<select name="tipo" id="">
				<option value="estetica">Estética/Melhorias</option>
				<option value="manutencao">Manutenção Preventiva</option>
				<option value="emergencial">Man. Emergencial</option>
			</select>
			<input type="submit" name="btnCadastro" value="Cadastrar">
			<input type="hidden" name="cadastrar" value="register">
		</form>

		<?php
			if ( isset( $_POST['cadastrar'] ) && $_POST['cadastrar'] == "register" ) {
				
				// Valores dos campos
				$data =			filter_input( INPUT_POST, 'data' );
				$data = 		explode( '/', $data );
				$data = 		array_reverse( $data );
				$data = 		implode( '-', $data );
				$descricao =	filter_input( INPUT_POST, 'descricao' );
				$valor =		filter_input( INPUT_POST, 'valor' );
				$km =			filter_input( INPUT_POST, 'km' );
				$km =			preg_replace( '/[^0-9]/', '', $km );
				$tipo =			filter_input( INPUT_POST, 'tipo' );
				
				// Verifica se os campos estão vazios
				if ( empty($data) || empty($descricao) || empty($valor) || empty($km) || empty($tipo) ) {
					echo "Por favor preencha todos os campos para prosseguir.";
				} else {
					$cadastrar = "INSERT INTO cadastros (`data`, `descricao`, `valor`, `km`, `tipo`) VALUES ('$data', '$descricao', '$valor', '$km', '$tipo')";
					if (mysqli_query($conexao, $cadastrar)) {
						echo "Cadastro realizado com sucesso!!";
					} else {
						echo "Erro ao cadastrar";
					}

				}

			}
			
		?>


	</body>
</html>