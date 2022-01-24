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
	
	
	<?php
	
	$valores = array(	'nome'=>'',
						'email'=>'',
						'tipo'=>'',
						'id_usuario'=>0);
	
	$id = 0;
	
	
		if(array_key_exists("id_usuario", $_GET) && $_GET["id_usuario"]>0)	{
		
		$usuarios->getDados($_GET["id_usuario"], $valores);
		$id = $valores["id_usuario"];
		}
	
	?>
	
	
				<div id='usuarios_principal'>	
					<table width='100%' style='color:#000;border:solid 1px #000'>
						<tr>
							<td align='center'>
							<br>
							<b>Dados de Usuário</b>
							</td>
						</tr>
						<tr>
							<td align='left'>
								<div id='div_nome'>
								Nome:<span style='color:red'>*</span><br>
								<input type='text' id='nome' value='<?php echo $valores['nome'] ?>' style='width:98%' >
								</div>
								<div id='div_email'>
								E-mail:<br>
								<input type='text' id='email' value='<?php echo $valores['email'] ?>' style='width:98%' >
								</div>
								<div id='div_tipo'>
								tipo:<br>
									<select id='tipo' style='width:98%'>
									<option value='NORMAL' <?php echo (strcmp($valores['tipo'], "NORMAL")==0?"selected":"") ?>>NORMAL</option>
									<option value='ADMIN' <?php echo (strcmp($valores['tipo'], "ADMIN")==0?"selected":"") ?>>ADMIN</option>
									</select>
								</div>
								<div style='clear:both'></div>
							</td>
						</tr>
						<tr>
							<td align='left'>
								<div id='div_senha'>
								Senha:<br>
								<input type='password' id='senha' value='' style='width:98%' >
								</div>
								<div id='div_senha_repete'>
								Repita a Senha:<br>
								<input type='password' id='senha_outra' value='' style='width:98%' >
								</div>
								<div style='clear:both'></div>	
							</td>
						</tr>
						<tr>
							<td align='center'><br><br><br><br>
								<table width='100%'>
									<tr>
										<td width='20%' align='left'>
										<button class='botao_maior' onclick='javascript:location.href="index.php";'><img src='../imgs/voltar.png'></button>
										</td><td align='center' width='60%'>
										<button style='width:150px;height:25px' onclick='javascript:salvaUsuario(<?php echo $id ?>);'>Salvar</button><br><br>
										</td><td width='20%' align='left'>
										</td>
									</tr>
								</table>
								<br>
							</td>
						</tr>
					</table>
				</div>		
			</div>
		</div>
		
	<?php } ?>

	
	<?php $estrutura->rodape() ?>
	
	</body>
</html>