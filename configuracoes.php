<?php
	session_start();
  	if ( empty( $_SESSION['id'] )  ) {
  		$_SESSION['msg'] = "Área restrita";
  		header("Location: login.php");
  	}

  	// Required Settings
  	include_once( "inc/settings.php" );

  	// Define Document Title
  	$document_title = 'Configurações';
  	global $document_title;

  	// Header
  	get_header();

	// Tratamento do formulário
	if ( isset( $_POST['editar'] ) && $_POST['editar'] == "register" ) {
		
		// Valores dos campos
		$data_inicial =			filter_input( INPUT_POST, 'data_inicial' );
		$data_inicial = 		explode( '/', $data_inicial );
		$data_inicial = 		array_reverse( $data_inicial );
		$data_inicial = 		implode( '-', $data_inicial );
		$valor_compra =				filter_input( INPUT_POST, 'valor_compra' );
		$km_inicial =			filter_input( INPUT_POST, 'km_inicial' );
		$km_inicial =			preg_replace( '/[^0-9]/', '', $km_inicial );
		
		// Verifica se os campos estão vazios
		if ( empty( $data_inicial ) || empty( $valor_compra ) || empty( $km_inicial ) ) {
			$_SESSION['msg_cadastro'] = '<div class="col-lg-12 alert alert-warning">Por favor preencha todos os campos para prosseguir.</div>';
		} else {
			$cadastrar = "INSERT INTO configuracoes (`km_inicial`, `data_inicial`, `valor_compra`) VALUES ('$km_inicial','$data_inicial', '$valor_compra')";
			if (mysqli_query($conexao, $cadastrar)) {
				$_SESSION['msg_cadastro'] = '<div class="col-lg-12 alert alert-success"><strong>Pronto.</strong> Seu item foi cadastrado com sucesso.</div>';
			} else {
				$_SESSION['msg_cadastro'] = '<div class="col-lg-12 alert alert-danger"><strong>Erro ao cadastrar.</strong> Tente novamente.</div>';
			}

		}

	} else {
		$_SESSION['msg_cadastro'] = '';
	}
	
?>

			<div id="page-wrapper">

			    <div class="container-fluid">

			        <!-- Page Heading -->
			        <div class="row">
			            <div class="col-lg-12">
			                <h1 class="page-header">
			                    Configurações <small>gerais</small>
			                </h1>
			                <ol class="breadcrumb">
		                        <li>
		                            <i class="fa fa-dashboard"></i>  <a href="index.html">Painel</a>
		                        </li>
		                        <li class="active">
		                            <i class="fa fa-cogs"></i> Configurações
		                        </li>
		                    </ol>
			            </div>
			        </div>
			        <!-- /.row -->

		        	
		        	<?php
		        	  	if ( !empty( $_SESSION['msg_cadastro'] ) ) {
		        	  		echo $_SESSION['msg_cadastro'];
		        	  	}
		        	  	
					  	//$mysqli = new mysqli( $host, $user, $pass, $banco ) or die( "ERROR : " . mysqli_error() );
					  	$sql = "SELECT `ID`, `km_inicial`, `data_inicial`, `valor_compra` FROM `configuracoes`";
						$query = $conexao->query( $sql );

						if ( $query->num_rows == 1 ) {
							$iniciado = true;
							while ( $dados = $query->fetch_array() ) {
								$item_id = 				$dados['ID'];
								$item_km_inicial = 		$dados['km_inicial'];
								$item_data_inicial = 	$dados['data_inicial'];
								$item_data_inicial = 	explode( '-', $item_data_inicial );
								$item_data_inicial = 	array_reverse( $item_data_inicial );
								$item_data_inicial =	implode( '/', $item_data_inicial );
								$item_valor_compra = 	$dados['valor_compra'];
							}
						}
								
						mysqli_close( $mysqli );
		
		        	?>

		        	<div class="row">

				        <div class="col-lg-12">

			                <form role="form" action="" method="POST" enctype="multipart/form-dara">

			                    <div class="form-group">
			                        <label>Data</label>
			                        <?php if ( ! empty( $item_data_inicial ) ) : ?>
										<input class="form-control" type="text" onKeyUp="formataData(this);" name="data_inicial" value="<?php echo $item_data_inicial; ?>">
			                        <?php else: ?>
			                        	<input class="form-control" type="text" onKeyUp="formataData(this);" name="data_inicial" placeholder="Data inicial dos relatórios">
			                        <?php endif; ?>
			                    </div>

			                    <div class="form-group">
			                        <label>KM</label>
			                        <?php if ( ! empty( $item_km_inicial ) ) : ?>
			                        	<input class="form-control" type="number" name="km_inicial" value="<?php echo $item_km_inicial; ?>">
			                        <?php else: ?>
			                        	<input class="form-control" type="number" name="km_inicial" placeholder="Kilometragem">
			                    	<?php endif; ?>
			                    </div>			                    

			                    <div class="form-group">
			                    	<label for="valor">Valor</label>
								    <div class="input-group">
								     	<div class="input-group-addon">R$</div>
								     	<?php if ( ! empty( $item_valor_compra ) ) : ?>
								      		<input type="text" name="valor_compra" class="form-control" id="valor" value="<?php echo $item_valor_compra; ?>">
								      	<?php else: ?>
								      		<input type="text" name="valor_compra" class="form-control" id="valor" placeholder="Valor">
								      	<?php endif; ?>

								    </div>
			                    </div>

			                    <input type="submit" class="btn btn-success" name="btnSalvarConfigs" value="Salvar">
								<input type="hidden" name="editar" value="register">
								<button type="reset" class="btn btn-default">Limpar formulário</button>

			                </form>

			            </div>

			        </div>
			        <!-- /.row -->

			    </div>
			    <!-- /.container-fluid -->

			</div>
			<!-- /#page-wrapper -->

		</div>
		    <!-- /#wrapper -->

	</body>
</html>