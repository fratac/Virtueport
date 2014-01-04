<?php
/*------------------------------------------------------------------------
# VirtuePort
# ------------------------------------------------------------------------
# Copyright (C) 2011 Francesco Tacconi. All Rights Reserved.
# Website: http://www.francescotacconi.it
-------------------------------------------------------------------------*/
// no direct access
   defined('_JEXEC') or die('Restricted Access');
   class VirtuePortModelConfig extends JModel
   {
   
   
  // var $_data;
   
function __construct()
	{
		parent::__construct();
		  $id = 1;
         $this->setId($id);
	}
	
	function setId($id)
	{
		// Set id and wipe data
		$this->_id		= $id;
		$this->_data	= null;
	}

	function &getData()
	{
		// Load the data
		if (empty( $this->_data )) {
			$query = ' SELECT * FROM #__virtueport_config '.
					'  WHERE id = '.$this->_id;
			$this->_db->setQuery( $query );
			$this->_data = $this->_db->loadObject();
		}
		
		if (!$this->_data) {
			$this->_data = new stdClass();
			$this->_data->id = 0;
			$this->_data->gsitename = null;
			$this->_data->gdescription= null;
			$this->_data->default_category = null;
			$this->_data->default_manufacturer = null;
			$this->_data->default_quantite = null;
		}
		return $this->_data;
	}
	
	
	function store()
	{
		$row =& $this->getTable();
		$data = JRequest::get( 'post' );
		
		if (!$row->bind($data)) {
			$this->setError($this->_db->getErrorMsg());
			return false;
		}
		
		if (!$row->check()) {
			$this->setError($this->_db->getErrorMsg());
			return false;
		}
		
		
		if (!$row->store()) {
			$this->setError( $row->_db->getErrorMsg() );
			return false;
		}
		return true;
	}
    
		
 }
 
      

?>