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
                    Editar Produto
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <form role="form" method="post" action="editar_action.php">
                                <div class="form-group">
                               		<label>Id</label>
                                    <p class="form-control-static"><?php echo($row["idtbprodutos"]);?></p>
                                    <input class="form-control" id="id"  name="id" type="hidden" value="<?php echo($row["idtbprodutos"]);?>">   
                                </div>
                                <div class="form-group">
                                	<label>Nome</label>
                                    <input class="form-control" id="nome"  name="nome" type="text" value="<?php echo($row["tbprodutosnome"]);?>">
                                </div>
                                <div class="form-group">
                                	<label>Código</label>
                                    <input class="form-control" id="codigo"  name="codigo" type="text" value="<?php echo($row["tbprodutoscodigo"]);?>">
                                </div>
                                <div class="form-group">
                                	<label>Descrição</label>
                                    <input class="form-control" id="descricao"  name="descricao" type="text" value="<?php echo($row["tbprodutosdescricao"]);?>">
                                </div>
                                <div class="form-group">
                                	<label>Marca</label>
                                    <input class="form-control" id="marca"  name="marca" type="text" value="<?php echo($row["tbprodutosmarca"]);?>">
                                </div>
                                <div class="form-group">
                                <label for="categoria">Categoria</label>
                                <select id="categoria" name="categoria" class="form-control">
                                <option value="" selected="selected">Selecione</option>
                                        <?php
                                            $sqlListaCategoria = "SELECT * FROM tbcategoria where tbcategoriast > 0 ORDER BY tbcategoriadesc ASC";
                                            $exeListaCategoria = mysql_query($sqlListaCategoria) or die("Erro [sqlListaCategorias]: ".mysql_error());
                                            
                                            while($verListaCategoria = mysql_fetch_array($exeListaCategoria)){
                                        ?>            
                                        <option value="<?php echo  $verListaCategoria['idtbcategoria']?>"
										<?php  echo selected($verListaCategoria['idtbcategoria'], $row["idtbcategoria"] ); ?>>
                                        <?php echo $verListaCategoria['tbcategoriadesc']; ?>
                                        </option>
                                        <?php
                                            }
                                        ?>
                                    </select>
                              </div>
                                <div class="form-group">
                                	<label>Custo</label>
                                    <input class="form-control" id="custo"  name="custo" type="text" value="<?php echo('R$ '.number_format($row["tbprodutoscusto"], 2, ',', '.'));?>">
                                </div>
                                 <div class="form-group">
                                	<label>Venda</label>
                                    <input class="form-control" id="venda"  name="venda" type="text" value="<?php echo('R$ '.number_format($row["tbprodutosvenda"], 2, ',', '.'));?>">
                                </div>
                                 <div class="form-group">
                                	<label>Estoque</label>
									 <p class="form-control-static"><?php echo($row["tbprodutosestoque"]);?></p>
                                </div>
                                <a class="btn btn-primary" href="visualizar.php" >Voltar</a>
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

