<?php
/*------------------------------------------------------------------------
# VirtuePort
# ------------------------------------------------------------------------
# Copyright (C) 2011 Francesco Tacconi. All Rights Reserved.
# Website: http://www.francescotacconi.it
-------------------------------------------------------------------------*/
// no direct access
defined('_JEXEC') or die('Restricted Access');

jimport('joomla.application.component.controller');
class VirtuePortControllerConfig extends JController
{
  function __construct()
	{
		parent::__construct();
		
	}
	
	 
	function save()
    {
  
    
       $model = $this->getModel('config');
		if ($model->store($post)) {
			$msg = JText::_( 'Configigurazione salvata!' );
		} else {
			$msg = JText::_( 'Errore' );
		}
		
		$link = 'index.php?option=com_virtueport';
		$this->setRedirect($link, $msg);
    }
function cancel()
	{
		$msg = JText::_( 'Oprazione annullata' );
		$this->setRedirect( 'index.php?option=com_virtueport', $msg );
	}
	
	
	
}
	
?>