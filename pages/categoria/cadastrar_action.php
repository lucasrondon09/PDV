<?php 
include ('../../ctrl_restrito_logado.php');
include '../../conexao.php';
include('../cabecalho.php');

$desc = $_POST['descricao'];

$nomeigual = "select idtbcategoria as id from tbcategoria where tbcategoriadesc = ('$desc') and tbcategoriast > 0;";
$querynomeigual = mysql_query($nomeigual);
$countquerynomeigual = mysql_num_rows($querynomeigual);

if($countquerynomeigual > 0){


$mensagem = "<div class='alert alert-warning' role='alert'><b>Erro!</b> Já existe uma Categoria com este nome.</div>";
$voltar = '<input type="button" class="btn btn-primary" onClick="JavaScript: window.history.back();" value="Voltar"/>';

}else{
		
		$insertsql = mysql_query("insert into tbcategoria (tbcategoriadesc, tbcategoriast) values ('$desc',1);");
		$voltar = '<a type="button" href="visualizar.php" class="btn btn-primary">Voltar</a>';
		
		if($insertsql){
			$mensagem = "<div class='alert alert-success' role='alert'><b>Tudo certo!</b> O produto foi inserido com sucesso.</div>";
			
			
			}else{
				
				$mensagem = "<div class='alert alert-warning' role='alert'><b>Não foi possível cadastrar a Categoria. Por favor, verifique!</div>";
				
				
				
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
