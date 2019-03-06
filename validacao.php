<?php

include("conexao.php");



?>


<!DOCTYPE html>
<html lang="pt">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>PDV System</title>

    <!-- Bootstrap Core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>



<?php


if (!empty($_POST) AND (empty($_POST['login']) OR empty($_POST['senha']))) {
	//header("Location: index.php"); exit;
	echo "não logou";
}

@$usuario = mysql_real_escape_string($_POST['login']);
@$senha = mysql_real_escape_string($_POST['senha']);

// Validação do usuário/senha digitados

$sql = "SELECT * FROM tbusuarios
		WHERE (tbusuarioslogin = '".$usuario."') AND (tbusuariossenha = '".sha1($senha)."') AND (tbusuariosst > 0) LIMIT 1";

$query = mysql_query($sql);

if (mysql_num_rows($query) > 0) {


	// Salva os dados encontados na variável $resultado
	$resultado = mysql_fetch_assoc($query);

	// Se a sessão não existir, inicia uma
	if (!isset($_SESSION)) session_start();

	// Salva os dados encontrados na sessão
	$_SESSION['UsuarioID'] = $resultado['idtbusuarios'];
	$_SESSION['UsuarioNome'] = $resultado['tbusuariosnome'];

	header("Location: pages/principal/index.php");  exit;

	

} else {

	// Mensagem de erro quando os dados são inválidos e/ou o usuário não foi encontrado
	
	echo 	"
	<div class='container'>
		<div class='row'>			
		  	<div class='alert alert-danger'>Hey, amigo(a).
		  	Não Encontramos seu Usuario ou Senha em nossos registros. Poderia verificar se está correto e tentar novamente?
		  	</div>
		 	<br /><br />
	      
	      	<a href='index.html' class='btn btn-primary btn-success btn-block'>Voltar</a>
	    </div>
	</div>
	";


}


?>


    <!-- jQuery -->
    <script src="vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="vendor/metisMenu/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="dist/js/sb-admin-2.js"></script>

</body>

</html>
