<?php

include('../NextwabAPI.php');

// Identifiants API disponibles dans le panel client
$Nextwab_UserName = "test@test.com";
$Nextwab_APIKey   = "123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";

include('_credentials.php');

// Initialisation
$NextwabAPI = new \Nextwab\NextwabAPI();
$NextwabAPI->Login($Nextwab_UserName, $Nextwab_APIKey);

// Configuration de l'API 
$NextwabAPI->Config('use_raw_url', false);
$NextwabAPI->Config('disable_ssl_check', true);

// Données à envoyer en POST
$Datas = array(
    'ID_VPS'    => 00001, // ( ID in VPS Listing : https://github.com/Nextwab/NextwabAPI/blob/master/Examples/Example_VPS_GetList.php )
    'vCores'    => 1,
    'Bandwidth' => 100,
    'Ram'       => 3,
    'Disk'      => 40,
    'IPv4'      => 1,
    'IPv6'      => 0,
);

// Envoi des données
$NextwabAPI->Send('VPS_Update', $Datas);

// Gestion des resultats
$Result     = $NextwabAPI->Result();  // Retour avancé contenant la gestion des erreurs
$API_Result = $NextwabAPI->API_Result(); // Retour d'un tableau PHP contenant la réponse API du serveur; renvoit false en cas d'erreur
// Affichage des résultats
echo '<pre>';
print_r($Result);
echo '</pre>';

echo '<pre>';
print_r($API_Result);
echo '</pre>';
?>
