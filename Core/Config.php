<?php

namespace Nextwab\Core;

class Config {

    // Variables initialisation
    const API_BASE_URL = "https://api.nextwab.com";

    protected $use_raw_url;
    protected $disable_ssl_check;

    // Construct
    public function __construct() {
        $this->use_raw_url       = false;
        $this->disable_ssl_check = false;
    }

    // Convert Rule into URL Endpoint
    public static function GetEndpointOf(\Nextwab\Core\InternalExchange $RuleName) {
        $URL        = $RuleName->getData('URL');
        $Datas      = $RuleName->getData('Datas');
        $NextwabAPI = $RuleName->getData('NextwabAPI');

        $EndPoints = array(
            // VPS 
            'VPS_Creation'           => '/vps/create.php',
            'VPS_GetPricing'         => '/vps/get_pricing.php',
            'VPS_SetRawData'         => '/vps/set_data_raw.php',
            'VPS_GetList'            => '/vps/GetList',
            'VPS_Delete'             => '/vps/delete.php',
            'VPS_Update'             => '/vps/update.php',
            'VPS_SetPower'           => '/vps/set_power.php',
            // TICKET
            'TICKET_Add'             => '/tickets/add.php',
            'TICKET_GetList'         => '/tickets/get_list.php',
            // USER
            'USER_Creation'          => '/account/create.php',
            'USER_GetInfos'          => '/account/infos.php',
            'USER_Login'             => '/account/login.php',
            'USER_Check_API_Key'     => '/account/check_api_key.php',
            // DOMAIN
            'Domain_GetList'         => '/domains/get_list.php',
            'Domain_Buy'             => '/domains/buy.php',
            'Domain_Add'             => '/domains/add.php',
            'Domain_Delete'          => '/domains/delete.php',
            'Domain_Set_NameServers' => '/domain/Set_NameServers',
            // MAIL
            'Mailbox_Add'            => '/mailbox/Create',
            'Mailbox_UpdatePassword' => '/mailbox/UpdatePassword',
            'Mailbox_GetList'        => '/mailbox/GetList',
            'Mailbox_Delete'         => '/mailbox/Delete',
            'MailboxAlias_Add'       => '/mailbox_alias/Create',
            'MailboxAlias_GetList'   => '/mailbox_alias/GetList',
            // MySQL
            'MySQL_GetList'          => '/mysql/get_list.php',
            'MySQL_AddUser'          => '/mysql/add_user.php',
            'MySQL_DeleteUser'       => '/mysql/delete_user.php',
            'MySQL_AddDatabase'      => '/mysql/add_database.php',
            'MySQL_DeleteDatabase'   => '/mysql/delete_database.php',
            // CMS
            'CMS_GetList'            => '/cms/get_list.php',
            'CMS_Install'            => '/cms/install.php'
                // Other Endpoint will be writed here
        );

        // If endpoint exist
        if (isset($EndPoints[$URL])) {
            // Return an InternalExchange with Data
            return \Nextwab\Core\InternalExchange::Success(array('NextwabAPI' => $NextwabAPI, 'URL' => self::API_BASE_URL . $EndPoints[$URL], 'Datas' => $Datas));
        } else {
            // Return an InternalExchange with Error    
            return \Nextwab\Core\InternalExchange::Error('CLIENT_API_ERROR', 'URL Rule not found');
        }
    }

    // Set configuration variable
    public function Set($Name, $Value) {
        $this->{$Name} = $Value;
    }

    // Get configuration variable
    public function Get($Name) {
        return $this->{$Name};
    }

}

?>