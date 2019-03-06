<?php 
include ('../../ctrl_restrito_logado.php');
include ('../../conexao.php');
include('../cabecalho.php');

$id = $_POST["id"];

$query = mysql_query("select idtbcategoria as idcat, tbcategoriadesc as descricao from tbcategoria where idtbcategoria = '$id';");

if($query > 0){
	
	$queryDelete = mysql_query('update tbcategoria set tbcategoriast = 0 where idtbcategoria = '.$id.';');
	
	if($queryDelete){
		
		$mensagem = "<div class='alert alert-success' role='alert'><b>Tudo certo!</b> O registro foi excluído com sucesso.</div>";
		$voltar = '<a type="button" href="visualizar.php" class="btn btn-primary">Voltar</a>';
		
		}else{
			
			$mensagem = "<div class='alert alert-danger' role='alert'><b>Não foi possível excluir o registro. Por favor, verifique!</div>";
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
