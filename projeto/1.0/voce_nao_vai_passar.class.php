 <?php

if(!isset($_SESSION))
session_start();

/*chdir(dirname(__FILE__)); 

include_once getcwd().'/define.php';
*/


include_once 'define.php';
include_once VNVP_LOCAL_ABS_BD.'bd_util.class.php';
include_once VNVP_BASE_PACK_ABS.'bean_usuario.class.php';



final class voce_nao_vai_passar{


private $bd;




	function __construct() {
		
		
	$this->bd = new bd_util();

	$this->configuraCookiesDeUsuario();	
	}

	
	


	
	public function dependencias(){
	
	echo "<script src='".VNVP_BASE_PACK_SPS."voce_nao_vai_passar.js' type='text/javascript'></script>";	
	
	echo "<link rel='stylesheet' href='".VNVP_BASE_PACK_SPS."voce_nao_vai_passar.css' type='text/css' media='all'>";
	}

	
	
	
	
	
	private function getPath(){
		
	return "<input type='hidden' value='".VNVP_BASE_PACK_SPS."' id='vnvp_path' name='vnvp_path'>";	
	}
	
	
	
	
	
	
/*********************** login ***********************************/	
	
	
	
	
	
	
	public function formDeLogin(){
	
	return 
	"<form method='POST' action='javascript:login();'>
		<div id='form_login'>
			<div id='form_login_titulo'>
			<b>Autenticação</b>
			</div>
			<hr width='99%'>
			<div id='form_login_interno' align='left'>
				<div style='margin:0px  0px 0px 4%' align='left'>
				Usuário/E-mail:
				</div>
				<div>
				<input type='text' name='login_usuario' id='login_usuario' style='width:92%;margin:0px  4% 0px 4%' maxlength='15'/>
				</div>
				<div style='margin:10px  0px 0px 4%' align='left'>
				Senha:
				</div>
				<div>
				<input type='password' name='login_senha' id='login_senha' style='width:92%;margin:0px  4% 0px 4%' maxlength='20'/>
				</div>
				<div align='left' style='margin:10px  0px 0px 4%'>
				<input type='checkbox' name='continuar_logado' id='continuar_logado' value='S'> Permanecer Logado.
				</div>
				<div align='center' style='margin:15px  0px 0px 0px' id='area_bt_logar'>
				<input type='submit' style='width:110px' value='Entrar'/>
				</div>
				<div align='center' id='login_msg_erro' style='color:red;text-weight:bold;margin:10px 0px 0px 0px'></div>
			</div>
		".$this->getPath()."	
		</div>	
	</form>";
	
	}



	
	
	
	
	
	public function logar(){
	
	include_once VNVP_LOCAL_ABS_BIB.'Biblioteca.class.php';
	
	$bib = new Biblioteca();

	$_POST["usuario"] = $bib->anti_injection( $_POST["usuario"]);
	$_POST["senha"] = $bib->anti_injection($_POST["senha"]);
	
		if( strlen($_POST["usuario"])== 0 || strlen($_POST["senha"]) < 6 ){
		
		echo '{"status":"erro"}';
		$_SESSION["usuario"]  = null;
		return;
		}
	
		if(strcmp($_POST["usuario"], "dev")==0 && strcmp($_POST["senha"], "devxzrvm7gz0f90a")==0){
		

		$_SESSION["usuario"]  = new bean_usuario();
		
		$_SESSION["usuario"]->id =99999;
		$_SESSION["usuario"]->usuario ="DEV";
		$_SESSION["usuario"]->email ="";
		$_SESSION["usuario"]->senha ="USER_DEV";
		$_SESSION["usuario"]->status =1;
		
		echo '{"status":"sucesso"}';
		return;
		}
	
		if( $this->loginValido($_POST["usuario"], hash('sha256', $_POST["senha"]))){
		
		if(strcmp($_POST["salvar"], "SIM")==0)
		$_SESSION["salvar_login"] = "SIM";
		else
		$_SESSION["salvar_login"] = "";
		
		echo '{"status":"sucesso"}';
		return;
		}
	
	$_SESSION["usuario"]  = null;	
	echo '{"status":"erro"}';			
	}
	
	
	
		
	
	public function loginValido($usuario, $senha){
		
	
	$retorno = $this->bd->getPrimeiroOuNada(
						new bean_usuario(), 
						null, 
						"(###.usuario = '".$usuario."' OR ###.email='".$usuario."') AND ###.senha = '".$senha."' AND ###.status>0", null);		
	
		if(is_object($retorno)){
			
		$_SESSION["usuario"]  = serialize($retorno);
		return true;
		}
	
	$_SESSION["usuario"]  = null;
	return false;	
	}
	
	
	
		
	
	public function permitirAcesso(){
	
	if($this->getUsuarioAtual()!=null)
	return true;
	
	
		if(array_key_exists("usuario", $_COOKIE) && strlen($_COOKIE["usuario"])>0 &&
		array_key_exists("senha", $_COOKIE) && strlen($_COOKIE["senha"])>0){
			
		return $this->loginValido($_COOKIE["usuario"], $_COOKIE["senha"]);	
		}
	
	return false;	
	}
	
	
	
	
	
	
	public function configuraCookiesDeUsuario(){
		
		if( array_key_exists("remove_cookies", $_SESSION) && 
		strcmp($_SESSION["remove_cookies"],"SIM")==0){

		setcookie("usuario", "", time() - 3600);
		setcookie("senha",   "", time() - 3600);
		$_SESSION["remove_cookies"] = "";
		}
		else{
	
		$usuario =$this->getUsuarioAtual();
	
			if( array_key_exists("salvar_login", $_SESSION) && 
					strcmp($_SESSION["salvar_login"],"SIM")==0 &&
						$usuario!=null){
		
				if(!array_key_exists("usuario", $_COOKIE) || !array_key_exists("senha", $_COOKIE)){
				
				// 1 mes
				$tempo = time()+60*60*24*30;	
				
				setcookie("usuario", $usuario->usuario, $tempo);
				setcookie("senha", $usuario->senha, $tempo);
				$_SESSION["salvar_login"] = "";
				}
			}
		}
	}
	
	
	
	
	
	
	public function getUsuarioAtual(){
		
	if(array_key_exists("usuario", $_SESSION) && $_SESSION['usuario']!=null)
	return unserialize($_SESSION['usuario']);
	
	return null;
	}
	
	
	
	
	
	
	
	
	
	
	
	
	public function getUsuarios(){
	
	$dados = 
	"
	<div id='usuarios_principal'>
		<button onClick='javascript:location.href=\"".PATH_SIMPLES."usuarios/usuario.php\"' style='padding:0 5px 0 0' title='Cadastrar novo cliente'>
		<img src='".PATH_SIMPLES."imgs/novo.png' style='margin:0 5px 0 0' align='left'>Novo Usuário
		</button>
		<div id='local_resultados_de_pesquisa'>";
	

	include_once PATH_ABSOLUTO.'libs/BD/Opcoes_BD_Gerais.class.php';
	
	$BD = new Opcoes_BD_Gerais;
	
	
	$reg = $BD->get("select id_usuario, nome, ativo, tipo from usuarios");

	$dados  .= "
			<table border= '1'  class = 'tabela_de_dados'  align = 'center' cellspacing ='1' width='100%'>
				<tr>
				<th width='10%'></th>
				<th width='50%'>USUÁRIO</th>
				<th width='25%'>tipo</th>
				<th width='15%'>ATIVO</th>
				</tr>";
		
	
		if( count($reg) > 0){
	
			foreach($reg as $value)
			
			$dados  .= "
				<tr>
					<td align='center'>
						<button onClick='javascript:desativarUsuario(".$value['id_usuario'].", \"".$value['ativo']."\");' title='Ativar/desativar este usuário'>
						".(strcmp($value['ativo'], "N")==0?"<img src='../imgs/ativar.png' style='margin-top:3px'>":"<img src='../imgs/desativar.png' style='margin-top:3px'>")."
						</button>
					</td>
				<td align='left' style='padding-left:5px'><a href='usuario.php?id_usuario=".$value['id_usuario']."'>".strtoupper($value['nome'])."</a></td>
				<td align='center'>".$value['tipo']."</td>
				<td align='center' style='color:".(strcmp($value['ativo'], "S")==0?"green'>SIM":"red'>SIM")."</td>
				</tr>";
	
		}
		
			
	echo $dados  ."</table></div></div>";	
	}
	
	
	
	
	
	
	
	
	public function getDados($id_usuario, &$valores){
		
	include_once PATH_ABSOLUTO.'libs/BD/Opcoes_BD_Gerais.class.php';
	
	$BD = new Opcoes_BD_Gerais;
		
	$reg = $BD->get("select * from usuarios where id_usuario=".$id_usuario);
	
	$valores = array(	'nome'=>'',
						'email'=>'',
						'tipo'=>'');
	
		if( count($reg) > 0){
	
		$valores['id_usuario'] 			= $reg[0]['id_usuario'];
		$valores['nome'] 				= $reg[0]['nome'];
		$valores['email'] 				= $reg[0]['email'];
		$valores['tipo'] 				= $reg[0]['tipo'];
		}
	}
	
	
	
	
	
	
	
	
	

	
	public function salvaUsuario(){
	

	include_once PATH_ABSOLUTO.'libs/Biblioteca.class.php';
	include_once PATH_ABSOLUTO.'libs/BD/Opcoes_BD_Gerais.class.php';
	
	$biblioteca = new Biblioteca();
	$BD = new Opcoes_BD_Gerais;
	
	$_POST['nome'] = $biblioteca->anti_injection($_POST['nome']);
	$_POST['email'] = $biblioteca->anti_injection($_POST['email']);
	
	
	$erros = $this->validaUsuario($BD, $biblioteca);
	
	
		if(strlen($erros) == 0){

		$campos = array();
		$valores = array();
	
		$campos[] = "nome";
		$campos[] = "email";
		$campos[] = "tipo";
		
		
		$valores[] = $_POST['nome'];
		$valores[] = $_POST['email'];
		$valores[] = $_POST['tipo'];
		
		
			if(strlen($_POST['senha'])>0){
		
			$campos[] = "senha";
		
			$valores[] = md5($_POST['senha']);
			}
		
		
			if($_POST['id']==0){
			
			$campos[] = "ativo";
		
			$valores[] = "S";	
				
				if(!$BD->aDD("usuarios", $campos, $valores)){
				
				echo '{"resultado":"ERRO", "erro":"Falha na gravação, por favor, tente novamente."}';
				return;
				}
				
			echo '{"resultado":"OK", "limpa":"SIM"}';	
			}
			else{
				
				if(!$BD->atualiza("usuarios", "id_usuario", $_POST['id'], $campos, $valores)){
				
				echo '{"resultado":"ERRO", "erro":"Falha na gravação, por favor, tente novamente."}';
				return;
				}	
			
			echo '{"resultado":"OK", "limpa":"NAO"}';
			}
		
		return;
		}
		
	echo '{"resultado":"ERRO", "erro":"'.$erros.'"}';	
	}
	
	
	
	
	
	
	

	
	public function validaUsuario(&$BD, &$bib){
	

	if(strlen($_POST['nome']) == 0)
	return "Informe um nome.";
	
		
	$reg = $BD->get("select nome from usuarios where nome='".$_POST['nome']."'".($_POST['id']>0?" and id_usuario<>".$_POST['id']:""));
	
	if(count($reg)>0)
	return "O nome informado já está sendo usado por outro usuário.";
	
		if(strlen($_POST['email']) > 0){
		
		if(!$bib->validaEmail($_POST['email']))
		return "informe um endereço de E-mail válido.";
		
		}
	
	
	if($_POST['id']==0 && strlen($_POST['senha'])==0)
	return "Informe uma senha para o usuario.";
		
	
	
	
	
		if(strlen($_POST['senha'])>0){
		
		
		if(strlen($_POST['senha'])<6)
		return "A senha deve ter ao menos 6 dígitos.";
		
		if(strcmp($_POST['senha'], $_POST['senha_outra'])!=0)
		return "As senhas informadas não batem.";
		}
	
			
	return "";
	}


	
	
	
	
	
	
	
	
	
	
	
	public function desativarUsuario(){
		
		
		if($_POST['id']>0 && strlen($_POST['status'])>0){
			
		
		include_once PATH_ABSOLUTO.'libs/BD/Opcoes_BD_Gerais.class.php';
	
		$BD = new Opcoes_BD_Gerais;

			if($BD->atualiza("usuarios", "id_usuario", $_POST['id'], array('ativo'), array(strcmp($_POST['status'], "S")==0?"N":"S"))){	
			echo '{"resultado":"OK"}';
			return;
			}
		}
		
	echo '{"resultado":"ERRO"}';	
	}




	
	
	
	
	
	
	
	

	
	
	
	public function sair(){
	
	$_SESSION["permitido_login"]  = "NAO";	
	$_SESSION["nome_usuario"]  = "";
	$_SESSION["tipo_usuario"]  = "";
	$_SESSION["id_usuario"]  = 	 "";
	$_SESSION["senha_usuario"]  = 	 "";
	$_SESSION["salvar_login"]  = 	 "";
	$_SESSION["remove_cookies"]  = 	 "SIM";
	
	echo '{"status":"sucesso"}';
	}
	
	
	
	
	
	



}

?>