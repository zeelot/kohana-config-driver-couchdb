<?php defined('SYSPATH') or die('No direct script access.');

/**
 * CouchDB writer for the kohana config system
 *
 * @package    CouchDB
 * @category   Configuration
 * @author     Zeelot (Lorenzo Pisani)
 * @copyright  (c) 2011 Lorenzo Pisani
 */
class Config_CouchDB_Writer extends Config_CouchDB_Reader implements Kohana_Config_Writer {

	/**
	 * Writes the passed config for $group
	 *
	 * Returns chainable instance on success or throws
	 * Kohana_Config_Exception on failure
	 *
	 * @param string      $group  The config group
	 * @param string      $key    The config key to write to
	 * @param array       $config The configuration to write
	 * @return boolean
	 */
	public function write($group, $key, $config)
	{
		$document = $this->_get_document($group);

		if ($document === FALSE)
		{
			// Create a new one
			$data = array(
				'values' => array(
					$key => $config,
				),
			);
		}
		else
		{
			$data = $document->body;
			$data['values'][$key] = $config;
		}

		$this->_sag->put($this->_document_prefix.$group, $data);

		return TRUE;
	}
}