<?php 
include ('../../ctrl_restrito_logado.php');
include '../../conexao.php';
include('../cabecalho.php');

$id = $_POST['id'];
$tipo = $_POST['tipo'];
$quantidade = $_POST['entrada'];


$query = mysql_query("select idtbprodutos as id, tbprodutosestoque as estoqueatual from tbprodutos where idtbprodutos = '$id';");
$query_rows = mysql_num_rows($query);

if($quantidade > 0){
	if($query_rows > 0){
		
		$resultado = mysql_fetch_array($query);
		$estAtual = $resultado['estoqueatual'];


		if($tipo > 0){
			$estoque = $estAtual + $quantidade;
		}else{
			$estoque = $estAtual - $quantidade;
		}

		$queryInsert = mysql_query("update tbprodutos set tbprodutosestoque = ".$estoque." where idtbprodutos = ".$id.";");

		if($queryInsert){
			$queryEntrada = mysql_query("insert into tbentrada (tbidproduto, tbmovimento, tbquantidade) values (".$id.",".$tipo.",".$quantidade.")");

			$mensagem = "<div class='alert alert-success' role='alert'><b>Tudo certo!</b> O registro foi alterado com sucesso.</div>";
			$voltar = '<a type="button" href="visualizar.php" class="btn btn-primary">Voltar</a>';

			}else{

				$mensagem = "<div class='alert alert-danger' role='alert'><b>Não foi possível alterar o registro. Por favor, verifique!</div>";
				$voltar = '<input type="button" class="btn btn-primary" onClick="JavaScript: window.history.back();" value="Voltar"/>';
			}

	}
}else{
	
	$mensagem = "<div class='alert alert-danger' role='alert'><b>Por favor, informe a Quantidade!</div>";
	$voltar = '<input type="button" class="btn btn-primary" onClick="JavaScript: window.history.back();" value="Voltar"/>';
	
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
