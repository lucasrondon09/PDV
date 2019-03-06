<?php 
include ('../../ctrl_restrito_logado.php');
include("../../conexao.php");
include("../cabecalho.php");


 $query ="SELECT * FROM tbformapagamento where tbformapagamentost > 0";  
 $result = mysql_query($query);  


?>     

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Forma de Pagamento</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <div class="row">
            	<div class="col-lg-12">
            		<a href="../formapagamento/cadastrar.php" class="btn btn-primary">Cadastrar</a>
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
                                        <th>Descrição</th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php  
									  while($row = mysql_fetch_array($result)){  
									  	$id = $row["idtbformapagamento"];
										$descricao = $row["tbformapagamentodescricao"];
										   echo '  
										   <tr>  
												<td>'.$id.'</td>  
												<td>'.$descricao.'</td>
												<td width="5%">
													<a href="detalhes.php?id='.$id.'">
														<button type="button" class="btn btn-info center-block"
														data-toggle="tooltip" data-placement="top" title="Visualizar Forma Pag.">
															<span class="glyphicon glyphicon-eye-open " aria-hidden="true"></span>
														</button>
													</a>
												</td>
												<td width="5%">
													<a href="editar.php?id='.$id.'">
														<button type="button" class="btn btn-warning center-block"
														data-toggle="tooltip" data-placement="top" title="Editar Forma Pag.">
															<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
														</button>
													</a>
												</td>
												<td width="5%">
													<a href="excluir.php?id='.$id.'">
														<button type="button" class="btn btn-danger center-block"
														data-toggle="tooltip" data-placement="top" title="Excluir Forma Pag.">
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
