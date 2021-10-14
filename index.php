<?php

// ----------------------------------------------------------------------------------------------------
// APP @ getFlokzurecords
// ----------------------------------------------------------------------------------------------------


	// HEADERS
		// Verificamos si la página es llamada dentro de otra, para invocar los headers
		/*
		header('Content-Type: text/html; charset=ISO-8859-15');
		// HTML headers
		header ('Expires: Sat, 01 Jan 2000 00:00:01 GMT'); //Date in the past
		header ('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); //always modified
		header ('Cache-Control: no-cache, must-revalidate, no-store, post-check=0, pre-check=0'); //HTTP/1.1
		header ('Pragma: no-cache');	// HTTP/1.0
		
*/
	// WARNINGS & ERRORS

		ini_set('display_errors', 1);
		ini_set('display_startup_errors', 1);
		error_reporting(E_ALL);

	// SCRIPT
		// Obtengo el nombre del script en ejecución
		$script = __FILE__;
		$camino = get_included_files();
		$scriptactual = $camino[count($camino)-1];
	

	// INCLUDES & REQUIRES 
		require_once("../includes/configuration.php");
		require_once("../includes/functions.php");
		require_once("../connection/vfunctions.php");
		require_once("../connection/vconfiguration.php");
		require_once('../connection/database.class.php');
		require_once('../connection/connection.php');
		require_once("../connection/session.php");
		require_once("../plugins/Classes/PHPExcel.php");
		include_once("../plugins/vPhpmailer/class.phpmailer.php");

// --------------------
// INICIO CONTENIDO
// --------------------


	// INIT 
		// ERROR ID ... inicializamos el indicador del error en el proceso
		$actionerrorid = 0;
		// AUTHNUMBER for duplicate check
		$actionauth = getActionAuth();
		// MESSAGe & KEY
		$message = "";
		$requiredkey = $cardnumber = $key = "8a88cf6819a52c891769d543a51e68f7635e09a9758b6520";
		$webservice = str_replace(getCurrentPageScript(), '', getCurrentPageURL());


	// PARAMS
		$file = "bug.txt";
		//$request = json_decode(file_get_contents($file));
		$request = json_decode(file_get_contents('php://input'));

		// Get JSON params

		/*if(json_encode($request,true) != ''){
		$fichero = fopen("testhtd2.txt", "w+");
		fwrite($fichero, json_encode($request,true)."\n");
		fclose($fichero);
		}*/

		$vMail = new PHPMailer();
		$vMail->IsSMTP();
		$vMail->CharSet = $vSMTP['CharSet'] = "UTF-8";
		$vMail->Host = $vSMTP['HostName'] = "";
		$vMail->SMTPAuth= true;
		$vMail->Port = $vSMTP['Port'] = "";
		$vMail->Username = $vSMTP['Email'] = "";
		$vMail->Password = $vSMTP['Password'] = "";
		$vMail->SMTPSecure = $vSMTP['Secure'] = "";
		$vMail->From = $vSMTP['Email'];
		$vMail->FromName = "";
		$vMail->isHTML(true);
		$vMail->addAddress("");
		
		$request = str_replace("'","",json_encode($request,true));
		if (isset($request)) {


				//print_r($request);
				
				$request = ($request);
				

				$request=json_decode($request,TRUE);  
				$Payload = $request['Payload'];
				$peticion = "";
				if (isset($request['Type'])) {
					$peticion = $request['Type'];
				}else{
					$actionerrorid = 2;
				}

				$type = "";
				$proceso = "";
				$creador = "";
				$proceso = $Payload['reference'];

				/*echo "<pre>";
					
				var_dump($request1);
				echo "</pre>";*/
				//HDT
				$TareaActual = "";
				$cuenta = "";
				$programa = "";
				$clasificacion = "";
				$area = "";
				$informacion = "";
				$fechacierre = "";
				$cliente = "";
				$estatus = "";
				$fechaSolicitud = "";
				$fechaEstimada = "";
				$horasDedicadasobj = "";
				$horastotales = "";
				$motivoRechazo = "";
				$asignacion = "";
				$cadenaref = "";
				$hdtRechazada = "";
				$iniciadorProceso = "";
				$reprocesoHdt = "";
				$tarea = "";
				$duracionEstimada = 0;
				$duracionEstimadaOdt = 0;
				$diasIniciada = 0;
				$diasEstimados = 0;
				$horastotales = 0;
				$descripcion = "";
				//ODT
				$clasificacionDes = "";
				$contacto = "";
				$enEsperaDe = "";
				$frecuenciaReporte = "";
				$sistemaInvolucrado = "";
				$situacionActual = "";
				$ejecutivoCuenta = "";
				$fechaApertura = "";
				$fechaTermino = "";
				$noSc = "";
				$requisitoTarea = "";

				//SC
				$duracionEstimada1 = 0;	        
				$duracionEstimada2 = 0;	        
				$duracionEstimada3 = 0;	        
				$duracionEstimada4 = 0;	        
				$duracionEstimada5 = 0;	        
				$duracionEstimada6 = 0;	        
				$duracionEstimada7 = 0;	        
				$duracionEstimada8 = 0;	        
				$duracionEstimada9 = 0;
				$diasEstimado1 = 0;			
				$diasEstimado2 = 0;			
				$diasEstimado3 = 0;			
				$diasEstimado4 = 0;			
				$diasEstimado5 = 0;			
				$diasEstimado6 = 0;			
				$diasEstimado7 = 0;			
				$diasEstimado8 = 0;			
				$diasEstimado9 = 0;
				$totalHorasOdt1 = 0;			
				$totalHorasOdt2 = 0;			
				$totalHorasOdt3 = 0;			
				$totalHorasOdt4 = 0;			
				$totalHorasOdt5 = 0;			
				$totalHorasOdt6 = 0;			
				$totalHorasOdt7 = 0;			
				$totalHorasOdt8 = 0;			
				$totalHorasOdt9 = 0;		
				$totalHorasSc = 0;
				$actualizaAdn ="";
				$adn ="";
				$aplicacionPlat ="";
				$area1 ="";
				$area2 ="";
				$area3 ="";
				$area4 ="";
				$area5 ="";
				$area6 ="";
				$area7 ="";
				$area8 ="";
				$area9 ="";
				$asignacion1 ="";
				$asignacion2 ="";
				$asignacion3 ="";
				$asignacion4 ="";
				$asignacion5 ="";
				$asignacion6 ="";
				$asignacion7 ="";
				$asignacion8 ="";
				$asignacion9 ="";
				$cambiosADN ="";
				$corregirRequi ="";
				$cotizacionAcep ="";
				$dentroADN ="";
				$dentroPOE ="";
				$dependenciaAre ="";
				$fechaAceptacion ="";
				$fechaBorrador ="";
				$fechaEntrega ="";
				$fechaEstimacion ="";
				$fechaLiberacion ="";
				$fechaOdt1 ="";
				$fechaOdt2 ="";
				$fechaOdt3 ="";
				$fechaOdt4 ="";
				$fechaOdt5 ="";
				$fechaOdt6 ="";
				$fechaOdt7 ="";
				$fechaOdt8 ="";
				$fechaOdt9 ="";
				$fechaRecepcion ="";
				$fechaDeseada ="";
				$fechaEstimada1 ="";
				$fechaEstimada2 ="";
				$fechaEstimada3 ="";
				$fechaEstimada4 ="";
				$fechaEstimada5 ="";
				$fechaEstimada6 ="";
				$fechaEstimada7 ="";
				$fechaEstimada8 ="";
				$fechaEstimada9 ="";
				$interpretacion ="";
				$medio ="";
				$motivoCancelacion ="";
				$motivoReestimacion ="";
				$necesidad ="";
				$cotizacion ="";
				$odt1 ="";
				$odt2 ="";
				$odt3 ="";
				$odt4 ="";
				$odt5 ="";
				$odt6 ="";
				$odt7 ="";
				$odt8 ="";
				$odt9 ="";
				$observacionesReq ="";
				$obsercacionesCie ="";
				$requisitosConfir ="";
				$requisitosTarea1 ="";
				$requisitosTarea2 ="";
				$requisitosTarea3 ="";
				$requisitosTarea4 ="";
				$requisitosTarea5 ="";
				$requisitosTarea6 ="";
				$requisitosTarea7 ="";
				$requisitosTarea8 ="";
				$requisitosTarea9 ="";
				$resultadoAceptado ="";
				$tarea1 ="";
				$tarea2 ="";
				$tarea3 ="";
				$tarea4 ="";
				$tarea5 ="";
				$tarea6 ="";
				$tarea7 ="";
				$tarea8 ="";
				$tarea9 ="";
				$last_action = "";
				$datecreated = "";



				if (isset($Payload['task_name'])) {
					$TareaActual = $Payload['task_name'];
				}

				if (isset($Payload['last_action'])) {
					$last_action = $Payload['last_action'];
					if ($last_action == 'ODT Programada' || $last_action == 'Entregar al solicitante' || $last_action == 'Cliente notificado' || $last_action == 'Abrir ODT') {
						//$actionerrorid = 3 ;
					}
					//echo $last_action;
				}
				

				
				if (isset($proceso)) {
					if (substr($proceso,0, 2) == "SC") {
						$type = "SC";
						if ($peticion != 'task_complete') {
							$horasarr = 90;
							$cuentanum = 11;
							$programanum = 12;
							$clasificacionnum = 20;
							$areanum = 96;
							$infonum = 25;
							//Tabla FlokzuSc
							$creador = $Payload['documentCreator'];
							$datecreated = $Payload['dateCreated'];
						}

						//$actionerrorid = 0;
					}else if(substr($proceso,0, 3) == "HDT"){
						$type = "HDT";
						if ($peticion != 'task_complete') {
							$horasarr = 23;
							$cuentanum = 16;
							$programanum = 17;
							$clasificacionnum = 14;
							$areanum = 15;
							$infonum = 19;

							$creador = $Payload['documentCreator'];
							$datecreated = $Payload['dateCreated'];
							}

						//$actionerrorid = 0;
					}else if (substr($proceso,0, 3) == "ODT") {
						$type = "ODT";
						if ($peticion != 'task_complete') {
							$horasarr = 57;
							$cuentanum = 10;
							$programanum = 11;
							$clasificacionnum = 14;
							$areanum = 39;
							$infonum = 16;

							$creador = $Payload['documentCreator'];
							$datecreated = $Payload['dateCreated'];
						}

						//$actionerrorid = 0;
					}else if (substr($proceso,0, 2) == "RT" || substr($proceso,0, 2) == "ER") {
						$type = "RT";
						if (substr($proceso,0, 2) == "ER") {
							$type = "ER";

						}
						if ($peticion != 'task_complete') {

							$creador 		= $Payload['documentCreator'];
							$datecreated 	= $Payload['dateCreated'];
							$informacion 	= $Payload['info'];
							$tags 			= $Payload['tags'];
							$tags = json_encode($tags);
							
						}

						//$actionerrorid = 0;
					}else if (substr($proceso,0, 3) == "BUG") {
						$type = "BUG";
						if ($peticion != 'task_complete') {

							$creador 		= $Payload['documentCreator'];
							$datecreated 	= $Payload['dateCreated'];
							$informacion 	= $Payload['info'];
							$tags 			= $Payload['tags'];
							$tags = json_encode($tags);
							
						}

						//$actionerrorid = 0;
					}
				}



				$fields = "";
				$horas = "";
				$horasdedicadas = array();
				if (isset($Payload['fields'])) {
					$fields = json_encode($Payload['fields']);
					//$fields2 = json_encode($Payload['fields']);
					$fields = str_replace('{','',$fields);
					$fields = str_replace('}','',$fields);
					//$fields = "-".$fields."-";
					$fields = str_replace('[','{',$fields);
					$fields = str_replace(']','}',$fields);
					$fields = json_decode($fields,TRUE);
					/*echo "<pre>";
					
					var_dump($fields["Horas dedicadas al HDT"]['Actividad']);
					echo "</pre>";
					exit();*/
				}
				if (!empty($fields) ) {
					$horasdedicadas = array();
					$cuenta 		= $fields['Cuenta'];
					$programa 		= $fields['Programa'];
					if (!empty($fields['Clasificación'])) {
						$clasificacion 	= $fields['Clasificación'];
					}
					
					if ($type == "HDT") {
						//Tabla Actividades
						$informacion 		= $fields['Información complementaria'];
						$area 				= $fields['Area'];

						//TABLA FLOKZUHDT

						$asignacion 		= $fields['Asignación'];
						$cadenaref			= $fields['Cadena de referencia'];
						$hdtRechazada		= $fields['HDT Rechazada'];
						$iniciadorProceso	= $fields['Iniciador del proceso'];
						$reprocesoHdt		= $fields['Reproceso de HDT'];
						$tarea				= $fields['Tarea'];
						$fechacierre 		= $fields['Fecha de cierre'];
						$cliente			= $fields['Cliente'];
						$estatus			= $fields['Estatus HDT'];
						$fechaSolicitud		= $fields['Fecha de solicitud'];
						$fechaEstimada		= $fields['Fecha estimada'];
						$horasDedicadasobj	= $fields['Horas dedicadas al HDT'];
						$horastotales		= $fields['Total de horas HDT'];
						$motivoRechazo		= $fields['Motivo de rechazo'];
						$fechaHoy 			= $fields['Fecha de hoy'];
						$horaActual 		= $fields['Hora actual'];
						$tipohdt			= $fields['Tipo HDT'];

						
					}

					if ($type == "RT") {
						//Tabla Actividades
						$area 			= $fields['Area'];
						

						//TABLA FLOKZUHDT

						$asignacion 		= "";//**
						$cadenaref			= "";//**
						$iniciadorProceso	= $fields['Iniciador del proceso'];
						$fechacierre 		= "";
						$cliente			= $fields['Cliente'];
						$estatus			= "Cerrado";
						$fechaSolicitud		= $fields['Fecha de registro'];
						$horasDedicadasobj	= $fields['Registro de horas'];
						$horastotales		= $fields['Total de horas'];
						$motivoRechazo		= "";

						
					}

					if ($type == "ER") {

						$fechaSolicitud		= $fields['Fecha de inicio'];
						$fechacierre 		= $fields['Fecha de cierre'];
						$cliente			= $fields['Cliente'];
						$eventocalendario	= $fields['Evento del calendario'];
						$fechaEntrega 		= $fields['Fecha de entrega'];
						$id 				= $fields['Id'];
						$tipoentregable		= $fields['Tipo de entregable'];
						$periodicidad		= $fields['Periodicidad'];
						$ejecutivoCuenta 	= $fields['Ejecutivo'];
						$nombreEntregable 	= $fields['Nombre del entregable'];
						$descripcion 		= $fields['Descripción'];
						$ejecutadopor		= $fields['Ejecutado por:'];
						$entregadopor 		= $fields['Entregado por:'];
						$medioentega 		= $fields['Medio de entrega'];
						$informacionRequerida	= $fields['Medio de entrega'];
						$duracion 			= 0;
						if (!empty($fields['Duración'])) {
							$duracion 		= $fields['Duración'];
						}
						$asignacion 		= $fields['Asignación'];
						$horasDedicadasobj	= $fields['Horas dedicadas'];
						$informacion 		= $fields['Descripción'];
						//$horastotales		= $fields['Total de horas'];
						$motivoRechazo		= "";
						$user 				= explode("@", $fields['Asignación'])[0];

						
					}


					if ($type == "BUG") {
						//Tabla Actividades
						$area 				= $fields['Area'];
						$informacion 		= $fields['Interpretación'];
						//TABLA FLOKZUBUG

						$cliente			= $fields['Cliente'];
						$fechaSolicitud		= $fields['Fecha de solicitud'];
						$fechacierre 		= $fields['Fecha de cierre'];
						$iniciadorProceso	= $fields['Iniciador del proceso'];
						$estatus 			= $fields['Estatus BUG'];
						$tarea				= $fields['Tarea'];
						$Severidad			= $fields['Severidad'];
						$DescripcionBreve	= $fields['Descripción breve'];
						$aplicacion			= $fields['Aplicación'];
						$Evidenciavisual 	= $fields['Evidencia visual'];
						$url 				= $fields['URL de aplicación Origis'];
						$url 				= str_replace("\\", "", $url);
						if (!empty($fields['Tipo de BUG'])) {
							$tipobug		= $fields['Tipo de BUG'];
						}else{
							$tipobug  		= "";
						}
						$Documentacion 		= $fields['Documentación'];
						$Solucion 			= $fields['Solución'];
						$causa 				= $fields['Causa'];
						$horasDedicadasobj	= $fields['Registro de horas'];
						$horastotales		= $fields['Total de horas'];
						$confirmacionBug	= $fields['Confirmación Bug'];

						
					}

					if ($type == "ODT") {
						$informacion 		= $fields['Interpretación'];
						$area 				= $fields['Area'];

						//Tabla FlokzuOdt
						if (!empty($fields['Duración estimada'])) {
							$duracionEstimada 	= $fields['Duración estimada'];
						}
						if (!empty($fields['Duración estimada ODT'])) {
							$duracionEstimadaOdt = $fields['Duración estimada ODT'];
						}
						if (!empty($fields['Días de iniciada'])) {
							$diasIniciada 		= $fields['Días de iniciada'];
						}
						if (!empty($fields['Días estimados'])) {
							$diasEstimados	 	= $fields['Días estimados'];
						}

						$ejecutivoCuenta 	= $fields['Ejecutivo de Cuenta'];
						$fechaApertura 		= $fields['Fecha de apertura'];
						$fechaTermino	 	= $fields['Fecha de término'];
						$noSc 				= $fields['No. de Solicitud'];
						$requisitoTarea 	= $fields['Requisitos de Tarea'];
						$descripcion		= $fields['Descripción de funcionalidad'];
						$fechacierre 		= $fields['Fecha de cierre'];
						$clasificacionDes	= $fields['Clasificación del desarrollo'];
						$cliente			= $fields['Cliente'];
						$contacto			= $fields['Contacto de soporte TI'];
						$enEsperaDe			= $fields['En espera de:'];
						$estatus			= $fields['Estatus'];
						$fechaSolicitud		= $fields['Fecha de Solicitud'];
						$fechaEstimada		= $fields['Fecha estimada'];
						$frecuenciaReporte	= $fields['Frecuencia del reporte'];
						$horasDedicadasobj	= $fields['Horas dedicadas a la ODT'];
						if (!empty($fields['Total de horas ODT'])) {
							$horastotales		= $fields['Total de horas ODT'];
						}
						$medio				= $fields['Medio'];
						$sistemaInvolucrado	= $fields['Sistema involucrado'];
						$situacionActual	= $fields['Situación actual'];
						$asignacion 		= $fields['Asignación'];
						$cadenaref			= $fields['Nombre de cadena'];
						$tarea				= $fields['Tarea'];


					}
					if ($type == "SC") {
						$informacion 		= $fields['Interpretación'];
						$area 				= $fields['Area 1'];

						//Tabla FlokzuSc
						$fechacierre 		= $fields['Fecha de cierre'];
						$actualizaAdn		= $fields['Actualizar ADN'];
						$adn				= $fields['ADN'];
						$aplicacionPlat		= $fields['Aplicación o Plataforma'];
						$area1				= $fields['Area 1'];
						$area2				= $fields['Area 2'];
						$area3				= $fields['Area 3'];
						$area4				= $fields['Area 4'];
						$area5				= $fields['Area 5'];
						$area6				= $fields['Area 6'];
						$area7				= $fields['Area 7'];
						$area8				= $fields['Area 8'];
						$area9				= $fields['Area 9'];
						$asignacion1		= $fields['Asignación 1'];
			            $asignacion2		= $fields['Asignación 2'];
			            $asignacion3		= $fields['Asignación 3'];
			            $asignacion4		= $fields['Asignación 4'];
			            $asignacion5		= $fields['Asignación 5'];
			            $asignacion6		= $fields['Asignación 6'];
			            $asignacion7		= $fields['Asignación 7'];
			            $asignacion8		= $fields['Asignación 8'];
			            $asignacion9		= $fields['Asignación 9'];
			            $cambiosADN			= $fields['Cambios al ADN'];
			            $clasificacionDes	= $fields['Clasificación del desarrollo'];
			            $cliente			= $fields['Cliente'];
			            $contacto			= $fields['Contacto'];
			            $corregirRequi		= $fields['Corregir requisitos'];
			            $cotizacionAcep		= $fields['Cotización aceptada'];
						$dentroADN			= $fields['Dentro de ADN'];
						$SolicitarEstimacion= $fields['Solicitar estimación a:'];
						$dentroPOE			= $fields['Dentro de POE'];
						$dependenciaAre		= $fields['Dependencia de áreas'];
						$descripcion		= $fields['Descripción de funcionalidad'];

						if (!empty($fields['Duración estimada 1'])) {
							$duracionEstimada1	= $fields['Duración estimada 1'];
						}
						if (!empty($fields['Duración estimada 2'])) {
			           		$duracionEstimada2	= $fields['Duración estimada 2'];
						}
			           	if (!empty($fields['Duración estimada 3'])) {
			           		$duracionEstimada3	= $fields['Duración estimada 3'];
						}
			           	if (!empty($fields['Duración estimada 4'])) {
			           		$duracionEstimada4	= $fields['Duración estimada 4'];
						}
			           	if (!empty($fields['Duración estimada 5'])) {
			           		$duracionEstimada5	= $fields['Duración estimada 5'];
						}
			           	if (!empty($fields['Duración estimada 6'])) {
			           		$duracionEstimada6	= $fields['Duración estimada 6'];
						}
			           	if (!empty($fields['Duración estimada 7'])) {
			           		$duracionEstimada7	= $fields['Duración estimada 7'];
						}
			           	if (!empty($fields['Duración estimada 8'])) {
			           		$duracionEstimada8	= $fields['Duración estimada 8'];
						}
			           	if (!empty($fields['Duración estimada 9'])) {
			           		$duracionEstimada9	= $fields['Duración estimada 9'];
						}
			           		$diasEstimado1		= $fields['Días estimados 1'];
							$diasEstimado2		= $fields['Días estimados 2'];
							$diasEstimado3		= $fields['Días estimados 3'];
							$diasEstimado4		= $fields['Días estimados 4'];
							$diasEstimado5		= $fields['Días estimados 5'];
							$diasEstimado6		= $fields['Días estimados 6'];
							$diasEstimado7		= $fields['Días estimados 7'];
							$diasEstimado8		= $fields['Días estimados 8'];
							$diasEstimado9		= $fields['Días estimados 9'];
						$enEsperaDe			= $fields['En espera de:'];
						$estatus			= $fields['Estatus de SC'];
						$fechaAceptacion	= $fields['Fecha de aceptación'];
						$fechaBorrador		= $fields['Fecha de borrador'];
						$fechaEntrega		= $fields['Fecha de entrega'];
						$fechaEstimacion	= $fields['Fecha de estimación'];
						$fechaLiberacion	= $fields['Fecha de liberación'];
						$fechaOdt1			= $fields['Fecha de ODT 1'];
						$fechaOdt2			= $fields['Fecha de ODT 2'];
						$fechaOdt3			= $fields['Fecha de ODT 3'];
						$fechaOdt4			= $fields['Fecha de ODT 4'];
						$fechaOdt5			= $fields['Fecha de ODT 5'];
						$fechaOdt6			= $fields['Fecha de ODT 6'];
						$fechaOdt7			= $fields['Fecha de ODT 7'];
						$fechaOdt8			= $fields['Fecha de ODT 8'];
						$fechaOdt9			= $fields['Fecha de ODT 9'];
						$fechaRecepcion		= $fields['Fecha de recepción'];
						$fechaSolicitud		= $fields['Fecha de solicitud'];
						$fechaDeseada		= $fields['Fecha deseable'];
						$fechaEstimada		= $fields['Fecha estimada'];
						$fechaEstimada1		= $fields['Fecha estimada 1'];
						$fechaEstimada2		= $fields['Fecha estimada 2'];
						$fechaEstimada3		= $fields['Fecha estimada 3'];
						$fechaEstimada4		= $fields['Fecha estimada 4'];
						$fechaEstimada5		= $fields['Fecha estimada 5'];
						$fechaEstimada6		= $fields['Fecha estimada 6'];
						$fechaEstimada7		= $fields['Fecha estimada 7'];
						$fechaEstimada8		= $fields['Fecha estimada 8'];
						$fechaEstimada9		= $fields['Fecha estimada 9'];
						$frecuenciaReporte	= $fields['Frecuencia del reporte'];
						$horasDedicadasobj	= $fields['Horas dedicadas a la Solicitud'];
						$horastotales		= $fields['Horas totales'];
						$interpretacion		= $fields['Interpretación'];
						$medio				= $fields['Medio'];
						$motivoCancelacion	= $fields['Motivo de cancelación'];
						$motivoRechazo		= $fields['Motivo de rechazo'];
						$motivoReestimacion	= $fields['Motivo de reestimación'];
						if (!empty($fields['Necesidad'])) {
							$necesidad			= $fields['Necesidad'];
						}
						$cotizacion			= $fields['No. de Cotización'];
						$odt1				= $fields['No. ODT 1'];
						$odt2				= $fields['No. ODT 2'];
						$odt3				= $fields['No. ODT 3'];
						$odt4				= $fields['No. ODT 4'];
						$odt5				= $fields['No. ODT 5'];
						$odt6				= $fields['No. ODT 6'];
						$odt7				= $fields['No. ODT 7'];
						$odt8				= $fields['No. ODT 8'];
						$odt9				= $fields['No. ODT 9'];
						$observacionesReq	= $fields['Observaciones a requisitos'];
						$obsercacionesCie	= $fields['Observaciones de cierre'];
						$requisitosConfir	= $fields['Requisitos confirmados por el solicitante'];
						$requisitosTarea1	= $fields['Requisitos de Tarea 1'];
						$requisitosTarea2	= $fields['Requisitos de Tarea 2'];
						$requisitosTarea3	= $fields['Requisitos de Tarea 3'];
						$requisitosTarea4	= $fields['Requisitos de Tarea 4'];
						$requisitosTarea5	= $fields['Requisitos de Tarea 5'];
						$requisitosTarea6	= $fields['Requisitos de Tarea 6'];
						$requisitosTarea7	= $fields['Requisitos de Tarea 7'];
						$requisitosTarea8	= $fields['Requisitos de Tarea 8'];
						$requisitosTarea9	= $fields['Requisitos de Tarea 9'];
						$resultadoAceptado	= $fields['Resultado aceptado por el solicitante'];
						$sistemaInvolucrado	= $fields['Sistema involucrado'];
						$situacionActual	= $fields['Situación actual'];
						$tarea1				= $fields['Tarea 1'];
						$tarea2				= $fields['Tarea 2'];
						$tarea3				= $fields['Tarea 3'];
						$tarea4				= $fields['Tarea 4'];
						$tarea5				= $fields['Tarea 5'];
						$tarea6				= $fields['Tarea 6'];
						$tarea7				= $fields['Tarea 7'];
						$tarea8				= $fields['Tarea 8'];
						$tarea9				= $fields['Tarea 9'];
						if (!empty($fields['Total de horas ODT 1'])) {
							$totalHorasOdt1		= $fields['Total de horas ODT 1'];
						}
						if (!empty($fields['Total de horas ODT 2'])) {
							$totalHorasOdt2		= $fields['Total de horas ODT 2'];
						}
						if (!empty($fields['Total de horas ODT 3'])) {
							$totalHorasOdt3		= $fields['Total de horas ODT 3'];
						}
						if (!empty($fields['Total de horas ODT 4'])) {
							$totalHorasOdt4		= $fields['Total de horas ODT 4'];
						}
						if (!empty($fields['Total de horas ODT 5'])) {
							$totalHorasOdt5		= $fields['Total de horas ODT 5'];
						}
						if (!empty($fields['Total de horas ODT 6'])) {
							$totalHorasOdt6		= $fields['Total de horas ODT 6'];
						}
						if (!empty($fields['Total de horas ODT 7'])) {
							$totalHorasOdt7		= $fields['Total de horas ODT 7'];
						}
						if (!empty($fields['Total de horas ODT 8'])) {
							$totalHorasOdt8		= $fields['Total de horas ODT 8'];
						}
						if (!empty($fields['Total de horas ODT 9'])) {
							$totalHorasOdt9		= $fields['Total de horas ODT 9'];
						}
						if (!empty($fields['Total de horas SC'])) {
							$totalHorasSc		= $fields['Total de horas SC'];
						}
						$cadena					= $fields['Nombre de cadena'];
						$tiposc					= $fields['Tipo de SC'];
						$pr 					= $fields['PR'];

					}
				}

		} else {
			$actionerrorid = 1;
		}
	

					// --------------------------------------------------
					// LOG INIT
							$bitacoraid = "0";
							$items = 0;
							$query = " EXEC usp_pos_OperationsLogsManage
									 'BEGIN', '".$webservice."',
									 '".$key."', '".getCurrentPageScript()."',
									 '1','999',
									 '0', '0',
									 'FLOKZU', '0',
									 '".$actionerrorid."',
									 'request=".str_replace("'","",json_encode($request,true))."',
									 '".$_SERVER['REMOTE_ADDR']."', 'JSON', '".$bitacoraid."';";
							//echo $query; exit;
							$dboperaciones->query($query);
							$items = $dboperaciones->count_rows();
							if ($items > 0) {
							    $my_row = $dboperaciones->get_row();
							    $bitacoraid = $my_row['OperationLogId'];
							}
					// --------------------------------------------------



		$actividad 	= "";
		$horas 		= "";
		$usuario 	= "";
		$fecha 		= "";
		if ($peticion == "task_complete"){
			$operation = $peticion;
		}else{
			$operation = "add";
		}
		$n = 0;
		

		if ($actionerrorid == 0) {

			//$ab = $horasdedicadas->{"Horas dedicadas al HDT"};
			if ($type == "SC" && $peticion != 'task_complete') {
				$ab = "Horas dedicadas a la Solicitud";
			}else if($type == "HDT" && $peticion != 'task_complete'){
				$ab = "Horas dedicadas al HDT";
			}else if($type == "ODT" && $peticion != 'task_complete'){
				$ab = "Horas dedicadas a la ODT";
			}else if($type == "RT" && $peticion != 'task_complete'){
				$ab = "Registro de horas";
			}else if($type == "BUG" && $peticion != 'task_complete'){
				$ab = "Registro de horas";
			}else if($type == "ER" && $peticion != 'task_complete'){
				$ab = "Horas dedicadas";
			}


			



			if ($peticion != 'task_complete') {
				$array = json_decode(json_encode($request['Payload']['fields']), true);

				$query = " EXEC dbo.usp_app_Flokzu 
					'delete', 
					'',
					'4',
					'".$proceso."';";
				$dboperaciones->query($query);

				foreach($array as $valor) {

				    foreach($valor as $clave => $actividad) {

				      if ($clave == $ab) {
				      	$horasDedicadasobj = json_encode($actividad);
				        foreach ($actividad as $totaldehoras) {
				          
				          	$actionerrorid = 0;
							if ($totaldehoras['Actividad'] != '') {
								$actividad = $totaldehoras['Actividad'];	
							}else{
								$actionerrorid = 2;
							}
							if ($totaldehoras['Horas'] != '') {
								$horas = $totaldehoras['Horas'];
							}else{
								$actionerrorid = 2;
							}
							if ($totaldehoras['Usuario'] != '') {
								$usuario = $totaldehoras['Usuario'];
							}else{
								$actionerrorid = 2;
							}
							if ($totaldehoras['Fecha'] != '') {
								$fecha = $totaldehoras['Fecha'];
							}else{
								$actionerrorid = 2;
							}


							if ($actionerrorid == 0 && $peticion == 'save') {

								$query = " EXEC dbo.usp_app_Flokzu 
								'".$operation."', 
								'',
								'4',
								'".$proceso."',
								'".utf8_decode($cuenta)."',  
								'".utf8_decode($programa)."',  
								'".utf8_decode($clasificacion)."',    
								'".utf8_decode($area)."',  
								'".$type."',  
								'".utf8_decode($actividad)."',  
								'".$horas."',  
								'".$usuario."',  
								'".$fecha."',
								'".utf8_decode($informacion)."';";
								//echo $query."<br>";

								$dboperaciones->query($query);
							}



				        }
				      }
				    }
				}

			}

						

			if ($type == "SC") {

				if ($peticion == "task_complete"){
					$operation = $peticion;
					if (isset($Payload['end_date'])) {
						$fechacierre = $Payload['end_date'];
					}
				}else{
					$operation = "addsc";
				}

				$query = " EXEC dbo.usp_app_Flokzu 
							'".$operation."',
							'',
							'4',
							'".$proceso."',			
							'".$cuenta."',					
							'".utf8_decode($programa)."',				
							'".utf8_decode($clasificacion)."',			
							'".utf8_decode($area)."',					
							'".$type."',					
							'".utf8_decode($actividad)."',				
							'".$horas."',					
							'".utf8_decode($usuario)."',				
							'".$datecreated."',					
							'".utf8_decode($descripcion)."',			
							'".$creador."',				
							'".$fechacierre."',			
							'".$actualizaAdn."',			
							'".$adn."',					
							'".$aplicacionPlat."',	     
							'".utf8_decode($area1)."',					
							'".utf8_decode($area2)."',					
							'".utf8_decode($area3)."',					
							'".utf8_decode($area4)."',					
							'".utf8_decode($area5)."',					
							'".utf8_decode($area6)."',					
							'".utf8_decode($area7)."',					
							'".utf8_decode($area8)."',					
							'".utf8_decode($area9)."',					
							'".$asignacion1."',			
							'".$asignacion2."',			
							'".$asignacion3."',			
							'".$asignacion4."',			
							'".$asignacion5."',			
							'".$asignacion6."',			
							'".$asignacion7."',			
							'".$asignacion8."',			
							'".$asignacion9."',			
							'".$cambiosADN."',				
							'".utf8_decode($clasificacionDes)."',	  
							'".$cliente."',				
							'".utf8_decode($contacto)."',				
							'".$corregirRequi."',	       
							'".$cotizacionAcep."',	       
							'".$dentroADN."',				
							'".$dentroPOE."',				
							'".$dependenciaAre."',		
							'".$duracionEstimada1."',	        
							'".$duracionEstimada2."',	        
							'".$duracionEstimada3."',	        
							'".$duracionEstimada4."',	        
							'".$duracionEstimada5."',	        
							'".$duracionEstimada6."',	        
							'".$duracionEstimada7."',	        
							'".$duracionEstimada8."',	        
							'".$duracionEstimada9."',	        
							'".$diasEstimado1."',			
							'".$diasEstimado2."',			
							'".$diasEstimado3."',			
							'".$diasEstimado4."',			
							'".$diasEstimado5."',			
							'".$diasEstimado6."',			
							'".$diasEstimado7."',			
							'".$diasEstimado8."',			
							'".$diasEstimado9."',			
							'".$enEsperaDe."',				
							'".utf8_decode($estatus)."',			
							'".$fechaAceptacion."',		
							'".$fechaBorrador."',			
							'".$fechaEntrega."',			
							'".$fechaEstimacion."',		
							'".$fechaLiberacion."',		
							'".$fechaOdt1."',				
							'".$fechaOdt2."',				
							'".$fechaOdt3."',				
							'".$fechaOdt4."',				
							'".$fechaOdt5."',				
							'".$fechaOdt6."',				
							'".$fechaOdt7."',				
							'".$fechaOdt8."',				
							'".$fechaOdt9."',				
							'".$fechaRecepcion."',			
							'".$fechaSolicitud."',			
							'".$fechaDeseada."',			
							'".$fechaEstimada."',			
							'".$fechaEstimada1."',			
							'".$fechaEstimada2."',			
							'".$fechaEstimada3."',			
							'".$fechaEstimada4."',			
							'".$fechaEstimada5."',			
							'".$fechaEstimada6."',			
							'".$fechaEstimada7."',			
							'".$fechaEstimada8."',			
							'".$fechaEstimada9."',			
							'".$frecuenciaReporte."',	        
							'".str_replace('\\','', $horasDedicadasobj)."',		
							'".$horastotales."',			
							'".utf8_decode($interpretacion)."',			
							'".$medio."',					
							'".$motivoCancelacion."',	        
							'".$motivoRechazo."',			
							'".$motivoReestimacion."',	       
							'".$necesidad."',				
							'".$cotizacion."',				
							'".$odt1."',					
							'".$odt2."',					
							'".$odt3."',					
							'".$odt4."',					
							'".$odt5."',					
							'".$odt6."',					
							'".$odt7."',					
							'".$odt8."',					
							'".$odt9."',					
							'".utf8_decode($observacionesReq)."',		
							'".$obsercacionesCie."',	      
							'".$requisitosConfir."',	    
							'".utf8_decode($requisitosTarea1)."',		
							'".utf8_decode($requisitosTarea2)."',		
							'".utf8_decode($requisitosTarea3)."',		
							'".utf8_decode($requisitosTarea4)."',		
							'".utf8_decode($requisitosTarea5)."',		
							'".utf8_decode($requisitosTarea6)."',		
							'".utf8_decode($requisitosTarea7)."',		
							'".utf8_decode($requisitosTarea8)."',		
							'".utf8_decode($requisitosTarea9)."',		
							'".$resultadoAceptado."',	
							'".utf8_decode($sistemaInvolucrado)."',	      
							'".utf8_decode($situacionActual)."',	
							'".utf8_decode($tarea1)."',					
							'".utf8_decode($tarea2)."',					
							'".utf8_decode($tarea3)."',					
							'".utf8_decode($tarea4)."',					
							'".utf8_decode($tarea5)."',					
							'".utf8_decode($tarea6)."',					
							'".utf8_decode($tarea7)."',					
							'".utf8_decode($tarea8)."',					
							'".utf8_decode($tarea9)."',					
							'".$totalHorasOdt1."',			
							'".$totalHorasOdt2."',			
							'".$totalHorasOdt3."',			
							'".$totalHorasOdt4."',			
							'".$totalHorasOdt5."',			
							'".$totalHorasOdt6."',			
							'".$totalHorasOdt7."',			
							'".$totalHorasOdt8."',			
							'".$totalHorasOdt9."',			
							'".$totalHorasSc."',
							'',
							'',
							'',
							'',
							'',
							'".utf8_decode($last_action)."',
							'',
							'',
							'',
							'',
							'',
							'',
							'',
							'',
							'',
							'',
							'',
							'".utf8_decode($SolicitarEstimacion)."',
							'".utf8_decode($tiposc)."',
							'".$pr."';";
							//echo $query;
							$dboperaciones->query($query);		
			}

			if ($type == "HDT") {

				if ($peticion == "task_complete"){
					$operation = $peticion;
					if (isset($Payload['end_date'])) {
						$fechacierre = $Payload['end_date'];
					}
				}else{
					$operation = "addhdt";
				}

				$query = " EXEC dbo.usp_app_Flokzu 
							'".$operation."',
							'',
							'4',
							'".utf8_decode($proceso)."',			
							'".utf8_decode($cuenta)."',					
							'".utf8_decode($programa)."',				
							'".utf8_decode($clasificacion)."',			
							'".utf8_decode($area)."',					
							'".$type."',					
							'',				
							'',					
							'',				
							'".$datecreated."',					
							'".utf8_decode($informacion)."',			
							'".$creador."',				
							'".$fechacierre."',			
							'',			
							'',					
							'',	     
							'',					
							'',					
							'',					
							'',					
							'',					
							'',					
							'',					
							'',					
							'',					
							'',			
							'',			
							'',			
							'',			
							'',			
							'',			
							'',			
							'',			
							'',			
							'',				
							'',	  
							'".$cliente."',				
							'',				
							'',	       
							'',	       
							'',				
							'',				
							'',		
							'',	        
							'',	        
							'',	        
							'',	        
							'',	        
							'',	        
							'',	        
							'',	        
							'',	        
							'',			
							'',			
							'',			
							'',			
							'',			
							'',			
							'',			
							'',			
							'',			
							'',				
							'".utf8_decode($estatus)."',				
							'',		
							'',			
							'',			
							'',		
							'',		
							'',				
							'',				
							'',				
							'',				
							'',				
							'',				
							'',				
							'',				
							'',				
							'',			
							'".$fechaSolicitud."',			
							'',			
							'".$fechaEstimada."',			
							'',			
							'',			
							'',			
							'',			
							'',			
							'',			
							'',			
							'',			
							'',			
							'',	        
							'".str_replace('\\','', $horasDedicadasobj)."',		
							'".$horastotales."',			
							'',			
							'',					
							'',	        
							'".utf8_decode($motivoRechazo)."',			
							'',	       
							'',				
							'',				
							'',					
							'',					
							'',					
							'',					
							'',					
							'',					
							'',					
							'',					
							'',					
							'',		
							'',	      
							'',	    
							'',		
							'',		
							'',		
							'',		
							'',		
							'',		
							'',		
							'',		
							'',		
							'',	
							'',	      
							'".$tipohdt."',	
							'',					
							'',					
							'',					
							'',					
							'',					
							'',					
							'',					
							'',					
							'',					
							'',			
							'',			
							'',			
							'',			
							'',			
							'',			
							'',			
							'',			
							'',			
							'',
							'".utf8_decode($asignacion)."',
							'".utf8_decode($cadenaref)."',
							'".$hdtRechazada."',
							'".utf8_decode($iniciadorProceso)."',
							'".utf8_decode($reprocesoHdt)."',
							'".utf8_decode($tarea)."',
							'',
							'',
							'',
							'',
							'',
							'',
							'',
							'',
							'',
							'".$fechaHoy." ".$horaActual."';";
							//echo $query." hdt";
							$dboperaciones->query($query);		
			}

			if ($type == "ODT") {

				if ($peticion == "task_complete"){
					$operation = $peticion;
					if (isset($Payload['end_date'])) {
						$fechacierre = $Payload['end_date'];
					}
				}else{
					$operation = "addodt";
				}

				$query = " EXEC dbo.usp_app_Flokzu 
							'".$operation."',
							'',
							'4',
							'".$proceso."',			
							'".utf8_decode($cuenta)."',					
							'".utf8_decode($programa)."',				
							'".utf8_decode($clasificacion)."',			
							'".utf8_decode($area)."',					
							'".$type."',					
							'".utf8_decode($actividad)."',				
							'".$horas."',					
							'".utf8_decode($usuario)."',				
							'".$datecreated."',					
							'".utf8_decode($descripcion)."',			
							'".utf8_decode($creador)."',				
							'".$fechacierre."',			
							'',			
							'',					
							'',	     
							'',					
							'',					
							'',					
							'',					
							'',					
							'',					
							'',					
							'',					
							'',					
							'',			
							'',			
							'',			
							'',			
							'',			
							'',			
							'',			
							'',			
							'',			
							'',				
							'".utf8_decode($clasificacionDes)."',	  
							'".utf8_decode($cliente)."',				
							'".utf8_decode($contacto)."',				
							'',	       
							'',	       
							'',				
							'',				
							'',		
							'',	        
							'',	        
							'',	        
							'',	        
							'',	        
							'',	        
							'',	        
							'',	        
							'',	        
							'',			
							'',			
							'',			
							'',			
							'',			
							'',			
							'',			
							'',			
							'',			
							'".utf8_decode($enEsperaDe)."',				
							'".utf8_decode($estatus)."',				
							'',		
							'',			
							'',			
							'',		
							'',		
							'',				
							'',				
							'',				
							'',				
							'',				
							'',				
							'',				
							'',				
							'',				
							'',			
							'".$fechaSolicitud."',			
							'',			
							'".$fechaEstimada."',			
							'',			
							'',			
							'',			
							'',			
							'',			
							'',			
							'',			
							'',			
							'',			
							'".utf8_decode($frecuenciaReporte)."',	        
							'".str_replace('\\','', $horasDedicadasobj)."',		
							'".$horastotales."',			
							'".utf8_decode($informacion)."',			
							'',					
							'',	        
							'',			
							'',	       
							'',				
							'',				
							'',					
							'',					
							'',					
							'',					
							'',					
							'',					
							'',					
							'',					
							'',					
							'',		
							'',	      
							'',	    
							'',		
							'',		
							'',		
							'',		
							'',		
							'',		
							'',		
							'',		
							'',		
							'',	
							'".utf8_decode($sistemaInvolucrado)."',	      
							'".utf8_decode($situacionActual)."',	
							'',					
							'',					
							'',					
							'',					
							'',					
							'',					
							'',					
							'',					
							'',					
							'',			
							'',			
							'',			
							'',			
							'',			
							'',			
							'',			
							'',			
							'',			
							'',
							'".utf8_decode($asignacion)."',
							'".utf8_decode($cadenaref)."',
							'',
							'',
							'',
							'".utf8_decode($tarea)."',
							'".$duracionEstimada."',
							'".$duracionEstimadaOdt."',
							'".$diasIniciada."',
							'".$diasEstimados."',
							'".utf8_decode($ejecutivoCuenta)."',
							'".$fechaApertura."',
							'".$fechaTermino."',
							'".$noSc."',
							'".utf8_decode($requisitoTarea)."' ;";
							//echo $query;
							$dboperaciones->query($query);		
			}


			if ($type == "RT") {

				if ($peticion == "task_complete"){
					$operation = $peticion;
					if (isset($Payload['end_date'])) {
						$fechacierre = $Payload['end_date'];
					}
				}else{
					$operation = "addrt";
				}

				$query = " EXEC dbo.usp_app_Flokzu 
							'".$operation."',
							'',
							'4',
							'".utf8_decode($proceso)."',			
							'".utf8_decode($cuenta)."',					
							'".utf8_decode($programa)."',				
							'".utf8_decode($clasificacion)."',			
							'".utf8_decode($area)."',					
							'".$type."',					
							'".str_replace('\\','', $tags)."',				
							'',					
							'',				
							'".$datecreated."',					
							'".utf8_decode($informacion)."',			
							'".$creador."',				
							'".$fechacierre."',			
							'',			
							'',					
							'',	     
							'',					
							'',					
							'',					
							'',					
							'',					
							'',					
							'',					
							'',					
							'',					
							'',			
							'',			
							'',			
							'',			
							'',			
							'',			
							'',			
							'',			
							'',			
							'',				
							'',	  
							'".$cliente."',				
							'',				
							'',	       
							'',	       
							'',				
							'',				
							'',		
							'',	        
							'',	        
							'',	        
							'',	        
							'',	        
							'',	        
							'',	        
							'',	        
							'',	        
							'',			
							'',			
							'',			
							'',			
							'',			
							'',			
							'',			
							'',			
							'',			
							'',				
							'".utf8_decode($estatus)."',				
							'',		
							'',			
							'',			
							'',		
							'',		
							'',				
							'',				
							'',				
							'',				
							'',				
							'',				
							'',				
							'',				
							'',				
							'',			
							'".$fechaSolicitud."',			
							'',			
							'',			
							'',			
							'',			
							'',			
							'',			
							'',			
							'',			
							'',			
							'',			
							'',			
							'',	        
							'".str_replace('\\','', $horasDedicadasobj)."',		
							'".$horastotales."',			
							'',			
							'',					
							'',	        
							'',			
							'',	       
							'',				
							'',				
							'',					
							'',					
							'',					
							'',					
							'',					
							'',					
							'',					
							'',					
							'',					
							'',		
							'',	      
							'',	    
							'',		
							'',		
							'',		
							'',		
							'',		
							'',		
							'',		
							'',		
							'',		
							'',	
							'',	      
							'',	
							'',					
							'',					
							'',					
							'',					
							'',					
							'',					
							'',					
							'',					
							'',					
							'',			
							'',			
							'',			
							'',			
							'',			
							'',			
							'',			
							'',			
							'',			
							'',
							'',
							'',
							'',
							'".utf8_decode($iniciadorProceso)."',
							'',
							'',
							'',
							'',
							'',
							'',
							'',
							'',
							'',
							'',
							'',
							'';";
							//echo $query;
							$dboperaciones->query($query);		
			}

			if ($type == "BUG") {

				if ($peticion == "task_complete"){
					$operation = $peticion;
					if (isset($Payload['end_date'])) {
						$fechacierre = $Payload['end_date'];
					}
				}else{
					$operation = "addbug";
				}

				$query = " EXEC dbo.usp_app_Flokzu 
							'".$operation."',
							'4',
							'',
							'".utf8_decode($proceso)."',			
							'".utf8_decode($cuenta)."',					
							'".utf8_decode($programa)."',				
							'".utf8_decode($clasificacion)."',			
							'".utf8_decode($area)."',					
							'".$type."',					
							'".str_replace('\\','', $tags)."',				
							'',					
							'',				
							'".$datecreated."',					
							'".utf8_decode($informacion)."',			
							'".utf8_decode($creador)."',				
							'".$fechacierre."',			
							'',			
							'',					
							'".$aplicacion."',	     
							'',					
							'',					
							'',					
							'',					
							'',					
							'',					
							'',					
							'',					
							'',					
							'',			
							'',			
							'',			
							'',			
							'',			
							'',			
							'',			
							'',			
							'',			
							'',				
							'',	  
							'".$cliente."',				
							'',				
							'',	       
							'',	       
							'',				
							'',				
							'',		
							'',	        
							'',	        
							'',	        
							'',	        
							'',	        
							'',	        
							'',	        
							'',	        
							'',	        
							'',			
							'',			
							'',			
							'',			
							'',			
							'',			
							'',			
							'',			
							'',			
							'',				
							'".utf8_decode($estatus)."',				
							'',		
							'',			
							'',			
							'',		
							'',		
							'',				
							'',				
							'',				
							'',				
							'',				
							'',				
							'',				
							'',				
							'',				
							'',			
							'".$fechaSolicitud."',			
							'',			
							'',			
							'',			
							'',			
							'',			
							'',			
							'',			
							'',			
							'',			
							'',			
							'',			
							'',	        
							'".str_replace('\\','', $horasDedicadasobj)."',		
							'".$horastotales."',			
							'',			
							'',					
							'',	        
							'',			
							'',	       
							'',				
							'',				
							'',					
							'',					
							'',					
							'',					
							'',					
							'',					
							'',					
							'',					
							'',					
							'',		
							'',	      
							'',	    
							'',		
							'',		
							'',		
							'',		
							'',		
							'',		
							'',		
							'',		
							'',		
							'',	
							'',	      
							'".utf8_decode($tipobug)."',	
							'',					
							'',					
							'',					
							'',					
							'',					
							'',					
							'',					
							'',					
							'',					
							'',			
							'',			
							'',			
							'',			
							'',			
							'',			
							'',			
							'',			
							'',			
							'',
							'',
							'',
							'',
							'".utf8_decode($iniciadorProceso)."',
							'',
							'".utf8_decode($tarea)."',
							'',
							'',
							'',
							'',
							'',
							'',
							'',
							'',
							'',
							'',
							'',
							'',
							'".utf8_decode($Severidad)."',
							'".utf8_decode($DescripcionBreve)."',
							'".utf8_decode($Evidenciavisual)."',
							'".utf8_decode($url)."',
							'".utf8_decode($Documentacion)."',
							'".utf8_decode($Solucion)."',
							'".utf8_decode($causa)."',
							'".$confirmacionBug."',
							'',
							'';";
							//echo $query;
							$dboperaciones->query($query);		
			}


			if ($type == "ER") {

				if ($peticion == "task_complete"){
					$operation = $peticion;
					if (isset($Payload['end_date'])) {
						$fechacierre = $Payload['end_date'];
					}
				}else{
					$operation = "adder";
				}

				$query = " EXEC dbo.usp_app_Flokzu 
							'".$operation."',
							'4',
							'',
							'".utf8_decode($proceso)."',			
							'".utf8_decode($cuenta)."',					
							'".utf8_decode($programa)."',				
							'".utf8_decode($clasificacion)."',			
							'".utf8_decode($area)."',					
							'".$type."',					
							'".str_replace('\\','', $tags)."',				
							'',					
							'',				
							'".$datecreated."',					
							'".utf8_decode($descripcion)."',			
							'".utf8_decode($creador)."',				
							'".$fechacierre."',			
							'',			
							'',					
							'',	     
							'',					
							'',					
							'',					
							'',					
							'',					
							'',					
							'',					
							'',					
							'',					
							'',			
							'',			
							'',			
							'',			
							'',			
							'',			
							'',			
							'',			
							'',			
							'',				
							'',	  
							'".$cliente."',				
							'',				
							'',	       
							'',	       
							'',				
							'',				
							'',		
							'',	        
							'',	        
							'',	        
							'',	        
							'',	        
							'',	        
							'',	        
							'',	        
							'',	        
							'',			
							'',			
							'',			
							'',			
							'',			
							'',			
							'',			
							'',			
							'',			
							'',				
							'".utf8_decode($estatus)."',				
							'',		
							'',			
							'".$fechaEntrega."',			
							'',		
							'',		
							'',				
							'',				
							'',				
							'',				
							'',				
							'',				
							'',				
							'',				
							'',				
							'',			
							'".$fechaSolicitud."',			
							'',			
							'',			
							'',			
							'',			
							'',			
							'',			
							'',			
							'',			
							'',			
							'',			
							'',			
							'',	        
							'".str_replace('\\','', $horasDedicadasobj)."',		
							'".$horastotales."',			
							'',			
							'',					
							'',	        
							'',			
							'',	       
							'',				
							'',				
							'',					
							'',					
							'',					
							'',					
							'',					
							'',					
							'',					
							'',					
							'',					
							'',		
							'',	      
							'',	    
							'',		
							'',		
							'',		
							'',		
							'',		
							'',		
							'',		
							'',		
							'',		
							'',	
							'',	      
							'".utf8_decode($tipoentregable)."',	
							'',					
							'',					
							'',					
							'',					
							'',					
							'',					
							'',					
							'',					
							'',					
							'',			
							'',			
							'',			
							'',			
							'',			
							'',			
							'',			
							'',			
							'',			
							'',
							'".utf8_decode($asignacion)."',
							'',
							'',
							'',
							'',
							'',
							'".$duracion."',
							'',
							'',
							'',
							'".utf8_decode($ejecutivoCuenta)."',
							'',
							'',
							'',
							'',
							'',
							'',
							'',
							'".$eventocalendario."',
							'".$id."',
							'".$periodicidad."',
							'".utf8_decode($nombreEntregable)."',
							'".utf8_decode($ejecutadopor)."',
							'".utf8_decode($entregadopor)."',
							'".utf8_decode($medioentega)."',
							'".$informacionRequerida."',
							'".$user."',
							'';";
							//echo $query;
							$dboperaciones->query($query);		
			}


		}


		$response = array();

		// --------------------------------------------------
		// LOG END
				$items = 0;
				$query = " EXEC usp_pos_OperationsLogsManage
						 'END', '".$webservice."',
						 '".$key."', '".getCurrentPageScript()."',
						 '1','999',
						 '0', '0',
						 '".$cardnumber."', '0',
						 '".$actionerrorid."',
						 '".$_SERVER['REMOTE_ADDR']."',
						 'response=".str_replace("'","",json_encode($response))."',
						 'JSON', '".$bitacoraid."';";
				$dboperaciones->query($query);
		// --------------------------------------------------	
	
	// DATABASE CONNECTION CLOSE
		//include_once('../includes/databaseconnectionrelease.php');	

		
	// OUTPUT
		// set header as json
		//header("Content-type: application/json");
		
		// send response
		//echo json_encode($response);

	$vMail->Subject = "[LOG] ".$proceso;
	//$vMail->Body = json_encode($response));
	$vMail->Body = str_replace("'","",json_encode($request,true));
	if(!$vMail->send()){ $response = array("vErrorId"=>"8"); }
			
?>