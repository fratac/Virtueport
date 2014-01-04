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
class VirtuePortViewexportrss extends JView
{
	function display($tpl = null)
	 {		$doc =& JFactory::getDocument();        $style = " .icon-48-google-merchant {background-image:url(components/com_virtueport/images/google-merchant.png); no-repeat; }";        $doc->addStyleDeclaration( $style ); 		JToolBarHelper::title(JText::_( 'Google Base : RSS'),'google-merchant.png');				$text = JText::_('EXPORT');		JToolBarHelper::save('rss',$text);		JToolBarHelper::cancel();	 				
		parent::display($tpl);
}
           

	
}
?>