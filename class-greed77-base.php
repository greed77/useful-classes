<?php
class Greed77_Base
{
  public $log_file = '';
	public $debug = false;

	function __construct()
	{
		$this->log_file					= __DIR__ . "/debug.greed77.log";
	}

	/**
	 * Allow for dynamic "set" and "get" methods
	 */
	function __call( $method, $args )
	{
		if ( substr( $method, 0, 4 ) == "set_" )
		{
			$target_variable = str_replace( "set_", "", $method );
			if ( is_array( $args ) && count( $args ) == 1 )
			{
				$args = $args[0];
			}
			$this->$target_variable = $args;
		}
		elseif ( substr( $method, 0, 4 ) == "get_" )
		{
			$target_variable = str_replace( "get_", "", $method );
			return $this->$target_variable;
		}
		else{
			return false;
		}
	}

	/**
	 * 
	 */
	function _log( $message, $override = false ) {
		if( $this->debug === true || $override === true ){
			$fp = fopen( $this->log_file, 'a+');
			if( is_array( $message ) || is_object( $message ) ){
				$data = print_r( $message, true );
			} else {
				$data = $message;
			}
			fwrite( $fp, "[" . date( 'd-M-Y H:i:s' ) . "] data:  " . $data . "\n" );
			fclose($fp);
		}
	}

}
