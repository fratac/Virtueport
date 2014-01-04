<?php
/*------------------------------------------------------------------------
# VirtuePort
# ------------------------------------------------------------------------
# Copyright (C) 2011 Francesco Tacconi. All Rights Reserved.
# Website: http://www.francescotacconi.it
-------------------------------------------------------------------------*/
// no direct access
defined('_JEXEC') or die('Restricted access');


?>
<form action="" method="post" name="adminForm" id="adminForm" >


    <input type="hidden" name="option" value="com_virtueport" />
    <input type="hidden" name="task" value="load" />
    <input type="hidden" name="controller" value="exportebay" />
</form>
<?php
$msg='Per esportare il file come la configurazione,'.'<br>';
$msg .='Fare clic su Esporta, il file verrà creato '.'<br>';
$msg .=' Potete uploadare in Ebay';
echo $msg;
?>