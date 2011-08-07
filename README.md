# Config Driver for CouchDB

*Using CouchDB documents to store config values*

- **Module Version:** 1.0.0
- **Module URL:** <https://github.com/Zeelot/kohana-config-driver-couchdb>
- **Compatible Kohana Version(s):** 3.2.x

## Requirements

The driver currently depends on Sag found here: https://github.com/hyla/sag/tree/hyla/develop however I do plan on rewriting my own CouchDB library so this module will probably be updated at that point to require that.

## Description
This module provides both a reader and writer for using CouchDB to store Kohana config values. Values are stored in documents with a prefix of `config.` by default and are placed in a sub-array named `values`.
Sample document:

	{
		"_id": "config.emails",
		"_rev": "5-b007ecade6bedc17eb574617331d9958",
		"values": {
			"foo": "bar"
		}
	}

## Usage

Create an instance of Sag to pass to the config reader/write and optionally specify the prefix for the document (defaults to `config.`).

	$sag = new Sag($host, $port);
	$sag->setDatabase($db);
	Kohana::$config->attach(new Config_CouchDB_Writer($sag));
	// Or
	Kohana::$config->attach(new Config_CouchDB_Reader($sag));
	// Will look in the document called `config.emails`
	Kohana::$config->load('emails');