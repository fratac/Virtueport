<?php
/* ------------------------------------------------------------------------
  # VirtuePort
  # ------------------------------------------------------------------------
  # Copyright (C) 2011 Francesco Tacconi. All Rights Reserved.
  # Website: http://www.francescotacconi.it
  ------------------------------------------------------------------------- */
// no direct access

defined('_JEXEC') or die('Restricted access');
?>

<div id="noticebox" style="border: 1px dotted #ccc; width: 20%;  padding: 10px; float: right;">
    <p><h3><?php echo JText::_('Virtueport - Virtuemart Export') ?> </h3></p>

<p><?php echo JText::_("Export Virtuemart Products") . ' - ' . JText::_('version 1.1'); ?></p><br />
<p><?php echo JText::_('Developer') ?> <a href="http://www.francescotacconi.it" target="_new">Francesco Tacconi IT Consulting</a> </p>
</div>

<div style="clear:none;width:80%">

    <div id="cpanel">
        <div style="float:left;">
            <div class="icon">
                <a href="index.php?option=com_virtueport&amp;view=exportrss">
                    <img src="components/com_virtueport/assets/images/rss.png" alt="Esporta in rss"><span><?php echo JText::_('RSS') ?></span></a>
            </div>
        </div>
        <div style="float:left;">
            <div class="icon">
                <a href="index.php?option=com_virtueport&amp;view=exportxml">
                    <img src="components/com_virtueport/assets/images/xml.png" alt="Esporta in XML"><span><?php echo JText::_('XML') ?></span></a>
            </div>
        </div>
        <div style="float:left;">
            <div class="icon">
                <a href="index.php?option=com_virtueport&amp;view=exportebay">
                    <img src="components/com_virtueport/assets/images/csv.png" alt="Esporta in Ebay"><span><?php echo JText::_('Ebay') ?></span></a>
            </div>
        </div>

        <div style="float:left;">
            <div class="icon">
                <a href="index.php?option=com_virtueport&amp;view=exportyatego">
                    <img src="components/com_virtueport/assets/images/csv.png" alt="Esporta in Yatego"><span><?php echo JText::_('Yatego') ?></span></a>
            </div>
        </div>
        <div style="float:left;">
            <div class="icon">
                <a href="index.php?option=com_virtueport&amp;view=exporteasyfatt">
                    <img src="components/com_virtueport/assets/images/csv.png" alt="Esporta in EasyFatt"><span><?php echo JText::_('EasyFatt') ?></span></a>
            </div>
        </div>
        <div style="float:left;">
            <div class="icon">
                <a href="index.php?option=com_virtueport&amp;view=config">
                    <img src="components/com_virtueport/assets/images/config.png" alt="configurazione"><span><?php echo JText::_('Configurazione') ?></span></a>
            </div>
        </div>



    </div>

</div>