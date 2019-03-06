<?php 
include ('../../ctrl_restrito_logado.php');
include("../../conexao.php");
include("../cabecalho.php");


 $query ="select idtbvenda as idvenda, date_format(tbvendadata, '%d/%m/%Y') as datavenda, 
			(select tbformapagamentodescricao from tbformapagamento pg where pg.idtbformapagamento = vd.tbvendaformapag) as formapagamentodesc,
			tbvendaformapag as formapag, tbvendast as stvenda, sum( pr.tbprodutosvenda*it.tbvendasitemquantidade) - sum(tbvendasitemdesconto) as total
			from tbvenda vd left join tbvendasitem it on
			it.tbvendasitemvendas = vd.idtbvenda
			left join tbprodutos pr on
			it.tbvendasitemproduto = pr.idtbprodutos
			where tbvendast > 0
			group by idtbvenda
			order by tbvendadata desc;";
			  
 $execQuery = mysql_query($query);  


?>     

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Vendas</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <div class="row">
            	<div class="col-lg-12">
            		<a href="cadastrar.php" class="btn btn-primary">Cadastrar</a>
                    <br /><br />
                </div>
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Tabela de dados
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Data</th>
                                        <th>Forma de Pagamento</th>
                                        <th>Valor</th>
                                        <th></th>
										<th></th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php  
									  while($row = mysql_fetch_array($execQuery))  
									  {  
									  
									  	$idvenda = $row['idvenda'];
										$datavenda = $row['datavenda'];
										$formapag = $row['formapagamentodesc'];
										$total = formatMoeda($row['total']);
										
										   echo '  
										   <tr>  
												<td>'.$idvenda.'</td>
   											    <td>'.$datavenda.'</td>
											    <td>'.$formapag.'</td>
												<td>'.$total.'</td>
												<td width="5%">
													<a href="detalhes.php?id='.$idvenda.'">
														<button type="button" class="btn btn-info center-block" 
														data-toggle="tooltip" data-placement="top" title="Visualizar Venda">
															<span class="glyphicon glyphicon-eye-open " aria-hidden="true"></span>
														</button>
													</a>
												</td> 
												<td width="5%">
													<a href="detalhes.php?id='.$idvenda.'&estorno=1">
														<button type="button" class="btn btn-danger center-block" 
														data-toggle="tooltip" data-placement="top" title="Estornar Venda">
															<span class="glyphicon glyphicon-retweet " aria-hidden="true"></span>
														</button>
													</a>
												</td> 
										   </tr>  
										   ';  
									  }  
									?>
                                </tbody>
                            </table>
                            
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    <?php include("../rodape.php");?>
