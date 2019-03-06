<?php 
include ('../../ctrl_restrito_logado.php');
include('../cabecalho.php');
include('../../conexao.php');


$id = $_GET["id"];
$query = mysql_query("SELECT * FROM tbpessoas where idtbpessoas = '".$id."';");


$row = mysql_fetch_array($query);

$idtipo =  $row["tbpessoastipo"];
$nome =  $row["tbpessoasnome"];
$nasc = date('d/m/Y', strtotime($row["tbpessoasnascimento"]));
$cpf =  formatCpfCnpj($row["tbpessoascpfcnpj"]);
$tel1 =  formatFone($row["tbpessoastel1"]);
$tel2 =  formatFone($row["tbpessoastel2"]);
$email1 =  $row["tbpessoasemail1"];
$email2 =  $row["tbpessoasemail2"];
$endereco =  $row["tbpessoasendereco"];
$cep =  formatCep($row["tbpessoascep"]);

if(empty($tel2)){
	$tel2 = "Não Consta";
}


if(empty($nasc)){
	$nasc = "Não Consta";
}

if(empty($email1)){
	$email1 = "Não Consta";
}

if(empty($email2)){
	$email2 = "Não Consta";
}

if(empty($endereco)){
	$endereco = "Não Consta";
}

if(empty($cep)){
	$cep = "Não Consta";
}

?>



<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Cliente</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Detalhes Cliente
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <form role="form" method="post" action="../categoria - Copy/editar_action.php">
                                <div class="form-group">
                               		<label>Id</label>
                                    <p class="form-control-static"><?php echo $id;?></p>
                                    <input class="form-control" id="id"  name="id" type="hidden" value="<?php echo $id;?>">
                                    <label>Nome</label>
                                    <p class="form-control-static"><?php echo $nome;?></p>
                                    <label>CPF</label>
                                    <p class="form-control-static"><?php echo $cpf;?></p>
                                    <label>Data de Aniversário</label>
                                    <p class="form-control-static"><?php echo $nasc;?></p>
                                    <label>Telefone 1</label>
                                    <p class="form-control-static"><?php echo $tel1;?></p>
                                    <label>Telefone 2</label>
                                    <p class="form-control-static"><?php echo $tel2;?></p>
                                    <label>E-mail 1</label>
                                    <p class="form-control-static"><?php echo $email1;?></p>
                                    <label>E-mail2</label>
                                    <p class="form-control-static"><?php echo $email2;?></p>
                                    <label>CEP</label>
                                    <p class="form-control-static"><?php echo $cep;?></p>
                                    <label>Endereço</label>
                                    <p class="form-control-static"><?php echo $endereco;?></p>
                                </div>
                                <a href="../clientes/visualizar.php" class="btn btn-primary">Voltar</a> 
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
