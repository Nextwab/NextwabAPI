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
    'Account_Mail'                 => "contact@nextwab.com",
    'Account_Password'             => "ABCD1234",
    'Account_PasswordConfirmation' => "ABCD1234",
    'User_Type'                    => "Classic", // ( Classic / Business )
    'User_LastName'                => "Nom",
    'User_FirstName'               => "Prénom",
    'User_Birthday_Day'            => 1,
    'User_Birthday_Month'          => 1,
    'User_Birthday_Year'           => 1990,
    'Address_StreetNumber'         => "15",
    'Address_StreetName'           => "Rue des Halles",
    'Address_ZipCode'              => "75001",
    'Address_City'                 => "Paris",
    'Address_Country'              => "FR",
    'Business_Name'                => 'Nextwab', // Si compte business
    'Business_Identifier'          => '798 730 826', // Si compte business
    'Send_Welcome_Mail'            => true
);

// Envoi des données
$NextwabAPI->Send('USER_Creation', $Datas);

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
