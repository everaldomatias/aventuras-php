<?php
	session_start();
  	if ( empty( $_SESSION['id'] )  ) {
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
		if ( empty($data) || empty($descricao) || empty($valor) || empty($km) || $tipo == 'null' ) {
			$_SESSION['msg_cadastro'] = '<div class="col-lg-12 alert alert-warning">Por favor preencha todos os campos para prosseguir.</div>';
		} else {
			$cadastrar = "INSERT INTO cadastros (`data`, `descricao`, `valor`, `km`, `tipo`) VALUES ('$data', '$descricao', '$valor', '$km', '$tipo')";
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
	                    Cadastro <small>de novos itens</small>
	                </h1>
	                <ol class="breadcrumb">
                        <li>
                            <i class="fa fa-dashboard"></i>  <a href="index.html">Painel</a>
                        </li>
                        <li class="active">
                            <i class="fa fa-edit"></i> Cadastro
                        </li>
                    </ol>
	            </div>
	        </div>
	        <!-- /.row -->

        	
        	<?php
        	  	if (!empty($_SESSION['msg_cadastro'])) {
        	  		echo $_SESSION['msg_cadastro'];
        	  	}
        	?>

        	<div class="row">

		        <div class="col-lg-12">

	                <form role="form" action="" method="POST" enctype="multipart/form-dara">

	                    <div class="form-group">
	                        <label>Data</label>
	                        <input class="form-control" type="text" onKeyUp="formataData(this);" name="data" placeholder="Data">
	                    </div>

	                    <div class="form-group">
	                        <label>Descrição</label>
	                        <textarea class="form-control" rows="3" name="descricao" placeholder="Descrição"></textarea>
	                    </div>

	                    <div class="form-group">
	                    	<label for="valor">Valor</label>
						    <div class="input-group">
						      <div class="input-group-addon">R$</div>
						      <input type="text" name="valor" class="form-control" id="valor" placeholder="Valor">
						    </div>
	                    </div>

	                    <div class="form-group">
	                        <label>KM</label>
	                        <input class="form-control" type="number" name="km" placeholder="Kilometragem">
	                    </div>

	                    <div class="form-group">
	                        <label>Natureza do item</label>
	                        <select name="tipo" class="form-control">
	                        	<option value="null">Selecione</option>
	                            <option value="interior">Interior</option>
								<option value="lataria">Lataria</option>
								<option value="mecanica">Mecânica</option>
	                        </select>
	                    </div>

	                    <input type="submit" class="btn btn-success" name="btnCadastro" value="Cadastrar">
						<input type="hidden" name="cadastrar" value="register">
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