<?php defined('_JEXEC') or die('Restricted Access');
/*------------------------------------------------------------------------
# VirtuePort
# ------------------------------------------------------------------------
# Copyright (C) 2011 Francesco Tacconi. All Rights Reserved.
# Website: http://www.francescotacconi.it
-------------------------------------------------------------------------*/
// no direct access

jimport('joomla.application.component.controller');

class VirtuePortControllerexportrss extends JController
{
        function __construct()
        {
                parent::__construct();
		$this->registerTask('salva', 'RSS'); 
				
        }
 
function cancel()
	{
		$msg = JText::_( 'Operazione annullata' );
		$this->setRedirect( 'index.php?option=com_virtueport', $msg );
	}
	
	
	
	 function RSS()
    {
  
   
        $model = $this->getModel('exportrss');
        
			$msg='RSS creato ';
            $model->getexportxml();
            $this->display();
			$this->setRedirect('index.php?option=com_virtueport&view=dashboard', $msg);	
		
    }
	
		

		
	

}

$controller = new VirtuePortControllerexportrss();
if(!isset($task)) $task = "display"; 
$controller->execute($task);
$controller->redirect();

?>