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
	{
        $doc =& JFactory::getDocument();
        //$style = ".icon-virtueport {background-image:url(components/com_virtueport/assets/images/virtueport_icon.png); no-repeat; }";
        //$doc->addStyleDeclaration( $style );
        $doc->addStyleSheet('components/com_virtueport/assets/css/virtueport.css');
        JToolBarHelper::title(JText::_('Virtueport'),'virtueport_icon.png');
        
        JSubMenuHelper::addEntry(JText::_('Dashboard'), 'index.php?option=com_virtueport', false); 
	JSubMenuHelper::addEntry(JText::_('Export RSS'),  'index.php?option=com_virtueport&view=exportrss', true); 
	JSubMenuHelper::addEntry(JText::_('Export Google Merchant'), 'index.php?option=com_virtueport&view=exportxml', true);
	JSubMenuHelper::addEntry(JText::_('Export Ebay'), 'index.php?option=com_virtueport&view=exportebay', true);
	JSubMenuHelper::addEntry(JText::_('Export Yatego'), 'index.php?option=com_virtueport&view=exportyatego', true);
        JSubMenuHelper::addEntry(JText::_('Export EasyFatt'), 'index.php?option=com_virtueport&view=exporteasyfatt', true);
	JSubMenuHelper::addEntry(JText::_('Configuration'), 'index.php?option=com_virtueport&view=config', true);

	parent::display($tpl);
	}
	
}
?>