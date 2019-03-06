<?php 
include ('../../ctrl_restrito_logado.php');
include '../../conexao.php';
include('../cabecalho.php');

$sql_itens = mysql_query("select idtbprevenda as idprevenda, tbprevendaproduto as prod, tbprevendaquantidade as qtd, 
									tbprevendadesconto as desconto from tbprevenda");

$sql_itens_rows = mysql_num_rows($sql_itens);

if($sql_itens_rows > 0){

$forma_pag = $_POST['pagamento'];
$data_atual= date('Y-m-d H:i:s');

$insertsql = mysql_query("insert into tbvenda (tbvendadata, tbvendaformapag, tbvendast) values ('".$data_atual."', ".$forma_pag.", 1);");
$id_venda =  mysql_insert_id();

if(!empty($forma_pag)){
	
	


	if($insertsql){
		
		$mensagem = "<div class='alert alert-success' role='alert'><b>Venda cadastrada com sucesso!</div>";
		$voltar = '<a type="button" href="visualizar.php" class="btn btn-primary">Voltar</a>';
		
		
			
			 while($resultado  = mysql_fetch_array($sql_itens)){
				 
				 $idprevenda = $resultado['idprevenda'];
				 $produto = $resultado['prod'];
				 $qtd = $resultado['qtd'];
				 $desconto = $resultado['desconto'];
				 
				 $sql_item = mysql_query("insert into tbvendasitem (tbvendasitemvendas, 
								tbvendasitemproduto, tbvendasitemdesconto, tbvendasitemquantidade) values(".$id_venda.",".$produto.",".$desconto.",".$qtd.");");
									
						if($sql_item){
							mysql_query("delete from tbprevenda where idtbprevenda = $idprevenda");
							
						}
			}
		
		
		
	}else{
			
			$mensagem = "<div class='alert alert-warning' role='alert'><b>Não foi possível realizar a venda. Por favor, verifique!</div>";
			$voltar = '<input type="button" class="btn btn-primary" onClick="JavaScript: window.history.back();" value="Voltar"/>';
			
	}
	
	
	
}else{
	
	$mensagem = "<div class='alert alert-warning' role='alert'><b>Por favor, informe a forma de pagamento!</div>";
	$voltar = '<input type="button" class="btn btn-primary" onClick="JavaScript: window.history.back();" value="Voltar"/>';
}
}else{
	$mensagem = "<div class='alert alert-warning' role='alert'><b>Nenhum produto foi informado!</div>";
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
