<?php
//función que direcciona a una pagina especifica
function iraURL($url){
	$ini='<script language="javascript">
				window.location = "';
	$fin='"; </script>';
	
	echo $ini.$url.$fin;
}

//alertas
function javaalert($msj){
	$ini='<script language="javascript">	alert("';
	$fin='"); </script>';
	echo $ini.$msj.$fin;
}
//Verificando que el analista tenga la sesión abierta
function existeSesion(){
	if(isset($_SESSION["Analista"]))
		return true;
	else
		return false;
}
//eliminando variable de sesion de cuenta de analista
function eliminarSesion(){
    if(isset($_SESSION["Analista"])){
	unset($_SESSION["Analista"]);
	}
}

?>