
<?php

if (isset($_GET["idAct"])||isset($_GET["idSes"])||isset($_GET["idCond"])||isset($_GET["idUsu"])) {
 require_once('nusoap.php'); 
        $wsdl_url = 'http://localhost:15362/CapaDeServiciosAnalistas/GestionDeActividades?WSDL';
           $client = new SOAPClient($wsdl_url);
           $client->decode_utf8 = false; 
		   $actividad= array('id' => $_GET["idAct"],'borrado'=>'false');		   
		   $sesion= array('id' => $_GET["idSes"],'borrado'=>'false');
		   $condicion= array('id' => $_GET["idCond"],'borrado'=>'false');
			$parametros = array(
			'actividadActual' => $actividad,
			 'sesionActual' => $sesion,
             'condicionActual' => $condicion,
           );
           $retorno = $client->FinalizarActividad($parametros);
             //         echo '<pre>';  
           //print_r($retorno);
			if($retorno->return->estatus=="OK"){
				//Consultado el id minimo en Cola para asignar
					$retornoActividad = $client->primeroEnEntrarPrimeroEnSalirDeCola();
					//echo '<br>IDActi_<pre>';
					//print_r($retornoActividad);
					if($retornoActividad->return->estatus=="OK"){
							//Asignando nueva actividad a usuario y se saca de la cola
							$actividad= array('id' => $retornoActividad->return->actividads->id,'borrado'=>'false');
							$usuario= array('id' => $_GET["idUsu"],'diasValidezClave'=> '50','borrado'=>'false');
							$xxx = array(
							'actividadActual' => $actividad,
							 'usuarioActual' => $usuario,
						   );					   
						   $Resultado = $client->ConsumirCola($xxx);
						//			   echo 'Consumo<br><pre>';
						  // print_r($Resultado);
						   if($Resultado->return->estatus=="OK"){
							echo '<script language="javascript"> window.location = "http://192.168.1.102:15362/HoriFarmaciasAnalistas/faces/actividadgrupousuario.xhtml?estatus='.$Resultado->return->estatus.'"; </script>';

						   }else{
							echo '<script language="javascript"> window.location = "http://192.168.1.102:15362/HoriFarmaciasAnalistas/faces/actividadgrupousuario.xhtml?estatus='.$Resultado->return->estatus.'"; </script>';
							}
					}else{
						echo '<script language="javascript"> window.location = "http://192.168.1.102:15362/HoriFarmaciasAnalistas/faces/actividadgrupousuario.xhtml?estatus='.$retornoActividad->return->estatus.'"; </script>';
					}
					
			}else{
			echo '<script language="javascript"> window.location = "http://192.168.1.102:15362/HoriFarmaciasAnalistas/faces/actividadgrupousuario.xhtml?estatus='.$retorno->return->estatus.'"; </script>';
			
			}
			
	}else{
		echo '<script language="javascript"> window.location = "http://192.168.1.102:15362/HoriFarmaciasAnalistas/faces/actividadgrupousuario.xhtml"; </script>';
	}	   
	
			
			


?>
