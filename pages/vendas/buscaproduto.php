

<?php
include ('../../ctrl_restrito_logado.php');
include '../../conexao.php';
include '../funcoes.php';

	
$bucouportfolio = $_POST['palavra'];
if($bucouportfolio){

$sqlportfolio = "SELECT pr.idtbprodutos as id , pr.tbprodutosnome as nome, pr.tbprodutosdescricao as descricao, pr.tbprodutosmarca as marca, 
					pr.tbprodutoscategoria as idcategoria, ct.tbcategoriadesc as categoriadesc,pr.tbprodutoscusto as custo, 
					pr.tbprodutosvenda as venda, pr.tbprodutosestoque as estoque, pr.tbprodutoscodigo as codigo, pr.tbprodutosst as st 
					FROM tbprodutos pr
					left join tbcategoria ct on
					ct.idtbcategoria = pr.tbprodutoscategoria
					where pr.tbprodutosnome like('%".$bucouportfolio."%') and pr.tbprodutosst > 0
					order by pr.tbprodutoscodigo asc";
				
$query = mysql_query($sqlportfolio);
$querysqlsqlportfolio = mysql_num_rows($query);

if($querysqlsqlportfolio > 0){ 
echo "
<div class='table-responsive'>
<table class='table table-hover'>
  <thead>
	  <tr>
		  <th>Código</th>
		  <th>Nome</th>
		  <th>Marca</th>
		  <th>Categoria</th>
		  <th>Valor</th>
		  <th>Estoque</th>
	  </tr>
  </thead>
";
while($resultado = mysql_fetch_array($query)){

$idproduto = $resultado['id'];
$codproduto = $resultado['codigo'];
$nomeproduto = $resultado['nome'];
$marcaproduto = $resultado['marca'];
$categoriaproduto = $resultado['categoriadesc'];
$vendaproduto = formatMoeda($resultado['venda']);
$estoqueproduto = $resultado['estoque'];




echo "
<tbody>
	<tr>
	<td><a href='javascript:void(0)' onclick=\"insert('$codproduto', '$nomeproduto')\" data-dismiss='modal'>$codproduto</a></td>
	<td>$nomeproduto</td>
	<td>$marcaproduto</td>
	<td>$categoriaproduto</td>
	<td>$vendaproduto</td>
	<td>$estoqueproduto</td>
	</tr>
	</body>";
	


}


}else{


echo "<div class='alert alert-danger' role='alert'><b>Ops.</b> Sua pesquisa não encontrou nenhum produto!</div>";


}


}

?>

  </table>

</div>

