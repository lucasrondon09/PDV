<?php

/*
Nome: Alterar Menu
Autor: Lucas Rondon
Data: 12/01/2018
Descrição: Verificar se a página que está sendo chamada no menu é a página index ou a uma página dentro da pasta arquivos.
Redirecionar o link corretamente para a página chamada.
*/









//Fim 


/*
Nome: nome_pagina
Autor: Lucas Rondon
Data: 15/01/2018
Descrição: Passar o nome da página para várivel e retornar array com o caminho encontrado.
*/

function nome_pagina(){

	$pagina = explode("/", $_SERVER['PHP_SELF']);
	
	return $pagina;

	}	

//Fim 


/*
Nome: selected
Autor: Lucas Rondon
Data: 21/02/2018
Descrição: Ativar o select cadastrado no banco de dados.
*/
function selected( $value, $selected ){
    return $value==$selected ? ' selected="selected"' : '';
}

//Fim 


/*
Nome: formatFloat
Autor: Lucas Rondon
Data: 21/02/2018
Descrição: Converte valor monetário para o tipo Float do banco de dados
*/
function formatFloat($valorRecebido){
	$removeCifrao = str_replace('R$', '',$valorRecebido);
	$valorFormatado = trim(str_replace(',', '.', str_replace('.', '', $removeCifrao)));
	
	return $valorFormatado;
}
//Fim


/*
Nome: formatFloat
Autor: Lucas Rondon
Data: 21/02/2018
Descrição: Converte o valor cadastrado no banco de dados para o formato de telefone
*/
function formatFone($valor){
	
	$qtd = strlen($valor);
	
	if($qtd === 10){
		
	$pattern = '/(\d{2})(\d{4})(\d*)/';
	$fone = preg_replace($pattern, '($1) $2-$3', $valor);
		
	}elseif($qtd === 11){
	
	$pattern = '/(\d{2})(\d{5})(\d*)/';
	$fone = preg_replace($pattern, '($1) $2-$3', $valor);
	
	}

	return $fone;
}
//Fim


/*
Nome: formatCpfCnpj
Autor: Lucas Rondon
Data: 21/02/2018
Descrição: Converte o valor cadastrado no banco de dados para o formato de CPF/CNPJ
*/
function formatCpfCnpj($valor){
	
	$qtd = strlen($valor);
	
	if($qtd === 11){
		
	$pattern = '/(\d{3})(\d{3})(\d{3})(\d*)/';
	$cpfCnpj = preg_replace($pattern, '$1.$2.$3-$4', $valor);
		
	}else{
	
	$pattern = '/(\d{2})(\d{3})(\d{2})(\d{4})(\d*)/';
	$cpfCnpj = preg_replace($pattern, '$1.$2.$3/$4-$5', $valor);
	
	}

	return $cpfCnpj;
}
//Fim

/*
Nome: formatCep
Autor: Lucas Rondon
Data: 21/02/2018
Descrição: Converte o valor cadastrado no banco de dados para o formato de CEP
*/
function formatCep($valor){

		
	$pattern = '/(\d{5})(\d*)/';
	$cep = preg_replace($pattern, '$1-$2', $valor);


	return $cep;
}
//Fim



/*
Nome: limpaCPF_CNPJ
Autor: Lucas Rondon
Data: 21/02/2018
Descrição: Retira todos os sinais e pontos e deixa somente os números do CPF/CNPJ
*/
function limpaCPF_CNPJ($valorrecebido){
	$chars = array(".","-","/");	
	$valor = trim(str_replace($chars, '', $valorrecebido));
   
   return $valor;
}
//Fim

/*
Nome: limpaCPF_CNPJ
Autor: Lucas Rondon
Data: 21/02/2018
Descrição: Retira todos os caracteres e deixa somente os números do Telefone
*/
function limpaTel($valorrecebido){
	$chars = array("(",")","-",".","_", " ");	
	$valor = str_replace($chars, '', $valorrecebido);

   return $valor;
}
//Fim

/*
Nome: limpaCEP
Autor: Lucas Rondon
Data: 21/02/2018
Descrição: Retira todos os caracteres e deixa somente os números do CEP
*/
function limpaCEP($valorrecebido){
	$chars = array("(",")","-",".","/","_");	
	$valor = trim(str_replace($chars, '', $valorrecebido));
   
   return $valor;
}
//Fim


/*
Nome: limpaCEP
Autor: Lucas Rondon
Data: 21/02/2018
Descrição: Retira todos os caracteres e deixa somente os números do CEP
*/
function formatMoeda($valorrecebido){
	
	$valor = 'R$ '.number_format($valorrecebido, 2, ',', '.');
   
   return $valor;
}
//Fim


/*
Nome: limpaCEP
Autor: Lucas Rondon
Data: 21/02/2018
Descrição: Retira todos os caracteres e deixa somente os números do CEP
*/
function mesExtenso($mes){
	
	switch ($mes) {
    case '01':
        $retorno = "Janeiro";
        break;
    case '02':
        $retorno = "Fevereiro";
        break;
    case '03':
        $retorno = "Março";
        break;
	case '04':
        $retorno = "Abril";
        break;
	case '05':
        $retorno = "Maio";
        break;
	case '06':
        $retorno = "Junho";
        break;
}
	
   
   return $retorno;
}
//Fim
?>