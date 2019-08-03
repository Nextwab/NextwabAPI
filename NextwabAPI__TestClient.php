<?php
include('NextwabAPI.php');

// Identifiants API disponibles dans le panel client
$Nextwab_UserName 		= "text@test.com";
$Nextwab_APIKey 		= "123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";

include('_credentials.php');

// Initialisation
$NextwabAPI = new \Nextwab\NextwabAPI();
$NextwabAPI->Login($Nextwab_UserName , $Nextwab_APIKey );

// Configuration de l'API 
$NextwabAPI->Config('use_raw_url' , false);
$NextwabAPI->Config('disable_ssl_check' , true);

// Données à envoyer en POST
$Datas = array(
	'ID' => 000001,
 	'Name' => 'RawDataTest_NAME',
	'Data' => 'RawDataTest_DATA'
	);

// Envoi des données
$NextwabAPI->Send('VPS_SetRawData' , $Datas);

// Gestion des resultats
$Result 		= $NextwabAPI->Result();		// Retour avancé contenant la gestion des erreurs
$API_Result 	= $NextwabAPI->API_Result();	// Retour d'un tableau PHP contenant la réponse API du serveur; renvoit false en cas d'erreur


// Affichage des résultats
echo '<pre>';
print_r($Result);
echo '</pre>';

echo '<pre>';
print_r($API_Result);
echo '</pre>';

?>
