<?php 
include ('../../ctrl_restrito_logado.php');
include '../../conexao.php';
include('../cabecalho.php');



$id_venda = $_GET['idVenda'];

$queryVenda = mysql_query("select idtbvendasitem as idItem, tbvendasitemvendas as idVenda, tbvendasitemproduto as idProduto, tbvendasitemdesconto as desconto, tbvendasitemquantidade as quantidade from tbvendasitem where tbvendasitemvendas =".$id_venda." and tbvendasitemst > 0;");
$queryVendaRow = mysql_num_rows($queryVenda);

if($queryVendaRow > 0){
	while($resultado = mysql_fetch_array($queryVenda)){
		
		$idItem = $resultado['idItem'];
		$idVenda = $resultado['idVenda'];
		$idProduto = $resultado['idProduto'];
		$desconto = $resultado['desconto'];
		$quantidade = $resultado['quantidade'];
		
		$queryProd = mysql_query("update tbprodutos set tbprodutosestoque = tbprodutosestoque + ".$quantidade." where idtbprodutos = ".$idProduto.";");
		
	}
	
	$queryUpItem = mysql_query("update tbvendasitem set tbvendasitemst = 0 where tbvendasitemvendas = ".$idVenda.";");
	$queryUpVenda = mysql_query("update tbvenda set tbvendast = 0 where idtbvenda = ".$idVenda.";");
	
	if($queryUpItem && $queryUpVenda){
		$mensagem = "<div class='alert alert-success' role='alert'><b>Estorno de Venda realizado com sucesso!</div>";
		$voltar = '<a type="button" href="visualizar.php" class="btn btn-primary">Voltar</a>';
	}else{
		$mensagem = "<div class='alert alert-warning' role='alert'><b>Não foi possível estornar a venda! Verifique com o Administrador do Sistema</div>";
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
