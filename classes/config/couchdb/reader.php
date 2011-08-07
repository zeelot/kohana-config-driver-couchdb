<?php defined('SYSPATH') or die('No direct script access.');

/**
 * CouchDB reader for the kohana config system
 *
 * @package    CouchDB
 * @category   Configuration
 * @author     Zeelot (Lorenzo Pisani)
 * @copyright  (c) 2011 Lorenzo Pisani
 */
class Config_CouchDB_Reader implements Kohana_Config_Reader {

	protected $_document_prefix  = 'config.';

	protected $_sag;

	/**
	 * Constructs the CouchDB reader object
	 *
	 * @param array Configuration for the reader
	 */
	public function __construct(Sag $sag, $document_prefix = NULL)
	{
		if ($document_prefix)
		{
			$this->_document_prefix = $document_prefix;
		}

		$this->_sag = $sag;
	}

	/**
	 * Tries to load the specificed configuration group
	 *
	 * Returns FALSE if group does not exist or an array if it does
	 *
	 * @param  string $group Configuration group
	 * @return boolean|array
	 */
	public function load($group)
	{
		$data = $this->_get_document($group);

		if ($data === FALSE)
		{
			return FALSE;
		}

		return $data->body['values'];
	}

	protected function _get_document($group)
	{
		$document = $this->_sag->get($this->_document_prefix.$group);

		if ($document->status !== '200' OR ! isset($document->body['values']))
		{
			return FALSE;
		}

		return $document;
	}
}