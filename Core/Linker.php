<?php
namespace Nextwab\Core;

/*
Class to make link between Nextwab.com and this server-side
*/

class Linker {
	
	// Command Sending
	public static function Send( \Nextwab\Core\InternalExchange $API_Request )
		{
			
		$NextwabAPI = $API_Request->getData('NextwabAPI');
		
		// Collect data to send & merge login data
		$Datas 				= $API_Request->getData('Datas');
		$Datas['user_mail'] 		= $NextwabAPI->GetLoginUsername();
		$Datas['user_password'] 	= $NextwabAPI->GetLoginPassword();
		
		
		$CURL	= curl_init();
		
		
		// Define CURL Options
		$CURL_Options     = array( 
			CURLOPT_URL => $API_Request->getData('URL'), 
			CURLOPT_HEADER => 0, 
			CURLOPT_POST => true, 
			CURLOPT_POSTFIELDS     => $Datas, 
			CURLOPT_RETURNTRANSFER => true);		
		curl_setopt_array($CURL, $CURL_Options);

		if($NextwabAPI->Config('disable_ssl_check') == true)
			{
			curl_setopt($CURL, CURLOPT_SSL_VERIFYHOST, 0);
			curl_setopt($CURL, CURLOPT_SSL_VERIFYPEER, 0);
			}
		
		
		$Output	= curl_exec($CURL);
		$Infos 	= curl_getinfo($CURL);
		$Error	= curl_error($CURL);
		
		$API_Reply = json_decode($Output, true);
		
		// Instantiate an InternalExchange 
		$Return = \Nextwab\Core\InternalExchange::Store( array('API_Reply' => $API_Reply , 'API_RawReply' => $Output ));
		
		// If CURL Error occured
		if($Error)
			{
			$Return->setError('INTERNAL_SYSTEM_API_ERROR' , $Error);	
			}
		
		// If API Error occured
		if($API_Reply['State'] != 1)
			{
			$Return->setError('REPLY_API_FAILED' , $API_Reply['Message']);		
			}
		
		// Return InternalExchange
		return $Return;
		}
	
	
	}
?>