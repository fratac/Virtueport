<?php

/*------------------------------------------------------------------------
# VirtuePort
# ------------------------------------------------------------------------
# Copyright (C) 2011 Francesco Tacconi. All Rights Reserved.
# Website: http://www.francescotacconi.it
-------------------------------------------------------------------------*/
// no direct access

defined('_JEXEC') or die('Restricted access');

class Tableconfig extends JTable
{
	var $id = null;
	var $default_manufacturer = null;
	var $default_quantite= null;
   	var $default_category = null;
	var $gsitename= null;
   	var $gdescription = null;
	function __construct(&$db)
	{
		parent::__construct('#__virtueport_config','id',$db);
	}

}