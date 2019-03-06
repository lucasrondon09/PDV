<?php 
include ('../../ctrl_restrito_logado.php');
include('../../conexao.php');
include('../cabecalho.php');

?>



<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Categorias</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Cadastrar Nova Categoria
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <form role="form" method="post" action="cadastrar_action.php">
                                <div class="form-group">
                                    <label>Descrição</label>
                                    <input class="form-control" id="descricao"  name="descricao" type="text">
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
