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
				$doc =& JFactory::getDocument();        $style = " .icon-48-google-merchant {background-image:url(components/com_virtueport/images/google-merchant.png); no-repeat; }";        $doc->addStyleDeclaration( $style ); 		JToolBarHelper::title(JText::_( 'Google Base Configurazione'),'google-merchant.png');
		
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