<?php
	// Funções do Sistema

	function get_header( $file = 'header' ) {
		if ( $file == 'header' ) {
			$file = 'header.php';
		} else {
			$file = $file . '.php';
		}
		if ( file_exists( $file ) ) {
			include_once( $file );
		} else {
			return;
		}		
	}

	function get_document_title() {
		global $document_title;
		echo $document_title;
	}

	function get_option( $value ) {
		global $conexao;
		
		// SQL
		$result = mysqli_query( $conexao, "SELECT `$value` FROM `configuracoes` WHERE id = 1" );

		// If the query completed without errors, fetch a result
		if ( $result ) {
		  $row = mysqli_fetch_assoc( $result );
		  return $row[ $value ];
		}
		// Otherwise display the error
		else return "An error occurred: " . mysqli_error( $conexao );
	}