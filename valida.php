<?php
	session_start();
	include_once( "inc/config.php" );
  	$btnLogin = filter_input( INPUT_POST, 'btnLogin', FILTER_SANITIZE_STRING );
  	if ( $btnLogin ) {
  		$usuario = filter_input( INPUT_POST, 'usuario', FILTER_SANITIZE_STRING );
  		$senha = filter_input( INPUT_POST, 'senha', FILTER_SANITIZE_STRING );

  		if( ( !empty( $usuario ) ) AND ( !empty( $senha ) ) ) {

  			// Gerar senha criptografada
  			//echo password_hash( $senha, PASSWORD_DEFAULT );

  			// Pesquisar o usuário no BD
  			$result_usuario = "SELECT id, nome, email, senha FROM usuarios WHERE usuario='$usuario' LIMIT 1";
  			$resultado_usuario = mysqli_query( $conexao, $result_usuario );

  			if ( $resultado_usuario ) {
  				$row_usuario = mysqli_fetch_assoc( $resultado_usuario );
  				if ( password_verify( $senha, $row_usuario['senha'] ) ) {
  					$_SESSION['id'] = $row_usuario['id'];
  					$_SESSION['nome'] = $row_usuario['nome'];
  					$_SESSION['email'] = $row_usuario['email'];
  					header("Location: cadastro.php");
  				} else {
  					$_SESSION['msg'] = "Login e/ou senha incorretos";
  					header("Location: login.php");
  				}
  			} else {
          $_SESSION['msg'] = "Dados não encontrados no banco de dados";
          header("Location: login.php");
        }

  		} else {
  			$_SESSION['msg'] = "Login e/ou senha incorretos";
  			header("Location: login.php");
  		}
  	} else {
  		$_SESSION['msg'] = "Página não encontrada";
  		header("Location: login.php");
  	}