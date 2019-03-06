<?php 
include ('../../ctrl_restrito_logado.php');
include('../../conexao.php');
include('../cabecalho.php');

?>



<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Clientes</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Cadastrar Novo Cliente
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <form role="form" method="post" action="../clientes/cadastrar_action.php">
                                <div class="form-group">
                                    <label>Nome</label>
                                    <input class="form-control" id="nome"  name="nome" type="text" value="">
                                    <input class="form-control" id="tipo"  name="tipo" type="hidden" value="1">
                                    <label>Data de Aniversário</label>
                                    <input class="form-control" id="nasc"  name="nasc" type="date" value="">
                                    <label>CPF</label>
                                    <input class="form-control" id="cpf"  name="cpf" type="text" value="" >
                                    <label>Telefone 1</label>
                                    <input class="form-control" id="tel1"  name="tel1" type="text" value="">
                                    <label>Telefone 2</label>
                                    <input class="form-control" id="tel2"  name="tel2" type="text" value="">
                                    <label>E-mail 1</label>
                                    <input class="form-control" id="email1"  name="email1" type="text" value="">
                                    <label>E-mail2</label>
                                    <input class="form-control" id="email2"  name="email2" type="text" value="">
                                    <label>CEP</label>
                                    <input class="form-control" id="cep"  name="cep" type="text" value="">
                                    <label>Endereço</label>
                                    <input class="form-control" id="endereco"  name="endereco" type="text" value="">
                                </div>
                                <a class="btn btn-primary" href="../clientes/visualizar.php" >Voltar</a>
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

<script>
	$('#cpf').mask('000.000.000-00', {reverse: true});

	$('#cep').mask('00000-000');
	
	var SPMaskBehavior = function (val) {
	return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
	},
		spOptions = {
		onKeyPress: function(val, e, field, options) {
		field.mask(SPMaskBehavior.apply({}, arguments), options);
		}
	};
	
	$('#tel1,#tel2').mask(SPMaskBehavior, spOptions);
	
</script>