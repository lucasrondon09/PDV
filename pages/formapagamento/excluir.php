<?php 
include ('../../ctrl_restrito_logado.php');
include('../cabecalho.php');
include('../../conexao.php');


$id = $_GET["id"];
$query = mysql_query("SELECT * FROM tbformapagamento where idtbformapagamento = '".$id."';");


$row = mysql_fetch_array($query);

$idpgto =  $row["idtbformapagamento"];
$descpgto =  $row["tbformapagamentodescricao"];

?>



<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Forma de Pagamento</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Excluir Forma de Pagamento
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <form role="form" method="post" action="../formapagamento/excluir_action.php">
                                <div class="form-group">
                               		<label>Id</label>
                                    <p class="form-control-static"><?php echo $idpgto;?></p>
                                    <input class="form-control" id="id"  name="id" type="hidden" value="<?php echo $idpgto;?>">
                                    <label>Descrição</label>
                                    <p class="form-control-static"><?php echo $descpgto;?></p>
                                </div>
                                <a href="../formapagamento/visualizar.php" class="btn btn-primary">Voltar</a>
                                <input class="btn btn-primary" type="submit" value="Excluir">   
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
