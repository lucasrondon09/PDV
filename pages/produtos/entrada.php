<?php 
include ('../../ctrl_restrito_logado.php');
include('../cabecalho.php');
include('../../conexao.php');


$id = $_GET["id"];
$query = mysql_query("	select  pr.*, ct.idtbcategoria, ct.tbcategoriadesc from tbprodutos pr
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
                    Entrada do Produto no Estoque
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <form role="form" method="post" action="entrada_action.php">
                                <div class="form-group">
                               		<label>Id</label>
                                    <p class="form-control-static"><?php echo($row["idtbprodutos"]);?></p>
                                    <input class="form-control" id="id"  name="id" type="hidden" value="<?php echo($row["idtbprodutos"]);?>">   
                                </div>
                                <div class="form-group">
                                	<label>Nome</label>
									<p class="form-control-static"><?php echo($row["tbprodutosnome"]);?></p>
                                </div>
                                <div class="form-group">
                                	<label>Código</label>
                                    <p class="form-control-static"><?php echo($row["tbprodutoscodigo"]);?></p>
                                </div>
								<div class="form-group">
                                	<label>Estoque Atual</label>
									<p class="form-control-static"><?php echo($row["tbprodutosestoque"]);?></p>
                                </div>
                                <div class="form-group">
									<label for="tipo">Tipo</label>
									<select id="tipo" name="tipo" class="form-control">
										<option value="1" selected="selected">Adicionar</option>
										<option value="0">Remover</option>     
									</select>
                              	</div>
                                <div class="form-group">
                                	<label>Quantidade</label>
                                    <input class="form-control" id="entrada"  name="entrada" type="number" required>
                                </div>
                                <a class="btn btn-primary" href="visualizar.php">Voltar</a>
                                <input class="btn btn-primary" type="submit" value="Salvar">   
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

<script>

	$('#custo,#venda').priceFormat({
		prefix: 'R$ ',
		centsSeparator: ',',
		thousandsSeparator: '.'
	});

</script>

