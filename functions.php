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