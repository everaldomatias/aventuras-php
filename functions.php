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
		//$sql = "SELECT $value FROM `configuracoes` WHERE $value = 1";
		$sql = "SELECT * FROM `configuracoes` WHERE `$value` = 1";
		$query = $conexao->query( $sql );
		$query = $conexao->mysqli_fetch_field_direct( 1 );
		
		var_dump($query);
	}