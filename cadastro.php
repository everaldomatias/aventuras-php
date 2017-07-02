<?php
	session_start();
  	if ( !empty( $_SESSION['id'] )  ) {
	  	echo "Seja bem vindo " . $_SESSION['nome'] . "<br>";
	  	echo "<a href='sair.php'>Sair</a>";	
  	} else {
  		$_SESSION['msg'] = "Área restrita";
  		header("Location: login.php");
  	}

  	// Required Settings
  	include_once( "inc/settings.php" );

  	// Define Document Title
  	$document_title = 'Cadastro de Itens';
  	global $document_title;

  	// Header
  	get_header();
?>

<div class="col-group">
	<article class="col-12 col-dt-4 col-dt-offset-0">
		<div class="col-group">
			<div class="col-6">
				…
			</div>
			<div class="col-6">
				…
			</div>
		</div>
	</article>
	<aside class="col-4 col-dt-8">
		…
	</aside>
</div>
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
		<option value="interior">Interior</option>
		<option value="lataria">Lataria</option>
		<option value="mecanica">Mecânica</option>
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