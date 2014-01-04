<?php
/*------------------------------------------------------------------------
# VirtuePort
# ------------------------------------------------------------------------
# Copyright (C) 2011 Francesco Tacconi. All Rights Reserved.
# Website: http://www.francescotacconi.it
-------------------------------------------------------------------------*/
// no direct access
defined('_JEXEC') or die('Restricted access');
// Require the base controller
require_once (JPATH_COMPONENT.DS.'controller.php');
// Require specific controller if requested
if($controller = JRequest::getVar('controller')) {
	require_once (JPATH_COMPONENT.DS.'controller'.DS.$controller.'.php');
}
// Create the controller
$classname	= 'VirtuePortController'.$controller;
$controller = new $classname( );
// Perform the Request task
$controller->execute( JRequest::getVar('task'));
// Redirect if set by the controller
$controller->redirect();
?>
