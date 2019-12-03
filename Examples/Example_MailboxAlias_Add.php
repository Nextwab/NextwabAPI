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
    'Address_From' => "test@test.fr",
    'Address_To'   => "cible@service.fr",
);

// Envoi des données
$NextwabAPI->Send('MailboxAlias_Add', $Datas);

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
