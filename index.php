<html lang="en">
	<head>
		<meta charset=\"utf-8\">
		<meta name=\"viewport\" content=\"width=device-width, initial-scale=1, shrink-to-fit=no\">
		<link rel=\"stylesheet\" href=\"https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css\" integrity=\"sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO\" crossorigin=\"anonymous\">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.js"></script>
		<link rel="stylesheet" href="css/bootstrap.css">
		<script type='text/javascript' src="js/bootstrap.js"></script>
        <title>Login MUNDALUA</title>
	</head>
    <?php
        require_once('Controller/logar.php');
        login();
    ?>
	<body>
    <br><br><br><br>
	<form method="POST" action="" autocomplete="off">
		<div class="row justify-content-center align-content-center">
				<div class="form-group col-md-3 border border-dark">
					<h1>Login Mundalua</h1>
					<label>Login</label>
					<input type="text" class="form-control" id="txtlogin" name="txtlogin" aria-describedby="emailHelp" placeholder="Login">
					<small id="emailHelp" class="form-text text-muted">Por favor preencha com o login que lhe foi passado</small>
					<label>Senha</label>
					<input type="password" class="form-control" id="txtsenha" name="txtsenha" placeholder="Senha"><br>
					<button type="submit" name="btnlogar" id="btnlogar" class="btn form-control btn-outline-success">Logar</button>
                    <label></label>
				</div>
		</div>
	</form>
	</body>
</html>