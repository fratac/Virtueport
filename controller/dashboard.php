<?php
/*------------------------------------------------------------------------
# VirtuePort
# ------------------------------------------------------------------------
# Copyright (C) 2011 Francesco Tacconi. All Rights Reserved.
# Website: http://www.francescotacconi.it
-------------------------------------------------------------------------*/
// no direct access
defined('_JEXEC') or die('Restricted Access');

// Load framework base classes
jimport('joomla.application.component.controller');

/**
 * The Control Panel controller class
 *
 */
class VirtuePortControllerDashboard extends JController
{
	/**
	 * Displays the Control Panel (main page)
	 * Accessible at index.php?option=com_virtueport
	 */
	function display()
	{
	    
 $doc =& JFactory::getDocument();
        
		JToolBarHelper::title(JText::_( 'esporta'));
	JToolBarHelper::divider();
		
	
		parent::display();
	}

	
}

$controller = new VirtuePortControllerDashboard();
if(!isset($task)) $task = "display"; 
$controller->execute($task);
$controller->redirect();
