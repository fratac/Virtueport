<?php
/*------------------------------------------------------------------------
# VirtuePort
# ------------------------------------------------------------------------
# Copyright (C) 2011 Francesco Tacconi. All Rights Reserved.
# Website: http://www.francescotacconi.it
-------------------------------------------------------------------------*/
// no direct access

defined('_JEXEC') or die('Restricted access');

jimport('joomla.application.component.view');

class VirtuePortViewDashboard extends JView
{
	function display($tpl = null)
	{ 	$doc =& JFactory::getDocument();    $style = " .icon-48-google-merchant {background-image:url(components/com_virtueport/images/google-merchant.png); no-repeat; }";    $doc->addStyleDeclaration( $style ); 	JToolBarHelper::title(JText::_( 'Google Base'),'google-merchant.png');		JSubMenuHelper::addEntry(JText::_('Dashboard'), 'index.php?option=com_virtueport', false); 
	JSubMenuHelper::addEntry(JText::_('Export RSS'),  'index.php?option=com_virtueport&view=exportrss', true); 
	JSubMenuHelper::addEntry(JText::_('Export XML'), 'index.php?option=com_virtueport&view=exportxml', true);
	JSubMenuHelper::addEntry(JText::_('Export Ebay'), 'index.php?option=com_virtueport&view=exportebay', true);
	
	JSubMenuHelper::addEntry(JText::_('Export Yatego'), 'index.php?option=com_virtueport&view=exportyatego', true);
	 JSubMenuHelper::addEntry(JText::_('Configuration'), 'index.php?option=com_virtueport&view=config', true);
	 
		parent::display($tpl);
	}
	
}
?>