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
class VirtuePortControllerexportebay extends JController
{
  function __construct()
	{
		parent::__construct();
		
		$this->registerTask('Salva', 'Carica'); 
	}
	
	
	function cancel()
	{
		$msg = JText::_( 'Opeazione annullata' );
		$this->setRedirect( 'index.php?option=com_virtueport', $msg );
	}
	 function load()
    {
        $model = $this->getModel('exportebay');

	$msg='Creato...';
        $model->getexportebay();
        $this->display();
	$this->setRedirect('index.php?option=com_virtueport&view=dashboard', $msg);
    }
	
}
	
$controller = new VirtuePortControllerexportebay();
if (!isset($task)) {
    $task = "display";
}
$controller->execute($task);
$controller->redirect();
?>