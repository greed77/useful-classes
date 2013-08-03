<?php
require_once( __DIR__ . DIRECTORY_SEPARATOR . 'class-greed77-base.php' );

abstract class DB extends Greed77_Base
{
	protected $_query = '';
	protected $_select = array();

	public function __construct()
	{
	}

	abstract protected function _connect();

	public function select( $select = false )
	{
		if ( is_array( $select ) ) {
			foreach ( $select as $key => $value ) {
				if ( is_numeric( $key ) ) {
					$this->_select[] = '' . $value . '';
				}
				else{
					$this->_select[] = '' . $key . ' AS ' . $value;
				}
			}
		}
		else{
			$this->_select[] = $select;
		}

		$this->_query.= 'SELECT ' . implode( ',', $this->_select ) . ' ';

		return $this;
	}

	public function from( $from = false )
	{
		$this->_query.= 'FROM ' . $from . ' ';

		return $this;
	}

	public function where( $where = false )
	{
		$this->_query.= 'WHERE ';

		return $this;
	}

	public function execute()
	{
		return $this->_query;
	}
}