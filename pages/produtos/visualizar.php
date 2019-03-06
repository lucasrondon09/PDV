<?php 
include ('../../ctrl_restrito_logado.php');
include("../../conexao.php");
include("../cabecalho.php");



 $query ="SELECT pd.idtbprodutos as id, pd.tbprodutoscodigo as codigo,pd.tbprodutosnome as nome, ct.tbcategoriadesc as categoria, pd.tbprodutosvenda 
						as valor FROM tbprodutos pd 
						left join tbcategoria ct on pd.tbprodutoscategoria = ct.idtbcategoria
						where pd.tbprodutosst > 0";  
 $execQuery = mysql_query($query);  


?>     

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Produtos</h1>
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
                                        <th>Código</th>
                                        <th>Nome</th>
                                        <th>Categoria</th>
                                        <th>Valor</th>
										<th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php  
									  while($row = mysql_fetch_array($execQuery))  
									  {  
									  
									  	$idproduto = $row['id'];
										$codigo = $row['codigo'];
										$nome = $row['nome'];
										$categoria = $row['categoria'];
										$valor = formatMoeda($row['valor']);
										
										   echo '  
										   <tr>  
												<td>'.$idproduto.'</td>
   											    <td>'.$codigo.'</td>
											    <td>'.$nome.'</td>
											    <td>'.$categoria.'</td>
												<td>'.$valor.'</td>
												<td width="5%">
													<a href="entrada.php?id='.$row["id"].'">
														<button type="button" class="btn btn-success center-block" 
														data-toggle="tooltip" data-placement="top" title="Entrada em Estoque">
															<span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span>
														</button>
													</a>
												</td>
												<td width="5%">
													<a href="detalhes.php?id='.$row["id"].'">
														<button type="button" class="btn btn-info center-block"
														data-toggle="tooltip" data-placement="top" title="Visualizar Produto">
															<span class="glyphicon glyphicon-eye-open " aria-hidden="true"></span>
														</button>
													</a>
												</td>
												<td width="5%">
													<a href="editar.php?id='.$row["id"].'">
														<button type="button" class="btn btn-warning center-block"
														data-toggle="tooltip" data-placement="top" title="Editar Produto">
															<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
														</button>
													</a>
												</td>
												<td width="5%">
													<a href="excluir.php?id='.$row["id"].'">
														<button type="button" class="btn btn-danger center-block"
														data-toggle="tooltip" data-placement="top" title="Excluir Produto">
															<span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
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
