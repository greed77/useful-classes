<?php
require_once( 'class-greed77-base.php' );

class Greed77_FTP extends Greed77_Base
{
  public $ftp_enabled = true;
	public $ftp_host = '';
	public $ftp_user = '';
	public $ftp_pass = '';

	public $local_filename = '';
	public $remote_filename = '';

	public $connection = false;
	public $logged_in = false;

	function __construct( $ftp_host = '', $ftp_user= '', $ftp_pass = '' )
	{
		if ( trim( $ftp_host ) <> '' ) {
			$this->ftp_host = $ftp_host;
			$this->connect();
		}

		if ( trim( $ftp_user ) <> '' ) {
			$this->ftp_user = $ftp_user;
		}

		if ( trim( $ftp_pass ) <> '' ) {
			$this->ftp_pass = $ftp_pass;
		}

		if ( $this->ftp_user <> '' && $this->ftp_pass <> '' ) {
			$this->login();
		}

	}

	function __destruct()
	{
		if ( $this->connection ) {
			ftp_close( $this->connection );
		}
	}

	/**
	 * 
	 */
	function connect( $ftp_host = '' )
	{
		if ( trim( $ftp_host ) <> '' ) {
			$this->ftp_host = $ftp_host;
		}

		if ( $this->ftp_host <> '' ) {
			$this->connection = ftp_connect( $this->ftp_host );
		}
		else{
			return false;
		}
		return $this;
	}

	/**
	 * 
	 */
	function login( $ftp_user = '', $ftp_pass = '' )
	{
		if ( trim( $ftp_user ) <> '' ) {
			$this->ftp_user = $ftp_user;
		}

		if ( trim( $ftp_pass ) <> '' ) {
			$this->ftp_pass = $ftp_pass;
		}

		if ( !$this->connection ) {
			$this->connect();
		}

		if ( $this->ftp_user <> '' && $this->ftp_pass <> '' ) {
			$this->logged_in = ftp_login( $this->connection, $this->ftp_user, $this->ftp_pass );
		}
		else{
			return false;
		}

		return $this;
	}

	/**
	 * Send local file to remote FTP
	 */
	function upload( $local_filename = '', $remote_filename = '' )
	{
		$status = false;
		$message = '';

		if ( trim( $local_filename ) <> '' ) {
			$this->local_filename = $local_filename;
		}

		if ( trim( $remote_filename ) <> '' ) {
			$this->remote_filename = $remote_filename;
		}

		if ( $this->local_filename <> '' ) {
			if ( $this->ftp_enabled ) {
				if ( file_exists( $this->local_filename ) ) {
					if ( !$this->connection ) {
						$this->connect();
					}

					if ( !$this->logged_in ) {
						$this->login();
					}

					if ( $this->logged_in ) {
						$upload_result = ftp_put( $this->connection, $this->remote_filename, $this->local_filename, FTP_BINARY );
						if ( $upload_result ) {
							$status = true;
							$message = "File has been uploaded.\n";
						}
						else{
							$message = "error uploading file to ftp\n";
						}
					}
					else{
						$message = "error connecting to ftp, file not uploaded\n";
					}

					// ftp_close( $conn_id );
				}
				else{
					$message = "The specified file doesn't exist to upload.\n";
				}
			}
			else{
				$message = "FTP disabled. " . $this->order_count . " transactions.";
			}
		}
		else{
			$message = "Local file not specified.";
		}

		return array(
			'status'	=> $status,
			'message'	=> $message,
			);
	}

}
