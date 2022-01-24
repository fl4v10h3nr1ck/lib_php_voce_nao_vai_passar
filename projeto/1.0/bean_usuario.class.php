<?php


/** @Anot_tabela(nome="usuarios_sistema", prefixo="us") */
final class bean_usuario{



/** @Anot_campo(nome="id_usuario", tipo="int", ehId=true) */
public $id;

/** @Anot_campo(nome="usuario") */
public $usuario;

/** @Anot_campo(nome="email") */
public $email;

/** @Anot_campo(nome="senha") */
public $senha;

/** @Anot_campo(nome="status", tipo="int") */
public $status;

/** @Anot_campo(nome="data_cadastro", tipo="data") */
public $data_cadastro;

/** @Anot_campo(nome="nome_completo") */
public $nome_completo;

/** @Anot_campo(nome="tel") */
public $tel;

/** @Anot_campo(nome="cel") */
public $cel;

/** @Anot_campo(nome="logradouro") */
public $logradouro;
	
/** @Anot_campo(nome="num_residencia") */
public $num_residencia;

/** @Anot_campo(nome="cidade") */
public $cidade;

/** @Anot_campo(nome="uf") */
public $uf;

/** @Anot_campo(nome="bairro") */
public $bairro;

/** @Anot_campo(nome="cep") */
public $cep;

/** @Anot_campo(nome="complemento") */
public $complemento;

/** @Anot_campo(nome="token") */
public $token;

/** @Anot_campo(nome="img_profile") */
public $img_profile;

/** @Anot_campo(nome="outras_infos") */
public $outras_infos;


}
?>