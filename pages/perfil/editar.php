<?php 
include ('../../ctrl_restrito_logado.php');
include('../cabecalho.php');
include('../../conexao.php');


$id = $_SESSION['UsuarioID'];
$query = mysql_query("SELECT * FROM tbusuarios where idtbusuarios = '".$id."';");


$row = mysql_fetch_array($query);

$idusuario =  $row["idtbusuarios"];
$nome =  $row["tbusuariosnome"];
$email =  $row["tbusuariosemail"];
$telefone =  $row["tbusuariostel"];


?>



<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Perfil</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Editar Perfil
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <form role="form" method="post" action="../perfil/editar_action.php">
                                <div class="form-group">
                                    <input class="form-control" id="id"  name="id" type="hidden" value="<?php echo $idusuario;?>">
                                    <label>Nome</label>
                                    <input class="form-control" id="nome"  name="nome" type="text" value="<?php echo $nome;?>">
                                    <label>E-mail</label>
                                    <input class="form-control" id="mail"  name="mail" type="text" value="<?php echo $email;?>">
                                    <label>Telefone</label>
                                    <input class="form-control" id="fone"  name="fone" type="text" value="<?php echo $telefone;?>">
                                </div>
                                <a class="btn btn-primary" href="../principal/index.php" >Voltar</a>
                                <input class="btn btn-primary" type="submit" value="Salvar">   
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

<script>
var SPMaskBehavior = function (val) {
	return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
	},
		spOptions = {
		onKeyPress: function(val, e, field, options) {
		field.mask(SPMaskBehavior.apply({}, arguments), options);
		}
	};
	
	$('#fone').mask(SPMaskBehavior, spOptions);
</script>