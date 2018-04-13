<?php
	session_start();
  	if ( empty( $_SESSION['id'] )  ) {
  		$_SESSION['msg'] = "Área restrita";
  		header("Location: login.php");
  	}

  	// Required Settings
  	include_once( "inc/settings.php" );

  	// ID do registro para apagar
  	$id = $_POST['id'];

	// Deleta o registro
	$query = "DELETE FROM cadastros WHERE id = " . $id;
	mysqli_query( $conexao,$query );

	echo 1;