<?php
	session_start();
  	if ( empty( $_SESSION['id'] )  ) {
  		$_SESSION['msg'] = "Área restrita";
  		header("Location: login.php");
  	}

  	// Required Settings
  	include_once( "inc/settings.php" );

  	// Define Document Title
  	$document_title = 'Registros';
  	global $document_title;

  	// Header
  	get_header();
	
?>

			<div id="page-wrapper">

			    <div class="container-fluid">

			        <!-- Page Heading -->
			        <div class="row">
			            <div class="col-lg-12">
			                <h1 class="page-header">
			                    <?php echo $document_title; ?>
			                </h1>
			                <ol class="breadcrumb">
		                        <li>
		                            <i class="fa fa-dashboard"></i>  <a href="index.html">Painel</a>
		                        </li>
		                        <li class="active">
		                            <i class="fa fa-edit"></i> <?php echo $document_title; ?>
		                        </li>
		                    </ol>
			            </div>
			        </div>
			        <!-- /.row -->

		        	<div class="row">

				        <div class="col-lg-12">
	                        <div class="table-responsive">
	                            <table class="table table-bordered table-hover table-striped">
	                                <thead>
	                                    <tr>
	                                        <th>ID</th>
	                                        <th>Data</th>
	                                        <th>Descrição</th>
	                                        <th>Valor</th>
	                                        <th>KM</th>
	                                        <th>Natureza</th>
	                                        <th></th>
	                                    </tr>
	                                </thead>
	                                <tbody>
	                                	<?php
	                                	// Query para verificar se os dados foram cadastrados ($iniciado = true)
									  	$sql = "SELECT * FROM `cadastros` ORDER by ID DESC";
										$query = $conexao->query( $sql );

										if ( $query->num_rows >= 1 ) {
											while ( $dados = mysqli_fetch_assoc( $query ) ) {
												$id = $dados['id'];
												$data = explode( '-', $dados['data'] );
												$data = array_reverse( $data );
												$data = implode( '/', $data );
												echo '<tr>';
												echo '<td>' . $id . '</td>';
												echo '<td>' . $data . '</td>';
												echo '<td>' . $dados['descricao'] . '</td>';
												echo '<td>R$ ' . $dados['valor'] . '</td>';
												echo '<td>' . $dados['km'] . '</td>';
												echo '<td>' . ucwords( $dados['tipo'] ) . '</td>';
												echo '<td><button class="btn btn-danger delete" id="del_'. $id .'">x</button></td>';
												echo '</tr>';
											}
										} else {
											echo 'It´s bad.';									
										}
	                                	?>
	                                </tbody>
	                            </table>
	                        </div>
	                    </div>

			        </div><!-- /.row -->
			    </div><!-- /.container-fluid -->
			</div><!-- /#page-wrapper -->
		</div><!-- /#wrapper -->
	</body>
</html>