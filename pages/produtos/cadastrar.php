<?php 
include ('../../ctrl_restrito_logado.php');
include('../../conexao.php');
include('../cabecalho.php');

?>



<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Produtos</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Cadastrar Novo Produto
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <form role="form" method="post" action="cadastrar_action.php">
                              <div class="form-group">
                                <label for="nome">Nome do Produto</label>
                                <input class="form-control" id="nome" name="nome" type="text" >
                              </div>
                              <div class="form-group">
                                <label for="nome">Código</label>
                                <input class="form-control" id="cod" name="cod" type="text" >
                              </div>
                              <div class="form-group">
                                <label for="descricao">Descrição</label>
                                <input class="form-control" id="descricao" name="descricao" type="text" >
                              </div>
                              <div class="form-group">
                                <label for="marca">Marca</label>
                                <input class="form-control" id="marca" name="marca" type="text" >
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
                                        <option value="<?php echo  $verListaCategoria['idtbcategoria']; ?>">
                                        <?php echo $verListaCategoria['tbcategoriadesc']; ?></option>
                                        <?php
                                            }
                                        ?>
                                    </select>
                              </div>
                              <div class="form-group">
                                <label for="custo">Valor de Custo</label>
                                <input class="form-control" id="custo" name="custo" type="text" >
                              </div>
                              <div class="form-group">
                                <label for="venda">Valor de Venda</label>
                                <input class="form-control" id="venda" name="venda" type="text" >
                              </div>
                              <div class="form-group">
                                <label for="venda">Estoque</label>
                                <input class="form-control" id="estoque" name="estoque" type="text" >
                              </div>
                                <a class="btn btn-primary" href="visualizar.php" >Voltar</a>
                                <input class="btn btn-primary" type="submit" value="Cadastrar"> 
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