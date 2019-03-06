<?php 
include ('../../ctrl_restrito_logado.php');
include('../cabecalho.php');
include('../../conexao.php');



$estorno = $_GET["estorno"];
$id = $_GET["id"];
 $query ="select idtbvenda as idvenda, date_format(tbvendadata, '%d/%m/%Y') as datavenda, 
			(select tbformapagamentodescricao from tbformapagamento pg where pg.idtbformapagamento = vd.tbvendaformapag) as formapagamentodesc,
			tbvendaformapag as formapag, tbvendast as stvenda, sum( pr.tbprodutosvenda*it.tbvendasitemquantidade) - sum(tbvendasitemdesconto) as total
			from tbvenda vd left join tbvendasitem it on
			it.tbvendasitemvendas = vd.idtbvenda
			left join tbprodutos pr on
			it.tbvendasitemproduto = pr.idtbprodutos
			where tbvendast > 0
			and vd.idtbvenda = ".$id."
			group by idtbvenda
			order by tbvendadata desc;";
			  
 $execQuery = mysql_query($query);  
 
 if($execQuery){
	$row = mysql_fetch_array($execQuery); 
	  
										  
	$idvenda = $row['idvenda'];
	$datavenda = $row['datavenda'];
	$formapag = $row['formapagamentodesc'];
	$total = formatMoeda($row['total']);
	
	}else{
		
		echo "<div class='alert alert-danger' role='alert'><b>Registro não localizado. Por favor, verifique!</div>";
		
		}



?>

<script>

function estornar(idVenda)
{

	//alert("Deseja realmente estorna esta venda?");

	var est = confirm("Deseja realmente estornar esta venda?");
	if(est == true){
	   
		location.href='estorno_action.php?idVenda='+idVenda;
	   
	   }

}
</script>


<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Venda</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Detalhes da Venda
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-4">
                                    <form class="form-horizontal">
                                      <div class="form-group">
                                        <label class="col-sm-4 control-label">Id</label>
                                        <div class="col-sm-8">
                                          <p class="form-control-static"><?php echo($idvenda);?></p>
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <label class="col-sm-4 control-label">Data</label>
                                        <div class="col-sm-8">
                                          <p class="form-control-static"><?php echo($datavenda);?></p>
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <label class="col-sm-4 control-label">Forma de Pag.</label>
                                        <div class="col-sm-8">
                                          <p class="form-control-static"><?php echo($formapag);?></p>
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <label class="col-sm-4 control-label">Total</label>
                                        <div class="col-sm-8">
                                          <p class="form-control-static"><?php echo($total);?></p>
                                        </div>
                                      </div>
                                    </form>                                	
                                <a href="visualizar.php" class="btn btn-primary">Voltar</a>
								<?php
									if($estorno > 0){
										
										echo '<input type="button" class="btn btn-danger" onclick="estornar('.$id.')" value="Estornar Venda" />';
									}
								?>
								 <p id="demo"></p>
						</div>
                        <div class="col-lg-8">
                        <table width="100%" class="table table-striped table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Código</th>
                                        <th>Produto</th>
                                        <th>Quantidade</th>
                                        <th>Desconto</th>
                                        <th>Valor Unit.</th>
										<th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php  
									
									
									 $itemQuery ="select it.idtbvendasitem as iditem, it.tbvendasitemvendas as idvenda, it.tbvendasitemproduto as idprod, 
										pr.tbprodutoscodigo as codigo ,pr.tbprodutosnome as nome, 
										it.tbvendasitemdesconto as desconto, it.tbvendasitemquantidade as qtd ,pr.tbprodutosvenda as venda, 
										(pr.tbprodutosvenda * it.tbvendasitemquantidade) - it.tbvendasitemdesconto as total 
										from tbvendasitem it 
										left join tbprodutos pr on
										idtbprodutos = tbvendasitemproduto
										where it.tbvendasitemvendas = ".$id.";";
											  
								 $resultadoItem = mysql_query($itemQuery); 
								  
									  while($rowItem = mysql_fetch_array($resultadoItem))  
									  {  
									  
									  	$codigo = $rowItem['codigo'];
										$nome = $rowItem['nome'];
										$qtd = $rowItem['qtd'];
										$desconto = formatMoeda($rowItem['desconto']);
										$venda = formatMoeda($rowItem['venda']);
										$totalItem = formatMoeda($rowItem['total']);
										
										   echo '  
										   <tr>  
												<td>'.$codigo.'</td>
   											    <td>'.$nome.'</td>
											    <td>'.$qtd.'</td>
												<td>'.$desconto.'</td>
												<td>'.$venda.'</td>
												<td>'.$totalItem.'</td>
										   </tr>  
										   ';  
									  }  
									?>
                                </tbody>
                         </table>
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
