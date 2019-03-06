<?php 
include ('../../ctrl_restrito_logado.php');
include '../../conexao.php';
include('../cabecalho.php');

$id = $_POST['id'];
$nome = $_POST['nome'];
$descricao = $_POST['descricao'];
$marca = $_POST['marca'];
$categoria = $_POST['categoria'];
$custo = formatFloat($_POST['custo']);
$venda = formatFloat($_POST['venda']);
$codigo = $_POST['codigo'];

$query = mysql_query("select idtbprodutos from tbprodutos where idtbprodutos = '$id';");

if($query > 0){
	
	$queryInsert = mysql_query("update tbprodutos set tbprodutosnome = '".$nome."', tbprodutosdescricao = '".$descricao."', 
								tbprodutoscodigo = '".$codigo."', tbprodutosmarca = '".$marca."', tbprodutoscategoria = ".$categoria.",
								tbprodutoscusto = ".$custo.", tbprodutosvenda = ".$venda." where idtbprodutos = ".$id.";");
	
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
