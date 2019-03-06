<script>
	document.getElementById('sub').value = document.getElementById('vlr').value
	function subtotal(){
		
		var subqtd = document.getElementById('qtd').value;
		var subvlr = document.getElementById('vlr').value;
		var subdesc = document.getElementById('desc').value;
		
		var subvlr_new = subvlr.replace(/[\,\.\R$ ]/g , "");
		var subdesc_new = subdesc.replace(/[\,\.\R$ ]/g , "");
		
		document.getElementById('sub').value = (subqtd * subvlr_new) - subdesc_new;
		
		
		$('#sub').priceFormat({
		prefix: 'R$ ',
		centsSeparator: ',',
		thousandsSeparator: '.'
		});
		
		}
	

  

	
</script> 

<?php 
include ('../../ctrl_restrito_logado.php');
include('../../conexao.php');
include('../cabecalho.php');



@$prodcod = $_POST['produtoid'];
$mensagem = NULL;


if(!empty($prodcod)){
	$idprod = NULL;	
	$sql_prod = mysql_query("select idtbprodutos as idprod, tbprodutosnome as prodnome, tbprodutosvenda as prodvenda, tbprodutosestoque as prodestoque 
								from tbprodutos where tbprodutoscodigo = '$prodcod';");

	$sql_prod_rows = mysql_num_rows($sql_prod);
	
	if($sql_prod_rows > 0 ){
		
			while($res_prod = mysql_fetch_array($sql_prod)){
				
				$idproduto = $res_prod['idprod'];
				$nomeproduto = $res_prod['prodnome'];
				$vlrvendaproduto = formatMoeda($res_prod['prodvenda']);
				$estoqueproduto = $res_prod['prodestoque'];
				}
		
		}else{
			
			$mensagem = "<div class='alert alert-warning' role='alert'><b>Erro!</b> Não foi possível localizar o produto!</div>";
			
			}
	
	
	
}
	
@$idprod = $_POST['id'];
@$qtd = $_POST['qtd'];
@$desc = formatFloat($_POST['desc']);
@$subtotal = formatFloat($_POST['sub']);


@$deletar = $_GET['del_id'];	

if(!empty($deletar)){
	
	$delEst = mysql_query("select tbprevendaproduto as prod, tbprevendaquantidade as qtd from tbprevenda where idtbprevenda = ".$deletar.";");
	$qtdPre = mysql_fetch_array($delEst);
	$idProdPreven = $qtdPre['prod'];
	$retEst = $qtdPre['qtd'];
	$retEstAtual += $retEst;
	
	$queryRetEstoque = mysql_query("update tbprodutos set tbprodutosestoque = ".$retEstAtual." where idtbprodutos = ".$idProdPreven."");
	
	
	$sql_del = mysql_query("delete from tbprevenda where idtbprevenda = $deletar;");
	
	if(!$sql_del || !$delEst){
		$msg2 = "<div class='alert alert-warning' role='alert'><b>Erro!</b>Não foi possível excluir o registro, verifique!</div>";
		}
$idprod = NULL;		
		
}


if(!empty($idprod)){
	//Verifica se tem estoque do produto
	$verifEst = mysql_query("select idtbprodutos as idProd, tbprodutosestoque as estoque from tbprodutos where idtbprodutos = ".$idprod." and tbprodutosestoque > 0;");
	$verifEstRow = mysql_num_rows($verifEst);
	$estoqueRes = mysql_fetch_array($verifEst);
	$estoque = $estoqueRes['estoque']; //$qtd
	
	if($verifEstRow > 0 && $qtd <= $estoque){
		
		
		$insertsql = mysql_query("insert into tbprevenda (tbprevendaproduto, tbprevendaquantidade, tbprevendadesconto) 
									values ($idprod, $qtd, $desc);");
									
		$queryProd = mysql_query("select tbprodutosestoque as estoque from tbprodutos where idtbprodutos = ".$idprod.";");	
		$qtdDisp = mysql_fetch_array($queryProd);
		$qtdAtual = $qtdDisp['estoque'] - $qtd;
		
		$atualizaEst = mysql_query("update tbprodutos set tbprodutosestoque = ".$qtdAtual." where idtbprodutos = ".$idprod."");
									
		$idprod = NULL;		
									
		if(!$insertsql || !$atualizaEst || !empty($idprod)){
				$mensagem = "<div class='alert alert-warning' role='alert'><b>Erro!</b> Houve um problema com o cadastro, verifique!</div>";
				
			}								
	
	
	}else{
			$mensagem = "<div class='alert alert-warning' role='alert'><b>Erro!</b> Não há estoque disponível para o produto selecionado!</div>";
	}

}
		
	
	
	

	

?>



<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Vendas</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-info">
                <div class="panel-heading">
                    Cadastrar Nova Venda
                </div>
                <div class="panel-body">
                <?php echo $mensagem;?>
					<form  role='form' class="form-horizontal" method="post" action="cadastrar.php">	
                                <div class="form-group">
									<div class="col-sm-3">
                                        <div class="input-group">
                                          <input class="form-control" name="produtoid" id= "produtoid" placeholder="Código">
                                          
                                          <span class="input-group-btn">
                                            <button class="btn btn-outline btn-warning" data-toggle="modal" data-target="#produto" type="button">
                                                Pesquisar
                                            </button>
                                            <input class="btn btn-outline btn-info" type="submit" value="Inserir">
                                            
                                          </span>
                                    	</div>
                                 	</div>
                                    
                                    <p class="col-sm-9 form-control-static" name="produtonome"><?php echo @$nomeproduto;?></p>
                                 </div>
                             </form>   
                                                   
                             <form class="form-inline" method="post" action="cadastrar.php">
                             	<input class="form-control" id="id" name="id" type="hidden" value="<?php echo $idproduto;?>">
                                  <div class="form-group">
                                    <label for="Quantidade">Quantidade</label>
                                    <input class="form-control" id="qtd" name="qtd" type="text" value="1" onblur="subtotal()">
                                  </div>
                                  <div class="form-group">
                                    <label for="Unitário">Valor</label>
                                    <input class="form-control dinheiro" id="vlr" name="vlw" type="text" value="<?php echo @$vlrvendaproduto;?>" disabled>
                                  </div>
                                  <div class="form-group">
                                    <label for="Desconto">Desconto</label>
                                    <input class="form-control dinheiro" id="desc" name="desc" type="text" value="0" onblur="subtotal()">
                                  </div>
                                  <div class="form-group">
                                    <label for="Subtotal">Subtotal</label>
                                    <input class="dinheiro form-control" id="sub" name="sub" value="<?php echo @$vlrvendaproduto;?>" type="text" disabled="disabled">
                                  </div>
                                  <input class="btn btn-success" type="submit" value="Adicionar Item">
								 
                            </form>
                </div>
           	</div>
         </div>
    </div>
    <div id="item">
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        Itens
                    </div>
                    <div class="panel-body">
                        <form method="post" action="cadastrar_action.php">
                                <div class="form-group">
                                    <label for="pagamento">Forma de Pagamento</label>
                                    <select id="pagamento" name="pagamento" class="form-control">
                                    <option value="" selected="selected">Selecione</option>
                                            <?php
                                                $sqlListaPagamento = "SELECT * FROM tbformapagamento ORDER BY idtbformapagamento ASC";
                                                $exeListaPagamento = mysql_query($sqlListaPagamento) or die("Erro [sqlListaPagamento]: ".mysql_error());
                                                
                                                while($verListaPagamento = mysql_fetch_array($exeListaPagamento)){
                                            ?>            
                                            <option value="<?php echo  $verListaPagamento['idtbformapagamento']; ?>">
                                            <?php echo $verListaPagamento['tbformapagamentodescricao']; ?></option>
                                            <?php
                                                }
                                            ?>
                                        </select>
                                </div>
								<div class="table-responsive">
                                	<table class="table table-responsive table-bordered " width="100%" cellspacing="0" >
                                <thead>
                                <tr>
                                  <th>Cód.</th>
                                  <th>Produto</th>
                                  <th>Qtd</th>
                                  <th>Vlr. Unitário</th>
                                  <th>Desconto</th>
                                  <th>Total</th>
                                  <th>Excluir</th>
                                </tr>
                                </thead>          
                                <tbody>
                                <?php
                                
                                $sql_prevenda = mysql_query("select pv.idtbprevenda as idpv, pv.tbprevendaproduto as idprod, pv.tbprevendaquantidade as pvqtd,
                                                                pv.tbprevendadesconto as pvdesc, pr.tbprodutoscodigo as prcod,
                                                                pr.tbprodutosnome as prnome, pr.tbprodutosvenda as prvenda
                                                                from tbprevenda as pv left join tbprodutos pr
                                                                on pv.tbprevendaproduto = pr.idtbprodutos
                                                                ");
                                
                                $sql_prevenda_rows = mysql_num_rows($sql_prevenda);
                                
                                if($sql_prevenda_rows > 0){
                                    
                                    while($resultado = mysql_fetch_array($sql_prevenda)){
                                
                                    $preven_cod = $resultado['prcod'];
                                    $id_preven = $resultado['idpv'];
                                    $preven_idprod = $resultado['idprod'];
                                    $preven_qtd = $resultado['pvqtd'];
                                    $preven_desc = formatMoeda($resultado['pvdesc']);
									$preven_desc_tot = $resultado['pvdesc'];
                                    $preven_nome = $resultado['prnome'];
                                    $preven_vlr = formatMoeda($resultado['prvenda']);
									$preven_vlr_tot = $resultado['prvenda'];
                                    
                                    @$vlr_sub = $preven_vlr_tot * $preven_qtd;
                                    @$sum_sub += $vlr_sub;
                                    @$sum_desc += $preven_desc_tot;
                                    @$sum_total = $sum_sub-$sum_desc;
									@$sum_sub_tot = formatMoeda($sum_sub);
									@$sum_desc_tot = formatMoeda($sum_desc);
									@$sum_total_tot = formatMoeda($sum_total);
                                    
                                    $preven_sub = formatMoeda(($preven_vlr_tot*$preven_qtd)-$preven_desc_tot);
                                
                                echo "
                                <tr>
                                  <td>$preven_cod</td>
                                  <td>$preven_nome</td>
                                  <td>$preven_qtd</td>
                                  <td>$preven_vlr</td>
                                  <td>$preven_desc</td>
                                  <td>$preven_sub</td>
                                  <td><a href='cadastrar.php?del_id=$id_preven'><div align='center'>
                                  <button type='button' class='btn btn-danger'><span class='fa fa-times' aria-hidden='true'></span></button></div></a></td>
                                </tr>";
                                
                                    }
                                    
                                }
                                ?>
                                </tbody>
                                </table>
                                </div>
                                <div class="row">
                                  <div class="col-sm-4">
                                    <label for="Total_descontos_form">Total sem descontos</label>
                                    <input class="form-control" id="subtotal" name="subtotal" type="text" value="<?php echo @$sum_sub_tot;?>" disabled="disabled">
                                  </div>
                                  <div class="col-sm-4">
                                    <label for="descontos_form">Descontos</label>
                                    <input class="form-control" id="descontos" name="descontos" type="text" value="<?php echo @$sum_desc_tot;?>" disabled>
                                  </div>
                                  <div class="col-sm-4">
                                    <label for="Total">Total</label>
                                    <input class="form-control" id="total" name="total" type="text" value="<?php echo @$sum_total_tot;?>" disabled>
                                  </div>
                                </div>
                                <br /><br />
                                <div class="pull-right">
                                <a href="excluiritens.php" class="btn btn-danger btn-lg">Cancelar</a>
                                <input class="btn btn-primary btn-lg" type="submit" value="Finalizar">
                                </div>
                                </form>                             
                    </div>
                </div>
                
            <div class="modal fade" id="produto" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
              <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Pesquisar Produto</h4>
                  </div>
                  <div class="modal-body">
                    <h5>Informe o nome do Produto</h5>
                        
                            <div class="input-group">
                                <input id="palavra" name="palavra" class="form-control" required="" type="search" autofocus>
                                <span class="input-group-btn">
                                <button class="btn btn-default" type="button" id="buscar" onclick="execBuscar()">Buscar</button>
                                </span>
                            </div>
                        <!--script para buscar Cursos-->      
                                   
                        <script type="text/javascript">
                            function buscar(palavra)
                            {

                                var page = "buscaproduto.php";	
                                $.ajax
                                    ({
                                        type: 'POST',
                                        dataType: 'HTML',
                                        url: page,
                                        beforeSend: function (){
                                            $("#dados").html("Carregando...");
                                            
                                            },
                                            data: {palavra: palavra},
                                            success: function(msg)
                                            {
                                                $("#dados").html(msg);
                                            }
                                    });
                            }
							 function execBuscar()
                            {
								 buscar($("#palavra").val())
								}
 	
            
                            function insert(id, produto){
    
                                    document.getElementById('produtoid').value = id;
                                    $("#produtonome").html(produto);
                                    $("#produtonome2").val(produto);
                    
                            }
                        
                        
                            function pesq_id(produtoid){
            
                                    var page = "buscaproduto.php";	
                                    $.ajax
                                        ({
                                            type: 'POST',
                                            dataType: 'HTML',
                                            url: page,
                                            data: {produtoid: produtoid},
                                                success: function passarnome(msg)
                                                {	
                                                        
                                                    $("#produtonome").html(msg);
                                                    $("#produtonome2").val(msg);
                                                                                                                                            
                                                }
                                        });
                            }
                            
                            
                            function setarnome(){
                                pesq_id($("#produtoid").val())
                                
                            }					
							
                        </script>
                        
                    <br />
                    <div id="dados"></div><!--Apresenta tabela de dados-->    
                    
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                  </div>
                </div>
              </div>
            </div>
             </div>
        </div>
        <div id="item"></div> 
    </div>
</div>
  

    
    
<?php

include("../rodape.php");

?>

<script>

		
	$('#desc').priceFormat({
		prefix: 'R$ ',
		centsSeparator: ',',
		thousandsSeparator: '.'
	});
	

  
</script>