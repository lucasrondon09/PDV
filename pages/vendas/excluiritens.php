<?php 
include ('../../ctrl_restrito_logado.php');
include '../../conexao.php';
include('../cabecalho.php');


$sql_itens = mysql_query("select * from tbprevenda");
$sql_itens_rows = mysql_num_rows($sql_itens);

if($sql_itens_rows > 0){
			
			 while($resultado  = mysql_fetch_array($sql_itens)){
				 
				 $idprevenda .= $resultado['idtbprevenda'].",";				 
				 $idProduto  = $resultado['tbprevendaproduto'];
				 $qtd  = $resultado['tbprevendaquantidade'];
				 
				 $queryProd = mysql_query("update tbprodutos set tbprodutosestoque = tbprodutosestoque + ".$qtd." where idtbprodutos = ".$idProduto.";");
							
			 }
					
				$idprevenda = rtrim($idprevenda,',');
				 
					$execQuery = mysql_query("delete from tbprevenda where idtbprevenda in (".$idprevenda.")");
					
					if($execQuery){
						
						$mensagem = "<div class='alert alert-success' role='alert'><b>Os itens da venda foram excluídos!</div>";
						$voltar = '<a type="button" href="cadastrar.php" class="btn btn-primary">Voltar</a>';
						
						}else{
							
							$mensagem = "<div class='alert alert-warning' role='alert'><b>Não foi possível realizar a venda. Por favor, verifique!</div>";
							$voltar = '<a type="button" href="cadastrar.php" class="btn btn-primary">Voltar</a>';
							
							}			
						
							
				//update tbprodutos set tbprodutosestoque = tbprodutosestoque + ".$quantidade." where idtbprodutos = ".$idProduto			
					
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
