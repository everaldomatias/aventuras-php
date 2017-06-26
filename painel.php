<?php
  	$host = "localhost";
  	$user = "root";
  	$pass = "";
  	$banco = "aventuras";
  	$conexao = mysqli_connect( $host, $user, $pass ) or die( mysqli_connect_error() );
  	mysqli_select_db( $conexao, $banco ) or die( mysqli_connect_error() );
?>
<?php
  	session_start();
  	if ( !isset( $_SESSION["email"] ) || !isset( $_SESSION["senha"] ) ) {
  		header("Location: login.php");
  		exit;
  	} else {
  		echo "Seja bem vindo!";
  	}
?>
<html>
	<head>
		<title>Painel Administrativo</title>
	</head>
	<body>
		<a href="logout.php">Logout</a>
	</body>
</html>