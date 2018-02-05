<?php
  	session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="utf-8">
		<title>Aventuras - Login</title>
	</head>
	<body>
		<h2>Área restrita</h2>
		<?php
		//echo password_hash( '826414', PASSWORD_DEFAULT );
		  	if (isset( $_SESSION['msg'] ) ) {  
		  		echo $_SESSION['msg'];
		  		unset( $_SESSION['msg'] );
		  	}
		?>
		<form action="valida.php" method="POST">
			<label for="">Usuário</label>
			<input type="text" name="usuario" placeholder="Digite o seu usuário"><br><br>
			<label for="">Senha</label>
			<input type="password" name="senha" placeholder="Digite a sua senha"><br><br>

			<input type="submit" name="btnLogin" value="Acessar">
		</form>
	</body>
</html>