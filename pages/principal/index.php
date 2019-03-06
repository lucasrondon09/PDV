        

<?php 



include ('../../ctrl_restrito_logado.php');

include("../cabecalho.php");

include("../../conexao.php");



$ano = date("Y");

$mesAtual = date("m");



//Gráfico Total de Vendas por Mês

$query = mysql_query("select date_format(tbvendadata, '%m') as datavenda, sum( pr.tbprodutosvenda*it.tbvendasitemquantidade) - sum(tbvendasitemdesconto) as total 

			from tbvenda vd 

			left join tbvendasitem it on it.tbvendasitemvendas = vd.idtbvenda 

			left join tbprodutos pr on it.tbvendasitemproduto = pr.idtbprodutos 

			where vd.tbvendast > 0 and date_format(vd.tbvendadata, '%Y') = ".$ano." 

			group by date_format(tbvendadata, '%m') order by vd.tbvendadata asc;");

		

$grafico = '';

	

	while($row = mysql_fetch_array($query)){						  

		$mes = $row['datavenda'];

		$total = $row['total'];

		$mes_nome = mesExtenso($mes);

		

		$grafico .= "{y: '".$mes_nome."', a:".$total."},";

		

	}

	

	$grafico = substr($grafico,0,-1);





//Gráfico Total de Vendas por Dia

$queryDia = mysql_query("select date_format(tbvendadata, '%d') as datavendadia, sum( pr.tbprodutosvenda*it.tbvendasitemquantidade) - sum(tbvendasitemdesconto) as totaldia 

			from tbvenda vd 

			left join tbvendasitem it on it.tbvendasitemvendas = vd.idtbvenda 

			left join tbprodutos pr on it.tbvendasitemproduto = pr.idtbprodutos 

			where vd.tbvendast > 0 and date_format(vd.tbvendadata, '%Y') = ".$ano." and date_format(vd.tbvendadata, '%m') = ".$mesAtual."

			group by date_format(tbvendadata, '%d') order by vd.tbvendadata asc;");

		

		



$graficoDia = '';

	

	while($rowDia = mysql_fetch_array($queryDia)){						  

		$dia = $rowDia['datavendadia'];

		$totalDia = $rowDia['totaldia'];

		

		

		$graficoDia .= "{dia: 'Dia ".$dia."', total:".$totalDia."},";

		

	}

	

	$graficoDia = substr($graficoDia,0,-1);





?>        

        <!-- Page Content -->

        <div id="page-wrapper">

            <div class="container-fluid">

                <div class="row">

                    <div class="col-lg-12">

                        <h1 class="page-header">Principal</h1>

                    </div>

                    <!-- /.col-lg-12 -->

                </div>

                <!-- /.row -->

                <div class="row">

                    <div class="col-lg-3 col-md-6">

                        <div class="panel panel-primary">

                            <div class="panel-heading">

                                <div class="row">

                                    <div class="col-xs-3">

                                        <i class="fa fa-dollar fa-5x"></i>

                                    </div>

                                    <div class="col-xs-9 text-right">

                                        <div class="huge">Vendas</div>

                                        <div>Visualizar vendas</div>

                                    </div>

                                </div>

                            </div>

                            <a href="../vendas/visualizar.php" />

                                <div class="panel-footer">

                                    <span class="pull-left">Acessar página</span>

                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>

                                    <div class="clearfix"></div>

                                </div>

                            </a>

                        </div>

                    </div>

                    <div class="col-lg-3 col-md-6">

                        <div class="panel panel-green">

                            <div class="panel-heading">

                                <div class="row">

                                    <div class="col-xs-3">

                                        <i class="fa fa-tags fa-5x"></i>

                                    </div>

                                    <div class="col-xs-9 text-right">

                                        <div class="huge">Produtos</div>

                                        <div>Cadastro de produtos</div>

                                    </div>

                                </div>

                            </div>

                            <a href="../produtos/visualizar.php" />

                                <div class="panel-footer">

                                    <span class="pull-left">Acessar página</span>

                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>

                                    <div class="clearfix"></div>

                                </div>

                            </a>

                        </div>

                    </div>

                    <div class="col-lg-3 col-md-6">

                        <div class="panel panel-yellow">

                            <div class="panel-heading">

                                <div class="row">

                                    <div class="col-xs-3">

                                        <i class="fa fa-group fa-5x"></i>

                                    </div>

                                    <div class="col-xs-9 text-right">

                                        <div class="huge">Clientes</div>

                                        <div>Clientes cadastrados</div>

                                    </div>

                                </div>

                            </div>

                            <a href="#">

                                <div class="panel-footer">

                                    <span class="pull-left">Acessar página</span>

                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>

                                    <div class="clearfix"></div>

                                </div>

                            </a>

                        </div>

                    </div>

                    <div class="col-lg-3 col-md-6">

                        <div class="panel panel-red">

                            <div class="panel-heading">

                                <div class="row">

                                    <div class="col-xs-3">

                                        <i class="fa fa-support fa-5x"></i>

                                    </div>

                                    <div class="col-xs-9 text-right">

                                        <div class="huge">Suporte</div>

                                        <div>Atendimento ao cliente</div>

                                    </div>

                                </div>

                            </div>

                            <a href="#">

                                <div class="panel-footer">

                                    <span class="pull-left">Acessar página</span>

                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>

                                    <div class="clearfix"></div>

                                </div>

                            </a>

                        </div>

                    </div>

                </div>

                <!-- /.row -->

                <div class="row">

                	<div class="col-lg-12">

                        <div class="panel panel-default">

                            <div class="panel-heading">

                                <i class="fa fa-bar-chart-o fa-fw"></i> Total de Vendas Mês      

                            </div>

                            <!-- /.panel-heading -->

                            <div class="panel-body">                                             

                                <div id="grafico-vendas"></div>  

                            </div>

                            <!-- /.panel-body -->

                        </div>

                        <!-- /.panel -->

                    </div>

					

					<div class="col-lg-12">

                    <div class="panel panel-default">

                        <div class="panel-heading">

                            Total de Vendas Dia

                        </div>

                        <!-- /.panel-heading -->

                        <div class="panel-body">

                            <div id="grafico-dia"></div>

                        </div>

                        <!-- /.panel-body -->

                    </div>

                    <!-- /.panel -->

                </div>

                </div>

            </div>

            <!-- /.container-fluid -->

        </div>

        <!-- /#page-wrapper -->

        

<?php include("../rodape.php");?>        



<script>



Morris.Bar({

        element: 'grafico-vendas',

        data: [<?php echo $grafico;?>],

        xkey: 'y',

        ykeys: ['a'],

        labels: ['Total de Vendas'],

        hideHover: 'auto',

        resize: true

    });

	



</script>



<script>



Morris.Bar({

        element: 'grafico-dia',

        data: [<?php echo $graficoDia;?>],

        xkey: 'dia',

        ykeys: ['total'],

        labels: ['Total Vendas Dia'],     

        hideHover: 'auto',

        resize: true

    });	



</script>

