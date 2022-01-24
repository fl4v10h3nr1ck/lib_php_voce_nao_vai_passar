<?php

header('Content-type: text/html; charset=UTF-8');

chdir(dirname(__FILE__)); 
chdir('../');

include_once getcwd().'/constantes.php';
	

include_once PATH_ABSOLUTO.'Estrutura.class.php';
include_once 'Usuarios.class.php';

$estrutura = new Estrutura();
$usuarios = new Usuarios();


?>


<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pt-br" lang="pt-br">
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="author" content="Flavio Henrique P Sousa">
	
	<?php $estrutura->getTitulo("Monitoração - usuários") ?>
	
	<?php $estrutura->getFavicon() ?>
	
	<?php $estrutura->dependencias() ?>
	
	
	<?php $usuarios->dependencias() ?>
	
	
	</head>
	<body>
	
	<?php $estrutura->getBarraDoTopo() ?>
	
	
	<?php if($estrutura->estaLogado()){ ?>
	
		<div id='geral'>
			<div id='conteudo'>
	

	
			<?php $usuarios->getUsuarios(); ?>
			
			

		</div>
	</div>
	
	<?php } ?>

	
	<?php $estrutura->rodape() ?>
	
	</body>
</html>