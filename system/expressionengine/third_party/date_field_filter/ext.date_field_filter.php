<?php

/**
 * Date Field Filter - Extension
 *
 * @package		Solspace:Date Field Filter
 * @author		Solspace, Inc.
 * @copyright	Copyright (c) 2008-2013, Solspace, Inc.
 * @link		http://solspace.com/docs/date_field_filter
 * @license		http://www.solspace.com/license_agreement
 * @version		2.1.1
 * @filesource	date_field_filter/ext.date_field_filter.php
 */

class Date_field_filter_ext
{

	var $settings        	= array();
	var $name            	= 'Date Field Filter';
	var $version         	= '2.1.1';
	var $description     	= 'Enables filtering of entries by custom date field.';
	var $settings_exist  	= 'n';
	var $docs_url        	= 'http://solspace.com/docs/date_field_filter/';

	/**
	* PHP 5 Constructor
	*
	* @param	array|string $settings Extension settings associative array or an empty string
	* @since	Version 1.0.0
	*/
	function __construct($settings='')
	{
		$this->EE =& get_instance();
		$this->settings = $settings;
	}


	function channel_entries_sql_where($sql, &$channel)
	{

		/** ----------------------------------------
		/**	Capture other uses of this same hook
		/** ----------------------------------------*/

		if ( is_string( $this->EE->extensions->last_call ) === TRUE )
		{
			$sql	= $this->EE->extensions->last_call;
		}

		/** ----------------------------------------
		/**	Should we proceed?
		/** ----------------------------------------*/

		if ( $this->EE->TMPL->fetch_param('date_field') === FALSE OR $this->EE->TMPL->fetch_param('date_field') == '' )
		{
			return $sql;
		}

		if ( ( $this->EE->TMPL->fetch_param('date_field_start') === FALSE OR $this->EE->TMPL->fetch_param('date_field_start') == '' ) AND ( $this->EE->TMPL->fetch_param('date_field_stop') === FALSE OR $this->EE->TMPL->fetch_param('date_field_stop') == '' ) )
		{
			return $sql;
		}

		if ( empty( $this->EE->TMPL->site_ids ) )
		{
			return $sql;
		}

		/** ----------------------------------------
		/**	Loop for site ids and add DB queries
		/** ----------------------------------------*/

		$sql_a	= array();

		foreach ( $this->EE->TMPL->site_ids as $site_id )
		{
			if ( ! empty( $channel->dfields[$site_id][ $this->EE->TMPL->fetch_param('date_field') ] )  )
			{
				$field_id	= $channel->dfields[$site_id][ $this->EE->TMPL->fetch_param('date_field') ];

				$sql_b	= array();

				if ( $this->EE->TMPL->fetch_param('date_field_start') != '' )
				{
					$sql_b[]	= " ( wd.field_id_{$field_id} >= '".$this->EE->localize->string_to_timestamp( $this->EE->db->escape_str( $this->EE->TMPL->fetch_param('date_field_start') ) )."' AND wd.site_id = " . $this->EE->db->escape_str( $site_id ) . " )";

				}

				if ( $this->EE->TMPL->fetch_param('date_field_stop') != '' )
				{
					$sql_b[]	= " ( wd.field_id_{$field_id} < '".$this->EE->localize->string_to_timestamp( $this->EE->db->escape_str( $this->EE->TMPL->fetch_param('date_field_stop') ) )."' AND wd.site_id = " . $this->EE->db->escape_str( $site_id ) . " )";
				}

				$sql_a[]	= implode( ' AND ', $sql_b );
			}
		}

		if ( ! empty( $sql_a ) )
		{
			/** ----------------------------------------
			/**	Prepare the necessary DB join
			/** ----------------------------------------*/

			if ( strpos($sql, 'LEFT JOIN exp_channel_data') === FALSE )
			{
				$sql = str_replace( 'LEFT JOIN exp_members', 'LEFT JOIN exp_channel_data AS wd ON wd.entry_id = t.entry_id  LEFT JOIN exp_members', $sql );
			}

			/** ----------------------------------------
			/**	Add our new conditions
			/** ----------------------------------------*/

			$sql	.= " AND ( " . implode( ' OR ', $sql_a ) . " )";
		}

		/*
		if ( $SESS->userdata('group_id') == '1' )
		{
			echo "Visible only to Super Admins<br /><br />";
			print_r( $sql );
			echo "<br /><br />Visible only to Super Admins";
		}
		*/
		return $sql;
	}





//  ========================================================================
//  Extension Install/Update/Delete
//  ========================================================================

	/**
	* Methods
	*
	* @access public
	* @since Version 1.0.0
	* @return bool	Always True
	*/
	function methods ()
	{
		/** ----------------------------------------
		/**	Set methods array
		/** ----------------------------------------*/

		$settings	= serialize(array());

		$method_class = 'channel_entries_sql_orderby';
		$method_name  = 'channel_entries_sql_where';
		$method_hook  = 'channel_entries_sql_where';

		$methods	= array(
			$method_class			=> array(
				'class'        => ucfirst( get_class($this) ),
				'method'       => $method_name,
				'hook'         => $method_hook,
				'settings'     => $settings,
				'priority'     => 10,
				'version'      => $this->version,
				'enabled'      => 'y'
			)
		);


		/** ----------------------------------------
		/**	Find out what already exists
		/** ----------------------------------------*/

		$query		= $this->EE->db->query( "SELECT method, hook, version FROM exp_extensions WHERE class = '".ucfirst( get_class($this) )."'" );

		foreach ( $query->result_array() as $row )
		{
			$dbmethods[ $row['method'] ]	= $row;
		}




		$dbmethods	= array();


		/** ----------------------------------------
		/**	Loop and install / update
		/** ----------------------------------------*/

		foreach ( $methods as $key => $val )
		{
			if ( isset( $dbmethods[$key] ) )
			{
				$dump	= array_shift($val);

				$this->EE->db->query( $this->EE->db->update_string( 'exp_extensions', $val, array( 'class' => ucfirst( get_class($this) ), 'method' => $key ) ) );

			}
			else
			{

				$this->EE->db->query( $this->EE->db->insert_string( 'exp_extensions', $val ) );

			}
		}

		/** ----------------------------------------
		/**	Return
		/** ----------------------------------------*/

		return TRUE;
	}





	/**
	* Activates the extension
	* @access public
	* @since Version 1.0.0
	* @return bool	Always True
	*/
	function activate_extension ()
	{
		$this->methods();

		return TRUE;
	}





	/**
	* Update the extension
	*
	* @access public
	* @since Version 1.0.0
	* @return bool	Always True
	*/
	function update_extension ( $current = '' )
	{
		if ( $current == '' OR $current == $this->version )
		{
			return FALSE;
		}

		$this->methods();

		return TRUE;
	}




	/**
	* Disable the extension
	*
	* @access public
	* @since Version 1.0.0
	* @return bool	Always True
	*/
	function disable_extension ()
	{

		$this->EE->db->query("DELETE FROM `exp_extensions` WHERE `class` = '".ucfirst( get_class($this) )."'");

		return TRUE;
	}
}
