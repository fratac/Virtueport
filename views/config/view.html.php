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
class VirtuePortViewConfig extends JView
{
		 
function display($tpl = null)
	{
	$doc =& JFactory::getDocument();
        $doc->addStyleSheet('components/com_virtueport/assets/css/virtueport.css');
        JToolBarHelper::title(JText::_( 'Config'),'config.png');
	JToolBarHelper::save();
	JToolBarHelper::cancel();

        //get config data
	$row =& JTable::getInstance('Config', 'Table');
	$id = 1; 
        if(!$row->load($id))
	{
		JError::raiseError(500, $row->getError());
	}
        else{
		    $this->assignRef('row',$row);
        }
        $this->assignRef(' gsitename', JRequest::getVar(' gsitename', ''));
        $this->assignRef('gdescription', JRequest::getVar('gdescription', ''));
        $this->assignRef('default_manufacturer', JRequest::getVar('default_manufacturer', ''));
        $this->assignRef('default_quantite', JRequest::getVar('default_quantite', ''));
        $this->assignRef('default_category', JRequest::getVar('default_category', ''));
		parent::display($tpl);
	}
}
?>