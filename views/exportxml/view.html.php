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
class VirtuePortViewexportxml extends JView
{
	function display($tpl = null)
	 {
            $doc =& JFactory::getDocument();
            $doc->addStyleSheet('components/com_virtueport/assets/css/virtueport.css');
            $style = " .icon-48-google-merchant {background-image:url(components/com_virtueport/images/xml.png); no-repeat; }";
            $doc->addStyleDeclaration( $style );
            JToolBarHelper::title(JText::_( 'Google Merchant: XML '),'xml.png');
            $text = JText::_('EXPORT');
            JToolBarHelper::save('load',$text);
            JToolBarHelper::cancel();
            parent::display($tpl);
    }

}
?>