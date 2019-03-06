<?php 
include ('../../ctrl_restrito_logado.php');
include '../../conexao.php';
include('../cabecalho.php');

$nome = $_POST['nome'];
$descricao = $_POST['descricao'];
$marca = $_POST['marca'];
$categoria = $_POST['categoria'];
$custo = formatFloat($_POST['custo']);
$venda = formatFloat($_POST['venda']);
$estoque = $_POST['estoque'];
$codigo = $_POST['cod'];




$nomeigual = "select idtbprodutos as id from tbprodutos where tbprodutosnome = ('$nome') or tbprodutoscodigo = ('$codigo') and tbprodutosst > 0;";
$querynomeigual = mysql_query($nomeigual);
$countquerynomeigual = mysql_num_rows($querynomeigual);

if($countquerynomeigual > 0){


$mensagem = "<div class='alert alert-warning' role='alert'><b>Erro!</b> Já existe um Produto com este nome.</div>";
$voltar = '<input type="button" class="btn btn-primary" onClick="JavaScript: window.history.back();" value="Voltar"/>';

}else{
		
		$insertsql = mysql_query("insert into tbprodutos (tbprodutosnome, tbprodutosdescricao, tbprodutosmarca, 
									tbprodutoscategoria, tbprodutoscusto, tbprodutosvenda, tbprodutosestoque, tbprodutoscodigo, tbprodutosst) 
									values ('$nome', '$descricao', '$marca', $categoria, $custo, $venda, $estoque, '$codigo',1);");

		$voltar = '<a type="button" href="visualizar.php" class="btn btn-primary">Voltar</a>';
		
		if($insertsql){
			$mensagem = "<div class='alert alert-success' role='alert'><b>Tudo certo!</b> O Produto foi inserido com sucesso.</div>";
			
			
			}else{
				
				$mensagem = "<div class='alert alert-warning' role='alert'><b>Não foi possível cadastrar o Produto. Por favor, verifique!</div>";
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
