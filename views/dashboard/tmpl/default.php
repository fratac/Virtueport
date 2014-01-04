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

 <div id="noticebox" style="border: 1px dotted #ccc; width: 40%; padding: 10px; float: right;">
	<p><h3><?php echo JText::_('Virtueport - Virtuemart Export') ?> </h3></p>
    
    <p><?php echo JText::_( "Export Virtuemart Products" ).' - '.JText::_('version 1.1'); ?></p><br />
    <p><?php echo JText::_('Developer') ?> <a href="http://www.francescotacconi.it" target="_new">Francesco Tacconi IT Consulting</a> </p>
</div>

<div style="float:left;clear:none;width:55%">
	
    <div id="cpanel">
        <div style="float:left;">
			<div class="icon">
				<a href="index.php?option=com_virtueport&amp;view=exportrss">
					<img src="components/com_virtueport/images/rss.png" alt="Esporta in rss"><span><?php echo JText::_('RSS') ?></span></a>
			</div>
		</div>
        <div style="float:left;">
			<div class="icon">
				<a href="index.php?option=com_virtueport&amp;view=exportxml">
					<img src="components/com_virtueport/images/txt.png" alt="Esporta in XML"><span><?php echo JText::_('XML') ?></span></a>
			</div>
		</div>
        <div style="float:left;">
			<div class="icon">
				<a href="index.php?option=com_virtueport&amp;view=exportebay">
					<img src="components/com_virtueport/images/csv.png" alt="Esporta in Ebay"><span><?php echo JText::_('Ebay') ?></span></a>
			</div>
		</div>
        
<div style="float:left;">
			<div class="icon">
				<a href="index.php?option=com_virtueport&amp;view=exportyatego">
					<img src="components/com_virtueport/images/csv.png" alt="Esporta in Yatego"><span><?php echo JText::_('Yatego') ?></span></a>
			</div>
		</div>
        <div style="float:left;">
			<div class="icon">
				<a href="index.php?option=com_virtueport&amp;view=config">
					<img src="components/com_virtueport/images/config.png" alt="configurazione"><span><?php echo JText::_('Configurazione') ?></span></a>
			</div>
		</div>
        
       
       
       </div>
		
</div>