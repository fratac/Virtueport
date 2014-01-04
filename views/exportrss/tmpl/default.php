<?php 
/*------------------------------------------------------------------------
# VirtuePort
# ------------------------------------------------------------------------
# Copyright (C) 2011 Francesco Tacconi. All Rights Reserved.
# Website: http://www.francescotacconi.it
-------------------------------------------------------------------------*/
// no direct access

defined('_JEXEC') or die('Restricted access') ?>


<form action="" method="post" name="adminForm" id="adminForm" >


    <input type="hidden" name="option" value="com_virtueport" />
    <input type="hidden" name="task" value="rss" />
	<input type="hidden" name="controller" value="exportrss" />
	</form>
<?php
$msg='Per esportare il file come la configurazione,'.'<br>';
$msg .='Fare clic su Esporta, il file verrà creato nella xml_exports'.'<br>';
$msg .=' nella root del sito, per un flusso di RSS';
echo $msg;
?>

