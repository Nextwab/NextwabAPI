<?php 
namespace Nextwab\Core;

class Config {
	
	// Variables initialisation
	const API_BASE_URL = "https://api.nextwab.com";
	
	protected $use_raw_url;
	protected $disable_ssl_check;
	
	// Construct
	public function __construct()
		{
		$this->use_raw_url = false;
		$this->disable_ssl_check = false;
		}
	
	// Convert Rule into URL Endpoint
	public static function GetEndpointOf( \Nextwab\Core\InternalExchange  $RuleName  )
		{
		$URL 		= $RuleName->getData('URL');
		$Datas 		= $RuleName->getData('Datas');
		$NextwabAPI 	= $RuleName->getData('NextwabAPI');
		
		$EndPoints 	= array(
		
		// VPS 
		'VPS_Creation' 		=> '/vps/create.php' ,
		'VPS_GetPricing' 		=> '/vps/get_pricing.php' ,
		'VPS_SetRawData' 	=> '/vps/set_data_raw.php' ,
		'VPS_GetList'		=> '/vps/get_list.php' ,
		'VPS_Delete'		=> '/vps/delete.php',
		'VPS_Update'		=> '/vps/update.php'	
		
		// Other Endpoint will be writed here
		);		
		
		// If endpoint exist
		if( isset($EndPoints[ $URL ]) )
			{
			// Return an InternalExchange with Data
			return \Nextwab\Core\InternalExchange::Success( array('NextwabAPI' => $NextwabAPI, 'URL' => self::API_BASE_URL.$EndPoints[ $URL ] , 'Datas' => $Datas )   ) ;
			}
		else
			{
			// Return an InternalExchange with Error	
			return \Nextwab\Core\InternalExchange::Error('CLIENT_API_ERROR' , 'URL Rule not found');
			}
		}
		
	// Set configuration variable
	public function Set($Name, $Value)
		{
		$this->{$Name} = $Value;
		}	
	
	// Get configuration variable
	public function Get($Name)
		{
		return $this->{$Name};
		}	
		
	}
?>