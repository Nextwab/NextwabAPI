<?php
namespace Nextwab\Core;

/*
This class is useful to transport data with success and error management between different methods & class
*/

class InternalExchange {
	
	// Variables initialisation
	protected $Data;
	protected $Success; 
	protected $ErrorLevel; 
	protected $ErrorMessage; 
	
	// Construct
	public function __construct( $Data = array() )
		{
		$this->Data = $Data;	
		$this->Success = true;
		$this->ErrorLevel = '';
		$this->ErrorMessage = '';
		}
	
	
	// Public Interface
	public static function Store($Data)
		{
		return self::Success($Data);	
		}	
	
	public static function Error($ERROR_LEVEL , $ERROR_MESSAGE)
		{
		$Local = new self();	
		$Local->setError($ERROR_LEVEL , $ERROR_MESSAGE);
		
		return $Local;	
		}
		
	public static function Success($Data)
		{
		$Local = new self($Data);	
		return $Local;				
		}
		
	public function getData($Name)
		{
		return $this->Data[$Name];	
		}
	
	
	// Internal & External function to manage data
	public function setSuccess(boolean $State)
		{
		$this->Success = $State;
		}
		
	public function setError($ErrorLevel , $ErrorMessage)
		{
		$this->Success = false;
		$this->ErrorLevel = $ErrorLevel;
		$this->ErrorMessage = $ErrorMessage;
		}
	
		
	// Public Logical Function
	public function valid()
		{
		return $this->Success;	
		}
	
	}
?>