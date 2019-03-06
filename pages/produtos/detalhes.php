<?php 
include ('../../ctrl_restrito_logado.php');
include('../cabecalho.php');
include('../../conexao.php');


$id = $_GET["id"];
$query = mysql_query("	select  pr.*, ct.tbcategoriadesc from tbprodutos pr
						left join tbcategoria ct on
						pr.tbprodutoscategoria = ct.idtbcategoria where idtbprodutos = '$id';");


$row = mysql_fetch_array($query);


?>



<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Produto</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Detalhes do Produto
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <form role="form" method="post" action="editar_action.php">
                                <div class="form-group">
                               		<label>Id</label>
                                    <p class="form-control-static"><?php echo($row["idtbprodutos"]);?></p>
                                    <input class="form-control" id="id"  name="id" type="hidden" value="<?php echo($row["idcat"]);?>">
                                    <label>Nome</label>
                                    <p class="form-control-static"><?php echo($row["tbprodutosnome"]);?></p>
                                    <label>Código</label>
                                    <p class="form-control-static"><?php echo($row["tbprodutoscodigo"]);?></p>
                                    <label>Descrição</label>
                                    <p class="form-control-static"><?php echo($row["tbprodutosdescricao"]);?></p>
                                    <label>Marca</label>
                                    <p class="form-control-static"><?php echo($row["tbprodutosmarca"]);?></p>
                                    <label>Categoria</label>
                                    <p class="form-control-static"><?php echo($row["tbcategoriadesc"]);?></p>
                                    <label>Custo</label>
                                    <p class="form-control-static"><?php echo('R$ '.number_format($row["tbprodutoscusto"], 2, ',', '.'));?></p>
                                    <label>Venda</label>
                                    <p class="form-control-static"><?php echo('R$ '.number_format($row["tbprodutosvenda"], 2, ',', '.'));?></p>
                                    <label>Estoque</label>
                                    <p class="form-control-static"><?php echo($row["tbprodutosestoque"]);?></p>
                                </div>
                                <a href="visualizar.php" class="btn btn-primary">Voltar</a> 
                             </form>    
						</div>
                    </div>
                </div>
           	</div>
         </div>
    </div>
</div>
  

    
    
<?php

include("../rodape.php");

?>
