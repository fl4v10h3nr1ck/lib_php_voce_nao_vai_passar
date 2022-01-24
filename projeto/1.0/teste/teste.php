<?php
if(!isset($_SESSION))
session_start();

header('Content-type: text/html; charset=UTF-8');



include_once $_SERVER['DOCUMENT_ROOT'].'/voce_nao_vai_passar.class.php';


$vnvp = new voce_nao_vai_passar();


echo "<html>";

echo "<head>";


echo "<script src='../dependencias/jquery-3.1.1.min.js' type='text/javascript'></script>";	
	
echo $vnvp->dependencias();

echo "</head>";

echo "<body>";

if($vnvp->permitirAcesso())
echo "entrou normal";
else	
echo $vnvp->formDeLogin();

echo "</body>";

echo "</html>";
?>