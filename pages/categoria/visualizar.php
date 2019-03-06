<?php 
include ('../../ctrl_restrito_logado.php');
include("../../conexao.php");
include("../cabecalho.php");


 $query ="SELECT idtbcategoria as id, tbcategoriadesc as descricao FROM tbcategoria where tbcategoriast > 0";  
 $result = mysql_query($query);  


?>     

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Categorias</h1>
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
                                        <th>Descrição</th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php  
									  while($row = mysql_fetch_array($result))  
									  {  
										   echo '  
										   <tr>  
												<td>'.$row["id"].'</td>  
												<td>'.$row["descricao"].'</td>
												<td width="5%">
													<a href="detalhes.php?id='.$row["id"].'">
														<button type="button" class="btn btn-info center-block"
														data-toggle="tooltip" data-placement="top" title="Visualizar Categoria">
															<span class="glyphicon glyphicon-eye-open " aria-hidden="true"></span>
														</button>
													</a>
												</td>
												<td width="5%">
													<a href="editar.php?id='.$row["id"].'">
														<button type="button" class="btn btn-warning center-block"
														data-toggle="tooltip" data-placement="top" title="Editar Categoria">
															<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
														</button>
													</a>
												</td>
												<td width="5%">
													<a href="excluir.php?id='.$row["id"].'">
														<button type="button" class="btn btn-danger center-block"
														data-toggle="tooltip" data-placement="top" title="Excluir Categoria">
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
