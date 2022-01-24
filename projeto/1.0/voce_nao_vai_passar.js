

	
function login(){
	
	$("#area_bt_logar").html("<img src='"+$("#vnvp_path").val()+"imgs/load.gif'>");
	
	jQuery.post(
		
	$("#vnvp_path").val()+'acao.php',
		{
		nome_da_funcao:"logar", 
		usuario:$("#login_usuario").val(), 
		senha:$("#login_senha").val(), 
		salvar:$("#continuar_logado").is(":checked")?"SIM":"NAO"
		},
		function(retorno){ 
		
		var aux = $.parseJSON(retorno.substring(retorno.indexOf("{")));
			
		if(aux.status=='sucesso')
		location.reload();	
			else{
			$("#login_msg_erro").html("Usuário ou senha inválidos.");
			$("#area_bt_logar").html("<input type='submit' style='width:110px' value='Entrar'/>");
			}
		}
	);
}
	
	
	
	
	
	
	function sair(){
	
		jQuery.post(
		
			path+'login/action.php',
			{nome_da_funcao:"sair"},
			function(retorno){ location.reload();}
		);
	}
	
	
	
	
	




	function salvaUsuario(param_id){
		
	var parans = {
	nome_da_funcao:"salvaUsuario",
	nome:jQuery("#nome").val(),
	email:jQuery("#email").val(),
	tipo:jQuery("#tipo").val(),
	senha:jQuery("#senha").val(),
	senha_outra:jQuery("#senha_outra").val(),
	id:param_id};
	
		jQuery.post(
		
		'action.php',
		parans,
			function(retorno){ 
		
			var aux = jQuery.parseJSON(retorno.substr(retorno.indexOf("{")));
			
				if(aux.resultado=='OK'){
				
				getMsgSucesso("Cadastro realizado com sucesso.", aux.limpa=='SIM'?"limpaCampos()":"");
				
				if(aux.limpa=='SIM')
				limpaCampos();
				}
				else
				getMsgErro(aux.erro);
			}
		);
	}

	
	
	
	
	
	
	function limpaCampos(){
		 
	jQuery("#nome").val("");
	jQuery("#email").val("");
	jQuery("#tipo").val("");
	jQuery("#senha").val("");
	jQuery("#senha_outro").val("");
	}
	
	
	
	
	
	
	
	
	
	
	 
	 
	function desativarUsuario(param_id, param_status){
	
		jQuery.post(
		
		'action.php',
		
		{nome_da_funcao:'desativarUsuario', id:param_id, status:param_status},
		
			function(retorno){
			
			var aux = jQuery.parseJSON(retorno);
			
			if(aux.resultado=='OK')
			location.reload();
				
			}
		);	
	}  
	 
	
	
	