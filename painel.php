<?php
	/* Connect and Configs */
	include_once ( 'inc/config.php' );
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