<?php

header('Content-type: text/html; charset=UTF-8');

chdir(dirname(__FILE__)); 

include_once getcwd().'/voce_nao_vai_passar.class.php';


$vnvp = new voce_nao_vai_passar();


	if( array_key_exists( "nome_da_funcao", $_POST) ){

	if (method_exists($vnvp, $_POST["nome_da_funcao"])) 
	call_user_func(array($vnvp, $_POST["nome_da_funcao"]));
	}
	
?>