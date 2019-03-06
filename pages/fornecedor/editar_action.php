<?php 
include ('../../ctrl_restrito_logado.php');
include '../../conexao.php';
include('../cabecalho.php');

$id = $_POST["id"];
$nome = $_POST["nome"];
$razao = $_POST["razao"];
$site = $_POST["site"];
$tipo = $_POST["tipo"];
$cnpj = limpaCPF_CNPJ($_POST["cnpj"]);
$tel1 = limpaTel($_POST["tel1"]);
$tel2 = limpaTel($_POST["tel2"]);
$email1 = $_POST["email1"];
$email2 = $_POST["email2"];
$cep = limpaCEP($_POST["cep"]);
$endereco = $_POST["endereco"];

$query = mysql_query("SELECT * FROM tbpessoas where idtbpessoas = '".$id."';");

if($query > 0){
	
	$queryInsert = mysql_query('update tbpessoas set tbpessoastipo ='.$tipo.', tbpessoasnome="'.$nome.'", tbpessoasrazao="'.$razao.'",tbpessoascpfcnpj ="'.$cnpj.'", tbpessoassite ="'.$site.'",tbpessoastel1 ="'.$tel1.'", tbpessoastel2 ="'.$tel2.'", tbpessoasemail1 ="'.$email1.'", tbpessoasemail2 ="'.$email2.'", tbpessoasendereco ="'.$endereco.'", tbpessoascep ="'.$cep.'" where idtbpessoas = '.$id.';');
	
	if($queryInsert){
		
		$mensagem = "<div class='alert alert-success' role='alert'><b>Tudo certo!</b> O registro foi alterado com sucesso.</div>";
		$voltar = '<a type="button" href="visualizar.php" class="btn btn-primary">Voltar</a>';
		
		}else{
			
			$mensagem = "<div class='alert alert-danger' role='alert'><b>Não foi possível alterar o registro. Por favor, verifique!</div>";
			$voltar = '<input type="button" class="btn btn-primary" onClick="JavaScript: window.history.back();" value="Voltar"/>';
		}
			
}


?>  
    
    <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Mensagem</h1>
                        <p><?php echo $mensagem;?></p>
         				<?php echo $voltar;?>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->

<?php

include("../rodape.php");

?>
