<?php
namespace Nextwab;

// Childs Classes Loading
require('Core/Config.php');
require('Core/Linker.php');
require('Core/InternalExchange.php');


class NextwabAPI {
	
	// Variables initialisation
	protected 	$ACCOUNT_Username;
	protected 	$ACCOUNT_Password;
	
	protected 	$_Config; 
	protected 	$_Linker;
	
	private 	$Result; 
	
	// Construct
	public function __construct()
		{
		$this->_Config = new \Nextwab\Core\Config();
		$this->_Linker = new \Nextwab\Core\Linker();
		}
	
	// Set Username & API Password
	public function Login($Username , $Password)
		{
		$this->ACCOUNT_Username = $Username;
		$this->ACCOUNT_Password = $Password;
		}
	
	// Set or Get Config Settings
	public function Config($Name, $Value = null)
		{	
		if(isset($Value))
			{
			return $this->_Config->Set($Name, $Value);
			}
		else
			{
			return $this->_Config->Get($Name);	
			}		
		}	
		
	// Return defined Username
	public function GetLoginUsername()
		{
		return $this->ACCOUNT_Username;
		}
	// Return defined Password
	public function GetLoginPassword()
		{
		return $this->ACCOUNT_Password;
		}	
		
	
	// Sender Process
	public function Send($ToURL , $Datas = array() )
		{	
		$ToURL = \Nextwab\Core\InternalExchange::Store( array('NextwabAPI' => $this, 'URL' => $ToURL , 'Datas' => $Datas ) );
		
		if($this->Config('use_raw_url') == false )
			{
			$ToURL = $this->_Config->GetEndpointOf($ToURL);
			}
		
		if( $ToURL->valid() ) 
			{
			$this->Result =  \Nextwab\Core\Linker::Send( $ToURL );  ;
			}
		else
			{
			$this->Result = $ToURL;	
			}	
		}
	
	// Return API Result with error managed
	public function Result()
		{
		return $this->Result;
		}
	
	// Return API Result of server ; Return false if an error occurred
	public function API_Result()
		{
			
		if($this->Result->valid())
			{
			return $this->Result->getData('API_Reply');
			}
			
		return false;
		}	
		
	}

?>