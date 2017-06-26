<?php
  	$host = "localhost";
  	$user = "root";
  	$pass = "";
  	$banco = "aventuras";
  	$conexao = mysqli_connect( $host, $user, $pass ) or die( mysqli_connect_error() );
  	mysqli_select_db( $conexao, $banco ) or die( mysqli_connect_error() );
?>

<html>
	<head>
		<title>Autenticando usuário</title>
		<script type="text/javascript">
			function loginsuccessfully() {
				setTimeout("window.location='painel.php'", 5000);
			}
			function loginfailed() {
				setTimeout("window.location='login.php'", 5000);
			}
		</script>
	</head>
	<body>
		<?php
		  	$email = $_POST['email'];
		  	$senha = $_POST['senha'];
		  	$sql = mysqli_query( $conexao, "SELECT * FROM usuarios WHERE login = '$email' and senha = '$senha'" ) or die( mysqli_connect_error() );
		  	$row = mysqli_num_rows( $sql );
		  	if ( $row > 0 ) {
				session_start();
				$_SESSION['email'] = $_POST['email'];
				$_SESSION['senha'] = $_POST['senha'];
				echo "Logado com sucesso! Aguarde um instante...";
				echo "<script>loginsuccessfully()</script>";
		  	} else {
		  		echo "Nome de usuário inválidos. Tente novamente.";
		  		echo "<script>loginfailed()</script>";
		  	}
		?>
	</body>
</html>