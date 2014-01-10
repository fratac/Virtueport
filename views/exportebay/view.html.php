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
class VirtuePortViewexportebay extends JView
{
	function display($tpl = null)
	 {
            $doc =& JFactory::getDocument();
            $doc->addStyleSheet('components/com_virtueport/assets/css/virtueport.css');
            JToolBarHelper::title(JText::_( 'Ebay '),'ebay');
            $text = JText::_('EXPORT');
            JToolBarHelper::save('load',$text);
            JToolBarHelper::cancel();
            parent::display($tpl);
}

}
?>