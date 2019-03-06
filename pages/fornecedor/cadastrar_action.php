<?php 
include ('../../ctrl_restrito_logado.php');
include '../../conexao.php';
include('../cabecalho.php');

$nome = $_POST["nome"];
$razao = $_POST["razao"];
$tipo = $_POST["tipo"];
$cnpj = limpaCPF_CNPJ($_POST["cnpj"]);
$site =  $_POST["site"];;
$tel1 = limpaTel($_POST["tel1"]);
$tel2 = limpaTel($_POST["tel2"]);
$email1 = $_POST["email1"];
$email2 = $_POST["email2"];
$cep = limpaCEP($_POST["cep"]);
$endereco = $_POST["endereco"];



$nomeigual = "select idtbpessoas as id from tbpessoas where tbppessoasnome = ('".$razao."') or tbpessoascpfcnpj = ('".$cnpj."') and tbpessoasst > 0;";
$querynomeigual = mysql_query($nomeigual);
$countquerynomeigual = mysql_num_rows($querynomeigual);

if($countquerynomeigual > 0){


$mensagem = "<div class='alert alert-warning' role='alert'><b>Erro!</b> Já existe um Fornecedor cadastrado.</div>";
$voltar = '<input type="button" class="btn btn-primary" onClick="JavaScript: window.history.back();" value="Voltar"/>';

}else{
		
		$insertsql = mysql_query("insert into tbpessoas (tbpessoastipo, tbpessoasnome, tbpessoasrazao, tbpessoassite, tbpessoascpfcnpj, 
									tbpessoastel1, tbpessoastel2, tbpessoasemail1, tbpessoasemail2, tbpessoasendereco, tbpessoascep, tbpessoasst) 
									values ('".$tipo."', '".$nome."', '".$razao."','".$site."', '".$cnpj."', '".$tel1."', '".$tel2."', '".$email1."', '".$email2."', '".$endereco."', '".$cep."',1);");		
									
	

		$voltar = '<a type="button" href="visualizar.php" class="btn btn-primary">Voltar</a>';
		
		if($insertsql){
			$mensagem = "<div class='alert alert-success' role='alert'><b>Tudo certo!</b> O Fornecedor foi inserido com sucesso.</div>";
			
			
			}else{
				
				$mensagem = "<div class='alert alert-warning' role='alert'><b>Não foi possível cadastrar o Fornecedor. Por favor, verifique!</div>";
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
						<?php echo("insert into tbpessoas (tbpessoastipo, tbpessoasnome, tbpessoasrazao, tbpessoassite, tbpessoascpfcnpj, 
									tbpessoastel1, tbpessoastel2, tbpessoasemail1, tbpessoasemail2, tbpessoasendereco, tbpessoascep, tbpessoasst) 
									values ('".$tipo."', '".$nome."', '".$razao."','".$site."', '".$cnpj."', '".$tel1."', '".$tel2."', '".$email1."', '".$email2."', '".$endereco."', '".$cep."',1);");?>

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

