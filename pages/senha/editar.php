<?php 
include ('../../ctrl_restrito_logado.php');
include('../cabecalho.php');
include('../../conexao.php');


$id = $_SESSION['UsuarioID'];
$query = mysql_query("SELECT * FROM tbusuarios where idtbusuarios = '".$id."';");


$row = mysql_fetch_array($query);

$idusuario =  $row["idtbusuarios"];
$login =  $row["tbusuarioslogin"];


?>



<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Senha</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Alterar Senha
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <form role="form" method="post" action="../senha/editar_action.php">
                                <div class="form-group">
                                    <input class="form-control" id="id"  name="id" type="hidden" value="<?php echo $idusuario;?>">
                                    <label>Login</label>
                                    <input class="form-control" id="login"  name="login" type="text" value="<?php echo $login;?>">
                                    <label>Senha</label>
                                    <input class="form-control" id="senha1"  name="senha1" type="password" value="">
                                    <label>Confirmar Senha</label>
                                    <input class="form-control" id="senha2"  name="senha2" type="password" value="">
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